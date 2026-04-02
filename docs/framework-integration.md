# Framework Integration

This guide shows how to integrate `Marwa\View` into a framework or custom application using:

- PSR-11 container conventions
- `league/container`
- a service-provider pattern

The goal is to keep `Marwa\View` focused on rendering while the framework provides:

- session
- auth
- request
- caching
- URL generation
- configuration

## Design Rule

`Marwa\View` should not own:

- session state
- auth state
- request lifecycle
- database queries
- flash message persistence

Instead:

- the framework resolves those services
- the provider builds the `View`
- the provider shares safe template data into the renderer

## What the Provider Should Do

A framework-side `ViewServiceProvider` should:

1. register `ViewConfig`
2. register `View`
3. alias `ViewInterface` to `View`
4. bootstrap theme support if needed
5. register extensions
6. share framework globals

## Example With `league/container`

```php
<?php

declare(strict_types=1);

namespace App\Providers;

use League\Container\ServiceProvider\AbstractServiceProvider;
use Marwa\View\Extension\AlpineExtension;
use Marwa\View\Extension\AssetExtension;
use Marwa\View\Extension\DateExtension;
use Marwa\View\Extension\HtmlExtension;
use Marwa\View\Extension\JsonExtension;
use Marwa\View\Extension\MetaStackExtension;
use Marwa\View\Extension\SeoExtension;
use Marwa\View\Extension\TextExtension;
use Marwa\View\Extension\TranslateExtension;
use Marwa\View\Extension\UrlExtension;
use Marwa\View\Theme\ThemeBootstrap;
use Marwa\View\Translate\ArrayTranslator;
use Marwa\View\View;
use Marwa\View\ViewConfig;
use Marwa\View\ViewInterface;
use Psr\Container\ContainerInterface;
use Psr\SimpleCache\CacheInterface;

final class ViewServiceProvider extends AbstractServiceProvider
{
    protected array $provides = [
        View::class,
        ViewInterface::class,
        ViewConfig::class,
    ];

    public function register(): void
    {
        $this->getContainer()->add(ViewConfig::class, function (): ViewConfig {
            return new ViewConfig(
                viewsPath: base_path('resources/views'),
                cachePath: storage_path('views'),
                debug: (bool) config('app.debug'),
                fragmentCache: container()->get(CacheInterface::class),
                namespaces: [
                    'Blog' => base_path('modules/Blog/views'),
                    'Admin' => base_path('modules/Admin/views'),
                ],
            );
        });

        $this->getContainer()->add(View::class, function (): View {
            $container = $this->getContainer();

            $translator = new ArrayTranslator(
                defaultLocale: 'en',
                langPath: base_path('lang')
            );

            $themeBuilder = ThemeBootstrap::initFromDirectory(
                base_path('themes/frontend'),
                'default'
            );

            $session = $container->get(\App\Session\SessionManager::class);
            $savedTheme = $session->get('theme.frontend');

            if (is_string($savedTheme) && $savedTheme !== '') {
                $themeBuilder->useTheme($savedTheme);
            }

            $view = new View(
                $container->get(ViewConfig::class),
                [
                    new AssetExtension('/assets', (string) config('app.version', '1.0.0')),
                    new AlpineExtension(),
                    new TextExtension(),
                    new DateExtension(),
                    new HtmlExtension(),
                    new JsonExtension(),
                    new UrlExtension($container->get(\App\Routing\UrlGenerator::class)->to('/')),
                    new TranslateExtension($translator),
                ],
                $themeBuilder
            );

            $view->addExtension(new MetaStackExtension($view));
            $view->addExtension(new SeoExtension($view));

            $this->shareGlobals($view, $container);

            return $view;
        });

        $this->getContainer()->add(ViewInterface::class, function (): ViewInterface {
            return $this->getContainer()->get(View::class);
        });
    }

    private function shareGlobals(View $view, ContainerInterface $container): void
    {
        $auth = $container->get(\App\Auth\AuthManager::class);
        $session = $container->get(\App\Session\SessionManager::class);
        $request = $container->get(\Psr\Http\Message\ServerRequestInterface::class);

        $view->share('app', [
            'name' => (string) config('app.name', 'My App'),
            'env' => (string) config('app.env', 'production'),
            'debug' => (bool) config('app.debug', false),
        ]);

        $view->share('auth', [
            'check' => $auth->check(),
            'user' => $auth->user(),
        ]);

        $view->share('flash', [
            'success' => $session->get('flash.success'),
            'error' => $session->get('flash.error'),
            'warning' => $session->get('flash.warning'),
        ]);

        $view->share('csrf', $session->token());
        $view->share('request', [
            'path' => $request->getUri()->getPath(),
            'method' => $request->getMethod(),
        ]);
    }
}
```

## Register the Provider

```php
use App\Providers\ViewServiceProvider;
use League\Container\Container;

$container = new Container();
$container->addServiceProvider(new ViewServiceProvider());
```

## Resolve the Renderer

From the container:

```php
$view = $container->get(\Marwa\View\ViewInterface::class);
```

## Controller Usage

Depend on `ViewInterface`, not on Twig.

```php
<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Marwa\View\ViewInterface;

final class DashboardController
{
    public function __construct(private ViewInterface $view)
    {
    }

    public function index(): string
    {
        return $this->view->render('dashboard/index', [
            'stats' => [
                'users' => 1240,
                'revenue' => 18420.55,
            ],
        ]);
    }
}
```

## Template Usage

Because the provider shares globals, templates stay simple:

```twig
<h1>{{ app.name }}</h1>

{% if auth.check %}
  <p>Signed in as {{ auth.user.name }}</p>
{% endif %}

{% if flash.success %}
  <div>{{ flash.success }}</div>
{% endif %}

<form method="post">
  <input type="hidden" name="_token" value="{{ csrf }}">
</form>
```

## Session, Auth, and DB

Recommended split:

- session
  read in the provider or controller, then share the values

- auth
  resolve current user in the auth service, then share it

- db
  query in repositories/services/controllers, then pass the results to `render()`

Do not:

- query the DB inside templates
- call session methods inside templates
- put auth logic inside `Marwa\View` extensions unless the extension depends on a framework interface outside this package

## Frontend and Backend Views

If your framework has separate frontend and backend themes, use separate providers or separate registrations.

Example:

- `FrontendViewServiceProvider`
- `BackendViewServiceProvider`

with separate theme directories:

```text
themes/
  frontend/
    default/
    dark/
  backend/
    default/
    compact/
```

## Optional Debugbar Integration

If your framework has a debugbar service, push its rendered output into view stacks:

```php
$view->pushToStack('head', $debugbar->renderHead());
$view->pushToStack('scripts', $debugbar->renderBody());
```

Layout:

```twig
<head>
  {{ stack('head')|raw }}
</head>
<body>
  {{ stack('scripts')|raw }}
</body>
```

This keeps debug tooling in the framework layer, not in the core view package.

## Recommended Container Bindings

Good bindings to keep in the framework:

- `ViewConfig`
- `View`
- `ViewInterface`
- translator
- theme builder
- cache
- URL generator
- auth manager
- session manager

## Summary

Good provider responsibilities:

- build config
- build the renderer
- register extensions
- share globals
- alias `ViewInterface`

Keep outside the provider:

- feature/business logic
- repository queries not needed for global state
- page-specific data assembly

## Related Documentation

- [API Reference](./api.md)
- [Extensions](./extensions.md)
- [Themes](./themes.md)
- [Create a Theme](./create-theme.md)
