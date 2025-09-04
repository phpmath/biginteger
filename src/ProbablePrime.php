<?php
/**
 * phpmath / biginteger (https://github.com/phpmath/biginteger)
 *
 * @link https://github.com/phpmath/biginteger for the canonical source repository
 */

declare(strict_types=1);

namespace PHP\Math\BigInteger;

/**
 * Represents the result of a probabilistic primality test.
 */
enum ProbablePrime
{
    /** The number is definitely not prime. */
    case No;

    /** The number may be prime, but further checks are required. */
    case Maybe;

    /** The number is surely a prime according to the test. */
    case Yes;
}
