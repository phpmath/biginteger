<?php
/**
 * phpmath / biginteger (https://github.com/phpmath/biginteger)
 *
 * @link https://github.com/phpmath/biginteger for the canonical source repository
 */

declare(strict_types=1);

namespace PHP\Math\BigInteger;

use PHP\Math\BigInteger\Exception\InvalidProbabilityFactorException;
use PHP\Math\BigInteger\Exception\InvalidValueException;

/**
 * Represents an arbitrary-precision integer and provides operations for mathematical calculations
 * such as addition, subtraction, multiplication, division, comparison, and more.
 *
 * This abstraction ensures consistent handling of big integers across different implementations.
 */
interface BigInteger
{
    /**
     * Returns the absolute value of this number.
     *
     * @return static A BigInteger instance representing the result.
     */
    public function abs(): static;

    /**
     * Adds the given value to this number.
     *
     * @param BigInteger $value The number to add.
     *
     * @return static A BigInteger instance representing the result.
     */
    public function add(BigInteger $value): static;

    /**
     * Calculates the binomial coefficient C(n, k), also known as "n choose k".
     *
     * The binomial coefficient represents the number of ways to choose {@see $k}
     * elements from a set of {@see $this} elements without regard to the order
     * of selection.
     *
     * @param int $k The number of elements to choose.
     *
     * @return static A BigInteger instance representing the binomial coefficient.
     *
     * @throws InvalidValueException If $k is negative or greater than the current value of this BigInteger.
     */
    public function binomial(int $k): static;

    /**
     * Performs a bitwise AND operation between this big integer and the given value.
     *
     * @param BigInteger $value The value to AND with.
     *
     * @return static A BigInteger instance representing the result.
     */
    public function bitwiseAnd(BigInteger $value): static;

    /**
     * Performs a bitwise NOT (one's complement) operation on this big integer.
     *
     * Each bit in the binary representation is inverted:
     * 1 becomes 0, and 0 becomes 1.
     *
     * @return static A new BigInteger instance representing the result.
     */
    public function bitwiseNot(): static;

    /**
     * Performs a bitwise OR operation between this big integer and the given value.
     *
     * @param BigInteger $value The value to OR with.
     *
     * @return static A BigInteger instance representing the result.
     */
    public function bitwiseOr(BigInteger $value): static;

    /**
     * Performs a bitwise XOR (exclusive OR) operation between this big integer and the given value.
     *
     * @param BigInteger $value The value to XOR with.
     *
     * @return static A BigInteger instance representing the result.
     */
    public function bitwiseXor(BigInteger $value): static;

    /**
     * Performs a probabilistic primality check on this number.
     *
     * The result indicates whether the number is composite, likely prime,
     * or definitely prime within the bounds of the test.
     *
     * @return ProbablePrime The result of the primality check.
     */
    public function checkPrimeProbability(): ProbablePrime;

    /**
     * Compares this number with another value.
     * If you want to know if the numbers are equal, use {@see equals()} instead.
     *
     * @param BigInteger $value The number to compare against.
     *
     * @return int Returns -1 if this number is smaller, 0 if equal, and 1 if larger.
     */
    public function cmp(BigInteger $value): int;

    /**
     * Divides this number by the given value (integer division).
     *
     * @param BigInteger $value The number to divide by.
     *
     * @return static A BigInteger instance representing the result.
     */
    public function divide(BigInteger $value): static;

    /**
     * Divides this big integer by the given value and returns the remainder.
     *
     * This operation is equivalent to the modulo operation:
     *   r = a mod b
     * where r is the remainder after dividing this number (a) by $value (b).
     * The difference with the modulo operation is that this returns the truncated remainder after dividing.
     *
     * @param BigInteger $value The divisor.
     *
     * @return static A new BigInteger instance representing the remainder.
     *
     * @throws InvalidValueException If $value is zero.
     */
    public function divideRemainder(BigInteger $value): static;

    /**
     * Checks if this number is equal to another value.
     *
     * @param BigInteger $value The number to compare against.
     *
     * @return bool True if equal, false otherwise.
     */
    public function equals(BigInteger $value): bool;

    /**
     * Calculates the factorial of this number.
     *
     * @return static A BigInteger instance representing the result.
     */
    public function factorial(): static;

    /**
     * Computes the greatest common divisor (GCD) of this number and the given value.
     *
     * @param BigInteger $value The value to compute the GCD with.
     *
     * @return static A new BigInteger instance representing the GCD.
     */
    public function greatestCommonDivisor(BigInteger $value): static;

    /**
     * Computes the Hamming distance between this number and the given value.
     *
     * The Hamming distance is the number of differing bits in the binary representation.
     *
     * @param BigInteger $value The value to compare with.
     *
     * @return int The number of differing bits.
     */
    public function hammingDistance(BigInteger $value): int;

