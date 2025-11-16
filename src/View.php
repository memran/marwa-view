<?php

declare(strict_types=1);

namespace Marwa\View;

use Marwa\View\Cache\NullCache;
use Marwa\View\Exception\ViewException;
use Marwa\View\Support\Path;
use Marwa\View\Theme\ThemeBuilder;
use Psr\SimpleCache\CacheInterface;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;

/**
 * View is a thin-but-powerful façade around Twig.
 * It focuses on DX, hides Twig, and adds PSR-16 fragment caching.
 *
 * Now supports optional ThemeBuilder for multi-tenant / skinning.
 * - If ThemeBuilder is provided, templates are resolved via ThemeBuilder
 *   and rendered from source (createTemplate()).
 * - Otherwise it falls back to classic Twig FilesystemLoader.
 */
final class View implements ViewInterface
{
    /**
     * @var array<string,mixed>
     */
    private array $sharedData = [];

    private Environment $twig;
    private CacheInterface $fragmentCache;
    private ViewConfig $config;

    /**
     * @var ThemeBuilder|null
     */
    private ?ThemeBuilder $themeBuilder;

    /**
     * @param ViewConfig               $config
     * @param list<AbstractExtension>  $extensions  optional custom filters/functions/globals
     * @param ThemeBuilder|null        $themeBuilder optional theme manager; if null we use default views path
     */
    public function __construct(
        ViewConfig $config,
        array $extensions = [],
        ?ThemeBuilder $themeBuilder = null
    ) {
        $this->config        = $config;
        $this->themeBuilder  = $themeBuilder;

        // If no ThemeBuilder: standard Twig loader bound to a single views path.
        // If ThemeBuilder exists: we still need an Environment, but we won't trust
        // the loader to locate themed templates automatically because theme can
        // change per request. We'll render from source manually in render().
        $loader = new FilesystemLoader($config->getViewsPath());

        $this->twig = new Environment(
            $loader,
            [
                'cache'            => $config->getCachePath(),
                'debug'            => $config->isDebug(),
                'auto_reload'      => $config->isDebug(),
                'strict_variables' => $config->isDebug(), // catch undefined vars in dev
            ]
        );

        // register core DX helpers (fragment(), view(), theme_asset() if available)
        $this->twig->addExtension($this->buildCoreExtension());

        // register caller-provided extensions
        foreach ($extensions as $ext) {
            $this->twig->addExtension($ext);
        }

        // sync shared() globals
        $this->syncSharedGlobals();

        // PSR-16 fragment cache
        $this->fragmentCache = $config->getFragmentCache() ?? new NullCache();
    }

    /**
     * Dynamically add Twig extension after construction
     */
    public function addExtension(AbstractExtension $extension): void
    {
        $this->twig->addExtension($extension);
    }

    /**
     * Render template to string with merged shared + local data.
     *
     * @param string $template logical template name without .twig
     * @param array<string,mixed> $data
     */
    public function render(string $template, array $data = []): string
    {
        $tplLogical = $this->normalizeTemplateName($template);

        try {
            $merged = array_merge($this->sharedData, $data);

            // THEME MODE:
            // If ThemeBuilder is available, we resolve file path via theme
            // inheritance and feed Twig using createTemplate() so we don't
            // have to mutate Twig's loader paths per request.
            if ($this->themeBuilder !== null) {
                $absoluteFile = $this->themeBuilder->template($tplLogical);

                $source = file_get_contents($absoluteFile);
                if ($source === false) {
                    throw new ViewException("Failed to read view file '{$absoluteFile}'");
                }

                $compiled = $this->twig->createTemplate($source);

                // inject theme_asset() callable into render scope
                $merged['theme_asset'] = function (string $assetPath): string {
                    if ($this->themeBuilder === null) {
                        // no theme builder -> no themed asset URL
                        return $assetPath;
                    }
                    return $this->themeBuilder->asset($assetPath);
                };

                return $compiled->render($merged);
            }

            // NON-THEME MODE:
            // Fall back to regular Twig::render() which uses FilesystemLoader root
            return $this->twig->render($tplLogical, $merged);
        } catch (\Throwable $e) {
            throw new ViewException(
                "Failed to render view '{$template}': " . $e->getMessage(),
                previous: $e
            );
        }
    }

    /**
     * Echo rendered result directly.
     *
     * @param string $template
     * @param array<string,mixed> $data
     */
    public function display(string $template, array $data = []): void
    {
        echo $this->render($template, $data);
    }

    /**
     * Add or override a global variable visible in every render().
     * Safe for things like auth user, app config, csrf token, etc.
     *
     * @param string $name
     * @param mixed $value
     */
    public function share(string $name, mixed $value): void
    {
        $this->sharedData[$name] = $value;
        $this->syncSharedGlobals();
    }

    /**
     * Clears PSR-16 fragment cache AND Twig compiled template cache directory.
     */
    public function clearCache(): void
    {
        // clear fragment cache
        $this->fragmentCache->clear();

        // clear twig compiled cache
        $path = $this->config->getCachePath();
        $this->purgeDirectory($path);
    }

