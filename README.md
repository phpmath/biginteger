# biginteger

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

A PHP library to work with big integers. This library makes use of the GMP extension to
do its calculations.

## Install

Via Composer

``` bash
$ composer require phpmath/biginteger
```

## Usage

``` php
use PHP\Math\BigInteger\BigInteger;
$number = new BigInteger('8273467836243255543265432745');
```
## Features

This library supports the following operations:

* Basic operations such as add, divide, multiply and subtract.
* Performing modulo operations.
* Calculate the square root and power of values.
* Negate numbers
* Make numbers absolute.
* Compare numbers

Beside these operations it's also possible to make the object mutable or immutable. Performing operations on an
immutable number results in the function returning a new instance.


## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please create an issue in the issue tracker.

## Credits

- [Walter Tamboer][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/phpmath/biginteger.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/phpmath/biginteger/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/phpmath/biginteger.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/phpmath/biginteger.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/phpmath/biginteger.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/phpmath/biginteger
[link-travis]: https://travis-ci.org/phpmath/biginteger
[link-scrutinizer]: https://scrutinizer-ci.com/g/phpmath/biginteger/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/phpmath/biginteger
[link-downloads]: https://packagist.org/packages/phpmath/biginteger
[link-author]: https://github.com/waltertamboer
[link-contributors]: ../../contributors
