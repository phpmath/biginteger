---
title: API reference
intro: Every public method of BigInteger, grouped by purpose.
group: Reference
order: 70
layout: reference
---

Every method returns a new `BigInteger` unless the return type says otherwise. All methods belong to `PHPMath\BigInteger\BigInteger`.

## Construction and output

Create a number and read its value back as a string.

### __construct()

```php
public function __construct(string|int $value)
```

Creates a number.

- **Parameters:** `$value` a decimal, `0x` hexadecimal or `0b` binary string, or an int
- **Throws:** [InvalidValueException](errors.md) if the value is not a whole number

### value()

```php
public function value(): string
```

Returns the number as a decimal string.

- **Returns:** `string`

## Arithmetic

Basic arithmetic, division, powers, roots, factorials and binomials.

### add()

```php
public function add(BigInteger $value): self
```

Adds a number.

- **Parameters:** `$value` the other operand
- **Returns:** `BigInteger`

### subtract()

```php
public function subtract(BigInteger $value): self
```

Subtracts a number.

- **Parameters:** `$value` the other operand
- **Returns:** `BigInteger`

### multiply()

```php
public function multiply(BigInteger $value): self
```

Multiplies by a number.

- **Parameters:** `$value` the other operand
- **Returns:** `BigInteger`

### divide()

```php
public function divide(BigInteger $value): self
```

Integer division, truncated toward zero.

- **Parameters:** `$value` the divisor
- **Returns:** `BigInteger`
- **Throws:** [InvalidValueException](errors.md) if the divisor is zero

### divideRemainder()

```php
public function divideRemainder(BigInteger $value): self
```

The remainder of truncated division. It takes the sign of the dividend.

- **Parameters:** `$value` the divisor
- **Returns:** `BigInteger`
- **Throws:** [InvalidValueException](errors.md) if the divisor is zero

### mod()

```php
public function mod(BigInteger $value): self
```

Modulo. The result is never negative.

- **Parameters:** `$value` the modulus
- **Returns:** `BigInteger`
- **Throws:** [InvalidValueException](errors.md) if the modulus is zero

### abs()

```php
public function abs(): self
```

The absolute value.

- **Returns:** `BigInteger`

### negate()

```php
public function negate(): self
```

Flips the sign. Zero stays zero.

- **Returns:** `BigInteger`

### pow()

```php
public function pow(int $exponent): self
```

Raises the number to a power.

- **Parameters:** `$exponent` zero or more
- **Returns:** `BigInteger`
- **Throws:** [InvalidValueException](errors.md) if the exponent is negative

### sqrt()

```php
public function sqrt(): self
```

The integer square root, rounded toward zero.

- **Returns:** `BigInteger`
- **Throws:** [InvalidValueException](errors.md) if the number is negative

### root()

```php
public function root(int $nth): self
```

The integer n-th root, rounded toward zero.

- **Parameters:** `$nth` the degree of the root, at least 1
- **Returns:** `BigInteger`
- **Throws:** [InvalidValueException](errors.md) if `$nth` is below 1, or the number is negative and `$nth` is even

### factorial()

```php
public function factorial(): self
```

The factorial of the number.

- **Returns:** `BigInteger`
- **Throws:** [InvalidValueException](errors.md) if the number is negative

### binomial()

```php
public function binomial(int $k): self
```

The binomial coefficient, "this number choose k".

- **Parameters:** `$k` zero or more
- **Returns:** `BigInteger`
- **Throws:** [InvalidValueException](errors.md) if `$k` is negative

## Comparison and sign

Compare numbers and inspect their sign.

### cmp()

```php
public function cmp(BigInteger $value): int
```

Compares with another number.

- **Parameters:** `$value` the number to compare with
- **Returns:** `-1`, `0` or `1`

### equals()

```php
public function equals(BigInteger $value): bool
```

Whether both numbers have the same value.

- **Parameters:** `$value` the number to compare with
- **Returns:** `bool`

### sign()

```php
public function sign(): Sign
```

The sign as an enum.

- **Returns:** `Sign::Positive`, `Sign::Negative` or `Sign::Zero`

### isNegative()

