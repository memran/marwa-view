# Contributing

## Getting Started

1. Fork the repository.
2. Create a focused branch for your work.
3. Install dependencies with `composer install`.
4. Run the quality checks before opening a pull request.

## Development Workflow

Recommended commands:

```bash
composer test
composer analyse
composer lint
composer ci
```

For local example browsing:

```bash
php -S 127.0.0.1:8000 -t examples
```

## Contribution Guidelines

- keep the package framework-agnostic
- keep Twig internal to the library API
- prefer small focused changes over large mixed refactors
- preserve documented public behavior unless fixing a bug or security issue
- add or update tests for behavior changes
- update docs when public API, examples, or workflows change
- avoid introducing abstractions that are not clearly justified

## Coding Standards

- target PHP 8.2+
- follow PSR-12
- use strict types where appropriate
- keep classes focused and readable
- prefer explicit, maintainable code over clever shortcuts

## Pull Requests

A good pull request should include:

- a short problem statement
- a summary of the solution
- notes about tests or manual verification
- any compatibility or migration concerns

Use the pull request template under `.github/pull_request_template.md`.

## Issues

When opening an issue:

- include reproduction steps for bugs
- provide expected and actual behavior
- include relevant environment details when applicable
- keep requests tightly scoped

## Security

Do not report vulnerabilities in public issues. Follow [SECURITY.md](./SECURITY.md).
