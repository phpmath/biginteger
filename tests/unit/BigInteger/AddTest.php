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

#[CoversMethod(BigInteger::class, 'add')]
#[CoversMethod(BigInteger::class, 'fromGmp')]
final class AddTest extends TestCase
{
    public function testAddPositiveNumbers(): void
    {
        // Arrange
        $bigint1 = new BigInteger(100);
        $bigint2 = new BigInteger(50);

        // Act
        $result = $bigint1->add($bigint2);

        // Assert
        static::assertInstanceOf(BigInteger::class, $result);
        static::assertSame('150', $result->value());
        static::assertNotSame($bigint1, $result); // Immutability check
        static::assertSame('100', $bigint1->value()); // Original unchanged
    }

    public function testAddNegativeNumbers(): void
    {
        // Arrange
        $bigint1 = new BigInteger(-25);
        $bigint2 = new BigInteger(-75);

        // Act
        $result = $bigint1->add($bigint2);

        // Assert
        static::assertSame('-100', $result->value());
    }

    public function testAddPositiveAndNegative(): void
    {
        // Arrange
        $bigint1 = new BigInteger(100);
        $bigint2 = new BigInteger(-30);

        // Act
        $result = $bigint1->add($bigint2);

        // Assert
        static::assertSame('70', $result->value());
    }

    public function testAddWithZero(): void
    {
        // Arrange
        $bigint1 = new BigInteger(42);
        $bigint2 = new BigInteger(0);

        // Act
        $result = $bigint1->add($bigint2);

        // Assert
        static::assertSame('42', $result->value());
    }

    public function testAddZeroToZero(): void
    {
        // Arrange
        $bigint1 = new BigInteger(0);
        $bigint2 = new BigInteger(0);

        // Act
        $result = $bigint1->add($bigint2);

        // Assert
        static::assertSame('0', $result->value());
    }

    public function testAddVeryLargeNumbers(): void
    {
        // Arrange
        $bigint1 = new BigInteger('999999999999999999999999999999');
        $bigint2 = new BigInteger('111111111111111111111111111111');

        // Act
        $result = $bigint1->add($bigint2);

        // Assert
        static::assertSame('1111111111111111111111111111110', $result->value());
    }

    public function testAddIsCommutative(): void
    {
        // Arrange
        $bigint1 = new BigInteger(123);
        $bigint2 = new BigInteger(456);

        // Act
        $result1 = $bigint1->add($bigint2);
        $result2 = $bigint2->add($bigint1);

        // Assert
        static::assertTrue($result1->equals($result2));
        static::assertSame('579', $result1->value());
        static::assertSame('579', $result2->value());
    }
}
