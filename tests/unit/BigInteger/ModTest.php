<?php
/**
 * phpmath / biginteger (https://github.com/phpmath/biginteger)
 *
 * @link https://github.com/phpmath/biginteger for the canonical source repository
 */

declare(strict_types=1);

namespace PHPMath\BigInteger\Tests\BigInteger;

use PHPMath\BigInteger\BigInteger;
use PHPMath\BigInteger\Exception\InvalidValueException;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\TestCase;

#[CoversMethod(BigInteger::class, 'mod')]
final class ModTest extends TestCase
{
    public function testModPositiveNumbers(): void
    {
        // Arrange
        $bigint1 = new BigInteger(23);
        $bigint2 = new BigInteger(5);

        // Act
        $result = $bigint1->mod($bigint2);

        // Assert
        static::assertInstanceOf(BigInteger::class, $result);
        static::assertSame('3', $result->value());
        static::assertNotSame($bigint1, $result); // Immutability check
        static::assertSame('23', $bigint1->value()); // Original unchanged
    }

    public function testModResultIsZero(): void
    {
        // Arrange
        $bigint1 = new BigInteger(20);
        $bigint2 = new BigInteger(4);

        // Act
        $result = $bigint1->mod($bigint2);

        // Assert
        static::assertSame('0', $result->value());
    }

    public function testModByOne(): void
    {
        // Arrange
        $bigint1 = new BigInteger(42);
        $bigint2 = new BigInteger(1);

        // Act
        $result = $bigint1->mod($bigint2);

        // Assert
        static::assertSame('0', $result->value());
    }

    public function testModWithNegativeDividend(): void
    {
        // Arrange
        $bigint1 = new BigInteger(-23);
        $bigint2 = new BigInteger(5);

        // Act
        $result = $bigint1->mod($bigint2);

        // Assert
        static::assertSame('2', $result->value()); // GMP mod behavior with negative numbers
    }

    public function testModWithNegativeDivisor(): void
    {
        // Arrange
        $bigint1 = new BigInteger(23);
        $bigint2 = new BigInteger(-5);

        // Act
        $result = $bigint1->mod($bigint2);

        // Assert
        static::assertSame('3', $result->value()); // GMP mod behavior
    }

    public function testModWithBothNegative(): void
    {
        // Arrange
        $bigint1 = new BigInteger(-23);
        $bigint2 = new BigInteger(-5);

        // Act
        $result = $bigint1->mod($bigint2);

        // Assert
        static::assertSame('2', $result->value()); // GMP mod behavior
    }

    public function testModZero(): void
    {
        // Arrange
        $bigint1 = new BigInteger(0);
        $bigint2 = new BigInteger(5);

        // Act
        $result = $bigint1->mod($bigint2);

        // Assert
        static::assertSame('0', $result->value());
    }

    public function testModLargerThanDivisor(): void
    {
        // Arrange
        $bigint1 = new BigInteger(7);
        $bigint2 = new BigInteger(10);

        // Act
        $result = $bigint1->mod($bigint2);

        // Assert
        static::assertSame('7', $result->value());
    }

    public function testModVeryLargeNumbers(): void
    {
        // Arrange
        $bigint1 = new BigInteger('123456789012345678901234567890');
        $bigint2 = new BigInteger('987654321');

        // Act
        $result = $bigint1->mod($bigint2);

        // Assert
        static::assertLessThan(987654321, (int) $result->value());
    }

    public function testModSelf(): void
    {
        // Arrange
        $bigint1 = new BigInteger(42);
        $bigint2 = new BigInteger(42);

        // Act
        $result = $bigint1->mod($bigint2);

        // Assert
        static::assertSame('0', $result->value());
    }

    public function testModByZeroThrowsException(): void
    {
        // Arrange
        $a = new BigInteger('10');
        $b = new BigInteger('0');

        // Assert
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage('Invalid value provided: 0');

        // Act
        $a->mod($b);
    }
}
