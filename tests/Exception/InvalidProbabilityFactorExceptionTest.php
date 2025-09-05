<?php
/**
 * phpmath / biginteger (https://github.com/phpmath/biginteger)
 *
 * @link https://github.com/phpmath/biginteger for the canonical source repository
 */

declare(strict_types=1);

namespace PHP\Math\BigInteger\Tests\Exception;

use PHP\Math\BigInteger\Exception\InvalidProbabilityFactorException;
use PHP\Math\BigInteger\Exception\InvalidValueException;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\TestCase;

#[CoversMethod(InvalidValueException::class, 'fromValue')]
final class InvalidProbabilityFactorExceptionTest extends TestCase
{
    public function testFromValueCreatesExceptionWithCorrectMessage(): void
    {
        // Arrange
        $invalidValue = 1.5;

        // Act
        $exception = InvalidProbabilityFactorException::fromValue($invalidValue);

        // Assert
        self::assertInstanceOf(InvalidProbabilityFactorException::class, $exception);
        self::assertSame(
            'The provided probability number should be between 0.0 and 1.0, got: 1.5',
            $exception->getMessage(),
        );
    }

    public function testFromValueAcceptsNegativeValue(): void
    {
        // Arrange
        $invalidValue = -0.2;

        // Act
        $exception = InvalidProbabilityFactorException::fromValue($invalidValue);

        // Assert
        self::assertSame(
            'The provided probability number should be between 0.0 and 1.0, got: -0.2',
            $exception->getMessage(),
        );
    }

    public function testFromValueAcceptsZeroValue(): void
    {
        // Arrange
        $invalidValue = 0.0;

        // Act
        $exception = InvalidProbabilityFactorException::fromValue($invalidValue);

        // Assert
        self::assertSame(
            'The provided probability number should be between 0.0 and 1.0, got: 0',
            $exception->getMessage(),
        );
    }
}
