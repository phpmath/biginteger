<?php
/**
 * phpmath / biginteger (https://github.com/phpmath/biginteger)
 *
 * @link https://github.com/phpmath/biginteger for the canonical source repository
 */

declare(strict_types=1);

namespace PHPMath\BigInteger\Exception;

use DomainException;

/**
 * Thrown when a number has no modular multiplicative inverse for the given modulus.
 */
final class NotInvertibleException extends DomainException implements BigIntegerException
{
}
