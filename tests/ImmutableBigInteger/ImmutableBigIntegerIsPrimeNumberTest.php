<?php
/**
 * phpmath / biginteger (https://github.com/phpmath/biginteger)
 *
 * @link https://github.com/phpmath/biginteger for the canonical source repository
 */

declare(strict_types=1);

namespace ImmutableBigInteger;

use PHP\Math\BigInteger\Exception\InvalidProbabilityFactorException;
use PHP\Math\BigInteger\ImmutableBigInteger;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\TestCase;

#[CoversMethod(ImmutableBigInteger::class, 'isPrimeNumber')]
final class ImmutableBigIntegerIsPrimeNumberTest extends TestCase
{
    public function testPrimeNumberReturnsTrue(): void
    {
        // Arrange
        $prime = new ImmutableBigInteger('13');

        // Act
        $result = $prime->isPrimeNumber();

        // Assert
        self::assertTrue($result);
    }

    public function testCompositeNumberReturnsFalse(): void
    {
        // Arrange
        $composite = new ImmutableBigInteger('12');

        // Act
        $result = $composite->isPrimeNumber();

        // Assert
        self::assertFalse($result);
    }

    public function testNegativeNumberReturnsFalse(): void
    {
        // Arrange
        $negative = new ImmutableBigInteger('-13');

        // Act
        $result = $negative->isPrimeNumber();

        // Assert
        self::assertFalse($result);
    }

    public function testThrowsExceptionWhenProbabilityFactorTooLow(): void
    {
        // Arrange
        $number = new ImmutableBigInteger('13');

        // Assert
        $this->expectException(InvalidProbabilityFactorException::class);

        // Act
        $number->isPrimeNumber(-0.1);
    }

    public function testThrowsExceptionWhenProbabilityFactorTooHigh(): void
    {
        // Arrange
        $number = new ImmutableBigInteger('13');

        // Assert
        $this->expectException(InvalidProbabilityFactorException::class);

        // Act
        $number->isPrimeNumber(2.0);
    }

    public function testBoundaryProbabilityFactorLowEnd(): void
    {
        // Arrange
        $prime = new ImmutableBigInteger('13');

        // Act
        $result = $prime->isPrimeNumber(0.0);

        // Assert
        self::assertTrue($result);
    }

    public function testBoundaryProbabilityFactorHighEnd(): void
    {
        // Arrange
        $prime = new ImmutableBigInteger('13');

        // Act
        $result = $prime->isPrimeNumber(1.0);

        // Assert
        self::assertTrue($result);
    }
}
