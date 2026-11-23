# Changelog

All notable changes to this project are documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/), and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [3.0.0] - 2026-11-23

### Added

- The marker interface `BigIntegerException`, implemented by every exception of the library.
- `NotInvertibleException`, thrown by `invert()` when a number has no inverse for the modulus.
- A documentation site at https://phpmath.github.io/biginteger/.

### Changed

- `ImmutableBigInteger` is renamed to `BigInteger`, the namespace is now `PHPMath\BigInteger`.
- Requires PHP 8.4 or newer and the `gmp` extension.
- Invalid input always throws a library exception (`InvalidValueException`, `InvalidProbabilityFactorException` or `NotInvertibleException`) and no longer `DivisionByZeroError` or `ValueError`.
- `divide()` truncates toward zero, which is now documented.

### Removed

- `MutableBigInteger` and its interface.

Earlier versions are described on the [releases page](https://github.com/phpmath/biginteger/releases).

[Unreleased]: https://github.com/phpmath/biginteger/compare/3.0.0...HEAD
[3.0.0]: https://github.com/phpmath/biginteger/compare/2.1.0...3.0.0
