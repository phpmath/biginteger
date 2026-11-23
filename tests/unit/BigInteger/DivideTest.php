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

#[CoversMethod(BigInteger::class, 'divide')]
#[CoversMethod(BigInteger::class, 'fromGmp')]
final class DivideTest extends TestCase
{
    public function testDividePositiveNumbers(): void
    {
        // Arrange
        $bigint1 = new BigInteger(100);
        $bigint2 = new BigInteger(4);

        // Act
        $result = $bigint1->divide($bigint2);

        // Assert
        static::assertInstanceOf(BigInteger::class, $result);
        static::assertSame('25', $result->value());
        static::assertNotSame($bigint1, $result); // Immutability check
        static::assertSame('100', $bigint1->value()); // Original unchanged
    }

    public function testDivideWithRemainder(): void
    {
        // Arrange
        $bigint1 = new BigInteger(23);
        $bigint2 = new BigInteger(5);

        // Act
        $result = $bigint1->divide($bigint2);

        // Assert
        static::assertSame('4', $result->value()); // Integer division truncates
    }

    public function testDivideByOne(): void
    {
        // Arrange
        $bigint1 = new BigInteger(42);
        $bigint2 = new BigInteger(1);

        // Act
        $result = $bigint1->divide($bigint2);

        // Assert
        static::assertSame('42', $result->value());
    }

    public function testDivideNegativeNumbers(): void
    {
        // Arrange
        $bigint1 = new BigInteger(-30);
        $bigint2 = new BigInteger(-6);

        // Act
        $result = $bigint1->divide($bigint2);

        // Assert
        static::assertSame('5', $result->value());
    }

    public function testDividePositiveByNegative(): void
    {
        // Arrange
        $bigint1 = new BigInteger(20);
        $bigint2 = new BigInteger(-4);

        // Act
        $result = $bigint1->divide($bigint2);

        // Assert
        static::assertSame('-5', $result->value());
    }

    public function testDivideNegativeByPositive(): void
    {
        // Arrange
        $bigint1 = new BigInteger(-20);
        $bigint2 = new BigInteger(4);

        // Act
        $result = $bigint1->divide($bigint2);

        // Assert
        static::assertSame('-5', $result->value());
    }

    public function testDivideZero(): void
    {
        // Arrange
        $bigint1 = new BigInteger(0);
        $bigint2 = new BigInteger(5);

        // Act
        $result = $bigint1->divide($bigint2);

        // Assert
        static::assertSame('0', $result->value());
    }

    public function testDivideBySelf(): void
    {
        // Arrange
        $bigint1 = new BigInteger(42);
        $bigint2 = new BigInteger(42);

        // Act
        $result = $bigint1->divide($bigint2);

        // Assert
        static::assertSame('1', $result->value());
    }

    public function testDivideVeryLargeNumbers(): void
    {
        // Arrange
        $bigint1 = new BigInteger('999999999999999999999999999999');
        $bigint2 = new BigInteger('333333333333333333333333333333');

        // Act
        $result = $bigint1->divide($bigint2);

        // Assert
        static::assertSame('3', $result->value());
    }

    public function testDivideTruncatesResult(): void
    {
        // Arrange
        $bigint1 = new BigInteger(7);
        $bigint2 = new BigInteger(3);

        // Act
        $result = $bigint1->divide($bigint2);

        // Assert
        static::assertSame('2', $result->value()); // 7/3 = 2.33... -> 2
    }

    public function testDivideByZeroThrowsException(): void
    {
        // Arrange
        $a = new BigInteger('10');
        $b = new BigInteger('0');

        // Assert
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage('Invalid value provided: 0');

        // Act
        $a->divide($b);
    }
}
