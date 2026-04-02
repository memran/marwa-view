# Marwa\View

[![CI](https://github.com/memran/marwa-view/actions/workflows/ci.yml/badge.svg)](https://github.com/memran/marwa-view/actions/workflows/ci.yml)
[![PHP 8.2+](https://img.shields.io/badge/PHP-8.2%2B-777bb4.svg)](https://www.php.net/)
[![PHPStan 2.x](https://img.shields.io/badge/PHPStan-2.x-31C652.svg)](https://phpstan.org/)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](LICENSE)

`Marwa\View` is a framework-agnostic view layer for PHP 8.2+ built on Twig. It gives application code a small public API, optional PSR-16 fragment caching, theme inheritance, and extension points without forcing the rest of the app to depend directly on Twig internals.

## Features

- Small public API centered on `View`, `ViewConfig`, and `ViewInterface`
- Twig-powered rendering with strict variables and auto-reload in debug mode
- Shared view data through `share()`
- Nested partial rendering through `view()` inside templates
- PSR-16 fragment caching through `fragment()`
- Optional runtime theme switching with `ThemeBuilder`
- Theme inheritance for templates and theme-specific asset URLs
- Optional extensions for assets, URLs, text helpers, dates, and translations
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

Example:

```php
use Marwa\View\Extension\AssetExtension;
use Marwa\View\Extension\DateExtension;
use Marwa\View\Extension\TextExtension;
use Marwa\View\Extension\TranslateExtension;
use Marwa\View\Extension\UrlExtension;
use Marwa\View\Translate\ArrayTranslator;

$translator = new ArrayTranslator('en', __DIR__ . '/lang');

$view = new View($config, [
    new AssetExtension('/static', '1.0.0'),
    new TextExtension(),
    new DateExtension(),
    new UrlExtension('https://example.com'),
    new TranslateExtension($translator),
]);
```

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
        'author' => 'Marwa Team',
        'preview_image' => '/themes/tenantA/assets/images/logo-tenantA.svg',
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

- [examples/index.php](/Users/memran/projects/php-projects/marwa-view/examples/index.php): minimal rendering example
- [examples/bootstrap.php](/Users/memran/projects/php-projects/marwa-view/examples/bootstrap.php): configured renderer with extensions
- [examples/render-demo.php](/Users/memran/projects/php-projects/marwa-view/examples/render-demo.php): simple demo page
- [examples/demo.php](/Users/memran/projects/php-projects/marwa-view/examples/demo.php): larger rendering demo
- [examples/theme.php](/Users/memran/projects/php-projects/marwa-view/examples/theme.php): manual theme registry example
- [examples/themeinit.php](/Users/memran/projects/php-projects/marwa-view/examples/themeinit.php): `ThemeBootstrap` example
- [examples/switch-theme.php](/Users/memran/projects/php-projects/marwa-view/examples/switch-theme.php): admin preview/apply/revert workflow
- [examples/admin-theme-preview.php](/Users/memran/projects/php-projects/marwa-view/examples/admin-theme-preview.php): alias entry point for the admin preview workflow

## Quality Tooling

Available Composer scripts:

- `composer test`
- `composer test:coverage`
- `composer analyse`
- `composer lint`
- `composer fix`
- `composer ci`

Configuration files:

- [phpunit.xml.dist](/Users/memran/projects/php-projects/marwa-view/phpunit.xml.dist)
- [phpstan.neon.dist](/Users/memran/projects/php-projects/marwa-view/phpstan.neon.dist)
- [.php-cs-fixer.dist.php](/Users/memran/projects/php-projects/marwa-view/.php-cs-fixer.dist.php)
- [.github/workflows/ci.yml](/Users/memran/projects/php-projects/marwa-view/.github/workflows/ci.yml)

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
