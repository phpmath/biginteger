---
title: Core concepts
intro: The few ideas you need to use BigInteger well.
group: Getting started
order: 20
---

## Numbers are immutable

`BigInteger` is a `final readonly` class. Once created, a number never changes. Methods such as `add()` or `negate()` return a new instance and leave the original untouched, so you can pass numbers around without defensive copies.

```php
use PHPMath\BigInteger\BigInteger;

$price = new BigInteger(100);
$total = $price->add(new BigInteger(25));

echo $price->value(); // 100
echo $total->value(); // 125
```

Because there is only one kind of number, there is no `Mutable` or `Immutable` variant to choose between.

## Creating numbers

The constructor accepts a `string` or an `int`.

```php
use PHPMath\BigInteger\BigInteger;

new BigInteger(42);
new BigInteger('-98765432109876543210');
new BigInteger('0x1F');   // 31, hexadecimal
new BigInteger('0b101');  // 5, binary
```

Anything that is not a whole number throws [`InvalidValueException`](errors.md), including decimals such as `'1.5'` and text such as `'abc'`.

```php
use PHPMath\BigInteger\BigInteger;
use PHPMath\BigInteger\Exception\InvalidValueException;

try {
    new BigInteger('1.5');
} catch (InvalidValueException $exception) {
    // Invalid number provided
}
```

> [!WARNING]
> Pass large numbers as strings. A PHP integer literal larger than `PHP_INT_MAX` is silently turned into a float before the library sees it.

## Reading values

`value()` returns the number as a decimal string. This is the only way to get a number out. There is no `__toString()`, so a `BigInteger` cannot be echoed or concatenated by accident.

```php
use PHPMath\BigInteger\BigInteger;

$number = new BigInteger('9223372036854775807');

echo $number->add(new BigInteger(1))->value(); // 9223372036854775808
```

## Operations take BigInteger arguments

Methods that combine two numbers accept another `BigInteger`, not a string or int. Wrap raw values first.

```php
use PHPMath\BigInteger\BigInteger;

$a = new BigInteger(10);

$a->add(new BigInteger(5));   // correct
$a->add(5);                   // TypeError
```

Methods that need a plain count, such as `pow()`, `root()` and `binomial()`, take a PHP `int`.

## Enums for results

Two methods return enums instead of magic numbers: `sign()` returns `Sign` and `checkPrimeProbability()` returns `ProbablePrime`. See [Comparison and sign](comparison.md) and [Number theory](number-theory.md).
