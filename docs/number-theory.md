---
title: Number theory
intro: Primes, divisors, modular arithmetic and quadratic residue symbols.
group: Guides
order: 60
---

## Testing for primes

Primality tests on big numbers are probabilistic. The library gives you two ways to ask.

### isPrimeNumber

Returns a plain boolean. The optional `$probabilityFactor` is a number from `0.0` to `1.0` that trades speed for certainty. It defaults to `1.0`, the most thorough test.

```php
use PHPMath\BigInteger\BigInteger;

(new BigInteger(97))->isPrimeNumber();       // true
(new BigInteger(91))->isPrimeNumber();       // false
(new BigInteger(97))->isPrimeNumber(0.5);    // true
```

### checkPrimeProbability

Returns a `ProbablePrime` enum, so you can tell a proven prime from a probable one.

| Case | Meaning |
|---|---|
| `ProbablePrime::Yes` | The number is definitely prime. |
| `ProbablePrime::Maybe` | The number is probably prime. Very large primes usually land here. |
| `ProbablePrime::No` | The number is definitely not prime. |

```php
use PHPMath\BigInteger\BigInteger;

(new BigInteger(97))->checkPrimeProbability();   // ProbablePrime::Yes
(new BigInteger(91))->checkPrimeProbability();   // ProbablePrime::No

// 2^89 - 1 is a Mersenne prime, too big to prove quickly
(new BigInteger(2))->pow(89)->subtract(new BigInteger(1))
    ->checkPrimeProbability();                   // ProbablePrime::Maybe
```

Negative numbers are never prime, and neither is `1`.

## Finding the next prime

`nextPrime()` returns the smallest prime that is greater than the number. It works for any size of number, and for numbers below 2 it returns 2.

```php
use PHPMath\BigInteger\BigInteger;

(new BigInteger(100))->nextPrime()->value();  // 101
```

## GCD and LCM

The greatest common divisor (GCD) is the largest number that divides both numbers without a remainder. The least common multiple (LCM) is the smallest positive number that both numbers divide into. For 12 and 18 the GCD is 6 and the LCM is 36. Together they satisfy `gcd * lcm = a * b` for positive numbers.

```php
use PHPMath\BigInteger\BigInteger;

$a = new BigInteger(12);
$b = new BigInteger(18);

$a->greatestCommonDivisor($b)->value();  // 6
$a->leastCommonMultiple($b)->value();    // 36
```

## Modular inverse

`invert()` finds `x` such that `(this * x) mod m = 1`.

```php
use PHPMath\BigInteger\BigInteger;

$three = new BigInteger(3);
$eleven = new BigInteger(11);

$three->invert($eleven)->value();  // 4, because 3 * 4 = 12 = 1 (mod 11)
```

When no inverse exists, for example `2` modulo `4`, it throws [`NotInvertibleException`](errors.md).

## Perfect squares and powers

A perfect square is a number that equals some integer multiplied by itself, such as 49 (7 * 7). A perfect power is a number that equals `a` raised to the power `b`, where both are whole numbers above 1, such as 64 (2<sup>6</sup> or 8<sup>2</sup>). Every perfect square is also a perfect power, and the number 1 counts as one. Both methods return `false` for negative numbers.

```php
use PHPMath\BigInteger\BigInteger;

(new BigInteger(49))->isPerfectSquare();  // true
(new BigInteger(64))->isPerfectPower();   // true, 2^6 or 8^2
(new BigInteger(-4))->isPerfectSquare();  // false
```

## Jacobi, Legendre and Kronecker symbols

These give `-1`, `0` or `1` and describe whether a number is a square modulo another. `legendre()` expects an odd prime as its argument. `jacobi()` expects an odd positive one. `kronecker()` accepts any integer.

```php
use PHPMath\BigInteger\BigInteger;

(new BigInteger(2))->legendre(new BigInteger(7));   // 1
(new BigInteger(5))->jacobi(new BigInteger(9));     // 1
(new BigInteger(2))->kronecker(new BigInteger(8));  // 0
```
