---
title: Introduction
intro: Integers of any size for PHP, built on the GMP extension. Every number is an immutable value object.
group: Getting started
order: 10
---

## Requirements

The library needs a current PHP version and the GMP extension, which does the heavy lifting.

- PHP 8.4 or newer
- The `gmp` extension

## Installation

Install the library with Composer. This also checks that the GMP extension is available.

```bash
composer require phpmath/biginteger
```

## A first example

Create a number from a string or an integer. Use a string for anything that does not fit in a PHP integer.

```php
use PHPMath\BigInteger\BigInteger;

$a = new BigInteger('12345678901234567890');
$b = new BigInteger('98765432109876543210');

$sum = $a->add($b);

echo $sum->value(); // 111111111011111111100
```

Calling `add()` did not change `$a`. It returned a new `BigInteger`. This is true for every operation in the library.

## Where to go next

Start with the core concepts, or jump straight to the topic you need.

<div class="cards"><a href="concepts.md"><strong>Core concepts</strong><span>Immutability, creating numbers and reading values.</span></a><a href="arithmetic.md"><strong>Arithmetic</strong><span>Add, divide, powers, roots and factorials.</span></a><a href="number-theory.md"><strong>Number theory</strong><span>Primes, GCD, modular inverses and symbols.</span></a><a href="api.md"><strong>API reference</strong><span>Every method with its parameters and errors.</span></a></div>
