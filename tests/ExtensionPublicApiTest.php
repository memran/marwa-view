<?php

declare(strict_types=1);

namespace Marwa\View\Tests;

use Marwa\View\Extension\AssetExtension;
use Marwa\View\Extension\DateExtension;
use Marwa\View\Extension\HtmlExtension;
use Marwa\View\Extension\IconExtension;
use Marwa\View\Extension\ImageExtension;
use Marwa\View\Extension\JsonExtension;
use Marwa\View\Extension\ListExtension;
use Marwa\View\Extension\MetaStackExtension;
use Marwa\View\Extension\MoneyExtension;
use Marwa\View\Extension\NumberExtension;
use Marwa\View\Extension\SeoExtension;
use Marwa\View\Extension\StatusExtension;
use Marwa\View\Extension\StringPresentationExtension;
use Marwa\View\Extension\TextExtension;
use Marwa\View\Extension\TranslateExtension;
use Marwa\View\Extension\UrlExtension;
use Marwa\View\Tests\Support\CreatesTemporaryFiles;
use Marwa\View\Translate\ArrayTranslator;
use Marwa\View\ViewInterface;
use PHPUnit\Framework\TestCase;
use Twig\Extension\AbstractExtension;

final class ExtensionPublicApiTest extends TestCase
{
    use CreatesTemporaryFiles;

    protected function tearDown(): void
    {
        $this->cleanupTemporaryPaths();
    }

    public function testAssetExtensionBuildsVersionedAssetUrls(): void
    {
        $callable = $this->functionCallable(new AssetExtension('/static', '123'), 'asset');

        self::assertSame('/static/app.css?v=123', $callable('app.css'));
    }

    public function testUrlExtensionBuildsUrlsAndRoutes(): void
    {
        $extension = new UrlExtension('https://example.com');
        $url = $this->functionCallable($extension, 'url');
        $route = $this->functionCallable($extension, 'route');

        self::assertSame('https://example.com/dashboard', $url('/dashboard'));
        self::assertSame('https://example.com/users?active=1&page=2', $route('users', ['active' => 1, 'page' => 2]));
    }

    public function testHtmlExtensionBuildsClassListsAndAttributes(): void
    {
        $extension = new HtmlExtension();
        $classNames = $this->functionCallable($extension, 'class_names');
        $htmlAttrs = $this->functionCallable($extension, 'html_attrs');

        self::assertSame(
            'btn btn-primary is-active',
            $classNames('btn', ['btn-primary', 'is-active' => true, 'is-disabled' => false])
        );
        self::assertSame(
            'type="button" class="btn btn-primary" disabled data-role="admin"',
            $htmlAttrs([
                'type' => 'button',
                'class' => ['btn', 'btn-primary' => true],
                'disabled' => true,
                'data-role' => 'admin',
            ])
        );
    }

    public function testJsonExtensionEncodesSafeJsonAndScriptTags(): void
    {
        $extension = new JsonExtension();
        $json = $this->functionCallable($extension, 'json');
        $jsonScript = $this->functionCallable($extension, 'json_script');

        self::assertSame('{"tag":"\\u003Cdiv\\u003E"}', $json(['tag' => '<div>']));
        self::assertSame(
            '<script type="application/json" id="payload">{"ok":true}</script>',
            $jsonScript('payload', ['ok' => true])
        );
    }

    public function testMoneyExtensionFormatsKnownAndUnknownCurrencies(): void
    {
        $callable = $this->functionCallable(new MoneyExtension(), 'money');

        self::assertSame('$1,250.50', $callable(1250.5, 'USD'));
        self::assertSame('-JPY 400', $callable(-400, 'JPY'));
        self::assertSame('EUR 19.90', $callable(19.9, 'EUR'));
    }

    public function testNumberExtensionFormatsNumbersPercentagesCompactValuesAndSizes(): void
    {
        $extension = new NumberExtension();
        $number = $this->functionCallable($extension, 'number');
        $percent = $this->functionCallable($extension, 'percent');
        $compact = $this->functionCallable($extension, 'compact_number');
        $size = $this->functionCallable($extension, 'file_size');

        self::assertSame('12,500.50', $number(12500.5, 2));
        self::assertSame('98.2%', $percent(98.2, 1));
        self::assertSame('18.4K', $compact(18420, 1));
        self::assertSame('5 GB', $size(5368709120, 0));
    }

