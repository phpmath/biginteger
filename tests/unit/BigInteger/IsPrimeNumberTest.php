<?php
/**
 * phpmath / biginteger (https://github.com/phpmath/biginteger)
 *
 * @link https://github.com/phpmath/biginteger for the canonical source repository
 */

declare(strict_types=1);

namespace PHPMath\BigInteger\Tests\BigInteger;

use PHPMath\BigInteger\BigInteger;
use PHPMath\BigInteger\Exception\InvalidProbabilityFactorException;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\TestCase;

#[CoversMethod(BigInteger::class, 'isPrimeNumber')]
final class IsPrimeNumberTest extends TestCase
{
    public function testPrimeNumberReturnsTrue(): void
    {
        // Arrange
        $prime = new BigInteger('13');

        // Act
        $result = $prime->isPrimeNumber();

        // Assert
        self::assertTrue($result);
    }

    public function testCompositeNumberReturnsFalse(): void
    {
        // Arrange
        $composite = new BigInteger('12');

        // Act
        $result = $composite->isPrimeNumber();

        // Assert
        self::assertFalse($result);
    }

    public function testNegativeNumberReturnsFalse(): void
    {
        // Arrange
        $negative = new BigInteger('-13');

        // Act
        $result = $negative->isPrimeNumber();

        // Assert
        self::assertFalse($result);
    }

    public function testThrowsExceptionWhenProbabilityFactorTooLow(): void
    {
        // Arrange
        $number = new BigInteger('13');

        // Assert
        $this->expectException(InvalidProbabilityFactorException::class);

        // Act
        $number->isPrimeNumber(-0.1);
    }

    public function testThrowsExceptionWhenProbabilityFactorTooHigh(): void
    {
        // Arrange
        $number = new BigInteger('13');

        // Assert
        $this->expectException(InvalidProbabilityFactorException::class);

        // Act
        $number->isPrimeNumber(2.0);
    }

    public function testBoundaryProbabilityFactorLowEnd(): void
    {
        // Arrange
        $prime = new BigInteger('13');

        // Act
        $result = $prime->isPrimeNumber(0.0);

        // Assert
        self::assertTrue($result);
    }

    public function testBoundaryProbabilityFactorHighEnd(): void
    {
        // Arrange
        $prime = new BigInteger('13');

        // Act
        $result = $prime->isPrimeNumber(1.0);

        // Assert
        self::assertTrue($result);
    }
}