```php
public function isNegative(): bool
```

True when the number is below zero.

- **Returns:** `bool`

### isPositive()

```php
public function isPositive(): bool
```

True when the number is above zero.

- **Returns:** `bool`

### isZero()

```php
public function isZero(): bool
```

True when the number is zero.

- **Returns:** `bool`

## Bitwise

Operations on the binary representation of a number.

### bitwiseAnd()

```php
public function bitwiseAnd(BigInteger $value): self
```

Bitwise AND.

- **Parameters:** `$value` the other operand
- **Returns:** `BigInteger`

### bitwiseOr()

```php
public function bitwiseOr(BigInteger $value): self
```

Bitwise OR.

- **Parameters:** `$value` the other operand
- **Returns:** `BigInteger`

### bitwiseXor()

```php
public function bitwiseXor(BigInteger $value): self
```

Bitwise XOR.

- **Parameters:** `$value` the other operand
- **Returns:** `BigInteger`

### bitwiseNot()

```php
public function bitwiseNot(): self
```

Flips every bit, which equals `-(n + 1)`.

- **Returns:** `BigInteger`

### hammingDistance()

```php
public function hammingDistance(BigInteger $value): int
```

The number of differing bits.

- **Parameters:** `$value` the number to compare with
- **Returns:** `int`
- **Throws:** [InvalidValueException](errors.md) if either number is negative

## Number theory

Primes, divisors, modular arithmetic and quadratic residue symbols.

### isPrimeNumber()

```php
public function isPrimeNumber(float $probabilityFactor = 1.0): bool
```

Probabilistic primality test as a boolean.

- **Parameters:** `$probabilityFactor` from 0.0 (fast) to 1.0 (thorough)
- **Returns:** `bool`
- **Throws:** [InvalidProbabilityFactorException](errors.md) if the factor is outside 0.0 to 1.0

### checkPrimeProbability()

```php
public function checkPrimeProbability(): ProbablePrime
```

Primality test that tells proven primes from probable ones.

- **Returns:** `ProbablePrime::Yes`, `Maybe` or `No`

### nextPrime()

```php
public function nextPrime(): self
```

The first prime greater than this number.

- **Returns:** `BigInteger`

### greatestCommonDivisor()

```php
public function greatestCommonDivisor(BigInteger $value): self
```

The greatest common divisor.

- **Parameters:** `$value` the other number
- **Returns:** `BigInteger`

### leastCommonMultiple()

```php
public function leastCommonMultiple(BigInteger $value): self
```

The least common multiple.

- **Parameters:** `$value` the other number
- **Returns:** `BigInteger`

### invert()

```php
public function invert(BigInteger $value): self
```

The modular multiplicative inverse.

- **Parameters:** `$value` the modulus
- **Returns:** `BigInteger`
- **Throws:** [InvalidValueException](errors.md) if the modulus is zero, [NotInvertibleException](errors.md) if no inverse exists

### isPerfectSquare()

```php
public function isPerfectSquare(): bool
```

Whether the number is n squared for some integer n.

- **Returns:** `bool`

### isPerfectPower()

```php
public function isPerfectPower(): bool
```

Whether the number is a^b for integers a and b above 1. Negative numbers return false.

- **Returns:** `bool`

### jacobi()

```php
public function jacobi(BigInteger $value): int
```

The Jacobi symbol.

- **Parameters:** `$value` an odd positive denominator
- **Returns:** `-1`, `0` or `1`

### legendre()

```php
public function legendre(BigInteger $value): int
```

The Legendre symbol.

- **Parameters:** `$value` an odd prime
- **Returns:** `-1`, `0` or `1`

### kronecker()

```php
public function kronecker(BigInteger $value): int
```

The Kronecker symbol, a generalization of Jacobi.

- **Parameters:** `$value` any integer
- **Returns:** `-1`, `0` or `1`

## Enums

Two methods return enums instead of numbers.

| Type | Cases |
|---|---|
| `PHPMath\BigInteger\Sign` | `Positive`, `Negative`, `Zero` |
| `PHPMath\BigInteger\ProbablePrime` | `Yes`, `Maybe`, `No` |
