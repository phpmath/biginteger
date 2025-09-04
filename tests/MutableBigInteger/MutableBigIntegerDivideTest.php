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

#[CoversMethod(MutableBigInteger::class, 'divide')]
final class MutableBigIntegerDivideTest extends TestCase
{
    public function testDividePositiveNumbers(): void
    {
        // Arrange
        $bigint1 = new MutableBigInteger(100);
        $bigint2 = new MutableBigInteger(4);

        // Act
        $result = $bigint1->divide($bigint2);

        // Assert
        static::assertSame($bigint1, $result); // Returns same instance (mutable)
        static::assertSame('25', $bigint1->value());
        static::assertSame('25', $result->value());
    }

    public function testDivideWithRemainder(): void
    {
        // Arrange
        $bigint1 = new MutableBigInteger(23);
        $bigint2 = new MutableBigInteger(5);

        // Act
        $result = $bigint1->divide($bigint2);

        // Assert
        static::assertSame($bigint1, $result);
        static::assertSame('4', $bigint1->value()); // Integer division truncates
    }

    public function testDivideByOne(): void
    {
        // Arrange
        $bigint1 = new MutableBigInteger(42);
        $bigint2 = new MutableBigInteger(1);

        // Act
        $result = $bigint1->divide($bigint2);

        // Assert
        static::assertSame($bigint1, $result);
        static::assertSame('42', $bigint1->value());
    }

    public function testDivideNegativeNumbers(): void
    {
        // Arrange
        $bigint1 = new MutableBigInteger(-30);
        $bigint2 = new MutableBigInteger(-6);

        // Act
        $result = $bigint1->divide($bigint2);

        // Assert
        static::assertSame($bigint1, $result);
        static::assertSame('5', $bigint1->value());
    }

    public function testDividePositiveByNegative(): void
    {
        // Arrange
        $bigint1 = new MutableBigInteger(20);
        $bigint2 = new MutableBigInteger(-4);

        // Act
        $result = $bigint1->divide($bigint2);

        // Assert
        static::assertSame($bigint1, $result);
        static::assertSame('-5', $bigint1->value());
    }

    public function testDivideNegativeByPositive(): void
    {
        // Arrange
        $bigint1 = new MutableBigInteger(-20);
        $bigint2 = new MutableBigInteger(4);

        // Act
        $result = $bigint1->divide($bigint2);

        // Assert
        static::assertSame($bigint1, $result);
        static::assertSame('-5', $bigint1->value());
    }

    public function testDivideZero(): void
    {
        // Arrange
        $bigint1 = new MutableBigInteger(0);
        $bigint2 = new MutableBigInteger(5);

        // Act
        $result = $bigint1->divide($bigint2);

        // Assert
        static::assertSame($bigint1, $result);
        static::assertSame('0', $bigint1->value());
    }

    public function testDivideBySelf(): void
    {
        // Arrange
        $bigint1 = new MutableBigInteger(42);
        $bigint2 = new MutableBigInteger(42);

        // Act
        $result = $bigint1->divide($bigint2);

        // Assert
        static::assertSame($bigint1, $result);
        static::assertSame('1', $bigint1->value());
    }

    public function testDivideVeryLargeNumbers(): void
    {
        // Arrange
        $bigint1 = new MutableBigInteger('999999999999999999999999999999');
        $bigint2 = new MutableBigInteger('333333333333333333333333333333');

        // Act
        $result = $bigint1->divide($bigint2);

        // Assert
        static::assertSame($bigint1, $result);
        static::assertSame('3', $bigint1->value());
    }

    public function testDivideChaining(): void
    {
        // Arrange
        $bigint = new MutableBigInteger(120);

        // Act
        $result = $bigint->divide(new MutableBigInteger(2))
                         ->divide(new MutableBigInteger(3));

        // Assert
        static::assertSame($bigint, $result);
        static::assertSame('20', $bigint->value());
    }

    public function testDivideModifiesOriginal(): void
    {
        // Arrange
        $bigint = new MutableBigInteger(100);
        $originalValue = $bigint->value();

        // Act
        $bigint->divide(new MutableBigInteger(4));

        // Assert
        static::assertNotSame($originalValue, $bigint->value());
        static::assertSame('25', $bigint->value());
    }

    public function testDivideTruncatesResult(): void
    {
        // Arrange
        $bigint1 = new MutableBigInteger(7);
        $bigint2 = new MutableBigInteger(3);

        // Act
        $result = $bigint1->divide($bigint2);

        // Assert
        static::assertSame($bigint1, $result);
        static::assertSame('2', $bigint1->value()); // 7/3 = 2.33... -> 2
    }
}