    public function testMetaStackExtensionPushesExpectedTagsIntoStacks(): void
    {
        $view = new class () implements ViewInterface {
            /** @var array<string, list<string>> */
            public array $stacks = [];

            public function render(string $template, array $data = []): string
            {
                return '';
            }

            public function display(string $template, array $data = []): void {}

            public function share(string $name, mixed $value): void {}

            public function clearCache(): void {}

            public function addNamespace(string $namespace, string $path): void {}

            public function pushToStack(string $stack, string $content): void
            {
                $this->stacks[$stack] ??= [];
                $this->stacks[$stack][] = $content;
            }

            public function prependToStack(string $stack, string $content): void {}

            public function renderStack(string $stack, string $glue = "\n"): string
            {
                return implode($glue, $this->stacks[$stack] ?? []);
            }
        };

        $extension = new MetaStackExtension($view);
        $pushMeta = $this->functionCallable($extension, 'push_meta');
        $pushProperty = $this->functionCallable($extension, 'push_property_meta');
        $pushLink = $this->functionCallable($extension, 'push_link_tag');
        $pushScript = $this->functionCallable($extension, 'push_script_tag');

        self::assertSame('', $pushMeta('description', 'Hello'));
        self::assertSame('', $pushProperty('og:title', 'Demo'));
        self::assertSame('', $pushLink('canonical', 'https://demo.test/page'));
        self::assertSame('', $pushScript('/app.js', ['defer' => true]));

        self::assertSame(
            '<meta name="description" content="Hello">' . "\n" .
            '<meta property="og:title" content="Demo">' . "\n" .
            '<link rel="canonical" href="https://demo.test/page">',
            $view->renderStack('head')
        );
        self::assertSame('<script src="/app.js" defer></script>', $view->renderStack('scripts'));
    }

    public function testSeoExtensionPushesSeoTagsIntoHeadStack(): void
    {
        $view = new class () implements ViewInterface {
            /** @var array<string, list<string>> */
            public array $stacks = [];

            public function render(string $template, array $data = []): string
            {
                return '';
            }

            public function display(string $template, array $data = []): void {}

            public function share(string $name, mixed $value): void {}

            public function clearCache(): void {}

            public function addNamespace(string $namespace, string $path): void {}

            public function pushToStack(string $stack, string $content): void
            {
                $this->stacks[$stack] ??= [];
                $this->stacks[$stack][] = $content;
            }

            public function prependToStack(string $stack, string $content): void {}

            public function renderStack(string $stack, string $glue = "\n"): string
            {
                return implode($glue, $this->stacks[$stack] ?? []);
            }
        };

        $extension = new SeoExtension($view);
        $metaTitle = $this->functionCallable($extension, 'meta_title');
        $metaDescription = $this->functionCallable($extension, 'meta_description');
        $canonicalTag = $this->functionCallable($extension, 'canonical_tag');
        $robotsTag = $this->functionCallable($extension, 'robots_tag');
        $ogTag = $this->functionCallable($extension, 'og_tag');

        self::assertSame('', $metaTitle('Demo Page'));
        self::assertSame('', $metaDescription('Page summary'));
        self::assertSame('', $canonicalTag('https://demo.test/docs'));
        self::assertSame('', $robotsTag('index,follow'));
        self::assertSame('', $ogTag('og:type', 'website'));

        self::assertSame(
            '<meta property="og:title" content="Demo Page">' . "\n" .
            '<meta name="description" content="Page summary">' . "\n" .
            '<meta property="og:description" content="Page summary">' . "\n" .
            '<link rel="canonical" href="https://demo.test/docs">' . "\n" .
            '<meta name="robots" content="index,follow">' . "\n" .
            '<meta property="og:type" content="website">',
            $view->renderStack('head')
        );
    }

    public function testIconExtensionRendersConfiguredIconsWithAttributes(): void
    {
        $extension = new IconExtension([
            'spark' => '<svg viewBox="0 0 24 24"><path d="M1 1h22"/></svg>',
        ]);
        $icon = $this->functionCallable($extension, 'icon');
        $hasIcon = $this->functionCallable($extension, 'has_icon');

        self::assertTrue($hasIcon('spark'));
        self::assertSame(
            '<svg class="h-4 w-4" aria-hidden="true" viewBox="0 0 24 24"><path d="M1 1h22"/></svg>',
            $icon('spark', ['class' => 'h-4 w-4', 'aria-hidden' => 'true'])
        );
    }

    public function testListExtensionFormatsHumanReadableLists(): void
    {
        $extension = new ListExtension();
        $joinHuman = $this->functionCallable($extension, 'join_human');
        $oxfordJoin = $this->functionCallable($extension, 'oxford_join');

        self::assertSame('cache and themes', $joinHuman(['cache', 'themes']));
        self::assertSame('cache, themes, and stacks', $oxfordJoin(['cache', 'themes', 'stacks']));
    }

