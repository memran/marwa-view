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
