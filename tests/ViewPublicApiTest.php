<?php

declare(strict_types=1);

namespace Marwa\View\Tests;

use Marwa\View\Cache\NullCache;
use Marwa\View\Tests\Support\CreatesTemporaryFiles;
use Marwa\View\View;
use Marwa\View\ViewConfig;
use PHPUnit\Framework\TestCase;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class ViewPublicApiTest extends TestCase
{
    use CreatesTemporaryFiles;

    protected function tearDown(): void
    {
        $this->cleanupTemporaryPaths();
    }

    public function testDisplayWritesRenderedOutput(): void
    {
        $views = $this->makeTempDirectory('views-');
        $cache = $this->makeTempDirectory('cache-');
        $this->writeFile($views . '/hello.twig', 'Hello {{ name }}');

        $view = new View(new ViewConfig($views, $cache, true));

        ob_start();
        $view->display('hello', ['name' => 'Emran']);
        $output = ob_get_clean();

        self::assertSame('Hello Emran', $output);
    }

    public function testShareMakesDataAvailableAcrossRenders(): void
    {
        $views = $this->makeTempDirectory('views-');
        $cache = $this->makeTempDirectory('cache-');
        $this->writeFile($views . '/shared.twig', '{{ app }}:{{ section }}');

        $view = new View(new ViewConfig($views, $cache, true));
        $view->share('app', 'Marwa');

        self::assertSame('Marwa:dashboard', $view->render('shared', ['section' => 'dashboard']));
    }

    public function testAddExtensionRegistersNewTwigFunction(): void
    {
        $views = $this->makeTempDirectory('views-');
        $cache = $this->makeTempDirectory('cache-');
        $this->writeFile($views . '/ext.twig', '{{ helper() }}');

        $view = new View(new ViewConfig($views, $cache, true));
        $view->addExtension(new class () extends AbstractExtension {
            public function getFunctions(): array
            {
                return [
                    new TwigFunction('helper', static fn (): string => 'from-extension'),
                ];
            }
        });

        self::assertSame('from-extension', $view->render('ext'));
    }

    public function testClearCacheRemovesCompiledTwigFiles(): void
    {
        $views = $this->makeTempDirectory('views-');
        $cache = $this->makeTempDirectory('cache-');
        $this->writeFile($views . '/cached.twig', 'Cached template');

        $view = new View(new ViewConfig($views, $cache, false, new NullCache()));
        $view->render('cached');

        self::assertNotSame([], $this->filesInDirectory($cache));

        $view->clearCache();

        self::assertSame([], $this->filesInDirectory($cache));
    }

    public function testAddNamespaceSupportsNamespacedTemplates(): void
    {
        $views = $this->makeTempDirectory('views-');
        $cache = $this->makeTempDirectory('cache-');
        $moduleViews = $this->makeTempDirectory('module-views-');

        $this->writeFile($views . '/page.twig', '{{ view("@Blog/card", { title: "Namespaced" })|raw }}');
        $this->writeFile($moduleViews . '/card.twig', '<article>{{ title }}</article>');

        $view = new View(new ViewConfig($views, $cache, true));
        $view->addNamespace('Blog', $moduleViews);

        self::assertSame('<article>Namespaced</article>', $view->render('page'));
    }

    public function testStacksCanBePushedPrependedAndRendered(): void
    {
        $views = $this->makeTempDirectory('views-');
        $cache = $this->makeTempDirectory('cache-');

        $this->writeFile($views . '/layout.twig', <<<'TWIG'
{% set pushed %}
<script src="/app.js"></script>
{% endset %}
{% set prepended %}
<meta name="robots" content="noindex">
{% endset %}
{{ push('head', pushed) }}
{{ prepend('head', prepended) }}
{{ stack('head', '')|raw }}
TWIG);

        $view = new View(new ViewConfig($views, $cache, true));

        self::assertStringContainsString('<meta name="robots" content="noindex">', $view->render('layout'));
        self::assertStringContainsString('<script src="/app.js"></script>', $view->render('layout'));

        $view->pushToStack('footer', '<script src="/footer.js"></script>');
        $view->prependToStack('footer', '<script src="/vendor.js"></script>');

        self::assertSame("<script src=\"/vendor.js\"></script>\n<script src=\"/footer.js\"></script>", $view->renderStack('footer'));
    }

    /**
     * @return list<string>
     */
    private function filesInDirectory(string $directory): array
    {
        $files = [];
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($directory, \FilesystemIterator::SKIP_DOTS)
        );

        foreach ($iterator as $file) {
            $files[] = $file->getPathname();
        }

        sort($files);

        return $files;
    }
}
