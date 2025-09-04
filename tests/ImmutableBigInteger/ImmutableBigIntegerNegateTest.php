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

#[CoversMethod(ImmutableBigInteger::class, 'negate')]
#[CoversMethod(ImmutableBigInteger::class, 'fromGmp')]
final class ImmutableBigIntegerNegateTest extends TestCase
{
    public function testNegatePositiveNumber(): void
    {
        // Arrange
        $bigint = new ImmutableBigInteger(42);

        // Act
        $result = $bigint->negate();

        // Assert
        static::assertInstanceOf(ImmutableBigInteger::class, $result);
        static::assertSame('-42', $result->value());
        static::assertNotSame($bigint, $result); // Immutability check
        static::assertSame('42', $bigint->value()); // Original unchanged
    }

    public function testNegateNegativeNumber(): void
    {
        // Arrange
        $bigint = new ImmutableBigInteger(-42);

        // Act
        $result = $bigint->negate();

        // Assert
        static::assertSame('42', $result->value());
        static::assertSame('-42', $bigint->value()); // Original unchanged
    }

    public function testNegateZero(): void
    {
        // Arrange
        $bigint = new ImmutableBigInteger(0);

        // Act
        $result = $bigint->negate();

        // Assert
        static::assertSame('0', $result->value());
    }

    public function testNegateLargePositiveNumber(): void
    {
        // Arrange
        $bigint = new ImmutableBigInteger('123456789012345678901234567890');

        // Act
        $result = $bigint->negate();

        // Assert
        static::assertSame('-123456789012345678901234567890', $result->value());
    }

    public function testNegateLargeNegativeNumber(): void
    {
        // Arrange
        $bigint = new ImmutableBigInteger('-987654321098765432109876543210');

        // Act
        $result = $bigint->negate();

        // Assert
        static::assertSame('987654321098765432109876543210', $result->value());
    }

    public function testNegateIsInvolutory(): void
    {
        // Arrange
        $bigint = new ImmutableBigInteger(100);

        // Act
        $result1 = $bigint->negate();
        $result2 = $result1->negate();

        // Assert
        static::assertTrue($bigint->equals($result2));
        static::assertSame('100', $result2->value());
        static::assertSame('-100', $result1->value());
    }

    public function testNegateChangesSign(): void
    {
        // Arrange
        $positive = new ImmutableBigInteger(100);
        $negative = new ImmutableBigInteger(-100);

        // Act
        $negatedPositive = $positive->negate();
        $negatedNegative = $negative->negate();

        // Assert
        static::assertTrue($positive->isPositive());
        static::assertTrue($negatedPositive->isNegative());
        static::assertTrue($negative->isNegative());
        static::assertTrue($negatedNegative->isPositive());
    }

    public function testNegateZeroRemainsZero(): void
    {
        // Arrange
        $zero = new ImmutableBigInteger(0);

        // Act
        $negatedZero = $zero->negate();

        // Assert
        static::assertTrue($zero->isZero());
        static::assertTrue($negatedZero->isZero());
        static::assertFalse($negatedZero->isPositive());
        static::assertFalse($negatedZero->isNegative());
    }
}
