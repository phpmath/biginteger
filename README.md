# biginteger

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE)
[![Total Downloads][ico-downloads]][link-downloads]

A PHP library to work with big integers. This library makes use of the GMP extension to
do its calculations.

## Install

Via Composer

``` bash
$ composer require phpmath/biginteger
```

## Usage

There are two ways to create a BigInteger. A mutable or immutable BigInteger.

``` php
$number = new PHP\Math\BigInteger\MutableBigInteger('8273467836243255543265432745');
$number = new PHP\Math\BigInteger\ImmutableBigInteger('8273467836243255543265432745');
```

```php
$a = new PHP\Math\BigInteger\ImmutableBigInteger('12345678901234567890');
$b = new PHP\Math\BigInteger\ImmutableBigInteger('98765432109876543210');

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


## Change log

We keep a changelog for every release, have a look at the [releases overview][link-releases-overview].

## Testing

``` bash
$ composer test
```

To generate code coverage:

``` bash
$ composer test-coverage
```

## Contributing

All contributions are welcome. Feel free to create a PR or open an issue.

## Security

If you discover any security related issues, please create an issue in the issue tracker.

## Credits

- [Walter Tamboer][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

[ico-version]: https://img.shields.io/packagist/v/phpmath/biginteger.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/phpmath/biginteger.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/phpmath/biginteger
[link-downloads]: https://packagist.org/packages/phpmath/biginteger/stats
[link-author]: https://github.com/waltertamboer
[link-contributors]: ../../contributors
[link-releases-overview]: https://github.com/phpmath/biginteger/releases
