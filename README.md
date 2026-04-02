# Marwa\View

[![Packagist Version](https://img.shields.io/packagist/v/memran/marwa-view.svg)](https://packagist.org/packages/memran/marwa-view)
[![Packagist Downloads](https://img.shields.io/packagist/dt/memran/marwa-view.svg)](https://packagist.org/packages/memran/marwa-view)
[![CI](https://github.com/memran/marwa-view/actions/workflows/ci.yml/badge.svg)](https://github.com/memran/marwa-view/actions/workflows/ci.yml)
[![PHP 8.2+](https://img.shields.io/badge/PHP-8.2%2B-777bb4.svg)](https://www.php.net/)
[![PHPStan 2.x](https://img.shields.io/badge/PHPStan-2.x-31C652.svg)](https://phpstan.org/)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](LICENSE)

`Marwa\View` is a framework-agnostic view layer for PHP 8.2+ built on Twig. It gives application code a small public API, optional PSR-16 fragment caching, theme inheritance, and extension points without forcing the rest of the app to depend directly on Twig internals.

Documentation is split into focused guides under [docs/README.md](docs/README.md). Start there to browse tutorials, API references, themes, extensions, examples, and development notes.

## Features

- Small public API centered on `View`, `ViewConfig`, and `ViewInterface`
- Twig-powered rendering with strict variables and auto-reload in debug mode
- Shared view data through `share()`
- Nested partial rendering through `view()` inside templates
- Namespaced views for modular template directories like `@Blog/post/index`
- Layout stack helpers through `push()`, `prepend()`, and `stack()`
- PSR-16 fragment caching through `fragment()`
- Optional runtime theme switching with `ThemeBuilder`
- Theme inheritance for templates and theme-specific asset URLs
- Optional extensions for assets, URLs, text helpers, dates, translations, HTML attributes, Alpine.js directives, JSON output, and money formatting
- PHPUnit, PHPStan 2.x, PHP-CS-Fixer, Composer scripts, and GitHub Actions CI

## Requirements

- PHP 8.2+
- Composer 2

## Installation

```bash
composer require memran/marwa-view
```

For package development:

```bash
composer install
```

## Documentation

- [Documentation Index](docs/README.md)
- [Tutorials](docs/tutorials.md)
- [API Reference](docs/api.md)
- [Module Views](docs/modules.md)
- [Extensions](docs/extensions.md)
- [Create an Extension](docs/create-extension.md)
- [Themes](docs/themes.md)
- [Create a Theme](docs/create-theme.md)
- [Framework Integration](docs/framework-integration.md)
- [Examples](docs/examples.md)
- [Development](docs/development.md)

## Tutorial

### 1. Create a views directory

```text
project/
  views/
    home/
      index.twig
  storage/
    views/
```

### 2. Configure the renderer

```php
<?php

declare(strict_types=1);

use Marwa\View\View;
use Marwa\View\ViewConfig;

require __DIR__ . '/vendor/autoload.php';

$config = new ViewConfig(
    viewsPath: __DIR__ . '/views',
    cachePath: __DIR__ . '/storage/views',
    debug: true,
);

$view = new View($config);
```

### 3. Share global view data

```php
$view->share('appName', 'Marwa Demo');
$view->share('auth', [
    'id' => 42,
    'name' => 'Emran',
]);
```

### 4. Render a template

```php
echo $view->render('home/index', [
    'title' => 'Dashboard',
]);
```

Logical template names are slash-based. `home/index` resolves to `home/index.twig`.

### 5. Use the data in Twig

```twig
{# views/home/index.twig #}
<h1>{{ title }}</h1>
<p>Welcome to {{ appName }}</p>
<p>Signed in as {{ auth.name }}</p>
```

## Public API

### `Marwa\View\ViewConfig`

Creates the renderer configuration and validates paths eagerly.

```php
$config = new ViewConfig(
    viewsPath: __DIR__ . '/views',
    cachePath: __DIR__ . '/storage/views',
    debug: false,
    fragmentCache: $cache, // optional PSR-16 cache
);
```

Constructor arguments:

- `viewsPath`: base directory that contains `.twig` templates
- `cachePath`: writable Twig compilation cache directory
- `debug`: enables Twig debug-friendly behavior
- `fragmentCache`: optional PSR-16 cache used by `fragment()`

### `Marwa\View\View`

Main rendering service.

```php
$view = new View($config, extensions: [
    // optional Twig extensions
]);
```

Public methods:

- `render(string $template, array $data = []): string`
- `display(string $template, array $data = []): void`
- `share(string $name, mixed $value): void`
- `clearCache(): void`
- `addNamespace(string $namespace, string $path): void`
- `pushToStack(string $stack, string $content): void`
- `prependToStack(string $stack, string $content): void`
- `renderStack(string $stack, string $glue = "\n"): string`
- `fragment(string $key, int $ttl, callable|array $producer): string`
- `addExtension(AbstractExtension $extension): void`
- `getThemeBuilder(): ?ThemeBuilder`

### `Marwa\View\ViewInterface`

Stable contract for application code that only needs rendering, shared data, and cache clearing.

### Theme API

The theming system lives under `Marwa\View\Theme`:

- `ThemeConfig`: immutable theme definition
- `ThemeRegistry`: collection of registered themes
- `ThemeResolver`: resolves template and asset lookups through the inheritance chain
- `ThemeBuilder`: runtime facade used by the view layer
- `ThemeBootstrap`: convenience loader that builds themes from a directory structure

### Translation API

The translation helpers live under `Marwa\View\Translate`:

- `TranslatorInterface`
- `ArrayTranslator`

## Usage Guide

### Basic rendering

```php
echo $view->render('dashboard', [
    'user' => $user,
    'metrics' => $metrics,
]);
```

### Shared data

```php
$view->share('csrf', 'token-value');
$view->share('locale', 'en');
```

### Display directly

```php
$view->display('pages/about');
```

### Nested partials in Twig

```twig
{{ view('components/card', { title: 'Status', value: 'Healthy' })|raw }}
```

### Translation

Create language files:

```php
<?php

return [
    'welcome' => [
        'title' => 'Welcome back, :name!',
    ],
    'cart' => [
        'items' => [
            'one' => ':count item',
            'other' => ':count items',
        ],
    ],
];
```

Register the translator:

```php
use Marwa\View\Extension\TranslateExtension;
use Marwa\View\Translate\ArrayTranslator;

$translator = new ArrayTranslator('en', __DIR__ . '/lang');

$view = new View($config, [
    new TranslateExtension($translator),
]);
```

Use it in Twig:

```twig
<h1>{{ t('welcome.title', { name: auth.name }) }}</h1>
<p>{{ tc('cart.items', cartCount) }}</p>
```

Rendered output:

```html
<h1>Welcome back, Avery!</h1>
<p>2 items</p>
```

### Namespaced views

Register a module namespace:

```php
$config = new ViewConfig(
    viewsPath: __DIR__ . '/views',
    cachePath: __DIR__ . '/storage/views',
    debug: true,
    namespaces: [
        'Blog' => __DIR__ . '/modules/Blog/views',
    ],
);
```

Render namespaced templates:

```php
echo $view->render('@Blog/post/show', ['post' => $post]);
```

From Twig:

```twig
{{ view('@Blog/teaser', { appName: appName })|raw }}
```

For full module-specific template setup and controller examples, see [docs/modules.md](docs/modules.md).

### Layout stacks

From PHP:

```php
$view->pushToStack('scripts', '<script src="/app.js"></script>');
$view->prependToStack('head', '<meta name="robots" content="noindex">');
```

From Twig:

```twig
{% set pageScript %}
  <script src="/dashboard.js"></script>
{% endset %}
{{ push('scripts', pageScript) }}
```

Render a stack in the layout:

```twig
{{ stack('head')|raw }}
{{ stack('scripts')|raw }}
```

### Fragment caching

From Twig:

```twig
{{ fragment('sidebar', 300, {
    template: 'partials/sidebar',
    data: { user: auth }
})|raw }}
```

From PHP:

```php
$html = $view->fragment('stats', 60, fn (): string => '<strong>Cached</strong>');
```

### Clearing caches

```php
$view->clearCache();
```

This clears both the PSR-16 fragment cache and compiled Twig cache files for the configured renderer.

## Extensions

The package ships with optional Twig extensions:

- `AssetExtension`
- `UrlExtension`
- `TextExtension`
- `DateExtension`
- `TranslateExtension`
- `HtmlExtension`
- `AlpineExtension`
- `JsonExtension`
- `MoneyExtension`
- `NumberExtension`
- `MetaStackExtension`
- `IconExtension`
- `SeoExtension`
- `ListExtension`
- `ImageExtension`
- `StringPresentationExtension`
- `StatusExtension`

Example:

```php
use Marwa\View\Extension\AlpineExtension;
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
use Marwa\View\Translate\ArrayTranslator;

$translator = new ArrayTranslator('en', __DIR__ . '/lang');

$view = new View($config, [
    new AssetExtension('/static', '1.0.0'),
    new AlpineExtension(),
    new TextExtension(),
    new DateExtension(),
    new HtmlExtension(),
    new ImageExtension(),
    new JsonExtension(),
    new ListExtension(),
    new MoneyExtension(),
    new NumberExtension(),
    new StatusExtension(),
    new StringPresentationExtension(),
    new UrlExtension('https://demo.test'),
    new TranslateExtension($translator),
]);

$view->addExtension(new MetaStackExtension($view));
$view->addExtension(new SeoExtension($view));
$view->addExtension(new IconExtension([
    'spark' => '<svg viewBox="0 0 24 24"><path d="M12 3l2 6 6 2-6 2-2 6-2-6-6-2 6-2 2-6Z"/></svg>',
]));
```

Useful helpers from the new extensions:

```twig
<div {{ ui().data({ open: false }) }}>
  <button {{ ui().click('open = !open') }}>Toggle</button>
</div>

<button {{ html_attrs({
    type: 'button',
    class: ['btn', 'btn-primary'],
    disabled: isDisabled
}) }}>
    Save
</button>

{{ money(1250.5, 'USD') }}
{{ json({ app: appName, locale: locale }) }}
{{ json_script('page-state', { user: auth }) }}
{{ compact_number(18420) }}
{{ file_size(5368709120) }}
{{ icon('spark', { class: 'h-4 w-4' }) }}
{{ push_meta('description', 'Dashboard page') }}
{{ meta_description('Dashboard page') }}
{{ oxford_join(['themes', 'stacks', 'fragments']) }}
<img {{ image_attrs('/images/panel.svg', 'Panel preview', { loading: 'lazy' }) }}>
{{ initials('Riley Harper') }}
{{ headline('framework_style_templates') }}
{{ status_label('pending') }}
{{ status_classes('active') }}
```

`class_names()` accepts strings, flat string lists, or `{ className: condition }` maps. `html_attrs()` supports scalar attributes, boolean attributes, and `class` values built from the same shapes.
`ui()` exposes the optional Alpine bridge so templates can render `x-data`, `x-on:*`, `x-show`, `x-bind:*`, and related directives without handwritten attribute strings.

## Themes

Themes are optional. When enabled, Twig still supports `extends`, `include`, and other loader-based features while the active theme changes at runtime.

### Theme directory structure

```text
themes/
  default/
    manifest.php
    views/
      layout.twig
      home/
        index.twig
    assets/
      css/
        app.css
  dark/
    manifest.php
    views/
      layout.twig
  tenantA/
    manifest.php
    views/
      home/
        index.twig
```

### Theme manifest

```php
<?php

declare(strict_types=1);

return [
    'name' => 'tenantA',
    'parent' => 'dark',
    'assets_url' => '/themes/tenantA',
    'meta' => [
        'label' => 'Tenant A',
        'description' => 'Tenant-specific branding layered on top of the dark base theme.',
        'version' => '1.0.0',
        'author' => 'Example Studio',
        'preview_image' => '/themes/tenantA/images/logo-tenantA.svg',
        'tags' => ['tenant', 'green-accent'],
    ],
];
```

Supported metadata keys:

- `label`
- `description`
- `version`
- `author`
- `preview_image`
- `tags`

### Bootstrap themes from a directory

```php
use Marwa\View\Theme\ThemeBootstrap;
use Marwa\View\View;
use Marwa\View\ViewConfig;

$themeBuilder = ThemeBootstrap::initFromDirectory(
    themesBaseDir: __DIR__ . '/themes',
    defaultTheme: 'default',
);

$themeBuilder->useTheme('tenantA');

$view = new View(
    config: new ViewConfig(
        viewsPath: __DIR__ . '/views',
        cachePath: __DIR__ . '/storage/views',
        debug: true,
    ),
    themeBuilder: $themeBuilder,
);

echo $view->render('home/index');
```

### Access theme data in Twig

Available globals:

- `_theme_name`
- `_theme_chain`
- `_theme_meta`
- `_theme_selected`
- `_theme_selected_meta`
- `_theme_previewing`
- `_theme_preview`
- `_theme_available`
- `_theme_catalog`

Helper function:

```twig
<link rel="stylesheet" href="{{ theme_asset('css/app.css') }}">
```

## Translation

`ArrayTranslator` loads locale files from a directory of PHP arrays.

```php
use Marwa\View\Extension\TranslateExtension;
use Marwa\View\Translate\ArrayTranslator;

$translator = new ArrayTranslator('en', __DIR__ . '/lang');

$view = new View($config, [
    new TranslateExtension($translator),
]);
```

Locale file example:

```php
<?php

declare(strict_types=1);

return [
    'welcome.title' => 'Welcome, :name!',
    'cart.items' => [
        'one' => ':count item',
        'other' => ':count items',
    ],
];
```

Twig usage:

```twig
{{ t('welcome.title', { name: user.name }) }}
{{ tc('cart.items', cartCount) }}
```

## Example Files

The repository includes runnable examples:

- [examples/README.md](examples/README.md): overview of the example structure
- [examples/basic/index.php](examples/basic/index.php): minimal rendering example
- [examples/basic/bootstrap.php](examples/basic/bootstrap.php): configured renderer with extensions, namespaces, and stacks
- [examples/basic/render-demo.php](examples/basic/render-demo.php): simple demo page
- [examples/basic/demo.php](examples/basic/demo.php): larger rendering demo
- [examples/basic/modules/Blog/views/teaser.twig](examples/basic/modules/Blog/views/teaser.twig): namespaced module view example
- [examples/theme/theme.php](examples/theme/theme.php): manual theme registry example
- [examples/theme/themeinit.php](examples/theme/themeinit.php): `ThemeBootstrap` example
- [examples/theme/switch-theme.php](examples/theme/switch-theme.php): admin preview/apply/revert workflow
- [examples/theme/admin-theme-preview.php](examples/theme/admin-theme-preview.php): alias entry point for the admin preview workflow

## 1.0 Readiness Checklist

- Implemented and tested small public API around `View` and `ViewConfig`
- Implemented and tested namespaced views
- Implemented and tested stack helpers for layout injection
- Implemented and tested theming, preview mode, and manifest metadata
- Added PHPUnit, PHPStan 2.x, PHP-CS-Fixer, Composer scripts, and CI
- Locked Composer platform to PHP 8.2 for reproducible dependency resolution
- Added public API regression coverage for documented package surface

Recommended before tagging `1.0.0`:

- publish a changelog policy and semantic versioning policy
- add upgrade notes when public behavior changes
- decide whether future stack/theme extensions belong in-core or in companion packages

## Feature-Claim Audit

Implemented and documented:

- framework-facing `View` API
- Twig-hidden rendering boundary
- fragment caching
- shared globals
- namespaced views
- stack system
- translation helpers with pluralization
- themes with inheritance, switching, preview mode, and manifest metadata

Explicitly not claimed:

- routing
- controllers
- HTTP/session abstraction
- persistence of user or tenant theme preferences
- framework-specific service container integration beyond examples

## Quality Tooling

Available Composer scripts:

- `composer test`
- `composer test:coverage`
- `composer analyse`
- `composer lint`
- `composer fix`
- `composer ci`

Configuration files:

- [phpunit.xml.dist](phpunit.xml.dist)
- [phpstan.neon.dist](phpstan.neon.dist)
- [.php-cs-fixer.dist.php](.php-cs-fixer.dist.php)
- [.github/workflows/ci.yml](.github/workflows/ci.yml)

## Production Notes

- Set `debug` to `false` outside development.
- Use a real PSR-16 cache backend in production.
- Keep Twig cache directories writable but outside the public web root.
- Do not pass raw user input directly to template names or theme names.
- Treat theme manifests and translation files as trusted application code.

## Contributing

1. Run `composer install`.
2. Make focused changes with tests.
3. Run `composer ci`.
4. Open a pull request with the problem, approach, and verification summary.

## License

MIT
