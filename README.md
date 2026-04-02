# Marwa\View

`Marwa\View` is a small Twig-based view library for PHP applications that want a clean rendering API, optional fragment caching, and theme-aware template resolution without coupling application code to Twig internals.

## Requirements

- PHP 8.1+
- Composer

## Installation

```bash
composer require memran/marwa-view
```

For local development:

```bash
composer install
```

## Quick Start

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
$view->share('appName', 'Marwa Demo');

echo $view->render('home/index', [
    'title' => 'Welcome',
]);
```

Templates are referenced by logical name. `home/index` resolves to `home/index.twig`.

## Features

- Clean `View::render()` and `View::display()` API
- Shared render context via `share()`
- PSR-16 fragment caching through `fragment()`
- Optional theme inheritance with `ThemeBuilder`
- Optional Twig extensions for assets, URLs, dates, text, and translations
- Debug-friendly Twig configuration with strict variables in debug mode

## Configuration

`ViewConfig` validates the template directory and cache directory up front. Cache directories are created automatically when possible.

```php
$config = new ViewConfig(
    viewsPath: __DIR__ . '/views',
    cachePath: __DIR__ . '/storage/views',
    debug: false,
    fragmentCache: $psr16Cache, // optional
);
```

Production recommendations:

- set `debug` to `false`
- use a persistent PSR-16 cache implementation for fragments
- place the Twig cache on a writable disk outside the public web root
- avoid passing unvalidated user input directly into template names or theme names

## Rendering and Partials

```php
echo $view->render('dashboard', [
    'user' => $user,
]);
```

Inside Twig:

```twig
{{ view('components/card', { title: 'Status' })|raw }}
```

## Fragment Caching

```twig
{{ fragment('sidebar', 300, {
    template: 'partials/sidebar',
    data: { user: user }
})|raw }}
```

You can also pass a closure from PHP:

```php
$html = $view->fragment('stats', 60, fn (): string => '<strong>Cached</strong>');
```

## Themes

Themes support template inheritance and theme-specific asset URLs.

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
    new ViewConfig(__DIR__ . '/views', __DIR__ . '/storage/views', true),
    themeBuilder: $themeBuilder,
);

echo $view->render('home/index');
```

Expected theme folder structure:

```text
themes/
  default/
    manifest.php
    views/
    assets/
  tenantA/
    manifest.php
    views/
    assets/
```

Example `manifest.php`:

```php
<?php

return [
    'name' => 'tenantA',
    'parent' => 'default',
    'assets_url' => '/themes/tenantA',
];
```

Inside Twig, `theme_asset('css/app.css')` resolves against the active theme.

## Translation

The bundled `ArrayTranslator` loads locale arrays from a directory of PHP files:

```php
use Marwa\View\Extension\TranslateExtension;
use Marwa\View\Translate\ArrayTranslator;

$translator = new ArrayTranslator('en', __DIR__ . '/lang');

$view = new View($config, [
    new TranslateExtension($translator),
]);
```

Example language file:

```php
<?php

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

## Folder Overview

```text
src/
  Cache/
  Exception/
  Extension/
  Support/
  Theme/
  Translate/
examples/
tests/
```

## Development Workflow

Install dependencies:

```bash
composer install
```

Run the full local quality suite:

```bash
composer ci
```

Available scripts:

- `composer test`
- `composer test:coverage`
- `composer analyse`
- `composer lint`
- `composer fix`
- `composer ci`

## Static Analysis and Linting

- PHPUnit is configured through [`phpunit.xml.dist`](/Users/memran/projects/php-projects/marwa-view/phpunit.xml.dist)
- PHPStan is configured through [`phpstan.neon.dist`](/Users/memran/projects/php-projects/marwa-view/phpstan.neon.dist)
- PHP-CS-Fixer is configured through [`.php-cs-fixer.dist.php`](/Users/memran/projects/php-projects/marwa-view/.php-cs-fixer.dist.php)

## CI

GitHub Actions runs Composer validation, dependency installation, linting, static analysis, and tests on pull requests and pushes. The workflow lives at [`.github/workflows/ci.yml`](/Users/memran/projects/php-projects/marwa-view/.github/workflows/ci.yml).

## Deployment Notes

- warm up Composer autoloading with `composer install --no-dev --optimize-autoloader`
- ensure the Twig cache path is writable in the target environment
- disable debug mode in production
- expose only compiled/public assets, not cache directories or vendor files
- treat theme manifests and translation files as trusted application code

## Contributing

1. Install dependencies with `composer install`.
2. Make focused changes with tests.
3. Run `composer ci`.
4. Open a pull request describing the problem, approach, and verification.

## Release Notes

Current production-readiness improvements in this iteration:

- fixed theme autoloading and namespace portability issues
- replaced ad hoc themed template rendering with a proper Twig loader
- tightened template and asset path validation
- added PHPUnit coverage for rendering, themes, translator behavior, and path handling
- added PHPStan, PHP-CS-Fixer, Composer quality scripts, and GitHub Actions

## License

MIT
