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

#[CoversMethod(ImmutableBigInteger::class, 'abs')]
#[CoversMethod(ImmutableBigInteger::class, 'fromGmp')]
final class ImmutableBigIntegerAbsTest extends TestCase
{
    public function testAbsPositiveNumber(): void
    {
        // Arrange
        $bigint = new ImmutableBigInteger(42);

        // Act
        $result = $bigint->abs();

        // Assert
        static::assertInstanceOf(ImmutableBigInteger::class, $result);
        static::assertSame('42', $result->value());
        static::assertNotSame($bigint, $result); // Immutability check
        static::assertSame('42', $bigint->value()); // Original unchanged
    }

    public function testAbsNegativeNumber(): void
    {
        // Arrange
        $bigint = new ImmutableBigInteger(-42);

        // Act
        $result = $bigint->abs();

        // Assert
        static::assertSame('42', $result->value());
        static::assertSame('-42', $bigint->value()); // Original unchanged
    }

    public function testAbsZero(): void
    {
        // Arrange
        $bigint = new ImmutableBigInteger(0);

        // Act
        $result = $bigint->abs();

        // Assert
        static::assertSame('0', $result->value());
    }

    public function testAbsLargePositiveNumber(): void
    {
        // Arrange
        $bigint = new ImmutableBigInteger('123456789012345678901234567890');

        // Act
        $result = $bigint->abs();

        // Assert
        static::assertSame('123456789012345678901234567890', $result->value());
    }

    public function testAbsLargeNegativeNumber(): void
    {
        // Arrange
        $bigint = new ImmutableBigInteger('-987654321098765432109876543210');

        // Act
        $result = $bigint->abs();

        // Assert
        static::assertSame('987654321098765432109876543210', $result->value());
    }

    public function testAbsIsIdempotent(): void
    {
        // Arrange
        $bigint = new ImmutableBigInteger(-100);

        // Act
        $result1 = $bigint->abs();
        $result2 = $result1->abs();

        // Assert
        static::assertTrue($result1->equals($result2));
        static::assertSame('100', $result1->value());
        static::assertSame('100', $result2->value());
    }

    public function testAbsPreservesPositiveness(): void
    {
        // Arrange
        $bigint = new ImmutableBigInteger(100);

        // Act
        $result = $bigint->abs();

        // Assert
        static::assertTrue($result->isPositive());
        static::assertFalse($result->isNegative());
        static::assertSame('100', $result->value());
    }

    public function testAbsMakesNegativePositive(): void
    {
        // Arrange
        $bigint = new ImmutableBigInteger(-100);

        // Act
        $result = $bigint->abs();

        // Assert
        static::assertTrue($result->isPositive());
        static::assertFalse($result->isNegative());
        static::assertSame('100', $result->value());
    }
}
