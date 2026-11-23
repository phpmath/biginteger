<?php
/**
 * phpmath / biginteger (https://github.com/phpmath/biginteger)
 *
 * @link https://github.com/phpmath/biginteger for the canonical source repository
 */

declare(strict_types=1);

namespace PHPMath\BigInteger;

use GMP;
use PHPMath\BigInteger\Exception\InvalidProbabilityFactorException;
use PHPMath\BigInteger\Exception\InvalidValueException;
use PHPMath\BigInteger\Exception\NotInvertibleException;
use ValueError;

use function floor;
use function gmp_abs;
use function gmp_add;
use function gmp_and;
use function gmp_binomial;
use function gmp_cmp;
use function gmp_com;
use function gmp_div_q;
use function gmp_div_r;
use function gmp_fact;
use function gmp_gcd;
use function gmp_hamdist;
use function gmp_init;
use function gmp_invert;
use function gmp_jacobi;
use function gmp_kronecker;
use function gmp_lcm;
use function gmp_legendre;
use function gmp_mod;
use function gmp_mul;
use function gmp_neg;
use function gmp_nextprime;
use function gmp_or;
use function gmp_perfect_power;
use function gmp_perfect_square;
use function gmp_pow;
use function gmp_prob_prime;
use function gmp_root;
use function gmp_sign;
use function gmp_sqrt;
use function gmp_strval;
use function gmp_sub;
use function gmp_xor;

use const GMP_ROUND_ZERO;

/**
 * An immutable arbitrary-precision integer.
 *
 * All arithmetic operations return a new instance, leaving the original unchanged.
 */
