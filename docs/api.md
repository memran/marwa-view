# API Reference

## `Marwa\View\ViewConfig`

Creates the renderer configuration and validates paths eagerly.

Constructor arguments:

- `viewsPath`: base template directory
- `cachePath`: writable Twig cache directory
- `debug`: enables strict variables and auto reload
- `fragmentCache`: optional PSR-16 fragment cache
- `namespaces`: optional namespaced view directories

## `Marwa\View\View`

Main rendering service.

### Public Methods

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

## `Marwa\View\ViewInterface`

Stable contract for app code that only needs rendering and stack support.

## Module View Resolution

Module-specific templates are supported through view namespaces.

Example:

```php
$view->addNamespace('Blog', __DIR__ . '/../modules/Blog/views');
echo $view->render('@Blog/post/show', ['post' => $post]);
```

See [Module Views](./modules.md) for configuration, controller usage, and naming rules.

## Theme API

- `ThemeConfig`
- `ThemeRegistry`
- `ThemeResolver`
- `ThemeBuilder`
- `ThemeBootstrap`

See [Themes](./themes.md) for usage patterns.

## Translation API

- `TranslatorInterface`
- `ArrayTranslator`

## Core Template Helpers

- `view()`
- `fragment()`
- `theme_asset()`
- `push()`
- `prepend()`
- `stack()`

## Optional Extension Helpers

See [Extensions](./extensions.md) for the full helper list and examples.
