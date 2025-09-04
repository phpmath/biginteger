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

#[CoversMethod(MutableBigInteger::class, 'abs')]
final class MutableBigIntegerAbsTest extends TestCase
{
    public function testAbsPositiveNumber(): void
    {
        // Arrange
        $bigint = new MutableBigInteger(42);

        // Act
        $result = $bigint->abs();

        // Assert
        static::assertSame($bigint, $result); // Returns same instance (mutable)
        static::assertSame('42', $bigint->value());
        static::assertSame('42', $result->value());
    }

    public function testAbsNegativeNumber(): void
    {
        // Arrange
        $bigint = new MutableBigInteger(-42);

        // Act
        $result = $bigint->abs();

        // Assert
        static::assertSame($bigint, $result);
        static::assertSame('42', $bigint->value());
        static::assertSame('42', $result->value());
    }

    public function testAbsZero(): void
    {
        // Arrange
        $bigint = new MutableBigInteger(0);

        // Act
        $result = $bigint->abs();

        // Assert
        static::assertSame($bigint, $result);
        static::assertSame('0', $bigint->value());
    }

    public function testAbsLargePositiveNumber(): void
    {
        // Arrange
        $bigint = new MutableBigInteger('123456789012345678901234567890');

        // Act
        $result = $bigint->abs();

        // Assert
        static::assertSame($bigint, $result);
        static::assertSame('123456789012345678901234567890', $bigint->value());
    }

    public function testAbsLargeNegativeNumber(): void
    {
        // Arrange
        $bigint = new MutableBigInteger('-987654321098765432109876543210');

        // Act
        $result = $bigint->abs();

        // Assert
        static::assertSame($bigint, $result);
        static::assertSame('987654321098765432109876543210', $bigint->value());
    }

    public function testAbsIsIdempotent(): void
    {
        // Arrange
        $bigint = new MutableBigInteger(-100);

        // Act
        $bigint->abs();
        $originalValue = $bigint->value();
        $result = $bigint->abs();

        // Assert
        static::assertSame($bigint, $result);
        static::assertSame('100', $bigint->value());
        static::assertSame($originalValue, $bigint->value());
    }

    public function testAbsPreservesPositiveness(): void
    {
        // Arrange
        $bigint = new MutableBigInteger(100);

        // Act
        $result = $bigint->abs();

        // Assert
        static::assertSame($bigint, $result);
        static::assertTrue($bigint->isPositive());
        static::assertFalse($bigint->isNegative());
        static::assertSame('100', $bigint->value());
    }

    public function testAbsMakesNegativePositive(): void
    {
        // Arrange
        $bigint = new MutableBigInteger(-100);

        // Act
        $result = $bigint->abs();

        // Assert
        static::assertSame($bigint, $result);
        static::assertTrue($bigint->isPositive());
        static::assertFalse($bigint->isNegative());
        static::assertSame('100', $bigint->value());
    }

    public function testAbsModifiesOriginal(): void
    {
        // Arrange
        $bigint = new MutableBigInteger(-75);
        $originalValue = $bigint->value();

        // Act
        $bigint->abs();

        // Assert
        static::assertNotSame($originalValue, $bigint->value());
        static::assertSame('75', $bigint->value());
    }

    public function testAbsChaining(): void
    {
        // Arrange
        $bigint = new MutableBigInteger(-50);

        // Act
        $result = $bigint->abs()->add(new MutableBigInteger(25));

        // Assert
        static::assertSame($bigint, $result);
        static::assertSame('75', $bigint->value());
    }

    public function testAbsZeroRemainsZero(): void
    {
        // Arrange
        $zero = new MutableBigInteger(0);

        // Act
        $result = $zero->abs();

        // Assert
        static::assertSame($zero, $result);
        static::assertTrue($zero->isZero());
        static::assertFalse($zero->isPositive());
        static::assertFalse($zero->isNegative());
        static::assertSame('0', $zero->value());
    }
}
