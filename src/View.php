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
     * @var array<string, string>
     */
    private array $namespaces;
    /**
     * @var array<string, list<string>>
     */
    private array $stacks = [];

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
        $this->namespaces    = $config->getNamespaces();

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

    public function addNamespace(string $namespace, string $path): void
    {
        if (preg_match('/^[A-Za-z][A-Za-z0-9_]*$/', $namespace) !== 1) {
            throw new ViewException("Invalid view namespace '{$namespace}'.");
        }

        $resolvedPath = realpath($path);
        if ($resolvedPath === false || !is_dir($resolvedPath)) {
            throw new ViewException("View namespace path '{$path}' is not a directory.");
        }

        $this->namespaces[$namespace] = $resolvedPath;

        $loader = $this->twig->getLoader();
        if ($loader instanceof FilesystemLoader) {
            $loader->addPath($resolvedPath, $namespace);
        } elseif ($loader instanceof ThemeTwigLoader) {
            $loader->addNamespace($namespace, $resolvedPath);
        }
    }

    public function pushToStack(string $stack, string $content): void
    {
        $stack = $this->normalizeStackName($stack);
        $this->stacks[$stack] ??= [];
        $this->stacks[$stack][] = $content;
    }

    public function prependToStack(string $stack, string $content): void
    {
        $stack = $this->normalizeStackName($stack);
        $this->stacks[$stack] ??= [];
        array_unshift($this->stacks[$stack], $content);
    }

    public function renderStack(string $stack, string $glue = "\n"): string
    {
        $stack = $this->normalizeStackName($stack);

        return implode($glue, $this->stacks[$stack] ?? []);
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
            return new ThemeTwigLoader($themeBuilder, $this->namespaces);
        }

        $loader = new FilesystemLoader($config->getViewsPath());
        foreach ($this->namespaces as $namespace => $path) {
            $loader->addPath($path, $namespace);
        }

        return $loader;
    }

    /**
     * @return array<string, mixed>
     */
    private function buildRenderContext(): array
    {
        $context = $this->sharedData;

        if ($this->themeBuilder !== null) {
            $context['_theme_name'] = $this->themeBuilder->current();
            $context['_theme_selected'] = $this->themeBuilder->selected();
            $context['_theme_chain'] = $this->themeBuilder->chain();
            $context['_theme_previewing'] = $this->themeBuilder->isPreviewing();
            $context['_theme_preview'] = $this->themeBuilder->previewingTheme();
            $context['_theme_available'] = $this->themeBuilder->themes();
            $context['_theme_meta'] = $this->themeBuilder->currentConfig()->metadata()->toArray();
            $context['_theme_selected_meta'] = $this->themeBuilder->selectedConfig()->metadata()->toArray();
            $context['_theme_catalog'] = $this->themeBuilder->catalog();
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
                    new TwigFunction(
                        'push',
                        function (string $stack, string $content): string {
                            $this->view->pushToStack($stack, $content);

                            return '';
                        }
                    ),
                    new TwigFunction(
                        'prepend',
                        function (string $stack, string $content): string {
                            $this->view->prependToStack($stack, $content);

                            return '';
                        }
                    ),
                    new TwigFunction(
                        'stack',
                        function (string $stack, string $glue = "\n"): string {
                            return $this->view->renderStack($stack, $glue);
                        },
                        ['is_safe' => ['html']]
                    ),
                ];
            }
        };
    }

    private function normalizeStackName(string $stack): string
    {
        $stack = trim($stack);
        if ($stack === '' || str_contains($stack, "\0")) {
            throw new ViewException('Stack name cannot be empty or contain null bytes.');
        }

        return $stack;
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
