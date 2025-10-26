<?php

declare(strict_types=1);

namespace Marwa\View;

use Marwa\View\Cache\NullCache;
use Marwa\View\Exception\ViewException;
use Psr\SimpleCache\CacheInterface;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;

/**
 * View is a thin-but-powerful façade around Twig.
 * It focuses on DX, hides Twig, and adds PSR-16 fragment caching.
 */
final class View implements ViewInterface
{
    /**
     * @var array<string,mixed>
     */
    private array $sharedData = [];

    private Environment $twig;
    private CacheInterface $fragmentCache;

    /**
     * @param ViewConfig $config
     * @param list<AbstractExtension> $extensions  (optional custom filters/functions/globals providers)
     */
    public function __construct(
        private ViewConfig $config,
        array $extensions = []
    ) {
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

        // register core DX helpers
        $this->twig->addExtension($this->buildCoreExtension());

        // register user-provided extensions
        foreach ($extensions as $ext) {
            $this->twig->addExtension($ext);
        }

        // share() globals should always be visible
        $this->syncSharedGlobals();

        // PSR-16 fragment cache
        $this->fragmentCache = $config->getFragmentCache() ?? new NullCache();
    }

    /**
     * Render template to string with merged shared + local data.
     *
     * @param string $template logical template name without .twig
     * @param array<string,mixed> $data
     */
    public function render(string $template, array $data = []): string
    {
        $tplFile = $this->normalizeTemplateName($template);

        try {
            $merged = array_merge($this->sharedData, $data);

            return $this->twig->render($tplFile, $merged);
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
     * INTERNAL: build our core DX helpers as a Twig Extension
     * without exposing Twig outside of this class.
     */
    private function buildCoreExtension(): AbstractExtension
    {
        // We create an anonymous extension to register helper functions
        return new class($this) extends AbstractExtension {
            public function __construct(private View $view) {}

            /**
             * @return array<int, TwigFunction>
             */
            public function getFunctions(): array
            {
                return [
                    // fragment('key', ttl, fn() => '<html>')
                    // fragment('sidebar', 300, {template:'partials/sidebar', data:{...}})
                    new TwigFunction(
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
                    ),

                    // view() lets you render a nested template from inside a template
                    // {{ view('components/button', {text: 'OK'})|raw }}
                    new TwigFunction(
                        'view',
                        /**
                         * @param string $tpl
                         * @param array<string,mixed> $data
                         */
                        function (string $tpl, array $data = []): string {
                            return $this->view->render($tpl, $data);
                        },
                        ['is_safe' => ['html']]
                    ),
                ];
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
    }

    /**
     * INTERNAL: normalize logical name "home/index" => "home/index.twig"
     */
    private function normalizeTemplateName(string $name): string
    {
        $trimmed = ltrim($name, '/');
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
}
