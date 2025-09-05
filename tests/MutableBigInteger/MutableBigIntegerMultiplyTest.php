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

#[CoversMethod(MutableBigInteger::class, 'multiply')]
final class MutableBigIntegerMultiplyTest extends TestCase
{
    public function testMultiplyPositiveNumbers(): void
    {
        // Arrange
        $bigint1 = new MutableBigInteger(12);
        $bigint2 = new MutableBigInteger(8);

        // Act
        $result = $bigint1->multiply($bigint2);

        // Assert
        static::assertSame($bigint1, $result); // Returns same instance (mutable)
        static::assertSame('96', $bigint1->value());
        static::assertSame('96', $result->value());
    }

    public function testMultiplyByZero(): void
    {
        // Arrange
        $bigint1 = new MutableBigInteger(100);
        $bigint2 = new MutableBigInteger(0);

        // Act
        $result = $bigint1->multiply($bigint2);

        // Assert
        static::assertSame($bigint1, $result);
        static::assertSame('0', $bigint1->value());
    }

    public function testMultiplyZeroByNumber(): void
    {
        // Arrange
        $bigint1 = new MutableBigInteger(0);
        $bigint2 = new MutableBigInteger(100);

        // Act
        $result = $bigint1->multiply($bigint2);

        // Assert
        static::assertSame($bigint1, $result);
        static::assertSame('0', $bigint1->value());
    }

    public function testMultiplyByOne(): void
    {
        // Arrange
        $bigint1 = new MutableBigInteger(42);
        $bigint2 = new MutableBigInteger(1);

        // Act
        $result = $bigint1->multiply($bigint2);

        // Assert
        static::assertSame($bigint1, $result);
        static::assertSame('42', $bigint1->value());
    }

    public function testMultiplyNegativeNumbers(): void
    {
        // Arrange
        $bigint1 = new MutableBigInteger(-5);
        $bigint2 = new MutableBigInteger(-6);

        // Act
        $result = $bigint1->multiply($bigint2);

        // Assert
        static::assertSame($bigint1, $result);
        static::assertSame('30', $bigint1->value());
    }

    public function testMultiplyPositiveByNegative(): void
    {
        // Arrange
        $bigint1 = new MutableBigInteger(7);
        $bigint2 = new MutableBigInteger(-4);

        // Act
        $result = $bigint1->multiply($bigint2);

        // Assert
        static::assertSame($bigint1, $result);
        static::assertSame('-28', $bigint1->value());
    }

    public function testMultiplyVeryLargeNumbers(): void
    {
        // Arrange
        $bigint1 = new MutableBigInteger('123456789012345678901234567890');
        $bigint2 = new MutableBigInteger('987654321098765432109876543210');

        // Act
        $result = $bigint1->multiply($bigint2);

        // Assert
        static::assertSame($bigint1, $result);
        static::assertStringContainsString(
            '121932631137021795226185032733622923332237463801111263526900',
            $bigint1->value(),
        );
    }

    public function testMultiplyChaining(): void
    {
        // Arrange
        $bigint = new MutableBigInteger(2);

        // Act
        $result = $bigint->multiply(new MutableBigInteger(3))
                         ->multiply(new MutableBigInteger(4));

        // Assert
        static::assertSame($bigint, $result);
        static::assertSame('24', $bigint->value());
    }

    public function testMultiplyModifiesOriginal(): void
    {
        // Arrange
        $bigint = new MutableBigInteger(15);
        $originalValue = $bigint->value();

        // Act
        $bigint->multiply(new MutableBigInteger(3));

        // Assert
        static::assertNotSame($originalValue, $bigint->value());
        static::assertSame('45', $bigint->value());
    }

    public function testMultiplyByNegativeOne(): void
    {
        // Arrange
        $bigint = new MutableBigInteger(42);

        // Act
        $result = $bigint->multiply(new MutableBigInteger(-1));

        // Assert
        static::assertSame($bigint, $result);
        static::assertSame('-42', $bigint->value());
    }
}
