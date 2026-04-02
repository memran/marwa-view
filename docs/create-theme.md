# Create a Theme

This guide shows how to create a full theme for `Marwa\View`.

Use themes when you need:

- frontend/backend skins
- tenant branding
- white-label rendering
- preview/apply/revert workflows
- theme-specific module templates

## 1. Create the Folder Structure

Start with this shape:

```text
themes/
  default/
    manifest.php
    views/
      layout.twig
      home/
        index.twig
```

You can later add:

- `css/`
- `images/`
- `modules/`
- deeper template folders

## 2. Create `manifest.php`

Every theme needs a manifest.

Example:

```php
<?php

declare(strict_types=1);

return [
    'name' => 'default',
    'assets_url' => '/themes/default',
    'meta' => [
        'label' => 'Default Theme',
        'description' => 'Primary application theme',
        'version' => '1.0.0',
        'author' => 'Your Team',
        'preview_image' => '/themes/default/images/preview.png',
        'tags' => ['light', 'core'],
    ],
];
```

Supported manifest fields:

- `name`
- `parent`
- `assets_url`
- `views_path`
- `meta.label`
- `meta.description`
- `meta.version`
- `meta.author`
- `meta.preview_image`
- `meta.tags`

## 3. Create a Base Layout

Example:

```twig
{# themes/default/views/layout.twig #}
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{% block title %}My App{% endblock %}</title>
    <link rel="stylesheet" href="{{ theme_asset('css/app.css') }}">
    {{ stack('head')|raw }}
  </head>
  <body>
    {% block content %}{% endblock %}
    {{ stack('scripts')|raw }}
  </body>
</html>
```

Important helpers in theme templates:

- `theme_asset()`
- `stack()`
- `push()`
- `prepend()`

## 4. Create a Page Template

Example:

```twig
{# themes/default/views/home/index.twig #}
{% extends "layout.twig" %}

{% block title %}Dashboard{% endblock %}

{% block content %}
  <main>
    <h1>Welcome</h1>
  </main>
{% endblock %}
```

## 5. Add Theme Assets

You can store theme CSS or images under your public asset structure.

Example logical usage:

```twig
<img src="{{ theme_asset('images/logo.svg') }}" alt="Theme logo">
```

If `assets_url` is:

```php
'/themes/default'
```

then:

```twig
{{ theme_asset('images/logo.svg') }}
```

resolves to:

```text
/themes/default/images/logo.svg
```

## 6. Bootstrap the Theme System

```php
use Marwa\View\Theme\ThemeBootstrap;
use Marwa\View\View;
use Marwa\View\ViewConfig;

$themeBuilder = ThemeBootstrap::initFromDirectory(
    __DIR__ . '/themes',
    'default'
);

$view = new View(
    new ViewConfig(
        viewsPath: __DIR__ . '/themes/default/views',
        cachePath: __DIR__ . '/storage/views',
        debug: true,
    ),
    [],
    $themeBuilder
);
```

Now:

```php
echo $view->render('home/index');
```

will render through the active theme.

## 7. Create a Child Theme

Add another theme:

```text
themes/
  default/
  dark/
    manifest.php
    views/
      layout.twig
      home/
        index.twig
```

`themes/dark/manifest.php`:

```php
<?php

declare(strict_types=1);

return [
    'name' => 'dark',
    'parent' => 'default',
    'assets_url' => '/themes/dark',
    'meta' => [
        'label' => 'Dark Theme',
    ],
];
```

This gives you inheritance:

- if `dark/views/home/index.twig` exists, use it
- otherwise fall back to `default/views/home/index.twig`

## 8. Switch Themes at Runtime

```php
$themeBuilder->useTheme('dark');
echo $view->render('home/index');
```

## 9. Preview a Theme Without Saving It

```php
$themeBuilder->previewTheme('dark');
echo $view->render('home/index');
```

Then revert:

```php
$themeBuilder->clearPreview();
```

Apply it permanently for the current builder state:

```php
$themeBuilder->applyTheme('dark');
```

## 10. Use Theme Metadata in Templates

These globals are automatically available:

- `_theme_name`
- `_theme_chain`
- `_theme_meta`
- `_theme_selected`
- `_theme_selected_meta`
- `_theme_previewing`
- `_theme_preview`
- `_theme_available`
- `_theme_catalog`

Example:

```twig
<h1>{{ _theme_meta.label }}</h1>

{% if _theme_previewing %}
  <p>Previewing {{ _theme_name }}</p>
{% endif %}
```

## 11. Override a Module Template From a Theme

If your controller renders:

```php
$view->render('@Blog/post/show', ['post' => $post]);
```

the active theme can override it at:

```text
themes/<active-theme>/views/modules/Blog/post/show.twig
```

Example:

```twig
{# themes/dark/views/modules/Blog/post/show.twig #}
{% extends "layout.twig" %}

{% block content %}
  <article>
    <h1>{{ post.title }}</h1>
    <p>Rendered from the dark theme override.</p>
  </article>
{% endblock %}
```

Fallback order:

1. active theme override
2. parent theme override
3. original module template

## 12. Recommended Theme Layout

For larger apps, this structure stays manageable:

```text
themes/
  default/
    manifest.php
    views/
      layout.twig
      home/
        index.twig
      dashboard/
        index.twig
      modules/
        Blog/
          post/
            show.twig
```

## 13. Common Mistakes

- missing `manifest.php`
- invalid `assets_url`
- wrong `views_path`
- trying to render `.twig` manually in application code
- mixing frontend and backend themes into one pool
- putting business logic inside theme templates

## 14. Frontend and Backend Themes

If your app has two theme surfaces, use two separate theme directories and two builders.

Recommended:

```text
themes/
  frontend/
    default/
    dark/
  backend/
    default/
    compact/
```

Then bootstrap them separately:

```php
$frontendThemes = ThemeBootstrap::initFromDirectory(__DIR__ . '/themes/frontend', 'default');
$backendThemes = ThemeBootstrap::initFromDirectory(__DIR__ . '/themes/backend', 'default');
```

## Where to Look in This Repository

Real examples:

- [examples/theme/theme.php](../examples/theme/theme.php)
- [examples/theme/switch-theme.php](../examples/theme/switch-theme.php)
- [examples/theme/themes/default/manifest.php](../examples/theme/themes/default/manifest.php)
- [examples/theme/themes/default/views/layout.twig](../examples/theme/themes/default/views/layout.twig)
- [examples/theme/themes/dark/views/layout.twig](../examples/theme/themes/dark/views/layout.twig)

## Next

- Read [Themes](./themes.md) for the shorter reference
- Read [Module Views](./modules.md) for namespaced template rendering
