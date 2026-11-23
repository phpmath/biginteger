<?php
/**
 * phpmath / biginteger (https://github.com/phpmath/biginteger)
 *
 * @link https://github.com/phpmath/biginteger for the canonical source repository
 */

declare(strict_types=1);

namespace PHPMath\BigInteger\Tests\BigInteger;

use PHPMath\BigInteger\BigInteger;
use PHPMath\BigInteger\Exception\InvalidValueException;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\TestCase;

#[CoversMethod(BigInteger::class, 'pow')]
#[CoversMethod(BigInteger::class, 'fromGmp')]
final class PowTest extends TestCase
{
    public function testPowPositiveNumbers(): void
    {
        // Arrange
        $bigint = new BigInteger(5);

        // Act
        $result = $bigint->pow(3);

        // Assert
        static::assertInstanceOf(BigInteger::class, $result);
        static::assertSame('125', $result->value());
        static::assertNotSame($bigint, $result); // Immutability check
        static::assertSame('5', $bigint->value()); // Original unchanged
    }

    public function testPowToZero(): void
    {
        // Arrange
        $bigint = new BigInteger(42);

        // Act
        $result = $bigint->pow(0);

        // Assert
        static::assertSame('1', $result->value());
    }

    public function testPowZeroToZero(): void
    {
        // Arrange
        $bigint = new BigInteger(0);

        // Act
        $result = $bigint->pow(0);

        // Assert
        static::assertSame('1', $result->value()); // 0^0 = 1 by convention in GMP
    }

    public function testPowToOne(): void
    {
        // Arrange
        $bigint = new BigInteger(42);

        // Act
        $result = $bigint->pow(1);

        // Assert
        static::assertSame('42', $result->value());
    }

    public function testPowZeroToPositive(): void
    {
        // Arrange
        $bigint = new BigInteger(0);

        // Act
        $result = $bigint->pow(5);

        // Assert
        static::assertSame('0', $result->value());
    }

    public function testPowOneToAnyPower(): void
    {
        // Arrange
        $bigint = new BigInteger(1);

        // Act
        $result = $bigint->pow(100);

        // Assert
        static::assertSame('1', $result->value());
    }

    public function testPowNegativeBase(): void
    {
        // Arrange
        $bigint = new BigInteger(-3);

        // Act
        $resultEven = $bigint->pow(4);
        $resultOdd = $bigint->pow(3);

        // Assert
        static::assertSame('81', $resultEven->value()); // (-3)^4 = 81
        static::assertSame('-27', $resultOdd->value()); // (-3)^3 = -27
    }

    public function testPowSquare(): void
    {
        // Arrange
        $bigint = new BigInteger(12);

        // Act
        $result = $bigint->pow(2);

        // Assert
        static::assertSame('144', $result->value());
    }

    public function testPowLargeBase(): void
    {
        // Arrange
        $bigint = new BigInteger('123456');

        // Act
        $result = $bigint->pow(2);

        // Assert
        static::assertSame('15241383936', $result->value());
    }

    public function testPowLargeExponent(): void
    {
        // Arrange
        $bigint = new BigInteger(2);

        // Act
        $result = $bigint->pow(10);

        // Assert
        static::assertSame('1024', $result->value());
    }

    public function testPowVeryLargeResult(): void
    {
        // Arrange
        $bigint = new BigInteger(10);

        // Act
        $result = $bigint->pow(20);

        // Assert
        static::assertSame('100000000000000000000', $result->value());
    }

    public function testPowWithNegativeExponentThrowsException(): void
    {
        // Arrange
        $n = new BigInteger('2');

        // Assert
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage('The exponent must not be negative.');

        // Act
        $n->pow(-1);
    }
}