    public function testImageExtensionBuildsImageAttributesAndSrcset(): void
    {
        $extension = new ImageExtension();
        $imageAttrs = $this->functionCallable($extension, 'image_attrs');
        $srcset = $this->functionCallable($extension, 'srcset');

        self::assertSame(
            '/images/panel.svg 1x, /images/panel@2x.svg 2x',
            $srcset(['1x' => '/images/panel.svg', '2x' => '/images/panel@2x.svg'])
        );
        self::assertSame(
            'src="/images/panel.svg" alt="Panel preview" loading="lazy"',
            $imageAttrs('/images/panel.svg', 'Panel preview', ['loading' => 'lazy'])
        );
    }

    public function testStringPresentationExtensionFormatsInitialsHeadlinesExcerptsAndLineBreaks(): void
    {
        $extension = new StringPresentationExtension();
        $initials = $this->functionCallable($extension, 'initials');
        $headline = $this->functionCallable($extension, 'headline');
        $excerpt = $this->functionCallable($extension, 'excerpt');
        $nl2brSafe = $this->functionCallable($extension, 'nl2br_safe');

        self::assertSame('RH', $initials('Riley Harper'));
        self::assertSame('Framework Style Templates', $headline('framework_style_templates'));
        self::assertSame('This is a concise example...', $excerpt('This is a concise example of string presentation helpers in templates.', 28));
        self::assertSame('line 1<br>' . "\n" . 'line 2', $nl2brSafe("line 1\nline 2"));
    }

    public function testStatusExtensionReturnsSemanticLabelsVariantsAndClasses(): void
    {
        $extension = new StatusExtension();
        $label = $this->functionCallable($extension, 'status_label');
        $variant = $this->functionCallable($extension, 'status_variant');
        $classes = $this->functionCallable($extension, 'status_classes');

        self::assertSame('Pending', $label('pending'));
        self::assertSame('success', $variant('active'));
        self::assertSame(
            'rounded-full px-2.5 py-1 text-xs font-semibold bg-rose-500/10 text-rose-300',
            $classes('failed')
        );
    }

    public function testTextExtensionFiltersWorkForDocumentedHelpers(): void
    {
        $extension = new TextExtension();
        $truncate = $this->filterCallable($extension, 'truncate');
        $slugify = $this->filterCallable($extension, 'slugify');
        $upper = $this->filterCallable($extension, 'upper');

        self::assertSame('hello...', $truncate('hello world', 8, '...'));
        self::assertSame('marwa-view-engine', $slugify('Marwa View Engine'));
        self::assertSame('MARWA', $upper('marwa'));
    }

    public function testDateExtensionFormatsAndHumanizesDates(): void
    {
        $extension = new DateExtension();

        self::assertNotSame('', $extension->formatDate('2024-01-15', 'short'));
        self::assertStringContainsString('ago', $extension->timeAgo((new \DateTimeImmutable('-2 hours'))->format(DATE_ATOM)));
        self::assertStringContainsString('in ', $extension->timeAgo((new \DateTimeImmutable('+2 hours'))->format(DATE_ATOM)));
    }

    public function testTranslateExtensionDelegatesToTranslator(): void
    {
        $lang = $this->makeTempDirectory('lang-');
        $this->writeFile($lang . '/en.php', <<<'PHP'
<?php
return [
    'greeting' => 'Hello, :name!',
    'items' => [
        'one' => ':count item',
        'other' => ':count items',
    ],
];
PHP);

        $translator = new ArrayTranslator('en', $lang);
        $extension = new TranslateExtension($translator);

        self::assertSame('Hello, Avery!', $extension->translate('greeting', ['name' => 'Avery']));
        self::assertSame('2 items', $extension->translateChoice('items', 2));
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

    /**
     * @return \Closure(mixed...): mixed
     */
    private function filterCallable(AbstractExtension $extension, string $name): \Closure
    {
        foreach ($extension->getFilters() as $filter) {
            if ($filter->getName() === $name) {
                $callable = $filter->getCallable();
                if ($callable === null || !is_callable($callable)) {
                    throw new \RuntimeException("Twig filter '{$name}' has no callable.");
                }

                return static fn (mixed ...$arguments): mixed => call_user_func_array($callable, $arguments);
            }
        }

        throw new \RuntimeException("Twig filter '{$name}' not found.");
    }
}