    /**
     * Tiny helper for fragment caching inside templates.
     * Usage in template: {{ fragment('sidebar', 300, {user: auth})|raw }}
     *
     * @param string $key    Cache key / logical fragment name
     * @param int $ttl       Cache lifetime in seconds
     * @param callable():string|array<string,mixed> $producer Either:
     *        - a closure returning HTML string
     *        - OR ['template' => 'partial/sidebar', 'data' => [...]]
     */
    public function fragment(string $key, int $ttl, callable|array $producer): string
    {
        $cacheKey = 'view_fragment:' . $key;

        $cached = $this->fragmentCache->get($cacheKey);
        if (is_string($cached) && $cached !== '') {
            return $cached;
        }

        $html = $this->produceFragmentHtml($producer);

        $this->fragmentCache->set($cacheKey, $html, $ttl);

        return $html;
    }

    /**
     * INTERNAL: core DX helpers extension.
     *
     * Registers:
     *  - fragment(key, ttl, producer)
     *  - view(tpl, data)
     *  - theme_asset(path)   [only meaningful if ThemeBuilder exists]
     */
    private function buildCoreExtension(): AbstractExtension
    {
        return new class($this) extends AbstractExtension {
            public function __construct(private View $view) {}

            /**
             * @return array<int, TwigFunction>
             */
            public function getFunctions(): array
            {
                $fns = [];

                // fragment('key', ttl, fn() => '<html>')
                // fragment('sidebar', 300, {template:'partials/sidebar', data:{...}})
                $fns[] = new TwigFunction(
                    'fragment',
                    /**
                     * @param string $key
                     * @param int $ttl
                     * @param callable|array $producer
                     */
                    function (string $key, int $ttl, callable|array $producer): string {
                        return $this->view->fragment($key, $ttl, $producer);
                    },
                    ['is_safe' => ['html']]
                );

                // Render nested partial:
                // {{ view('components/button', {text: 'OK'})|raw }}
                $fns[] = new TwigFunction(
                    'view',
                    /**
                     * @param string $tpl
                     * @param array<string,mixed> $data
                     */
                    function (string $tpl, array $data = []): string {
                        return $this->view->render($tpl, $data);
                    },
                    ['is_safe' => ['html']]
                );

                // theme_asset('css/app.css')
                // will return themed asset URL if ThemeBuilder exists,
                // otherwise we just return the path untouched.
                $fns[] = new TwigFunction(
                    'theme_asset',
                    /**
                     * @param string $assetPath
                     */
                    function (string $assetPath): string {
                        $builder = $this->view->getThemeBuilder();
                        if ($builder === null) {
                            return $assetPath;
                        }
                        return $builder->asset($assetPath);
                    }
                );

                return $fns;
            }
        };
    }

    /**
     * INTERNAL: sync sharedData to Twig's global scope.
     */
    private function syncSharedGlobals(): void
    {
        foreach ($this->sharedData as $key => $value) {
            $this->twig->addGlobal($key, $value);
        }

        // Also expose "theme" info globally if ThemeBuilder exists.
        if ($this->themeBuilder !== null) {
            $this->twig->addGlobal('_theme_name', $this->themeBuilder->current());
            $this->twig->addGlobal('_theme_chain', $this->themeBuilder->chain());
        }
    }

    /**
     * INTERNAL: normalize logical name "home/index" => "home/index.twig"
     */
    private function normalizeTemplateName(string $name): string
    {
        $tplPath = Path::normalize($name);
        $trimmed = ltrim($tplPath, '/');
        if (str_contains($trimmed, '..')) {
            throw new ViewException("Invalid template path '{$name}'");
        }
        return $trimmed . '.twig';
    }

    /**
     * INTERNAL: produce HTML for fragment() from either closure or (template,data) array.
     *
     * @param callable():string|array{template:string,data?:array<string,mixed>} $producer
     */
    private function produceFragmentHtml(callable|array $producer): string
    {
        if (is_callable($producer)) {
            $result = $producer();
            if (!is_string($result)) {
                throw new ViewException('fragment producer closure must return string HTML.');
            }
            return $result;
        }

        if (!isset($producer['template']) || !is_string($producer['template'])) {
            throw new ViewException("fragment producer array must contain 'template' => string");
        }

        /** @var array<string,mixed> $data */
        $data = $producer['data'] ?? [];

        return $this->render($producer['template'], $data);
    }

    /**
     * INTERNAL: delete all files in a directory (Twig cache purge).
     */
    private function purgeDirectory(string $dir): void
    {
        if (!is_dir($dir)) {
            return;
        }

        $items = scandir($dir);
        if ($items === false) {
            return;
        }

        foreach ($items as $item) {
            if ($item === '.' || $item === '..') {
                continue;
            }

            $path = $dir . DIRECTORY_SEPARATOR . $item;
            if (is_dir($path)) {
                $this->purgeDirectory($path);
                @rmdir($path);
            } else {
                @unlink($path);
            }
        }
    }

    /**
     * Expose ThemeBuilder for internal helpers (theme_asset(), etc.).
     * Returns null if View was constructed without a ThemeBuilder.
     */
    public function getThemeBuilder(): ?ThemeBuilder
    {
        return $this->themeBuilder;
    }
}