final readonly class BigInteger
{
    /**
     * The internal GMP representation of the big integer.
     *
     * All arithmetic operations are performed on this GMP value.
     */
    private GMP $handle;

    /**
     * Initializes a new big integer.
     *
     * @param string|int $value The initial value.
     *
     * @throws InvalidValueException Thrown if the value is invalid.
     */
    public function __construct(string|int $value)
    {
        try {
            $this->handle = gmp_init($value);
        } catch (ValueError $exception) {
            throw new InvalidValueException('Invalid number provided', 0, $exception);
        }
    }

    /**
     * Helper to create a new instance from a GMP value.
     *
     * @param GMP $gmp The GMP value.
     */
    private static function fromGmp(GMP $gmp): self
    {
        return new self(gmp_strval($gmp));
    }

    /**
     * Returns the absolute value of this number.
     *
     * @return self A BigInteger instance representing the result.
     */
    public function abs(): self
    {
        return self::fromGmp(gmp_abs($this->handle));
    }

    /**
     * Adds the given value to this number.
     *
     * @param BigInteger $value The number to add.
     *
     * @return self A BigInteger instance representing the result.
     */
    public function add(BigInteger $value): self
    {
        return self::fromGmp(gmp_add($this->handle, $value->handle));
    }

    /**
     * Calculates the binomial coefficient C(n, k), also known as "n choose k".
     *
     * The binomial coefficient represents the number of ways to choose {@see $k}
     * elements from a set of n elements (this number) without regard to the order
     * of selection.
     *
     * @param int $k The number of elements to choose.
     *
     * @return self A BigInteger instance representing the binomial coefficient.
     *
     * @throws InvalidValueException If $k is negative.
     */
    public function binomial(int $k): self
    {
        if ($k < 0) {
            throw new InvalidValueException('The number of elements to choose must not be negative.');
        }

        return self::fromGmp(gmp_binomial($this->handle, $k));
    }

    /**
     * Performs a bitwise AND operation between this big integer and the given value.
     *
     * @param BigInteger $value The value to AND with.
     *
     * @return self A BigInteger instance representing the result.
     */
    public function bitwiseAnd(BigInteger $value): self
    {
        return self::fromGmp(gmp_and($this->handle, $value->handle));
    }

    /**
     * Performs a bitwise NOT (one's complement) operation on this big integer.
     *
     * Each bit in the binary representation is inverted:
     * 1 becomes 0, and 0 becomes 1.
     *
     * @return self A new BigInteger instance representing the result.
     */
    public function bitwiseNot(): self
    {
        return self::fromGmp(gmp_com($this->handle));
    }

    /**
     * Performs a bitwise OR operation between this big integer and the given value.
     *
     * @param BigInteger $value The value to OR with.
     *
     * @return self A BigInteger instance representing the result.
     */
    public function bitwiseOr(BigInteger $value): self
    {
        return self::fromGmp(gmp_or($this->handle, $value->handle));
    }

    /**
     * Performs a bitwise XOR (exclusive OR) operation between this big integer and the given value.
     *
     * @param BigInteger $value The value to XOR with.
     *
     * @return self A BigInteger instance representing the result.
     */
    public function bitwiseXor(BigInteger $value): self
    {
        return self::fromGmp(gmp_xor($this->handle, $value->handle));
    }

    /**
     * Performs a probabilistic primality check on this number.
     *
     * The result indicates whether the number is composite, likely prime,
     * or definitely prime within the bounds of the test.
     *
     * @return ProbablePrime The result of the primality check.
     */
    public function checkPrimeProbability(): ProbablePrime
    {
        if ($this->isNegative()) {
            return ProbablePrime::No;
        }

        $result = gmp_prob_prime($this->handle);

        return match ($result) {
            2 => ProbablePrime::Yes,
            1 => ProbablePrime::Maybe,
            default => ProbablePrime::No,
        };
    }

    /**
     * Compares this number with another value.
     * If you want to know if the numbers are equal, use {@see equals()} instead.
     *
     * @param BigInteger $value The number to compare against.
     *
     * @return int Returns -1 if this number is smaller, 0 if equal, and 1 if larger.
     */
    public function cmp(BigInteger $value): int
    {
        return gmp_cmp($this->handle, $value->handle);
    }

    /**
     * Divides this number by the given value (integer division).
     *
     * The result is truncated toward zero. To get a rounded quotient, use `Fraction::of($a, $b)->round()` from
     * phpmath/fraction.
     *
     * @param BigInteger $value The number to divide by.
     *
     * @return self A BigInteger instance representing the result.
     *
     * @throws InvalidValueException If $value is zero.
     */
    public function divide(BigInteger $value): self
    {
        if ($value->isZero()) {
            throw InvalidValueException::fromValue(0);
        }

        return self::fromGmp(gmp_div_q($this->handle, $value->handle, GMP_ROUND_ZERO));
    }

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
     * @return self A new BigInteger instance representing the remainder.
     *
     * @throws InvalidValueException If $value is zero.
     */
    public function divideRemainder(BigInteger $value): self
    {
        if ($value->isZero()) {
            throw InvalidValueException::fromValue(0);
        }

        return self::fromGmp(gmp_div_r($this->handle, $value->handle, GMP_ROUND_ZERO));
    }

    /**
     * Checks if this number is equal to another value.
     *
     * @param BigInteger $value The number to compare against.
     *
     * @return bool True if equal, false otherwise.
     */
    public function equals(BigInteger $value): bool
    {
        return gmp_cmp($this->handle, $value->handle) === 0;
    }

    /**
     * Calculates the factorial of this number.
     *
     * @return self A BigInteger instance representing the result.
     *
     * @throws InvalidValueException If this number is negative.
     */
    public function factorial(): self
    {
        if ($this->isNegative()) {
            throw new InvalidValueException('Cannot calculate the factorial of a negative number.');
        }

        return self::fromGmp(gmp_fact($this->handle));
    }

    /**
     * Computes the greatest common divisor (GCD) of this number and the given value.
     *
     * @param BigInteger $value The value to compute the GCD with.
     *
     * @return self A new BigInteger instance representing the GCD.
     */
    public function greatestCommonDivisor(BigInteger $value): self
    {
        return self::fromGmp(gmp_gcd($this->handle, $value->handle));
    }

    /**
     * Computes the Hamming distance between this number and the given value.
     *
     * The Hamming distance is the number of differing bits in the binary representation.
     *
     * @param BigInteger $value The value to compare with.
     *
     * @return int The number of differing bits.
     */
    public function hammingDistance(BigInteger $value): int
    {
        if ($this->isNegative() || $value->isNegative()) {
            throw new InvalidValueException('Negative numbers do not have a Hamming distance.');
        }

        return gmp_hamdist($this->handle, $value->handle);
    }

    /**
     * Computes the modular multiplicative inverse of this number modulo the given value.
     *
     * The result `x` satisfies: (this * x) ≡ 1 (mod $value).
     *
     * @param BigInteger $value The modulus.
     *
     * @return self A new BigInteger instance representing the modular inverse.
     *
     * @throws InvalidValueException If the modulus is zero.
     * @throws NotInvertibleException If no inverse exists.
     */
    public function invert(BigInteger $value): self
    {
        if ($value->isZero()) {
            throw InvalidValueException::fromValue(0);
        }

        $result = gmp_invert($this->handle, $value->handle);

        if ($result === false) {
            throw new NotInvertibleException('No modular inverse exists.');
        }

        return self::fromGmp($result);
    }

    /**
     * Returns whether this number is less than zero.
     *
     * @return bool Returns true if this number is less than zero, false otherwise.
     */
    public function isNegative(): bool
    {
        return gmp_cmp($this->handle, 0) < 0;
    }

    /**
     * Checks whether this number is a perfect power.
     *
     * A perfect power is a number of the form a^b where a > 1 and b > 1.
     *
     * @return bool True if the number is a perfect power, false otherwise.
     */
    public function isPerfectPower(): bool
    {
        if ($this->isNegative()) {
            return false;
        }

        return gmp_perfect_power($this->handle);
    }

    /**
     * Checks whether this number is a perfect square.
     *
     * A perfect square is a number of the form n^2.
     *
     * @return bool True if the number is a perfect square, false otherwise.
     */
    public function isPerfectSquare(): bool
    {
        return gmp_perfect_square($this->handle);
    }

    /**
     * Returns whether this number is greater than zero.
     *
     * @return bool Returns true if this number is greater than zero, false otherwise.
     */
    public function isPositive(): bool
    {
        return gmp_cmp($this->handle, 0) > 0;
    }

    /**
     * Checks if the big integr is the prime number.
     *
     * @param float $probabilityFactor A normalized factor between 0 and 1 used for checking the probability.
     *
     * @return bool Returns true if the number is a prime number false if not.
     *
     * @throws InvalidProbabilityFactorException Thrown if the probability factor is invalid.
     */
    public function isPrimeNumber(float $probabilityFactor = 1.0): bool
    {
        if ($this->isNegative()) {
            return false;
        }

        if ($probabilityFactor < 0.0 || $probabilityFactor > 1.0) {
            throw InvalidProbabilityFactorException::fromValue($probabilityFactor);
        }

        $reps = (int)floor(($probabilityFactor * 5.0) + 5.0);

        return gmp_prob_prime($this->handle, $reps) !== 0;
    }

    /**
     * Returns whether this number is zero.
     *
     * @return bool Returns true if this number is zero, false otherwise.
     */
    public function isZero(): bool
    {
        return gmp_cmp($this->handle, 0) === 0;
    }

    /**
     * Computes the Jacobi symbol (a/n).
     *
     * @param BigInteger $value The denominator n (must be odd and positive).
     *
     * @return int Returns -1, 0, or 1 depending on the Jacobi symbol.
     */
    public function jacobi(BigInteger $value): int
    {
        return gmp_jacobi($this->handle, $value->handle);
    }

    /**
     * Computes the Kronecker symbol (a/n), a generalization of the Jacobi symbol.
     *
     * @param BigInteger $value The denominator n.
     *
     * @return int Returns -1, 0, or 1 depending on the Kronecker symbol.
     */
    public function kronecker(BigInteger $value): int
    {
        return gmp_kronecker($this->handle, $value->handle);
    }

    /**
     * Computes the least common multiple (LCM) of this number and the given value.
     *
     * @param BigInteger $value The value to compute the LCM with.
     *
     * @return self A new BigInteger instance representing the LCM.
     */
    public function leastCommonMultiple(BigInteger $value): self
    {
        return self::fromGmp(gmp_lcm($this->handle, $value->handle));
    }

    /**
     * Computes the Legendre symbol (a/p).
     *
     * @param BigInteger $value The odd prime p.
     *
     * @return int Returns -1, 0, or 1 depending on the Legendre symbol.
     */
    public function legendre(BigInteger $value): int
    {
        return gmp_legendre($this->handle, $value->handle);
    }

    /**
     * Multiplies this number by the given value.
     *
     * @param BigInteger $value The number to multiply by.
     *
     * @return self A BigInteger instance representing the result.
     */
    public function multiply(BigInteger $value): self
    {
        return self::fromGmp(gmp_mul($this->handle, $value->handle));
    }

    /**
     * Performs a modulo operation with the given value.
     *
     * @param BigInteger $value The modulus.
     *
     * @return self A BigInteger instance representing the result.
     *
     * @throws InvalidValueException If $value is zero.
     */
    public function mod(BigInteger $value): self
    {
        if ($value->isZero()) {
            throw InvalidValueException::fromValue(0);
        }

        return self::fromGmp(gmp_mod($this->handle, $value->handle));
    }

    /**
     * Negates this number.
     *
     * @return self A BigInteger instance representing the result.
     */
    public function negate(): self
    {
        return self::fromGmp(gmp_neg($this->handle));
    }

    /**
     * Finds the next prime greater than this number.
     *
     * @return self A new BigInteger instance representing the next prime number.
     */
    public function nextPrime(): self
    {
        return self::fromGmp(gmp_nextprime($this->handle));
    }

    /**
     * Raises this number to the power of the given exponent.
     *
     * @param int $exponent The exponent (must be zero or more).
     *
     * @return self A BigInteger instance representing the result.
     *
     * @throws InvalidValueException If $exponent is negative.
     */
    public function pow(int $exponent): self
    {
        if ($exponent < 0) {
            throw new InvalidValueException('The exponent must not be negative.');
        }

        return self::fromGmp(gmp_pow($this->handle, $exponent));
    }

    /**
     * Computes the integer n-th root of this number.
     *
     * @param int $nth The degree of the root (must be at least 1).
     *
     * @return self A new BigInteger instance representing the n-th root.
     *
     * @throws InvalidValueException If $nth is below 1, or if this number is negative and $nth is even.
     */
    public function root(int $nth): self
    {
        if ($nth < 1) {
            throw new InvalidValueException('The degree of the root must be at least 1.');
        }

        if ($this->isNegative() && $nth % 2 === 0) {
            throw new InvalidValueException('Cannot calculate an even root of a negative number.');
        }

        return self::fromGmp(gmp_root($this->handle, $nth));
    }

    /**
     * Determines the sign of this number.
     *
     * @return Sign Returns the sign of this number:
     *   - Sign::Negative if this number is negative
     *   - Sign::POSITIVE if this number is positive
     *   - Sign::ZERO if this number is zero
     */
    public function sign(): Sign
    {
        switch (gmp_sign($this->handle)) {
            case -1:
                return Sign::Negative;

            case 0:
                return Sign::Zero;

            default:
                break;
        }

        return Sign::Positive;
    }

    /**
     * Returns the integer square root of this BigInteger.
     *
     * @return self A new instance representing the square root.
     *
     * @throws InvalidValueException If this number is negative.
     */
    public function sqrt(): self
    {
        if ($this->isNegative()) {
            throw new InvalidValueException('Cannot calculate the square root of a negative number.');
        }

        return self::fromGmp(gmp_sqrt($this->handle));
    }

    /**
     * Subtracts the given value from this number.
     *
     * @param BigInteger $value The number to subtract.
     *
     * @return self A BigInteger instance representing the result.
     */
    public function subtract(BigInteger $value): self
    {
        return self::fromGmp(gmp_sub($this->handle, $value->handle));
    }

    /**
     * Returns the value of the big integer as a string.
     */
    public function value(): string
    {
        return gmp_strval($this->handle);
    }
}
