# Extensions

`Marwa\View` ships with optional Twig extensions that stay focused on presentation concerns.

## Included Extensions

- `AssetExtension`
- `UrlExtension`
- `TextExtension`
- `DateExtension`
- `TranslateExtension`
- `HtmlExtension`
- `JsonExtension`
- `MoneyExtension`
- `NumberExtension`
- `MetaStackExtension`
- `IconExtension`

## Registration Example

```php
use Marwa\View\Extension\AssetExtension;
use Marwa\View\Extension\DateExtension;
use Marwa\View\Extension\HtmlExtension;
use Marwa\View\Extension\IconExtension;
use Marwa\View\Extension\JsonExtension;
use Marwa\View\Extension\MetaStackExtension;
use Marwa\View\Extension\MoneyExtension;
use Marwa\View\Extension\NumberExtension;
use Marwa\View\Extension\TextExtension;
use Marwa\View\Extension\TranslateExtension;
use Marwa\View\Extension\UrlExtension;
use Marwa\View\Translate\ArrayTranslator;

$translator = new ArrayTranslator('en', __DIR__ . '/../lang');

$view = new View($config, [
    new AssetExtension('/static', '1.0.0'),
    new TextExtension(),
    new DateExtension(),
    new HtmlExtension(),
    new JsonExtension(),
    new MoneyExtension(),
    new NumberExtension(),
    new UrlExtension('https://demo.test'),
    new TranslateExtension($translator),
]);

$view->addExtension(new MetaStackExtension($view));
$view->addExtension(new IconExtension([
    'spark' => '<svg viewBox="0 0 24 24"><path d="M12 3l2 6 6 2-6 2-2 6-2-6-6-2 6-2 2-6Z"/></svg>',
]));
```

## Helper Summary

### HTML

- `class_names()`
- `html_attrs()`

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

### Icons

- `icon()`
- `has_icon()`

## Guidance

- Keep extensions view-layer only.
- Avoid request, session, auth, and routing concerns here.
- Prefer explicit registration over magic discovery.
