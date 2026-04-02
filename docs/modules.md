# Module Views

`Marwa\View` already supports module-specific templates through namespaced views.

This is the feature you want when each module has its own `views/` folder and the controller should render that module's templates directly.

## What Exists Today

- Yes, module-specific template rendering already exists.
- You configure module view folders as namespaces.
- You render them with `@Namespace/template`.
- This works in both normal rendering mode and theme mode.
- This does **not** currently mean theme override for `@Namespace/...` templates. It simply renders the module's own template when you call it.

## Recommended Folder Structure

```text
app/
  modules/
    Blog/
      views/
        index.twig
        post/
          show.twig
    Shop/
      views/
        cart.twig
  views/
    home/
      index.twig
  storage/
    views/
```

## Configure Module Namespaces

Register module view folders in `ViewConfig`:

```php
<?php

declare(strict_types=1);

use Marwa\View\View;
use Marwa\View\ViewConfig;

$config = new ViewConfig(
    viewsPath: __DIR__ . '/../views',
    cachePath: __DIR__ . '/../storage/views',
    debug: true,
    namespaces: [
        'Blog' => __DIR__ . '/../modules/Blog/views',
        'Shop' => __DIR__ . '/../modules/Shop/views',
    ],
);

$view = new View($config);
```

This means:

- `@Blog/index` resolves to `modules/Blog/views/index.twig`
- `@Blog/post/show` resolves to `modules/Blog/views/post/show.twig`
- `@Shop/cart` resolves to `modules/Shop/views/cart.twig`

## Add a Namespace Later

If your framework boots modules dynamically, you can register namespaces after creating the `View` instance:

```php
$view->addNamespace('Blog', __DIR__ . '/../modules/Blog/views');
$view->addNamespace('Shop', __DIR__ . '/../modules/Shop/views');
```

## Render From a Controller

Use the namespace-prefixed logical template name:

```php
<?php

declare(strict_types=1);

final class BlogController
{
    public function __construct(private \Marwa\View\ViewInterface $view)
    {
    }

    public function index(): string
    {
        return $this->view->render('@Blog/index', [
            'title' => 'Blog dashboard',
            'posts' => [
                ['title' => 'Release notes'],
                ['title' => 'Rendering guide'],
            ],
        ]);
    }

    public function show(array $post): string
    {
        return $this->view->render('@Blog/post/show', [
            'post' => $post,
        ]);
    }
}
```

If your controller echoes output directly, `display()` works the same way:

```php
$this->view->display('@Blog/post/show', ['post' => $post]);
```

## Render Module Templates From Another Template

Use the built-in `view()` helper:

```twig
{{ view('@Blog/post/show', { post: post })|raw }}
```

This is useful for module cards, widgets, or dashboard panels.

## Example Module Template

```twig
{# modules/Blog/views/post/show.twig #}
<article>
  <h1>{{ post.title }}</h1>
  <p>{{ post.summary }}</p>
</article>
```

## Example From This Repository

See these files for a working example:

- [examples/basic/bootstrap.php](../examples/basic/bootstrap.php)
- [examples/basic/modules/Blog/views/teaser.twig](../examples/basic/modules/Blog/views/teaser.twig)
- [examples/basic/views/full-demo.twig](../examples/basic/views/full-demo.twig)

The example bootstrap registers:

```php
namespaces: [
    'Blog' => __DIR__ . '/modules/Blog/views',
],
```

Then the template is rendered with:

```twig
{{ view('@Blog/teaser', { appName: appName })|raw }}
```

## Rules To Follow

- Namespace names must start with a letter.
- Namespace names may contain letters, numbers, and underscores.
- Template names stay slash-based.
- Do not include the `.twig` extension in render calls.

Valid:

- `@Blog/index`
- `@Blog/post/show`
- `@AdminPanel/users/table`

Invalid:

- `@blog/index`
- `@blog-post/index`
- `@Blog/post/show.twig`

## Important Limitation

If you are asking:

"Can the active theme transparently replace `@Blog/post/show` with a theme-specific version?"

The answer is: not currently.

Right now, namespaced module views render the module's own template directly. That is already useful for modular apps, and it is the correct feature when you simply want each module to own and render its own templates.

## Related Documentation

- [Tutorials](./tutorials.md)
- [API Reference](./api.md)
- [Themes](./themes.md)
