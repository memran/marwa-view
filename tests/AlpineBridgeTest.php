<?php

declare(strict_types=1);

namespace Marwa\View\Tests;

use Marwa\View\Bridge\Alpine\UiBridge;
use Marwa\View\Extension\AlpineExtension;
use Marwa\View\Tests\Support\CreatesTemporaryFiles;
use Marwa\View\View;
use Marwa\View\ViewConfig;
use PHPUnit\Framework\TestCase;
use Twig\Extension\AbstractExtension;
use Twig\Markup;

final class AlpineBridgeTest extends TestCase
{
    use CreatesTemporaryFiles;

    protected function tearDown(): void
    {
        $this->cleanupTemporaryPaths();
    }

    public function testUiBridgeBuildsSafeAlpineDirectiveAttributes(): void
    {
        $ui = new UiBridge();

        self::assertSame('x-data="{&quot;open&quot;:false}"', (string) $ui->data(['open' => false]));
        self::assertSame('x-on:click="open = !open"', (string) $ui->click('open = !open'));
        self::assertSame('x-show="open"', (string) $ui->show('open'));
        self::assertSame('x-bind:aria-expanded="open"', (string) $ui->bind('aria-expanded', 'open'));
        self::assertSame('x-on:keydown.escape.prevent="close()"', (string) $ui->on('keydown', 'close()', ['escape', 'prevent']));
        self::assertSame('x-cloak', (string) $ui->cloak());
        self::assertSame('x-transition.opacity.duration-200ms', (string) $ui->transition(['opacity', 'duration-200ms']));
    }

    public function testUiBridgeEscapesExpressionsForHtmlAttributeContext(): void
    {
        $ui = new UiBridge();

        self::assertSame(
            'x-text="message &amp;&amp; &quot;&lt;safe&gt;&quot;"',
            (string) $ui->text('message && "<safe>"')
        );
    }

    public function testUiBridgeRejectsInvalidDirectiveFragments(): void
    {
        $ui = new UiBridge();

        $this->expectException(\InvalidArgumentException::class);
        $ui->bind('aria expanded', 'open');
    }

    public function testGlobalUiHelperReturnsReusableBridgeInstance(): void
    {
        self::assertTrue(function_exists('ui'));
        self::assertInstanceOf(UiBridge::class, ui());
        self::assertSame(ui(), ui());
    }

    public function testAlpineExtensionExposesUiFunctionForTemplates(): void
    {
        $extension = new AlpineExtension();
        $ui = $this->functionCallable($extension, 'ui');
        $bridge = $ui();

        self::assertInstanceOf(UiBridge::class, $bridge);
        self::assertInstanceOf(Markup::class, $bridge->click('open = !open'));
        self::assertSame('x-on:click="open = !open"', (string) $bridge->click('open = !open'));
    }

    public function testAlpineExtensionRendersUsableAttributesInsideTwigTemplates(): void
    {
        $views = $this->makeTempDirectory('views-');
        $cache = $this->makeTempDirectory('cache-');

        file_put_contents(
            $views . '/panel.twig',
            '<div {{ ui().data({ open: false }) }}><button {{ ui().click(\'open = !open\') }}>Toggle</button><section {{ ui().show(\'open\') }} {{ ui().cloak() }}>Body</section></div>'
        );

        $view = new View(
            new ViewConfig($views, $cache, true),
            [new AlpineExtension()]
        );

        self::assertSame(
            '<div x-data="{&quot;open&quot;:false}"><button x-on:click="open = !open">Toggle</button><section x-show="open" x-cloak>Body</section></div>',
            $view->render('panel')
        );
    }

    /**
     * @return \Closure(mixed...): mixed
     */
    private function functionCallable(AbstractExtension $extension, string $name): \Closure
    {
        foreach ($extension->getFunctions() as $function) {
            if ($function->getName() === $name) {
                $callable = $function->getCallable();
                if ($callable === null || !is_callable($callable)) {
                    throw new \RuntimeException("Twig function '{$name}' has no callable.");
                }

                return static fn (mixed ...$arguments): mixed => call_user_func_array($callable, $arguments);
            }
        }

        throw new \RuntimeException("Twig function '{$name}' not found.");
    }
}
