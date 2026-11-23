<?php
/**
 * phpmath / biginteger (https://github.com/phpmath/biginteger)
 *
 * @link https://github.com/phpmath/biginteger for the canonical source repository
 */

declare(strict_types=1);

namespace PHPMath\BigInteger\Exception;

use InvalidArgumentException;

use function get_debug_type;
use function is_array;
use function is_object;
use function is_resource;
use function is_scalar;
use function sprintf;

/**
 * The InvalidArgumentException class is thrown when an argument is not of the expected type.
 */
final class InvalidValueException extends InvalidArgumentException implements BigIntegerException
{
    /**
     * Creates a new InvalidArgumentException for the given invalid value.
     *
     * @param mixed $value The invalid value that caused the exception.
     */
    public static function fromValue(mixed $value): self
    {
        switch (true) {
            case is_object($value):
                $value = $value::class;
                break;

            case is_array($value):
                $value = 'array';
                break;

            case is_resource($value):
                $value = 'resource';
                break;

            default:
                $value = is_scalar($value) ? (string)$value : get_debug_type($value);
                break;
        }

        $message = sprintf('Invalid value provided: %s', $value);

        return new self($message);
    }
}
