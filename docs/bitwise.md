---
title: Bitwise operations
intro: Work on the binary representation of a number.
group: Guides
order: 50
---

## And, or, xor

These three combine two numbers bit by bit. `bitwiseAnd()` keeps a bit only when it is set in both numbers. `bitwiseOr()` keeps a bit when it is set in at least one of them. `bitwiseXor()` keeps a bit when it is set in exactly one of them. The comments below show the binary form of each number.

```php
use PHPMath\BigInteger\BigInteger;

$a = new BigInteger(12);  // 1100
$b = new BigInteger(10);  // 1010

$a->bitwiseAnd($b)->value();  // 8   (1000)
$a->bitwiseOr($b)->value();   // 14  (1110)
$a->bitwiseXor($b)->value();  // 6   (0110)
```

## Not

`bitwiseNot()` flips every bit. For integers of any size this is always `-(n + 1)`.

```php
use PHPMath\BigInteger\BigInteger;

(new BigInteger(5))->bitwiseNot()->value();  // -6
```

## Hamming distance

The Hamming distance is the number of bits in which two numbers differ. Both numbers must be zero or more.

```php
use PHPMath\BigInteger\BigInteger;

$a = new BigInteger(12);  // 1100
$b = new BigInteger(10);  // 1010

$a->hammingDistance($b);  // 2
```

A negative number throws [`InvalidValueException`](errors.md).
