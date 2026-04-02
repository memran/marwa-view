<?php

declare(strict_types=1);

namespace Marwa\View\Tests;

use Marwa\View\Exception\ViewException;
use Marwa\View\Tests\Support\CreatesTemporaryFiles;
use Marwa\View\Tests\Support\InMemoryCache;
use Marwa\View\View;
use Marwa\View\ViewConfig;
use PHPUnit\Framework\TestCase;

final class ViewTest extends TestCase
{
    use CreatesTemporaryFiles;

    protected function tearDown(): void
    {
        $this->cleanupTemporaryPaths();
    }

    public function testRenderUsesSharedDataAndNestedViewHelper(): void
    {
        $views = $this->makeTempDirectory('views-');
        $cache = $this->makeTempDirectory('cache-');

        $this->writeFile($views . '/home.twig', 'Hello {{ name }} from {{ app }} {{ view("partial", {name: name})|raw }}');
        $this->writeFile($views . '/partial.twig', '[{{ name }}]');

        $view = new View(new ViewConfig($views, $cache, true));
        $view->share('app', 'Marwa');

        $output = $view->render('home', ['name' => 'Emran']);

        self::assertSame('Hello Emran from Marwa [Emran]', $output);
    }

    public function testFragmentCachesEmptyStringsAndAvoidsRerendering(): void
    {
        $views = $this->makeTempDirectory('views-');
        $cache = $this->makeTempDirectory('cache-');

        $invocations = 0;
        $view = new View(new ViewConfig($views, $cache, false, new InMemoryCache()));

        $first = $view->fragment('empty', 60, function () use (&$invocations): string {
            $invocations++;

            return '';
        });
        $second = $view->fragment('empty', 60, function () use (&$invocations): string {
            $invocations++;

            return 'should-not-run';
        });

        self::assertSame('', $first);
        self::assertSame('', $second);
        self::assertSame(1, $invocations);
    }

    public function testRenderRejectsTemplateTraversal(): void
    {
        $views = $this->makeTempDirectory('views-');
        $cache = $this->makeTempDirectory('cache-');

        $view = new View(new ViewConfig($views, $cache, true));

        $this->expectException(ViewException::class);
        $view->render('../secrets');
    }
}