    /**
     * Computes the modular multiplicative inverse of this number modulo the given value.
     *
     * The result `x` satisfies: (this * x) ≡ 1 (mod $value).
     *
     * @param BigInteger $value The modulus.
     *
     * @return static A new BigInteger instance representing the modular inverse.
     *
     * @throws InvalidValueException If no inverse exists.
     */
    public function invert(BigInteger $value): static;

    /**
     * Returns whether this number is less than zero.
     *
     * @return bool Returns true if this number is less than zero, false otherwise.
     */
    public function isNegative(): bool;

    /**
     * Checks whether this number is a perfect power.
     *
     * A perfect power is a number of the form a^b where a > 1 and b > 1.
     *
     * @return bool True if the number is a perfect power, false otherwise.
     */
    public function isPerfectPower(): bool;

    /**
     * Checks whether this number is a perfect square.
     *
     * A perfect square is a number of the form n^2.
     *
     * @return bool True if the number is a perfect square, false otherwise.
     */
    public function isPerfectSquare(): bool;

    /**
     * Returns whether this number is greater than zero.
     *
     * @return bool Returns true if this number is greater than zero, false otherwise.
     */
    public function isPositive(): bool;

    /**
     * Returns whether this number is zero.
     *
     * @return bool Returns true if this number is zero, false otherwise.
     */
    public function isZero(): bool;

    /**
     * Computes the Jacobi symbol (a/n).
     *
     * @param BigInteger $value The denominator n (must be odd and positive).
     *
     * @return int Returns -1, 0, or 1 depending on the Jacobi symbol.
     */
    public function jacobi(BigInteger $value): int;

    /**
     * Computes the Kronecker symbol (a/n), a generalization of the Jacobi symbol.
     *
     * @param BigInteger $value The denominator n.
     *
     * @return int Returns -1, 0, or 1 depending on the Kronecker symbol.
     */
    public function kronecker(BigInteger $value): int;

    /**
     * Computes the least common multiple (LCM) of this number and the given value.
     *
     * @param BigInteger $value The value to compute the LCM with.
     *
     * @return static A new BigInteger instance representing the LCM.
     */
    public function leastCommonMultiple(BigInteger $value): static;

    /**
     * Computes the Legendre symbol (a/p).
     *
     * @param BigInteger $value The odd prime p.
     *
     * @return int Returns -1, 0, or 1 depending on the Legendre symbol.
     */
    public function legendre(BigInteger $value): int;

    /**
     * Checks if the big integr is the prime number.
     *
     * @param float $probabilityFactor A normalized factor between 0 and 1 used for checking the probability.
     *
     * @return bool Returns true if the number is a prime number false if not.
     *
     * @throws InvalidProbabilityFactorException Thrown if the probability factor is invalid.
     */
    public function isPrimeNumber(float $probabilityFactor = 1.0): bool;

    /**
     * Multiplies this number by the given value.
     *
     * @param BigInteger $value The number to multiply by.
     *
     * @return static A BigInteger instance representing the result.
     */
    public function multiply(BigInteger $value): static;

    /**
     * Performs a modulo operation with the given value.
     *
     * @param BigInteger $value The modulus.
     *
     * @return static A BigInteger instance representing the result.
     */
    public function mod(BigInteger $value): static;

    /**
     * Negates this number.
     *
     * @return static A BigInteger instance representing the result.
     */
    public function negate(): static;

    /**
     * Finds the next prime greater than this number.
     *
     * @return static A new BigInteger instance representing the next prime number.
     */
    public function nextPrime(): static;

    /**
     * Raises this number to the power of the given exponent.
     *
     * @param int $exponent The exponent.
     *
     * @return static A BigInteger instance representing the result.
     */
    public function pow(int $exponent): static;

    /**
     * Computes the integer n-th root of this number.
     *
     * @param int $nth The degree of the root (must be >= 2).
     *
     * @return static A new BigInteger instance representing the n-th root.
     *
     * @throws InvalidValueException If $nth < 2.
     */
    public function root(int $nth): static;

    /**
     * Determines the sign of this number.
     *
     * @return Sign Returns the sign of this number:
     *   - Sign::NEGATIVE if this number is negative
     *   - Sign::POSITIVE if this number is positive
     *   - Sign::ZERO if this number is zero
     */
    public function sign(): Sign;

    /**
     * Returns the integer square root of this BigInteger.
     *
     * @return static A new instance representing the square root.
     */
    public function sqrt(): static;

    /**
     * Subtracts the given value from this number.
     *
     * @param BigInteger $value The number to subtract.
     *
     * @return static A BigInteger instance representing the result.
     */
    public function subtract(BigInteger $value): static;

    /**
     * Returns the value of the big integer as a string.
     */
    public function value(): string;
}
