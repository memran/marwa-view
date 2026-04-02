<?php

declare(strict_types=1);

namespace Marwa\View\Tests;

use Marwa\View\Tests\Support\CreatesTemporaryFiles;
use Marwa\View\Translate\ArrayTranslator;
use PHPUnit\Framework\TestCase;

final class ArrayTranslatorTest extends TestCase
{
    use CreatesTemporaryFiles;

    protected function tearDown(): void
    {
        $this->cleanupTemporaryPaths();
    }

    public function testTransSupportsNamedReplacementsWithoutColonPrefix(): void
    {
        $lang = $this->makeTempDirectory('lang-');

        $this->writeFile($lang . '/en.php', <<<'PHP'
<?php
return [
    'welcome' => 'Welcome, :name!',
];
PHP);

        $translator = new ArrayTranslator('en', $lang);

        self::assertSame('Welcome, Emran!', $translator->trans('welcome', ['name' => 'Emran']));
    }

    public function testTransChoiceFallsBackToPluralMap(): void
    {
        $lang = $this->makeTempDirectory('lang-');

        $this->writeFile($lang . '/en.php', <<<'PHP'
<?php
return [
    'cart.items' => [
        'one' => ':count item',
        'other' => ':count items',
    ],
];
PHP);

        $translator = new ArrayTranslator('en', $lang);

        self::assertSame('1 item', $translator->transChoice('cart.items', 1));
        self::assertSame('3 items', $translator->transChoice('cart.items', 3));
    }

    public function testSetLocaleRejectsUnknownLocale(): void
    {
        $lang = $this->makeTempDirectory('lang-');

        $this->writeFile($lang . '/en.php', <<<'PHP'
<?php
return [
    'welcome' => 'Welcome',
];
PHP);

        $translator = new ArrayTranslator('en', $lang);

        $this->expectException(\InvalidArgumentException::class);
        $translator->setLocale('bn');
    }
}
