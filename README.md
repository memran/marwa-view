# Marwa\View

A **modern, developer-friendly View Engine** built on top of [Twig](https://twig.symfony.com), designed for **best DX**, **clean integration**, and **PSR-16 fragment caching** — without ever exposing Twig internals.

> ⚙️ Part of the [MarwaPHP](https://github.com/memran) ecosystem.

---

## 🚀 Features

- ✅ Thin wrapper — hides Twig from your app code
- ⚡ PSR-16 fragment caching (`fragment('key', ttl, producer)`)
- 🧠 Familiar DX (`View::render()`, `View::share()`, `view()` in templates)
- 🔒 PSR-12, SOLID, framework-agnostic
- 💾 Automatic cache directory management
- 🧩 Extensible via custom Twig Extensions
- 🧰 Debug-safe with strict variables in dev mode

---

## 📦 Installation

```bash
composer require memran/marwa-view
```

## Quick Start

```bash
use Marwa\View\View;
use Marwa\View\ViewConfig;
use Symfony\Component\Cache\Simple\Psr16Cache; // or any PSR-16 cache

$config = new ViewConfig(
    viewsPath: __DIR__ . '/views',
    cachePath: __DIR__ . '/storage/views',
    debug: true,
    fragmentCache: new Psr16Cache() // optional
);

$view = new View($config);
$view->share('appName', 'EnetFlow');

// Render a view
echo $view->render('home/index', ['title' => 'Welcome']);
```

## Example Template

```bash
{# views/home/index.twig #}
<!DOCTYPE html>
<html>
  <head><title>{{ title }} - {{ appName }}</title></head>
  <body>
    <h1>Hello {{ title }}</h1>
    {{ view('components/footer')|raw }}

    {# Cache fragment for 5 min (300s) #}
    {{ fragment('sidebar', 300, {
      template: 'partials/sidebar',
      data: { name: 'Emran' }
    })|raw }}
  </body>
</html>
```

## Integrating with a Container

```bash
$container->add(Marwa\View\ViewInterface::class, function() {
    $cfg = new ViewConfig(
        viewsPath: base_path('resources/views'),
        cachePath: storage_path('views'),
        debug: env('APP_DEBUG', false)
    );
    return new View($cfg);
});
```

## Testing

```bash
composer test
```

## Requirements

- PHP 8.1 +
- twig/twig ^3.21
- psr/simple-cache ^3.0

## License

MIT © Mohammad Emran
