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

#[CoversMethod(MutableBigInteger::class, 'mod')]
final class MutableBigIntegerModTest extends TestCase
{
    public function testModPositiveNumbers(): void
    {
        // Arrange
        $bigint1 = new MutableBigInteger(23);
        $bigint2 = new MutableBigInteger(5);

        // Act
        $result = $bigint1->mod($bigint2);

        // Assert
        static::assertSame($bigint1, $result); // Returns same instance (mutable)
        static::assertSame('3', $bigint1->value());
        static::assertSame('3', $result->value());
    }

    public function testModResultIsZero(): void
    {
        // Arrange
        $bigint1 = new MutableBigInteger(20);
        $bigint2 = new MutableBigInteger(4);

        // Act
        $result = $bigint1->mod($bigint2);

        // Assert
        static::assertSame($bigint1, $result);
        static::assertSame('0', $bigint1->value());
    }

    public function testModByOne(): void
    {
        // Arrange
        $bigint1 = new MutableBigInteger(42);
        $bigint2 = new MutableBigInteger(1);

        // Act
        $result = $bigint1->mod($bigint2);

        // Assert
        static::assertSame($bigint1, $result);
        static::assertSame('0', $bigint1->value());
    }

    public function testModWithNegativeDividend(): void
    {
        // Arrange
        $bigint1 = new MutableBigInteger(-23);
        $bigint2 = new MutableBigInteger(5);

        // Act
        $result = $bigint1->mod($bigint2);

        // Assert
        static::assertSame($bigint1, $result);
        static::assertSame('2', $bigint1->value()); // GMP mod behavior with negative numbers
    }

    public function testModWithNegativeDivisor(): void
    {
        // Arrange
        $bigint1 = new MutableBigInteger(23);
        $bigint2 = new MutableBigInteger(-5);

        // Act
        $result = $bigint1->mod($bigint2);

        // Assert
        static::assertSame($bigint1, $result);
        static::assertSame('3', $bigint1->value()); // GMP mod behavior
    }

    public function testModWithBothNegative(): void
    {
        // Arrange
        $bigint1 = new MutableBigInteger(-23);
        $bigint2 = new MutableBigInteger(-5);

        // Act
        $result = $bigint1->mod($bigint2);

        // Assert
        static::assertSame($bigint1, $result);
        static::assertSame('2', $bigint1->value()); // GMP mod behavior
    }

    public function testModZero(): void
    {
        // Arrange
        $bigint1 = new MutableBigInteger(0);
        $bigint2 = new MutableBigInteger(5);

        // Act
        $result = $bigint1->mod($bigint2);

        // Assert
        static::assertSame($bigint1, $result);
        static::assertSame('0', $bigint1->value());
    }

    public function testModLargerThanDivisor(): void
    {
        // Arrange
        $bigint1 = new MutableBigInteger(7);
        $bigint2 = new MutableBigInteger(10);

        // Act
        $result = $bigint1->mod($bigint2);

        // Assert
        static::assertSame($bigint1, $result);
        static::assertSame('7', $bigint1->value());
    }

    public function testModVeryLargeNumbers(): void
    {
        // Arrange
        $bigint1 = new MutableBigInteger('123456789012345678901234567890');
        $bigint2 = new MutableBigInteger('987654321');

        // Act
        $result = $bigint1->mod($bigint2);

        // Assert
        static::assertSame($bigint1, $result);
        static::assertIsString($bigint1->value());
        static::assertLessThan(987654321, (int) $bigint1->value());
    }

    public function testModSelf(): void
    {
        // Arrange
        $bigint1 = new MutableBigInteger(42);
        $bigint2 = new MutableBigInteger(42);

        // Act
        $result = $bigint1->mod($bigint2);

        // Assert
        static::assertSame($bigint1, $result);
        static::assertSame('0', $bigint1->value());
    }

    public function testModModifiesOriginal(): void
    {
        // Arrange
        $bigint = new MutableBigInteger(17);
        $originalValue = $bigint->value();

        // Act
        $bigint->mod(new MutableBigInteger(5));

        // Assert
        static::assertNotSame($originalValue, $bigint->value());
        static::assertSame('2', $bigint->value());
    }
}
