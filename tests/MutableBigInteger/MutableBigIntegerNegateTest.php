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

#[CoversMethod(MutableBigInteger::class, 'negate')]
final class MutableBigIntegerNegateTest extends TestCase
{
    public function testNegatePositiveNumber(): void
    {
        // Arrange
        $bigint = new MutableBigInteger(42);

        // Act
        $result = $bigint->negate();

        // Assert
        static::assertSame($bigint, $result); // Returns same instance (mutable)
        static::assertSame('-42', $bigint->value());
        static::assertSame('-42', $result->value());
    }

    public function testNegateNegativeNumber(): void
    {
        // Arrange
        $bigint = new MutableBigInteger(-42);

        // Act
        $result = $bigint->negate();

        // Assert
        static::assertSame($bigint, $result);
        static::assertSame('42', $bigint->value());
        static::assertSame('42', $result->value());
    }

    public function testNegateZero(): void
    {
        // Arrange
        $bigint = new MutableBigInteger(0);

        // Act
        $result = $bigint->negate();

        // Assert
        static::assertSame($bigint, $result);
        static::assertSame('0', $bigint->value());
    }

    public function testNegateLargePositiveNumber(): void
    {
        // Arrange
        $bigint = new MutableBigInteger('123456789012345678901234567890');

        // Act
        $result = $bigint->negate();

        // Assert
        static::assertSame($bigint, $result);
        static::assertSame('-123456789012345678901234567890', $bigint->value());
    }

    public function testNegateLargeNegativeNumber(): void
    {
        // Arrange
        $bigint = new MutableBigInteger('-987654321098765432109876543210');

        // Act
        $result = $bigint->negate();

        // Assert
        static::assertSame($bigint, $result);
        static::assertSame('987654321098765432109876543210', $bigint->value());
    }

    public function testNegateIsInvolutory(): void
    {
        // Arrange
        $bigint = new MutableBigInteger(100);
        $originalValue = $bigint->value();

        // Act
        $result1 = $bigint->negate();
        $result2 = $bigint->negate();

        // Assert
        static::assertSame($bigint, $result1);
        static::assertSame($bigint, $result2);
        static::assertSame($originalValue, $bigint->value());
    }

    public function testNegateChangesSign(): void
    {
        // Arrange
        $positive = new MutableBigInteger(100);
        $negative = new MutableBigInteger(-100);

        // Act
        $positive->negate();
        $negative->negate();

        // Assert
        static::assertTrue($positive->isNegative());
        static::assertFalse($positive->isPositive());
        static::assertTrue($negative->isPositive());
        static::assertFalse($negative->isNegative());
    }

    public function testNegateZeroRemainsZero(): void
    {
        // Arrange
        $zero = new MutableBigInteger(0);

        // Act
        $result = $zero->negate();

        // Assert
        static::assertSame($zero, $result);
        static::assertTrue($zero->isZero());
        static::assertFalse($zero->isPositive());
        static::assertFalse($zero->isNegative());
        static::assertSame('0', $zero->value());
    }

    public function testNegateModifiesOriginal(): void
    {
        // Arrange
        $bigint = new MutableBigInteger(88);
        $originalValue = $bigint->value();

        // Act
        $bigint->negate();

        // Assert
        static::assertNotSame($originalValue, $bigint->value());
        static::assertSame('-88', $bigint->value());
    }

    public function testNegateChaining(): void
    {
        // Arrange
        $bigint = new MutableBigInteger(50);

        // Act
        $result = $bigint->negate()->add(new MutableBigInteger(-25));

        // Assert
        static::assertSame($bigint, $result);
        static::assertSame('-75', $bigint->value());
    }

    public function testNegateDoubleNegation(): void
    {
        // Arrange
        $bigint = new MutableBigInteger(42);
        $originalValue = $bigint->value();

        // Act
        $bigint->negate()->negate();

        // Assert
        static::assertSame($originalValue, $bigint->value());
        static::assertTrue($bigint->isPositive());
    }
}
