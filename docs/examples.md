# Examples

The repository includes runnable demos under `examples/`.

## Basic Examples

- `examples/basic/index.php`
- `examples/basic/render-demo.php`
- `examples/basic/demo.php`
- `examples/basic/bootstrap.php`

## Theme Examples

- `examples/theme/theme.php`
- `examples/theme/switch-theme.php`
- `examples/theme/admin-theme-preview.php`
- `examples/theme/docs.php`

## What They Demonstrate

- minimal renderer setup
- shared globals
- namespaced views
- layout stacks
- fragment caching
- translation helpers
- runtime theme switching and preview
- optional extensions

## Recommended Local Commands

```bash
composer install
composer ci
php examples/basic/index.php
php examples/basic/render-demo.php
php examples/basic/demo.php
php -S 127.0.0.1:8000 -t examples
```

Then open:

- `http://127.0.0.1:8000/theme/switch-theme.php`
- `http://127.0.0.1:8000/theme/docs.php`
