<?php

declare(strict_types=1);

namespace Marwa\View\Tests;

use Marwa\View\Extension\AssetExtension;
use Marwa\View\Extension\DateExtension;
use Marwa\View\Extension\TextExtension;
use Marwa\View\Extension\TranslateExtension;
use Marwa\View\Extension\UrlExtension;
use Marwa\View\Tests\Support\CreatesTemporaryFiles;
use Marwa\View\Translate\ArrayTranslator;
use PHPUnit\Framework\TestCase;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

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

        self::assertSame('Hello, Emran!', $extension->translate('greeting', ['name' => 'Emran']));
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
