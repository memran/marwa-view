# Development

## Tooling

- PHPUnit
- PHPStan 2.x
- PHP-CS-Fixer
- GitHub Actions CI

## Composer Scripts

- `composer test`
- `composer test:coverage`
- `composer analyse`
- `composer lint`
- `composer fix`
- `composer ci`

## Quality Gates

- keep public behavior backward compatible unless fixing bugs or security issues
- prefer framework-agnostic APIs
- keep Twig internal to the library
- keep extensions focused on presentation concerns

## Release Notes

Recommended before stable tags:

- maintain a changelog
- publish upgrade notes for public behavior changes
- keep README claims aligned with implemented features
- preserve PHP platform compatibility in `composer.lock`
