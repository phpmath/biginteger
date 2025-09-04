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

#[CoversMethod(ImmutableBigInteger::class, 'isNegative')]
final class ImmutableBigIntegerIsNegativeTest extends TestCase
{
    public function testIsNegativeWithNegativeNumber(): void
    {
        // Arrange
        $bigint = new ImmutableBigInteger(-42);

        // Act
        $result = $bigint->isNegative();

        // Assert
        static::assertTrue($result);
    }

    public function testIsNegativeWithNegativeStringNumber(): void
    {
        // Arrange
        $bigint = new ImmutableBigInteger('-987654321098765432109876543210');

        // Act
        $result = $bigint->isNegative();

        // Assert
        static::assertTrue($result);
    }

    public function testIsNegativeWithZero(): void
    {
        // Arrange
        $bigint = new ImmutableBigInteger(0);

        // Act
        $result = $bigint->isNegative();

        // Assert
        static::assertFalse($result);
    }

    public function testIsNegativeWithPositiveNumber(): void
    {
        // Arrange
        $bigint = new ImmutableBigInteger(42);

        // Act
        $result = $bigint->isNegative();

        // Assert
        static::assertFalse($result);
    }

    public function testIsNegativeWithPositiveStringNumber(): void
    {
        // Arrange
        $bigint = new ImmutableBigInteger('123456789012345678901234567890');

        // Act
        $result = $bigint->isNegative();

        // Assert
        static::assertFalse($result);
    }

    public function testIsNegativeAfterNegation(): void
    {
        // Arrange
        $positiveBigint = new ImmutableBigInteger(100);

        // Act
        $result = $positiveBigint->negate();

        // Assert
        static::assertTrue($result->isNegative());
        static::assertFalse($result->isPositive());
        static::assertFalse($result->isZero());
        static::assertFalse($positiveBigint->isNegative()); // Original unchanged
    }

    public function testIsNegativeAfterSubtraction(): void
    {
        // Arrange
        $bigint1 = new ImmutableBigInteger(25);
        $bigint2 = new ImmutableBigInteger(50);

        // Act
        $result = $bigint1->subtract($bigint2);

        // Assert
        static::assertTrue($result->isNegative());
        static::assertSame('-25', $result->value());
    }

    public function testIsNegativeExcludesZeroAndPositive(): void
    {
        // Arrange
        $negative = new ImmutableBigInteger(-1);
        $zero = new ImmutableBigInteger(0);
        $positive = new ImmutableBigInteger(1);

        // Act & Assert
        static::assertTrue($negative->isNegative());
        static::assertFalse($negative->isZero());
        static::assertFalse($negative->isPositive());

        static::assertFalse($zero->isNegative());
        static::assertTrue($zero->isZero());
        static::assertFalse($zero->isPositive());

        static::assertFalse($positive->isNegative());
        static::assertFalse($positive->isZero());
        static::assertTrue($positive->isPositive());
    }

    public function testIsNegativeAfterMultiplication(): void
    {
        // Arrange
        $positive = new ImmutableBigInteger(7);
        $negative = new ImmutableBigInteger(-6);

        // Act
        $result = $positive->multiply($negative);

        // Assert
        static::assertTrue($result->isNegative());
        static::assertSame('-42', $result->value());
    }

    public function testIsNegativeWithOddPowerOfNegative(): void
    {
        // Arrange
        $negative = new ImmutableBigInteger(-3);

        // Act
        $result = $negative->pow(3);

        // Assert
        static::assertTrue($result->isNegative());
        static::assertSame('-27', $result->value());
    }

    public function testIsNegativeWithEvenPowerOfNegative(): void
    {
        // Arrange
        $negative = new ImmutableBigInteger(-3);

        // Act
        $result = $negative->pow(2);

        // Assert
        static::assertFalse($result->isNegative());
        static::assertTrue($result->isPositive());
        static::assertSame('9', $result->value());
    }

    public function testIsNegativeConsistencyWithCmp(): void
    {
        // Arrange
        $negative = new ImmutableBigInteger(-100);
        $zero = new ImmutableBigInteger(0);

        // Act & Assert
        static::assertTrue($negative->isNegative());
        static::assertSame(-1, $negative->cmp($zero));
    }

    public function testIsNegativeDoesNotAffectAbsolute(): void
    {
        // Arrange
        $negative = new ImmutableBigInteger(-100);

        // Act
        $absolute = $negative->abs();

        // Assert
        static::assertTrue($negative->isNegative());
        static::assertFalse($absolute->isNegative());
        static::assertTrue($absolute->isPositive());
    }
}
