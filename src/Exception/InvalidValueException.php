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
 * The InvalidArgumentException class is thrown when an argument is not of the expected type.
 */
final class InvalidValueException extends InvalidArgumentException
{
    /**
     * Creates a new InvalidArgumentException for the given invalid value.
     *
     * @param mixed $value The invalid value that caused the exception.
     * @return self
     */
    public static function fromValue(mixed $value): self
    {
        switch (true) {
            case is_object($value):
                $value = get_class($value);
                break;

            case is_array($value):
                $value = 'array';
                break;

            case is_resource($value):
                $value = 'resource';
                break;

            default:
                $value = (string)$value;
                break;
        }

        $message = sprintf('Invalid value provided: %s', $value);

        return new self($message);
    }
}
