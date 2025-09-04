<?php
/**
 * phpmath / biginteger (https://github.com/phpmath/biginteger)
 *
 * @link https://github.com/phpmath/biginteger for the canonical source repository
 */

declare(strict_types=1);

namespace PHP\Math\BigInteger\Tests\ImmutableBigInteger;

use PHP\Math\BigInteger\ImmutableBigInteger;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\TestCase;

#[CoversMethod(ImmutableBigInteger::class, 'divide')]
#[CoversMethod(ImmutableBigInteger::class, 'fromGmp')]
final class ImmutableBigIntegerDivideTest extends TestCase
{
    public function testDividePositiveNumbers(): void
    {
        // Arrange
        $bigint1 = new ImmutableBigInteger(100);
        $bigint2 = new ImmutableBigInteger(4);

        // Act
        $result = $bigint1->divide($bigint2);

        // Assert
        static::assertInstanceOf(ImmutableBigInteger::class, $result);
        static::assertSame('25', $result->value());
        static::assertNotSame($bigint1, $result); // Immutability check
        static::assertSame('100', $bigint1->value()); // Original unchanged
    }

    public function testDivideWithRemainder(): void
    {
        // Arrange
        $bigint1 = new ImmutableBigInteger(23);
        $bigint2 = new ImmutableBigInteger(5);

        // Act
        $result = $bigint1->divide($bigint2);

        // Assert
        static::assertSame('4', $result->value()); // Integer division truncates
    }

    public function testDivideByOne(): void
    {
        // Arrange
        $bigint1 = new ImmutableBigInteger(42);
        $bigint2 = new ImmutableBigInteger(1);

        // Act
        $result = $bigint1->divide($bigint2);

        // Assert
        static::assertSame('42', $result->value());
    }

    public function testDivideNegativeNumbers(): void
    {
        // Arrange
        $bigint1 = new ImmutableBigInteger(-30);
        $bigint2 = new ImmutableBigInteger(-6);

        // Act
        $result = $bigint1->divide($bigint2);

        // Assert
        static::assertSame('5', $result->value());
    }

    public function testDividePositiveByNegative(): void
    {
        // Arrange
        $bigint1 = new ImmutableBigInteger(20);
        $bigint2 = new ImmutableBigInteger(-4);

        // Act
        $result = $bigint1->divide($bigint2);

        // Assert
        static::assertSame('-5', $result->value());
    }

    public function testDivideNegativeByPositive(): void
    {
        // Arrange
        $bigint1 = new ImmutableBigInteger(-20);
        $bigint2 = new ImmutableBigInteger(4);

        // Act
        $result = $bigint1->divide($bigint2);

        // Assert
        static::assertSame('-5', $result->value());
    }

    public function testDivideZero(): void
    {
        // Arrange
        $bigint1 = new ImmutableBigInteger(0);
        $bigint2 = new ImmutableBigInteger(5);

        // Act
        $result = $bigint1->divide($bigint2);

        // Assert
        static::assertSame('0', $result->value());
    }

    public function testDivideBySelf(): void
    {
        // Arrange
        $bigint1 = new ImmutableBigInteger(42);
        $bigint2 = new ImmutableBigInteger(42);

        // Act
        $result = $bigint1->divide($bigint2);

        // Assert
        static::assertSame('1', $result->value());
    }

    public function testDivideVeryLargeNumbers(): void
    {
        // Arrange
        $bigint1 = new ImmutableBigInteger('999999999999999999999999999999');
        $bigint2 = new ImmutableBigInteger('333333333333333333333333333333');

        // Act
        $result = $bigint1->divide($bigint2);

        // Assert
        static::assertSame('3', $result->value());
    }

    public function testDivideTruncatesResult(): void
    {
        // Arrange
        $bigint1 = new ImmutableBigInteger(7);
        $bigint2 = new ImmutableBigInteger(3);

        // Act
        $result = $bigint1->divide($bigint2);

        // Assert
        static::assertSame('2', $result->value()); // 7/3 = 2.33... -> 2
    }
}
