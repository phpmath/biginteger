<?php
/**
 * phpmath / biginteger (https://github.com/phpmath/biginteger)
 *
 * @link https://github.com/phpmath/biginteger for the canonical source repository
 */

declare(strict_types=1);

namespace PHPMath\BigInteger\Tests\BigInteger;

use PHPMath\BigInteger\BigInteger;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\TestCase;

#[CoversMethod(BigInteger::class, 'subtract')]
#[CoversMethod(BigInteger::class, 'fromGmp')]
final class SubtractTest extends TestCase
{
    public function testSubtractPositiveNumbers(): void
    {
        // Arrange
        $bigint1 = new BigInteger(100);
        $bigint2 = new BigInteger(30);

        // Act
        $result = $bigint1->subtract($bigint2);

        // Assert
        static::assertInstanceOf(BigInteger::class, $result);
        static::assertSame('70', $result->value());
        static::assertNotSame($bigint1, $result); // Immutability check
        static::assertSame('100', $bigint1->value()); // Original unchanged
    }

    public function testSubtractResultInNegative(): void
    {
        // Arrange
        $bigint1 = new BigInteger(50);
        $bigint2 = new BigInteger(80);

        // Act
        $result = $bigint1->subtract($bigint2);

        // Assert
        static::assertSame('-30', $result->value());
    }

    public function testSubtractNegativeNumbers(): void
    {
        // Arrange
        $bigint1 = new BigInteger(-25);
        $bigint2 = new BigInteger(-15);

        // Act
        $result = $bigint1->subtract($bigint2);

        // Assert
        static::assertSame('-10', $result->value());
    }

    public function testSubtractPositiveFromNegative(): void
    {
        // Arrange
        $bigint1 = new BigInteger(-25);
        $bigint2 = new BigInteger(15);

        // Act
        $result = $bigint1->subtract($bigint2);

        // Assert
        static::assertSame('-40', $result->value());
    }

    public function testSubtractZero(): void
    {
        // Arrange
        $bigint1 = new BigInteger(42);
        $bigint2 = new BigInteger(0);

        // Act
        $result = $bigint1->subtract($bigint2);

        // Assert
        static::assertSame('42', $result->value());
    }

    public function testSubtractFromZero(): void
    {
        // Arrange
        $bigint1 = new BigInteger(0);
        $bigint2 = new BigInteger(42);

        // Act
        $result = $bigint1->subtract($bigint2);

        // Assert
        static::assertSame('-42', $result->value());
    }

    public function testSubtractSameNumber(): void
    {
        // Arrange
        $bigint1 = new BigInteger(100);
        $bigint2 = new BigInteger(100);

        // Act
        $result = $bigint1->subtract($bigint2);

        // Assert
        static::assertSame('0', $result->value());
    }

    public function testSubtractVeryLargeNumbers(): void
    {
        // Arrange
        $bigint1 = new BigInteger('999999999999999999999999999999');
        $bigint2 = new BigInteger('111111111111111111111111111111');

        // Act
        $result = $bigint1->subtract($bigint2);

        // Assert
        static::assertSame('888888888888888888888888888888', $result->value());
    }
}
