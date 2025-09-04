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

#[CoversMethod(ImmutableBigInteger::class, 'isPositive')]
final class ImmutableBigIntegerIsPositiveTest extends TestCase
{
    public function testIsPositiveWithPositiveNumber(): void
    {
        // Arrange
        $bigint = new ImmutableBigInteger(42);

        // Act
        $result = $bigint->isPositive();

        // Assert
        static::assertTrue($result);
    }

    public function testIsPositiveWithPositiveStringNumber(): void
    {
        // Arrange
        $bigint = new ImmutableBigInteger('123456789012345678901234567890');

        // Act
        $result = $bigint->isPositive();

        // Assert
        static::assertTrue($result);
    }

    public function testIsPositiveWithZero(): void
    {
        // Arrange
        $bigint = new ImmutableBigInteger(0);

        // Act
        $result = $bigint->isPositive();

        // Assert
        static::assertFalse($result);
    }

    public function testIsPositiveWithNegativeNumber(): void
    {
        // Arrange
        $bigint = new ImmutableBigInteger(-42);

        // Act
        $result = $bigint->isPositive();

        // Assert
        static::assertFalse($result);
    }

    public function testIsPositiveWithNegativeStringNumber(): void
    {
        // Arrange
        $bigint = new ImmutableBigInteger('-987654321098765432109876543210');

        // Act
        $result = $bigint->isPositive();

        // Assert
        static::assertFalse($result);
    }

    public function testIsPositiveAfterAbsoluteValue(): void
    {
        // Arrange
        $negativeBigint = new ImmutableBigInteger(-100);

        // Act
        $result = $negativeBigint->abs();

        // Assert
        static::assertTrue($result->isPositive());
        static::assertFalse($result->isNegative());
        static::assertFalse($result->isZero());
    }

    public function testIsPositiveAfterNegation(): void
    {
        // Arrange
        $negativeBigint = new ImmutableBigInteger(-100);

        // Act
        $result = $negativeBigint->negate();

        // Assert
        static::assertTrue($result->isPositive());
        static::assertFalse($negativeBigint->isPositive()); // Original unchanged
    }

    public function testIsPositiveExcludesZeroAndNegative(): void
    {
        // Arrange
        $positive = new ImmutableBigInteger(1);
        $zero = new ImmutableBigInteger(0);
        $negative = new ImmutableBigInteger(-1);

        // Act & Assert
        static::assertTrue($positive->isPositive());
        static::assertFalse($positive->isZero());
        static::assertFalse($positive->isNegative());

        static::assertFalse($zero->isPositive());
        static::assertTrue($zero->isZero());
        static::assertFalse($zero->isNegative());

        static::assertFalse($negative->isPositive());
        static::assertFalse($negative->isZero());
        static::assertTrue($negative->isNegative());
    }

    public function testIsPositiveAfterAddition(): void
    {
        // Arrange
        $bigint1 = new ImmutableBigInteger(50);
        $bigint2 = new ImmutableBigInteger(25);

        // Act
        $result = $bigint1->add($bigint2);

        // Assert
        static::assertTrue($result->isPositive());
        static::assertSame('75', $result->value());
    }

    public function testIsPositiveAfterMultiplication(): void
    {
        // Arrange
        $bigint1 = new ImmutableBigInteger(7);
        $bigint2 = new ImmutableBigInteger(6);

        // Act
        $result = $bigint1->multiply($bigint2);

        // Assert
        static::assertTrue($result->isPositive());
        static::assertSame('42', $result->value());
    }

    public function testIsPositiveWithFactorial(): void
    {
        // Arrange
        $bigint = new ImmutableBigInteger(5);

        // Act
        $result = $bigint->factorial();

        // Assert
        static::assertTrue($result->isPositive());
        static::assertSame('120', $result->value());
    }

    public function testIsPositiveConsistencyWithCmp(): void
    {
        // Arrange
        $positive = new ImmutableBigInteger(100);
        $zero = new ImmutableBigInteger(0);

        // Act & Assert
        static::assertTrue($positive->isPositive());
        static::assertSame(1, $positive->cmp($zero));
    }
}
