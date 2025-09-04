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

#[CoversMethod(ImmutableBigInteger::class, 'subtract')]
#[CoversMethod(ImmutableBigInteger::class, 'fromGmp')]
final class ImmutableBigIntegerSubtractTest extends TestCase
{
    public function testSubtractPositiveNumbers(): void
    {
        // Arrange
        $bigint1 = new ImmutableBigInteger(100);
        $bigint2 = new ImmutableBigInteger(30);

        // Act
        $result = $bigint1->subtract($bigint2);

        // Assert
        static::assertInstanceOf(ImmutableBigInteger::class, $result);
        static::assertSame('70', $result->value());
        static::assertNotSame($bigint1, $result); // Immutability check
        static::assertSame('100', $bigint1->value()); // Original unchanged
    }

    public function testSubtractResultInNegative(): void
    {
        // Arrange
        $bigint1 = new ImmutableBigInteger(50);
        $bigint2 = new ImmutableBigInteger(80);

        // Act
        $result = $bigint1->subtract($bigint2);

        // Assert
        static::assertSame('-30', $result->value());
    }

    public function testSubtractNegativeNumbers(): void
    {
        // Arrange
        $bigint1 = new ImmutableBigInteger(-25);
        $bigint2 = new ImmutableBigInteger(-15);

        // Act
        $result = $bigint1->subtract($bigint2);

        // Assert
        static::assertSame('-10', $result->value());
    }

    public function testSubtractPositiveFromNegative(): void
    {
        // Arrange
        $bigint1 = new ImmutableBigInteger(-25);
        $bigint2 = new ImmutableBigInteger(15);

        // Act
        $result = $bigint1->subtract($bigint2);

        // Assert
        static::assertSame('-40', $result->value());
    }

    public function testSubtractZero(): void
    {
        // Arrange
        $bigint1 = new ImmutableBigInteger(42);
        $bigint2 = new ImmutableBigInteger(0);

        // Act
        $result = $bigint1->subtract($bigint2);

        // Assert
        static::assertSame('42', $result->value());
    }

    public function testSubtractFromZero(): void
    {
        // Arrange
        $bigint1 = new ImmutableBigInteger(0);
        $bigint2 = new ImmutableBigInteger(42);

        // Act
        $result = $bigint1->subtract($bigint2);

        // Assert
        static::assertSame('-42', $result->value());
    }

    public function testSubtractSameNumber(): void
    {
        // Arrange
        $bigint1 = new ImmutableBigInteger(100);
        $bigint2 = new ImmutableBigInteger(100);

        // Act
        $result = $bigint1->subtract($bigint2);

        // Assert
        static::assertSame('0', $result->value());
    }

    public function testSubtractVeryLargeNumbers(): void
    {
        // Arrange
        $bigint1 = new ImmutableBigInteger('999999999999999999999999999999');
        $bigint2 = new ImmutableBigInteger('111111111111111111111111111111');

        // Act
        $result = $bigint1->subtract($bigint2);

        // Assert
        static::assertSame('888888888888888888888888888888', $result->value());
    }
}
