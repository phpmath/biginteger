# biginteger

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE)
[![Build Status][ico-travis]][link-travis]
[![Total Downloads][ico-downloads]][link-downloads]
[![SensioLabsInsight][ico-sensio]][link-sensio]

A PHP library to work with big integers.

## Getting started

It's recommended to install this library via [Composer](https://getcomposer.org).

```json
{
    "require": {
        "phpmath/biginteger": "1.0.0"
    }
}
```

The current master branch is considered stable. The badges on top of this document should confirm this.

## Requirements

This library runs on PHP 5.3, PHP 5.4, PHP 5.5, PHP 5.6, PHP 7 and HHVM. The only requirement is that the GMP extension
is installed.

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

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

[ico-version]: https://img.shields.io/packagist/v/phpmath/biginteger.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/phpmath/biginteger/master.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/phpmath/biginteger.svg?style=flat-square
[ico-sensio]: https://img.shields.io/sensiolabs/i/e94c9ef4-54e2-4785-bff5-d96db4b468d7.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/phpmath/biginteger
[link-travis]: https://travis-ci.org/phpmath/biginteger
[link-downloads]: https://packagist.org/packages/phpmath/biginteger
[link-sensio]: https://insight.sensiolabs.com/projects/e94c9ef4-54e2-4785-bff5-d96db4b468d7
