---
title: Comparison and sign
intro: Compare numbers, test for equality and inspect the sign.
group: Guides
order: 40
---

## Equality

Use `equals()` to test whether two numbers have the same value. Do not use `==`. Two `BigInteger` objects with the same value are different objects.

```php
use PHPMath\BigInteger\BigInteger;

$a = new BigInteger('100');
$b = new BigInteger(100);

$a->equals($b);  // true
```

## Ordering

`cmp()` returns `-1`, `0` or `1`, which makes it a drop-in callback for `usort()`.

```php
use PHPMath\BigInteger\BigInteger;

$three = new BigInteger(3);
$nine = new BigInteger(9);

$three->cmp($nine);  // -1
$nine->cmp($three);  // 1
$three->cmp($three); // 0

$numbers = [$nine, $three];
usort($numbers, fn (BigInteger $x, BigInteger $y): int => $x->cmp($y));
```

## Sign

Three predicates cover the common questions, and `sign()` gives the full answer as an enum.

```php
use PHPMath\BigInteger\BigInteger;

$number = new BigInteger(-3);

$number->isNegative();  // true
$number->isPositive();  // false
$number->isZero();      // false

$number->sign();        // Sign::Negative
```

| Sign case | Meaning |
|---|---|
| `Sign::Positive` | The number is greater than zero. |
| `Sign::Negative` | The number is less than zero. |
| `Sign::Zero` | The number is exactly zero. |

```php
use PHPMath\BigInteger\Sign;

echo match ($number->sign()) {
    Sign::Positive => 'above zero',
    Sign::Negative => 'below zero',
    Sign::Zero => 'zero',
};
```
