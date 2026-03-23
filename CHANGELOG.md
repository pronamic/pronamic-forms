# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.0.0] - 2026-03-23

### Breaking Changes

- Raised minimum PHP requirement from 8.1 to 8.2.
- Moved all PHP classes from `php/` to `psr-4/` — update composer.json autoload path if you reference this package's PSR-4 root directly.
- `Plugin::__construct()` is now `private`; `Plugin::setup()` is removed. Use `Plugin::instance()` to bootstrap.

### Changed

- Applied `declare(strict_types=1)` and a direct-access guard to the plugin bootstrap file.
- Converted `Plugin` to a singleton via a `private` constructor and `public static instance()` factory.
- Added `namespace Pronamic\PronamicForms` to the plugin bootstrap file.
- Guarded autoloader load with a `file_exists` check.
- Disabled `testsEnvironment` in `.wp-env.json`.
- Moved `wp-slug` from `config` to `extra` in `composer.json`.
- Updated copyright year to 2026 across pattern files.

### Composer

- Updated `pronamic/wp-coding-standards` to `^2.5`.
- Updated `rector/rector` to `^2.3`.
- Updated `roots/wordpress-no-content` to `^6.9`.

### npm

- Updated `@wordpress/interactivity` to `^6.42.0`.
- Updated `@wordpress/env` to `^11.2.0`.
- Updated `@wordpress/scripts` to `^31.7.0`.

Full set of changes: [`1.2.1...2.0.0`][2.0.0]

[2.0.0]: https://github.com/pronamic/pronamic-forms/compare/v1.2.1...v2.0.0

## [1.2.1] - 2026-01-27

### Commits

- Fixed payment line unit price requirement for Mollie ([0778a1f](https://github.com/pronamic/pronamic-forms/commit/0778a1fc95a5b5c1636aa7077453a8410463cacb))

### Composer

- Changed `automattic/jetpack-autoloader` from `v5.0.9` to `v5.0.15`.
	Release notes: https://github.com/Automattic/jetpack-autoloader/releases/tag/v5.0.15
- Changed `pronamic/wp-pay-logos` from `v2.2.3` to `v2.3.2`.
	Release notes: https://github.com/pronamic/wp-pay-logos/releases/tag/v2.3.2

Full set of changes: [`1.2.0...1.2.1`][1.2.1]

[1.2.1]: https://github.com/pronamic/pronamic-forms/compare/v1.2.0...v1.2.1

## [1.2.0] - 2025-08-22

### Commits

- ncu ([7e51486](https://github.com/pronamic/pronamic-forms/commit/7e5148658114d8951932393d986337451f8ec1ef))
- Don't hide label for toggle switch. ([902f805](https://github.com/pronamic/pronamic-forms/commit/902f805076360657c32d77804b58efe27da64d0b))

### Composer

- Changed `automattic/jetpack-autoloader` from `v5.0.7` to `v5.0.9`.
	Release notes: https://github.com/Automattic/jetpack-autoloader/releases/tag/v5.0.9

Full set of changes: [`1.1.0...1.2.0`][1.2.0]

[1.2.0]: https://github.com/pronamic/pronamic-forms/compare/v1.1.0...v1.2.0

## [1.1.0] - 2025-06-19

### Commits

- Fixed problem with grouped forms. ([8db31a1](https://github.com/pronamic/pronamic-forms/commit/8db31a17de52e8878976f15ce34e3cd470dc3769))
- Added Dutch translations ([55a7dc3](https://github.com/pronamic/pronamic-forms/commit/55a7dc3e024928bc6933f60df44c14f0346e101a))
- Improve/add block descriptions ([2d3d617](https://github.com/pronamic/pronamic-forms/commit/2d3d61738bd193b202cb85535ef7a255c72a6925))

Full set of changes: [`1.0.0...1.1.0`][1.1.0]

[1.1.0]: https://github.com/pronamic/pronamic-forms/compare/v1.0.0...v1.1.0

## [1.0.0] - 2025-05-20

- First release.

[1.0.0]: https://github.com/pronamic/pronamic-forms/releases/tag/v1.0.0
