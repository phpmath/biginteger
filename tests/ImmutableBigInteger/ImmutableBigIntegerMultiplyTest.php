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

#[CoversMethod(ImmutableBigInteger::class, 'multiply')]
#[CoversMethod(ImmutableBigInteger::class, 'fromGmp')]
final class ImmutableBigIntegerMultiplyTest extends TestCase
{
    public function testMultiplyPositiveNumbers(): void
    {
        // Arrange
        $bigint1 = new ImmutableBigInteger(12);
        $bigint2 = new ImmutableBigInteger(8);

        // Act
        $result = $bigint1->multiply($bigint2);

        // Assert
        static::assertInstanceOf(ImmutableBigInteger::class, $result);
        static::assertSame('96', $result->value());
        static::assertNotSame($bigint1, $result); // Immutability check
        static::assertSame('12', $bigint1->value()); // Original unchanged
    }

    public function testMultiplyByZero(): void
    {
        // Arrange
        $bigint1 = new ImmutableBigInteger(100);
        $bigint2 = new ImmutableBigInteger(0);

        // Act
        $result = $bigint1->multiply($bigint2);

        // Assert
        static::assertSame('0', $result->value());
    }

    public function testMultiplyZeroByNumber(): void
    {
        // Arrange
        $bigint1 = new ImmutableBigInteger(0);
        $bigint2 = new ImmutableBigInteger(100);

        // Act
        $result = $bigint1->multiply($bigint2);

        // Assert
        static::assertSame('0', $result->value());
    }

    public function testMultiplyByOne(): void
    {
        // Arrange
        $bigint1 = new ImmutableBigInteger(42);
        $bigint2 = new ImmutableBigInteger(1);

        // Act
        $result = $bigint1->multiply($bigint2);

        // Assert
        static::assertSame('42', $result->value());
    }

    public function testMultiplyNegativeNumbers(): void
    {
        // Arrange
        $bigint1 = new ImmutableBigInteger(-5);
        $bigint2 = new ImmutableBigInteger(-6);

        // Act
        $result = $bigint1->multiply($bigint2);

        // Assert
        static::assertSame('30', $result->value());
    }

    public function testMultiplyPositiveByNegative(): void
    {
        // Arrange
        $bigint1 = new ImmutableBigInteger(7);
        $bigint2 = new ImmutableBigInteger(-4);

        // Act
        $result = $bigint1->multiply($bigint2);

        // Assert
        static::assertSame('-28', $result->value());
    }

    public function testMultiplyVeryLargeNumbers(): void
    {
        // Arrange
        $bigint1 = new ImmutableBigInteger('123456789012345678901234567890');
        $bigint2 = new ImmutableBigInteger('987654321098765432109876543210');

        // Act
        $result = $bigint1->multiply($bigint2);

        // Assert
        static::assertStringContainsString(
            '121932631137021795226185032733622923332237463801111263526900',
            $result->value(),
        );
    }

    public function testMultiplyIsCommutative(): void
    {
        // Arrange
        $bigint1 = new ImmutableBigInteger(13);
        $bigint2 = new ImmutableBigInteger(17);

        // Act
        $result1 = $bigint1->multiply($bigint2);
        $result2 = $bigint2->multiply($bigint1);

        // Assert
        static::assertTrue($result1->equals($result2));
        static::assertSame('221', $result1->value());
        static::assertSame('221', $result2->value());
    }
}
