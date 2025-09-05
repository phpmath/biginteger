<?php
/**
 * phpmath / biginteger (https://github.com/phpmath/biginteger)
 *
 * @link https://github.com/phpmath/biginteger for the canonical source repository
 */

declare(strict_types=1);

namespace PHP\Math\BigInteger;

use GMP;
use PHP\Math\BigInteger\Exception\InvalidValueException;
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
 * A mutable big integer implementation.
 *
 * All arithmetic operations will modify the current instance.
 */
final class MutableBigInteger implements BigInteger
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
            throw InvalidValueException::fromValue('Invalid number provided', $exception);
        }
    }

    public function abs(): static
    {
        $this->handle = gmp_abs($this->handle);

        return $this;
    }

    public function add(BigInteger $value): static
    {
        $this->handle = gmp_add($this->handle, $value->handle);

        return $this;
    }

    public function binomial(int $k): static
    {
        $this->handle = gmp_binomial($this->handle, $k);

        return $this;
    }

    public function bitwiseAnd(BigInteger $value): static
    {
        $this->handle = gmp_and($this->handle, $value->handle);

        return $this;
    }

    public function bitwiseNot(): static
    {
        $this->handle = gmp_com($this->handle);

        return $this;
    }

    public function bitwiseOr(BigInteger $value): static
    {
        $this->handle = gmp_or($this->handle, $value->handle);

        return $this;
    }

    public function bitwiseXor(BigInteger $value): static
    {
        $this->handle = gmp_xor($this->handle, $value->handle);

        return $this;
    }

    public function checkPrimeProbability(): ProbablePrime
    {
        $result = gmp_prob_prime($this->handle);

        if ($result === 2) {
            return ProbablePrime::Yes;
        }

        if ($result === 1) {
            return ProbablePrime::Maybe;
        }

        return ProbablePrime::No;
    }

    public function cmp(BigInteger $value): int
    {
        return gmp_cmp($this->handle, $value->handle);
    }

    public function divide(BigInteger $value): static
    {
        $this->handle = gmp_div_q($this->handle, $value->handle, GMP_ROUND_ZERO);

        return $this;
    }

    public function divideRemainder(BigInteger $value): static
    {
        $this->handle = gmp_div_r($this->handle, $value->handle, GMP_ROUND_ZERO);

        return $this;
    }

    public function equals(BigInteger $value): bool
    {
        return gmp_cmp($this->handle, $value->handle) === 0;
    }

    public function factorial(): static
    {
        $this->handle = gmp_fact($this->handle);

        return $this;
    }

    public function greatestCommonDivisor(BigInteger $value): static
    {
        $this->handle = gmp_gcd($this->handle, $value->handle);

        return $this;
    }

    public function hammingDistance(BigInteger $value): int
    {
        return gmp_hamdist($this->handle, $value->handle);
    }

    public function invert(BigInteger $value): static
    {
        $this->handle = gmp_invert($this->handle, $value->handle);

        return $this;
    }

    public function isNegative(): bool
    {
        return gmp_cmp($this->handle, 0) < 0;
    }

    public function isPerfectPower(): bool
    {
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

    public function isPrimeNumber(float $probabilityFactor = 1.0): bool
    {
        $reps = (int)floor(($probabilityFactor * 5.0) + 5.0);

        if ($reps < 5 || $reps > 10) {
            throw new InvalidValueException('The provided probability number should be 5 to 10.');
        }

        return gmp_prob_prime($this->handle, $reps) !== 0;
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
        $this->handle = gmp_lcm($this->handle, $value->handle);

        return $this;
    }

    public function legendre(BigInteger $value): int
    {
        return gmp_legendre($this->handle, $value->handle);
    }

    public function multiply(BigInteger $value): static
    {
        $this->handle = gmp_mul($this->handle, $value->handle);

        return $this;
    }

    public function mod(BigInteger $value): static
    {
        $this->handle = gmp_mod($this->handle, $value->handle);

        return $this;
    }

    public function negate(): static
    {
        $this->handle = gmp_neg($this->handle);

        return $this;
    }

    public function nextPrime(): static
    {
        $this->handle = gmp_nextprime($this->handle);

        return $this;
    }

    public function pow(int $exponent): static
    {
        $this->handle = gmp_pow($this->handle, $exponent);

        return $this;
    }

    public function root(int $nth): static
    {
        $this->handle = gmp_root($this->handle, $nth);

        return $this;
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
        $this->handle = gmp_sqrt($this->handle);

        return $this;
    }

    public function subtract(BigInteger $value): static
    {
        $this->handle = gmp_sub($this->handle, $value->handle);

        return $this;
    }

    public function value(): string
    {
        return gmp_strval($this->handle);
    }
}
