# biginteger

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE)
[![CI][ico-ci]][link-ci]
[![Total Downloads][ico-downloads]][link-downloads]

A PHP library to work with big integers. This library makes use of the GMP extension to
do its calculations.

## Documentation

The full documentation is at https://phpmath.github.io/biginteger/. Every release is described on the [releases page](https://github.com/phpmath/biginteger/releases).

## Install

```bash
composer require phpmath/biginteger
```

## Requirements

- PHP 8.4 or newer
- The `gmp` extension

## Usage

Every `BigInteger` is an immutable value object. Operations never change the instance they are
called on, they return a new instance.

``` php
$number = new PHPMath\BigInteger\BigInteger('8273467836243255543265432745');
```

```php
$a = new PHPMath\BigInteger\BigInteger('12345678901234567890');
$b = new PHPMath\BigInteger\BigInteger('98765432109876543210');

$sum = $a->add($b);

echo $sum->value();
```

## Features

This library provides a wide range of operations for working with big integers using the GMP extension:

### Basic Arithmetic
- Add, subtract, multiply, and divide large numbers.
- Calculate powers and roots of numbers.
- Perform modulo operations.
- Negate numbers and get absolute values.

### Comparison
- Compare numbers using `cmp()` and check equality with `equals()`.
- Determine the sign of a number (positive, negative, or zero).

### Bitwise Operations
- Perform bitwise AND, OR, XOR, and NOT operations.
- Compute Hamming distance between numbers.

### Number Theory
- Calculate factorials.
- Check if numbers are prime or likely prime.
- Compute modular inverses.
- Compute Jacobi, Legendre, and Kronecker symbols.
- Calculate greatest common divisors (GCD) and least common multiples (LCM).
- Check for perfect squares and perfect powers.
- Find the next prime number.
- Compute binomial coefficients.

## Development

```bash
composer test
composer test-coverage
composer analyse
composer check-style
composer fix-style
```

## Contributing

All contributions are welcome. Open an issue or a pull request on GitHub. Please follow the coding standard and add tests.

## Security

If you discover a security issue, please create an issue in the issue tracker.

## Credits

- [Walter Tamboer](https://github.com/waltertamboer)
- [All contributors](https://github.com/phpmath/biginteger/graphs/contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

[ico-version]: https://img.shields.io/packagist/v/phpmath/biginteger.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-ci]: https://img.shields.io/github/actions/workflow/status/phpmath/biginteger/ci.yml?branch=master&style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/phpmath/biginteger.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/phpmath/biginteger
[link-ci]: https://github.com/phpmath/biginteger/actions/workflows/ci.yml
[link-downloads]: https://packagist.org/packages/phpmath/biginteger/stats
