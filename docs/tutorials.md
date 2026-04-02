# Tutorials

## Quick Start

1. Create a `views/` directory and a writable cache directory.
2. Create a `ViewConfig` instance with the views path and cache path.
3. Construct `View`.
4. Share global data with `share()`.
5. Render templates with `$view->render('home/index', $data)`.

## Basic Renderer Setup

```php
<?php

declare(strict_types=1);

use Marwa\View\View;
use Marwa\View\ViewConfig;

require __DIR__ . '/../vendor/autoload.php';

$config = new ViewConfig(
    viewsPath: __DIR__ . '/../views',
    cachePath: __DIR__ . '/../storage/views',
    debug: true,
);

$view = new View($config);
```

## Shared Data

```php
$view->share('appName', 'Marwa Demo');
$view->share('auth', [
    'id' => 42,
    'name' => 'Avery',
]);
```

## Rendering

```php
echo $view->render('home/index', [
    'title' => 'Dashboard',
]);
```

## Namespaced Views

```php
$config = new ViewConfig(
    viewsPath: __DIR__ . '/../views',
    cachePath: __DIR__ . '/../storage/views',
    debug: true,
    namespaces: [
        'Blog' => __DIR__ . '/../modules/Blog/views',
    ],
);
```

```php
echo $view->render('@Blog/post/show', ['post' => $post]);
```

## Layout Stacks

```php
$view->pushToStack('scripts', '<script src="/app.js"></script>');
$view->prependToStack('head', '<meta name="robots" content="noindex">');
```

```twig
{{ stack('head')|raw }}
{{ stack('scripts')|raw }}
```

## Fragment Caching

```twig
{{ fragment('sidebar', 300, {
    template: 'partials/sidebar',
    data: { user: auth }
})|raw }}
```

## Next

- Continue with the [API Reference](./api.md)
- See optional helpers in [Extensions](./extensions.md)
- Read [Themes](./themes.md) for runtime theme switching
