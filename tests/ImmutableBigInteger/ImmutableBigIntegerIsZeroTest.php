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

#[CoversMethod(ImmutableBigInteger::class, 'isZero')]
final class ImmutableBigIntegerIsZeroTest extends TestCase
{
    public function testIsZeroWithZero(): void
    {
        // Arrange
        $bigint = new ImmutableBigInteger(0);

        // Act
        $result = $bigint->isZero();

        // Assert
        static::assertTrue($result);
    }

    public function testIsZeroWithStringZero(): void
    {
        // Arrange
        $bigint = new ImmutableBigInteger('0');

        // Act
        $result = $bigint->isZero();

        // Assert
        static::assertTrue($result);
    }

    public function testIsZeroWithPositiveNumber(): void
    {
        // Arrange
        $bigint = new ImmutableBigInteger(42);

        // Act
        $result = $bigint->isZero();

        // Assert
        static::assertFalse($result);
    }

    public function testIsZeroWithNegativeNumber(): void
    {
        // Arrange
        $bigint = new ImmutableBigInteger(-42);

        // Act
        $result = $bigint->isZero();

        // Assert
        static::assertFalse($result);
    }

    public function testIsZeroWithLargePositiveNumber(): void
    {
        // Arrange
        $bigint = new ImmutableBigInteger('123456789012345678901234567890');

        // Act
        $result = $bigint->isZero();

        // Assert
        static::assertFalse($result);
    }

    public function testIsZeroWithLargeNegativeNumber(): void
    {
        // Arrange
        $bigint = new ImmutableBigInteger('-987654321098765432109876543210');

        // Act
        $result = $bigint->isZero();

        // Assert
        static::assertFalse($result);
    }

    public function testIsZeroAfterArithmetic(): void
    {
        // Arrange
        $bigint1 = new ImmutableBigInteger(50);
        $bigint2 = new ImmutableBigInteger(50);

        // Act
        $result = $bigint1->subtract($bigint2);

        // Assert
        static::assertTrue($result->isZero());
        static::assertSame('0', $result->value());
    }

    public function testIsZeroMutualExclusivityWithIsPositive(): void
    {
        // Arrange
        $zero = new ImmutableBigInteger(0);
        $positive = new ImmutableBigInteger(1);

        // Act & Assert
        static::assertTrue($zero->isZero());
        static::assertFalse($zero->isPositive());

        static::assertFalse($positive->isZero());
        static::assertTrue($positive->isPositive());
    }

    public function testIsZeroMutualExclusivityWithIsNegative(): void
    {
        // Arrange
        $zero = new ImmutableBigInteger(0);
        $negative = new ImmutableBigInteger(-1);

        // Act & Assert
        static::assertTrue($zero->isZero());
        static::assertFalse($zero->isNegative());

        static::assertFalse($negative->isZero());
        static::assertTrue($negative->isNegative());
    }

    public function testIsZeroResultAfterMultiplicationByZero(): void
    {
        // Arrange
        $bigint = new ImmutableBigInteger(999999);
        $zero = new ImmutableBigInteger(0);

        // Act
        $result = $bigint->multiply($zero);

        // Assert
        static::assertTrue($result->isZero());
    }

    public function testIsZeroResultAfterModuloOfSameNumbers(): void
    {
        // Arrange
        $bigint = new ImmutableBigInteger(42);

        // Act
        $result = $bigint->mod($bigint);

        // Assert
        static::assertTrue($result->isZero());
    }
}
