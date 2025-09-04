<?php
/**
 * phpmath / biginteger (https://github.com/phpmath/biginteger)
 *
 * @link https://github.com/phpmath/biginteger for the canonical source repository
 */

declare(strict_types=1);

namespace PHP\Math\BigInteger\Tests\MutableBigInteger;

use PHP\Math\BigInteger\MutableBigInteger;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\TestCase;

#[CoversMethod(MutableBigInteger::class, 'pow')]
final class MutableBigIntegerPowTest extends TestCase
{
    public function testPowPositiveNumbers(): void
    {
        // Arrange
        $bigint = new MutableBigInteger(5);

        // Act
        $result = $bigint->pow(3);

        // Assert
        static::assertSame($bigint, $result); // Returns same instance (mutable)
        static::assertSame('125', $bigint->value());
        static::assertSame('125', $result->value());
    }

    public function testPowToZero(): void
    {
        // Arrange
        $bigint = new MutableBigInteger(42);

        // Act
        $result = $bigint->pow(0);

        // Assert
        static::assertSame($bigint, $result);
        static::assertSame('1', $bigint->value());
    }

    public function testPowZeroToZero(): void
    {
        // Arrange
        $bigint = new MutableBigInteger(0);

        // Act
        $result = $bigint->pow(0);

        // Assert
        static::assertSame($bigint, $result);
        static::assertSame('1', $bigint->value()); // 0^0 = 1 by convention in GMP
    }

    public function testPowToOne(): void
    {
        // Arrange
        $bigint = new MutableBigInteger(42);

        // Act
        $result = $bigint->pow(1);

        // Assert
        static::assertSame($bigint, $result);
        static::assertSame('42', $bigint->value());
    }

    public function testPowZeroToPositive(): void
    {
        // Arrange
        $bigint = new MutableBigInteger(0);

        // Act
        $result = $bigint->pow(5);

        // Assert
        static::assertSame($bigint, $result);
        static::assertSame('0', $bigint->value());
    }

    public function testPowOneToAnyPower(): void
    {
        // Arrange
        $bigint = new MutableBigInteger(1);

        // Act
        $result = $bigint->pow(100);

        // Assert
        static::assertSame($bigint, $result);
        static::assertSame('1', $bigint->value());
    }

    public function testPowNegativeBase(): void
    {
        // Arrange
        $bigintEven = new MutableBigInteger(-3);
        $bigintOdd = new MutableBigInteger(-3);

        // Act
        $resultEven = $bigintEven->pow(4);
        $resultOdd = $bigintOdd->pow(3);

        // Assert
        static::assertSame($bigintEven, $resultEven);
        static::assertSame($bigintOdd, $resultOdd);
        static::assertSame('81', $bigintEven->value()); // (-3)^4 = 81
        static::assertSame('-27', $bigintOdd->value()); // (-3)^3 = -27
    }

    public function testPowSquare(): void
    {
        // Arrange
        $bigint = new MutableBigInteger(12);

        // Act
        $result = $bigint->pow(2);

        // Assert
        static::assertSame($bigint, $result);
        static::assertSame('144', $bigint->value());
    }

    public function testPowLargeBase(): void
    {
        // Arrange
        $bigint = new MutableBigInteger('123456');

        // Act
        $result = $bigint->pow(2);

        // Assert
        static::assertSame($bigint, $result);
        static::assertSame('15241383936', $bigint->value());
    }

    public function testPowLargeExponent(): void
    {
        // Arrange
        $bigint = new MutableBigInteger(2);

        // Act
        $result = $bigint->pow(10);

        // Assert
        static::assertSame($bigint, $result);
        static::assertSame('1024', $bigint->value());
    }

    public function testPowVeryLargeResult(): void
    {
        // Arrange
        $bigint = new MutableBigInteger(10);

        // Act
        $result = $bigint->pow(20);

        // Assert
        static::assertSame($bigint, $result);
        static::assertSame('100000000000000000000', $bigint->value());
    }

    public function testPowModifiesOriginal(): void
    {
        // Arrange
        $bigint = new MutableBigInteger(6);
        $originalValue = $bigint->value();

        // Act
        $bigint->pow(2);

        // Assert
        static::assertNotSame($originalValue, $bigint->value());
        static::assertSame('36', $bigint->value());
    }

    public function testPowChaining(): void
    {
        // Arrange
        $bigint = new MutableBigInteger(2);

        // Act - Note: This would be 2^3^2 = 2^9 = 512, but since it's mutable,
        // it's actually (2^3)^2 = 8^2 = 64
        $result = $bigint->pow(3)->pow(2);

        // Assert
        static::assertSame($bigint, $result);
        static::assertSame('64', $bigint->value());
    }
}
