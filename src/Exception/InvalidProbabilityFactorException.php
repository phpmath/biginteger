<?php
/**
 * phpmath / biginteger (https://github.com/phpmath/biginteger)
 *
 * @link https://github.com/phpmath/biginteger for the canonical source repository
 */

declare(strict_types=1);

namespace PHP\Math\BigInteger\Exception;

use InvalidArgumentException;

/**
 * The InvalidProbabilityFactorException exception is thrown when an invalid probability factor is provided.
 */
final class InvalidProbabilityFactorException extends InvalidArgumentException
{
    /**
     * Creates a new InvalidProbabilityFactorException for the given invalid value.
     *
     * @param float $value The invalid value that caused the exception.
     */
    public static function fromValue(float $value): self
    {
        $message = 'The provided probability number should be between 0.0 and 1.0, got: ' . $value;

        return new self($message);
    }
}
