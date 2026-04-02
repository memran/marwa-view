# Extensions

`Marwa\View` ships with optional Twig extensions that stay focused on presentation concerns.

## Included Extensions

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

## Registration Example

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

$translator = new ArrayTranslator('en', __DIR__ . '/../lang');

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

## Helper Summary

### HTML

- `class_names()`
- `html_attrs()`
- `ui()`

### Alpine Bridge

`AlpineExtension` exposes a `ui()` helper for Alpine.js directive attributes.

Twig usage:

```twig
<div {{ ui().data({ open: false }) }}>
  <button {{ ui().click('open = !open') }}>Toggle</button>
  <div {{ ui().show('open') }} {{ ui().cloak() }}>Hello</div>
</div>
```

PHP-first usage:

```php
<div <?= ui()->data(['open' => false]) ?>>
    <button <?= ui()->click('open = !open') ?>>Toggle</button>
    <div <?= ui()->show('open') ?> <?= ui()->cloak() ?>>Hello</div>
</div>
```

Common methods:

- `data()`
- `click()`
- `show()`
- `text()`
- `html()`
- `model()`
- `bind()`
- `on()`
- `init()`
- `ref()`
- `transition()`
- `cloak()`

### JSON

- `json()`
- `json_script()`

### Money and Numbers

- `money()`
- `number()`
- `percent()`
- `compact_number()`
- `file_size()`

### Stack Helpers

- `push_meta()`
- `push_property_meta()`
- `push_link_tag()`
- `push_script_tag()`

### SEO Helpers

- `meta_title()`
- `meta_description()`
- `canonical_tag()`
- `robots_tag()`
- `og_tag()`

### Icons

- `icon()`
- `has_icon()`

### List and Image Helpers

- `join_human()`
- `oxford_join()`
- `image_attrs()`
- `srcset()`

### String and Status Helpers

- `initials()`
- `headline()`
- `excerpt()`
- `nl2br_safe()`
- `status_label()`
- `status_variant()`
- `status_classes()`

## Guidance

- Keep extensions view-layer only.
- Avoid request, session, auth, and routing concerns here.
- Prefer explicit registration over magic discovery.
