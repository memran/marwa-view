# Create an Extension

This guide shows how to create and register a custom extension for `Marwa\View`.

The package keeps extensions simple:

- extensions are optional
- extensions should stay presentation-focused
- extensions are just Twig extensions registered through `Marwa\View`
- application code still talks to `Marwa\View`, not to Twig directly

## When to Create an Extension

Create an extension when you need reusable template helpers such as:

- formatting helpers
- HTML attribute helpers
- metadata helpers
- UI bridge helpers
- icon rendering helpers

Do not use extensions for:

- database access
- auth/session state
- request mutation
- business logic
- heavy framework services

## 1. Create the Class

Put the class under `src/Extension/`.

Example:

```php
<?php

declare(strict_types=1);

namespace Marwa\View\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class GreetingExtension extends AbstractExtension
{
    /**
     * @return array<int, TwigFunction>
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('greet', [$this, 'greet']),
        ];
    }

    public function greet(string $name): string
    {
        return 'Hello, ' . trim($name) . '!';
    }
}
```

## 2. Register the Extension

Register it when creating the `View` instance:

```php
use Marwa\View\Extension\GreetingExtension;
use Marwa\View\View;
use Marwa\View\ViewConfig;

$view = new View($config, [
    new GreetingExtension(),
]);
```

You can also add it later:

```php
$view->addExtension(new GreetingExtension());
```

## 3. Use It in Templates

```twig
<h1>{{ greet('Avery') }}</h1>
```

Rendered output:

```html
<h1>Hello, Avery!</h1>
```

## Functions vs Filters

Use a function when the helper reads more naturally as an action or utility:

```twig
{{ money(1250.5, 'USD') }}
{{ icon('spark') }}
{{ greet('Avery') }}
```

Use a filter when the helper transforms an existing value:

```twig
{{ title|truncate(40) }}
{{ name|upper }}
```

## Returning HTML Safely

If your extension returns HTML attributes or markup, mark it as safe:

```php
new TwigFunction('badge', [$this, 'badge'], ['is_safe' => ['html']])
```

Example:

```php
public function badge(string $label): string
{
    return '<span class="badge">' . htmlspecialchars($label, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</span>';
}
```

Important:

- only mark output as HTML-safe when you have already escaped it correctly
- never return unescaped user input as safe HTML

## Example: Extension With a Dependency

If the helper needs another service, inject it through the constructor.

```php
<?php

declare(strict_types=1);

namespace Marwa\View\Extension;

use Marwa\View\Translate\TranslatorInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class GreetingExtension extends AbstractExtension
{
    public function __construct(private TranslatorInterface $translator)
    {
    }

    /**
     * @return array<int, TwigFunction>
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('greet_user', [$this, 'greetUser']),
        ];
    }

    public function greetUser(string $name): string
    {
        return $this->translator->translate('greeting', ['name' => $name]);
    }
}
```

Register it:

```php
$view = new View($config, [
    new GreetingExtension($translator),
]);
```

## Example: HTML Attribute Helper

This is the same style used by helpers like `HtmlExtension` and the Alpine bridge.

```php
<?php

declare(strict_types=1);

namespace Marwa\View\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class PanelExtension extends AbstractExtension
{
    /**
     * @return array<int, TwigFunction>
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('panel_attrs', [$this, 'panelAttrs'], ['is_safe' => ['html']]),
        ];
    }

    public function panelAttrs(string $variant): string
    {
        $variant = $variant === 'warning' ? 'warning' : 'default';

        $classes = $variant === 'warning'
            ? 'rounded-xl border border-amber-300 bg-amber-50 p-4'
            : 'rounded-xl border border-slate-200 bg-white p-4';

        return 'class="' . htmlspecialchars($classes, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '"';
    }
}
```

Template usage:

```twig
<section {{ panel_attrs('warning') }}>
  Billing configuration needs review.
</section>
```

## Testing Your Extension

Add a focused test under `tests/`.

Example:

```php
public function testGreetingExtensionReturnsExpectedGreeting(): void
{
    $extension = new GreetingExtension();
    $callable = $this->functionCallable($extension, 'greet');

    self::assertSame('Hello, Avery!', $callable('Avery'));
}
```

For HTML helpers:

- test escaping
- test invalid input
- test optional flags/modifiers
- test exact rendered attribute strings

## Recommended Rules

- keep methods small
- keep output deterministic
- prefer string/array inputs over complex objects unless necessary
- escape HTML output explicitly
- avoid hidden global state
- avoid framework-only dependencies in this package

## Where to Look in This Repository

Good real examples:

- [src/Extension/HtmlExtension.php](../src/Extension/HtmlExtension.php)
- [src/Extension/MetaStackExtension.php](../src/Extension/MetaStackExtension.php)
- [src/Extension/SeoExtension.php](../src/Extension/SeoExtension.php)
- [src/Extension/AlpineExtension.php](../src/Extension/AlpineExtension.php)
- [tests/ExtensionPublicApiTest.php](../tests/ExtensionPublicApiTest.php)
- [tests/AlpineBridgeTest.php](../tests/AlpineBridgeTest.php)

## Next

- Read [Extensions](./extensions.md) for built-in helpers
- Read [API Reference](./api.md) for registration points
