# Themes

Themes are optional and allow runtime switching without exposing Twig internals to application code.

## Capabilities

- runtime theme switching
- preview mode
- apply/revert workflow
- theme inheritance
- theme metadata from manifests
- theme asset URL resolution

## Theme Directory Structure

```text
themes/
  default/
    manifest.php
    views/
      layout.twig
      home/
        index.twig
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

## Manifest Example

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

## Bootstrap

```php
use Marwa\View\Theme\ThemeBootstrap;

$themeBuilder = ThemeBootstrap::initFromDirectory(
    themesBaseDir: __DIR__ . '/../themes',
    defaultTheme: 'default',
);
```

## Runtime Flow

```php
$themeBuilder->previewTheme('dark');
$themeBuilder->applyTheme('dark');
$themeBuilder->clearPreview();
```

## Theme Globals

- `_theme_name`
- `_theme_chain`
- `_theme_meta`
- `_theme_selected`
- `_theme_selected_meta`
- `_theme_previewing`
- `_theme_preview`
- `_theme_available`
- `_theme_catalog`

## Helper

```twig
<link rel="stylesheet" href="{{ theme_asset('css/app.css') }}">
```

## Example Pages

- `examples/theme/theme.php`
- `examples/theme/switch-theme.php`
- `examples/theme/docs.php`
