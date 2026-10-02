# Changelog

## 2.0.0 (unreleased)

### Breaking changes

- Require PHP `^8.1`; drop PHP 7.x and PHP 8.0 support.
- Rename `privateMethodWithParameters()` to `invokeNonPublicMethod()`.
- Rename `getProtectedOrPrivatePropertyValue()` to `getNonPublicProperty()`.
- Require object instances and add explicit parameter and return types.
- Remove the old helper names without compatibility aliases.

### Added

- `setNonPublicProperty()` for changing private/protected properties.
- Tests for missing members, property writes, value types, named arguments, and propagated exceptions.
- Composer `test` script and GitHub Actions for PHP 8.1–8.5.

### Changed

- Remove obsolete Reflection accessibility calls.
- Enable strict types in source and tests.
- Upgrade to PHPUnit 10.5 and update its configuration.
- Update documentation for the new API and test workflow.

### Fixed

- Make the protected-method-with-parameters fixture actually protected.
