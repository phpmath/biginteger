<?php
/**
 * phpmath / biginteger (https://github.com/phpmath/biginteger)
 *
 * @link https://github.com/phpmath/biginteger for the canonical source repository
 */

declare(strict_types=1);

namespace PHP\Math\BigInteger;

use GMP;
use PHP\Math\BigInteger\Exception\InvalidArgumentException;
use PHP\Math\BigInteger\Exception\InvalidValueException;

use ValueError;

use function gmp_abs;
use function gmp_add;
use function gmp_cmp;
use function gmp_div_q;
use function gmp_fact;
use function gmp_init;
use function gmp_mod;
use function gmp_mul;
use function gmp_neg;
use function gmp_pow;
use function gmp_strval;
use function gmp_sub;

use const GMP_ROUND_ZERO;

/**
 * An immutable big integer implementation.
 *
 * All arithmetic operations return a new instance, leaving the original unchanged.
 */
final class ImmutableBigInteger implements BigInteger
{
    /**
     * The internal GMP representation of the big integer.
     *
     * All arithmetic operations are performed on this GMP resource.
     */
    protected GMP $handle;

    /**
     * Initializes a new immutable big integer.
     *
     * @param string|int $value The initial value.
     *
     * @throws InvalidValueException Throw if the value is invalid.
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
     * Helper to create a new instance from a GMP resource.
     *
     * @param GMP $gmp The GMP value.
     *
     * @return static
     */
    protected static function fromGmp(GMP $gmp): static
    {
        return new static(gmp_strval($gmp));
    }

    public function abs(): static
    {
        return self::fromGmp(gmp_abs($this->handle));
    }

    public function add(BigInteger $value): static
    {
        return self::fromGmp(gmp_add($this->handle, $value->handle));
    }

    public function binomial(int $k): static
    {
        return self::fromGmp(gmp_binomial($this->handle, $k));
    }

    public function bitwiseAnd(BigInteger $value): static
    {
        return self::fromGmp(gmp_and($this->handle, $value->handle));
    }

    public function bitwiseNot(): static
    {
        return self::fromGmp(gmp_com($this->handle));
    }

    public function bitwiseOr(BigInteger $value): static
    {
        return self::fromGmp(gmp_or($this->handle, $value->handle));
    }

    public function bitwiseXor(BigInteger $value): static
    {
        return self::fromGmp(gmp_xor($this->handle, $value->handle));
    }

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

    public function cmp(BigInteger $value): int
    {
        return gmp_cmp($this->handle, $value->handle);
    }

    public function divide(BigInteger $value): static
    {
        return self::fromGmp(gmp_div_q($this->handle, $value->handle, GMP_ROUND_ZERO));
    }

    public function divideRemainder(BigInteger $value): static
    {
        if ($value->isZero()) {
            throw InvalidValueException::fromValue(0);
        }

        return self::fromGmp(gmp_div_r($this->handle, $value->handle, GMP_ROUND_ZERO));
    }

    public function equals(BigInteger $value): bool
    {
        return gmp_cmp($this->handle, $value->handle) === 0;
    }

    public function factorial(): static
    {
        return self::fromGmp(gmp_fact($this->handle));
    }

    public function greatestCommonDivisor(BigInteger $value): static
    {
        return self::fromGmp(gmp_gcd($this->handle, $value->handle));
    }

    public function hammingDistance(BigInteger $value): int
    {
        if ($this->isNegative() || $value->isNegative()) {
            throw new InvalidValueException('Negative numbers do not have a Hamming distance.');
        }

        return gmp_hamdist($this->handle, $value->handle);
    }

    public function invert(BigInteger $value): static
    {
        $result = gmp_invert($this->handle, $value->handle);

        if ($result === false) {
            throw new InvalidValueException('No modular inverse exists.');
        }

        return self::fromGmp($result);
    }

    public function isNegative(): bool
    {
        return gmp_cmp($this->handle, 0) < 0;
    }

    public function isPerfectPower(): bool
    {
        if ($this->isNegative()) {
            return false;
        }

        return gmp_perfect_power($this->handle);
    }

    public function isPerfectSquare(): bool
    {
        return gmp_perfect_square($this->handle);
    }

    public function isPositive(): bool
    {
        return gmp_cmp($this->handle, 0) > 0;
    }

    public function isZero(): bool
    {
        return gmp_cmp($this->handle, 0) === 0;
    }

    public function jacobi(BigInteger $value): int
    {
        return gmp_jacobi($this->handle, $value->handle);
    }

    public function kronecker(BigInteger $value): int
    {
        return gmp_kronecker($this->handle, $value->handle);
    }

    public function leastCommonMultiple(BigInteger $value): static
    {
        return self::fromGmp(gmp_lcm($this->handle, $value->handle));
    }

    public function legendre(BigInteger $value): int
    {
        return gmp_legendre($this->handle, $value->handle);
    }

    public function multiply(BigInteger $value): static
    {
        return self::fromGmp(gmp_mul($this->handle, $value->handle));
    }

    public function mod(BigInteger $value): static
    {
        return self::fromGmp(gmp_mod($this->handle, $value->handle));
    }

    public function negate(): static
    {
        return self::fromGmp(gmp_neg($this->handle));
    }

    public function nextPrime(): static
    {
        return self::fromGmp(gmp_nextprime($this->handle));
    }

    public function pow(int $exponent): static
    {
        return self::fromGmp(gmp_pow($this->handle, $exponent));
    }

    public function root(int $nth): static
    {
        return self::fromGmp(gmp_root($this->handle, $nth));
    }

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

    public function sqrt(): static
    {
        return self::fromGmp(gmp_sqrt($this->handle));
    }

    public function subtract(BigInteger $value): static
    {
        return self::fromGmp(gmp_sub($this->handle, $value->handle));
    }

    public function value(): string
    {
        return gmp_strval($this->handle);
    }
}
