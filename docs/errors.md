---
title: Errors and exceptions
intro: What can go wrong and how to catch it.
group: Reference
order: 80
---

## Library exceptions

Every exception the library throws implements the marker interface `PHPMath\BigInteger\Exception\BigIntegerException`, so one `catch` block handles all of them. Each exception also extends an exception from PHP, which says what kind of problem it is:

- `InvalidArgumentException`: an argument has an invalid value.
- `DomainException`: the arguments are fine in general, but the result is mathematically undefined for them.

| Exception | Extends | Thrown when |
|---|---|---|
| `PHPMath\BigInteger\Exception\InvalidValueException` | `InvalidArgumentException` | The input is not valid for the operation. See the list below. |
| `PHPMath\BigInteger\Exception\InvalidProbabilityFactorException` | `InvalidArgumentException` | `isPrimeNumber()` gets a factor outside 0.0 to 1.0. |
| `PHPMath\BigInteger\Exception\NotInvertibleException` | `DomainException` | `invert()` is called for a number that has no inverse for the modulus. |

```php
use PHPMath\BigInteger\BigInteger;
use PHPMath\BigInteger\Exception\BigIntegerException;

try {
    (new BigInteger(2))->invert(new BigInteger(4));
} catch (BigIntegerException $exception) {
    echo $exception->getMessage(); // No modular inverse exists.
}
```

## When InvalidValueException is thrown

This table lists every case where a method rejects its input.

| Method | Condition |
|---|---|
| `new BigInteger()` | The text is not a whole number. |
| `divide()`, `divideRemainder()`, `mod()` | The divisor is zero. |
| `invert()` | The modulus is zero. |
| `pow()` | The exponent is negative. |
| `sqrt()` | The number is negative. |
| `root()` | The degree is below 1, or the number is negative and the degree is even. |
| `factorial()` | The number is negative. |
| `binomial()` | `$k` is negative. |
| `hammingDistance()` | Either number is negative. |

## Handling untrusted input

```php
use PHPMath\BigInteger\BigInteger;
use PHPMath\BigInteger\Exception\InvalidValueException;

try {
    $number = new BigInteger($_POST['amount']);
} catch (InvalidValueException) {
    // not a whole number
}
```
