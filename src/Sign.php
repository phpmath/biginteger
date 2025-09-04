<?php
/**
 * phpmath / biginteger (https://github.com/phpmath/biginteger)
 *
 * @link https://github.com/phpmath/biginteger for the canonical source repository
 */

declare(strict_types=1);

namespace PHP\Math\BigInteger;

/**
 * Represents the sign of a number.
 */
enum Sign
{
    /** The number is greater than zero. */
    case Positive;

    /** The number is less than zero. */
    case Negative;

    /** The number is exactly zero. */
    case Zero;
}
