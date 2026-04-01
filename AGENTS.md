# Repository Guidelines

## Project Structure & Module Organization
`src/` contains the library code under the `Marwa\View\` namespace. Core entry points live in [`src/View.php`](/Users/memran/projects/php-projects/marwa-view/src/View.php) and [`src/ViewConfig.php`](/Users/memran/projects/php-projects/marwa-view/src/ViewConfig.php), with support code grouped by concern in `Cache/`, `Exception/`, `Extension/`, `Support/`, `Translate/`, and `theme/`. `examples/` holds runnable demo scripts, Twig templates, translation files, and theme assets. Composer maps production code from `src/` and expects test code in `tests/`.

## Build, Test, and Development Commands
Run `composer install` to install Twig, Symfony Translation, and dev tools. Use `composer test` to execute the configured `memran/php-testify` suite via `phpunit.config.php`. For quick manual verification, run example scripts directly, for example `php examples/demo.php` or `php examples/theme.php`. If you add new tests, keep them compatible with the configured patterns in `tests/*Test.php` or `tests/*_test.php`.

## Coding Style & Naming Conventions
Target PHP 8.1+ and follow PSR-12. Existing code uses `declare(strict_types=1);`, typed properties, constructor promotion where appropriate, and short, focused classes. Keep namespaces PSR-4 aligned with file paths, for example `Marwa\View\Extension\AssetExtension` in `src/Extension/AssetExtension.php`. Use `StudlyCase` for classes, `camelCase` for methods and properties, and keep template logical names slash-based, such as `home/index`.

## Testing Guidelines
There is currently no committed `tests/` directory, but the project is already wired for tests through `phpunit.config.php` and Composer. Add regression tests for new behavior and bug fixes under `tests/`, favoring one test file per class or feature. Cover both standard rendering and theme-aware paths when changing view resolution, caching, or translation behavior.

## Commit & Pull Request Guidelines
Recent history uses short, imperative commit messages such as `Added Theme`, `Update Examples`, and `Delete cache/twig directory`. Prefer concise subject lines that describe the visible change. Pull requests should explain the problem, summarize the approach, list test coverage or manual verification, and include screenshots only when template or asset output changes in `examples/`.

## Configuration Notes
Do not commit generated cache output or vendor files. Keep example assets and manifests under `examples/views/themes/` self-contained so contributors can verify theme resolution without extra setup.
