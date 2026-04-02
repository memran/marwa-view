<?php

declare(strict_types=1);

namespace Marwa\View;

use Marwa\View\Cache\NullCache;
use Marwa\View\Exception\ViewException;
use Marwa\View\Theme\ThemeBuilder;
use Marwa\View\Theme\ThemeTwigLoader;
use Psr\SimpleCache\CacheInterface;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\Loader\FilesystemLoader;
use Twig\Loader\LoaderInterface;
use Twig\TwigFunction;

/**
 * View is a thin-but-powerful façade around Twig.
 * It focuses on DX, hides Twig, and adds PSR-16 fragment caching.
 *
 * Now supports optional ThemeBuilder for multi-tenant / skinning.
 * - If ThemeBuilder is provided, template loading is delegated to a custom
 *   Twig loader so includes/extents remain cacheable and theme-aware.
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

        $loader = $this->createLoader($config, $themeBuilder);

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
            return $this->twig->render($tplLogical, array_merge($this->buildRenderContext(), $data));
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
     * @param callable|array<string,mixed> $producer Either:
     *        - a closure returning HTML string
     *        - OR ['template' => 'partial/sidebar', 'data' => [...]]
     */
    public function fragment(string $key, int $ttl, callable|array $producer): string
    {
        $cacheKey = 'view_fragment:' . $key;

        if ($this->fragmentCache->has($cacheKey)) {
            $cached = $this->fragmentCache->get($cacheKey);
            if (is_string($cached)) {
                return $cached;
            }
        }

        if ($ttl < 0) {
            throw new ViewException('Fragment TTL must be zero or greater.');
        }

        $html = $this->produceFragmentHtml($producer);

        $this->fragmentCache->set($cacheKey, $html, $ttl);

        return $html;
    }

    private function createLoader(ViewConfig $config, ?ThemeBuilder $themeBuilder): LoaderInterface
    {
        if ($themeBuilder !== null) {
            return new ThemeTwigLoader($themeBuilder);
        }

        return new FilesystemLoader($config->getViewsPath());
    }

    /**
     * @return array<string, mixed>
     */
    private function buildRenderContext(): array
    {
        $context = $this->sharedData;

        if ($this->themeBuilder !== null) {
            $context['_theme_name'] = $this->themeBuilder->current();
            $context['_theme_chain'] = $this->themeBuilder->chain();
        }

        return $context;
    }

    /**
     * INTERNAL: normalize logical name "home/index" => "home/index.twig"
     */
    private function normalizeTemplateName(string $name): string
    {
        $name = trim(str_replace('\\', '/', $name));
        if ($name === '' || str_contains($name, "\0")) {
            throw new ViewException('Template name cannot be empty or contain null bytes.');
        }

        $segments = [];
        foreach (explode('/', $name) as $segment) {
            if ($segment === '' || $segment === '.') {
                continue;
            }

            if ($segment === '..') {
                throw new ViewException("Invalid template path '{$name}'");
            }

            $segments[] = $segment;
        }

        if ($segments === []) {
            throw new ViewException("Invalid template path '{$name}'");
        }

        $normalized = implode('/', $segments);
        if (!str_ends_with($normalized, '.twig')) {
            $normalized .= '.twig';
        }

        return $normalized;
    }

    /**
     * INTERNAL: produce HTML for fragment() from either closure or (template,data) array.
     *
     * @param callable|array<string,mixed> $producer
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

        $template = $producer['template'] ?? null;
        if (!is_string($template)) {
            throw new ViewException("fragment producer array must contain 'template' => string");
        }

        /** @var array<string,mixed> $data */
        $data = $producer['data'] ?? [];

        return $this->render($template, $data);
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
        return new class ($this) extends AbstractExtension {
            public function __construct(private View $view) {}

            /**
             * @return array<int, TwigFunction>
             */
            public function getFunctions(): array
            {
                return [
                    new TwigFunction(
                        'fragment',
                        function (string $key, int $ttl, callable|array $producer): string {
                            return $this->view->fragment($key, $ttl, $producer);
                        },
                        ['is_safe' => ['html']]
                    ),
                    new TwigFunction(
                        'view',
                        function (string $tpl, array $data = []): string {
                            return $this->view->render($tpl, $data);
                        },
                        ['is_safe' => ['html']]
                    ),
                    new TwigFunction(
                        'theme_asset',
                        function (string $assetPath): string {
                            $builder = $this->view->getThemeBuilder();

                            return $builder?->asset($assetPath) ?? $assetPath;
                        }
                    ),
                ];
            }
        };
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
