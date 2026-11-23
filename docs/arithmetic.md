---
title: Arithmetic
intro: Add, subtract, multiply and divide, then powers, roots and factorials.
group: Guides
order: 30
---

## The four operations

`add()`, `subtract()` and `multiply()` take another `BigInteger` and return the result as a new one. The results are exact, however large the numbers get, because there is no overflow and no rounding.

```php
use PHPMath\BigInteger\BigInteger;

$a = new BigInteger('12345678901234567890');
$b = new BigInteger('98765432109876543210');

$a->add($b)->value();       // 111111111011111111100
$b->subtract($a)->value();  // 86419753208641975320
$a->multiply($b)->value();  // 1219326311370217952237463801111263526900
```

## Division

There are three ways to divide, and they differ for negative numbers.

| Method | Result for -7 and 2 | Rule |
|---|---|---|
| `divide()` | `-3` | Integer quotient, truncated toward zero. |
| `divideRemainder()` | `-1` | Remainder of that truncated division. Takes the sign of the dividend. |
| `mod()` | `1` | Modulo. The result is never negative. |

```php
use PHPMath\BigInteger\BigInteger;

$a = new BigInteger(-7);
$b = new BigInteger(2);

$a->divide($b)->value();           // -3
$a->divideRemainder($b)->value();  // -1
$a->mod($b)->value();              // 1
```

`divide()` never rounds. Dividing -7 by 2 gives -3, not -4. If you want a rounded quotient, use `Fraction` from the `phpmath/fraction` library: `Fraction::of(-7, 2)->round()` gives -4, because a half rounds away from zero.

> [!WARNING]
> Dividing by zero is an error. `divide()`, `divideRemainder()` and `mod()` all throw [`InvalidValueException`](errors.md) when the divisor is zero.

## Sign and magnitude

`abs()` returns the number without its sign. `negate()` flips the sign, so a positive number becomes negative and the other way around. Zero has no sign, so negating it gives zero.

```php
use PHPMath\BigInteger\BigInteger;

$number = new BigInteger(-3);

$number->abs()->value();     // 3
$number->negate()->value();  // 3
(new BigInteger(0))->negate()->value(); // 0
```

## Powers and roots

`pow()` raises a number to a whole-number power. `sqrt()` returns the square root and `root()` returns the n-th root. Roots are whole numbers, so any fractional part is cut off.

```php
use PHPMath\BigInteger\BigInteger;

$two = new BigInteger(2);

$two->pow(100)->value();  // 1267650600228229401496703205376

(new BigInteger(10))->sqrt()->value();   // 3
(new BigInteger(27))->root(3)->value();  // 3
(new BigInteger(-27))->root(3)->value(); // -3
```

`sqrt()` and `root()` return the integer part of the result, rounded toward zero. `pow()` needs an exponent of zero or more. `sqrt()` needs a number of zero or more. `root()` needs a degree of at least 1, and for a negative number only odd degrees work. Anything else throws [`InvalidValueException`](errors.md).

## Factorials and binomials

The factorial of n, written n!, is the product of all whole numbers from 1 up to n. The binomial coefficient answers "how many ways can I choose k items out of n, ignoring order?". Both grow very quickly, which is where big integers come in handy.

```php
use PHPMath\BigInteger\BigInteger;

(new BigInteger(20))->factorial()->value();  // 2432902008176640000

// "5 choose 2"
(new BigInteger(5))->binomial(2)->value();  // 10
```

`factorial()` needs a number of zero or more. `binomial()` needs `$k` of zero or more, and returns `0` when `$k` is larger than the number. Negative input throws [`InvalidValueException`](errors.md).
