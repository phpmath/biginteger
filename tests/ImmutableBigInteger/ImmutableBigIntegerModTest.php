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

#[CoversMethod(ImmutableBigInteger::class, 'mod')]
final class ImmutableBigIntegerModTest extends TestCase
{
    public function testModPositiveNumbers(): void
    {
        // Arrange
        $bigint1 = new ImmutableBigInteger(23);
        $bigint2 = new ImmutableBigInteger(5);

        // Act
        $result = $bigint1->mod($bigint2);

        // Assert
        static::assertInstanceOf(ImmutableBigInteger::class, $result);
        static::assertSame('3', $result->value());
        static::assertNotSame($bigint1, $result); // Immutability check
        static::assertSame('23', $bigint1->value()); // Original unchanged
    }

    public function testModResultIsZero(): void
    {
        // Arrange
        $bigint1 = new ImmutableBigInteger(20);
        $bigint2 = new ImmutableBigInteger(4);

        // Act
        $result = $bigint1->mod($bigint2);

        // Assert
        static::assertSame('0', $result->value());
    }

    public function testModByOne(): void
    {
        // Arrange
        $bigint1 = new ImmutableBigInteger(42);
        $bigint2 = new ImmutableBigInteger(1);

        // Act
        $result = $bigint1->mod($bigint2);

        // Assert
        static::assertSame('0', $result->value());
    }

    public function testModWithNegativeDividend(): void
    {
        // Arrange
        $bigint1 = new ImmutableBigInteger(-23);
        $bigint2 = new ImmutableBigInteger(5);

        // Act
        $result = $bigint1->mod($bigint2);

        // Assert
        static::assertSame('2', $result->value()); // GMP mod behavior with negative numbers
    }

    public function testModWithNegativeDivisor(): void
    {
        // Arrange
        $bigint1 = new ImmutableBigInteger(23);
        $bigint2 = new ImmutableBigInteger(-5);

        // Act
        $result = $bigint1->mod($bigint2);

        // Assert
        static::assertSame('3', $result->value()); // GMP mod behavior
    }

    public function testModWithBothNegative(): void
    {
        // Arrange
        $bigint1 = new ImmutableBigInteger(-23);
        $bigint2 = new ImmutableBigInteger(-5);

        // Act
        $result = $bigint1->mod($bigint2);

        // Assert
        static::assertSame('2', $result->value()); // GMP mod behavior
    }

    public function testModZero(): void
    {
        // Arrange
        $bigint1 = new ImmutableBigInteger(0);
        $bigint2 = new ImmutableBigInteger(5);

        // Act
        $result = $bigint1->mod($bigint2);

        // Assert
        static::assertSame('0', $result->value());
    }

    public function testModLargerThanDivisor(): void
    {
        // Arrange
        $bigint1 = new ImmutableBigInteger(7);
        $bigint2 = new ImmutableBigInteger(10);

        // Act
        $result = $bigint1->mod($bigint2);

        // Assert
        static::assertSame('7', $result->value());
    }

    public function testModVeryLargeNumbers(): void
    {
        // Arrange
        $bigint1 = new ImmutableBigInteger('123456789012345678901234567890');
        $bigint2 = new ImmutableBigInteger('987654321');

        // Act
        $result = $bigint1->mod($bigint2);

        // Assert
        static::assertIsString($result->value());
        static::assertLessThan(987654321, (int) $result->value());
    }

    public function testModSelf(): void
    {
        // Arrange
        $bigint1 = new ImmutableBigInteger(42);
        $bigint2 = new ImmutableBigInteger(42);

        // Act
        $result = $bigint1->mod($bigint2);

        // Assert
        static::assertSame('0', $result->value());
    }
}
