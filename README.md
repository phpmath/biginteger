# biginteger

[![Build Status](https://travis-ci.org/phpmath/biginteger.svg?branch=master)](https://travis-ci.org/phpmath/biginteger)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/phpmath/biginteger/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/phpmath/biginteger/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/phpmath/biginteger/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/phpmath/biginteger/?branch=master)
[![Coverage Status](https://coveralls.io/repos/phpmath/biginteger/badge.svg)](https://coveralls.io/r/phpmath/biginteger)
[![Dependency Status](https://www.versioneye.com/user/projects/552269cc971f781c480003f0/badge.svg?style=flat)](https://www.versioneye.com/user/projects/552269cc971f781c480003f0)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/e94c9ef4-54e2-4785-bff5-d96db4b468d7/mini.png)](https://insight.sensiolabs.com/projects/e94c9ef4-54e2-4785-bff5-d96db4b468d7)

A PHP library to work with big integers.

## Getting started

It's recommended to install this library via [Composer](https://getcomposer.org).

```json
{
    "require": {
        "phpmath/biginteger": "dev-master"
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
