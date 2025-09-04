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

#[CoversMethod(MutableBigInteger::class, 'subtract')]
final class MutableBigIntegerSubtractTest extends TestCase
{
    public function testSubtractPositiveNumbers(): void
    {
        // Arrange
        $bigint1 = new MutableBigInteger(100);
        $bigint2 = new MutableBigInteger(30);

        // Act
        $result = $bigint1->subtract($bigint2);

        // Assert
        static::assertSame($bigint1, $result); // Returns same instance (mutable)
        static::assertSame('70', $bigint1->value());
        static::assertSame('70', $result->value());
    }

    public function testSubtractResultInNegative(): void
    {
        // Arrange
        $bigint1 = new MutableBigInteger(50);
        $bigint2 = new MutableBigInteger(80);

        // Act
        $result = $bigint1->subtract($bigint2);

        // Assert
        static::assertSame($bigint1, $result);
        static::assertSame('-30', $bigint1->value());
    }

    public function testSubtractNegativeNumbers(): void
    {
        // Arrange
        $bigint1 = new MutableBigInteger(-25);
        $bigint2 = new MutableBigInteger(-15);

        // Act
        $result = $bigint1->subtract($bigint2);

        // Assert
        static::assertSame($bigint1, $result);
        static::assertSame('-10', $bigint1->value());
    }

    public function testSubtractPositiveFromNegative(): void
    {
        // Arrange
        $bigint1 = new MutableBigInteger(-25);
        $bigint2 = new MutableBigInteger(15);

        // Act
        $result = $bigint1->subtract($bigint2);

        // Assert
        static::assertSame($bigint1, $result);
        static::assertSame('-40', $bigint1->value());
    }

    public function testSubtractZero(): void
    {
        // Arrange
        $bigint1 = new MutableBigInteger(42);
        $bigint2 = new MutableBigInteger(0);

        // Act
        $result = $bigint1->subtract($bigint2);

        // Assert
        static::assertSame($bigint1, $result);
        static::assertSame('42', $bigint1->value());
    }

    public function testSubtractFromZero(): void
    {
        // Arrange
        $bigint1 = new MutableBigInteger(0);
        $bigint2 = new MutableBigInteger(42);

        // Act
        $result = $bigint1->subtract($bigint2);

        // Assert
        static::assertSame($bigint1, $result);
        static::assertSame('-42', $bigint1->value());
    }

    public function testSubtractSameNumber(): void
    {
        // Arrange
        $bigint1 = new MutableBigInteger(100);
        $bigint2 = new MutableBigInteger(100);

        // Act
        $result = $bigint1->subtract($bigint2);

        // Assert
        static::assertSame($bigint1, $result);
        static::assertSame('0', $bigint1->value());
    }

    public function testSubtractVeryLargeNumbers(): void
    {
        // Arrange
        $bigint1 = new MutableBigInteger('999999999999999999999999999999');
        $bigint2 = new MutableBigInteger('111111111111111111111111111111');

        // Act
        $result = $bigint1->subtract($bigint2);

        // Assert
        static::assertSame($bigint1, $result);
        static::assertSame('888888888888888888888888888888', $bigint1->value());
    }

    public function testSubtractChaining(): void
    {
        // Arrange
        $bigint = new MutableBigInteger(100);

        // Act
        $result = $bigint->subtract(new MutableBigInteger(20))
                         ->subtract(new MutableBigInteger(30));

        // Assert
        static::assertSame($bigint, $result);
        static::assertSame('50', $bigint->value());
    }

    public function testSubtractModifiesOriginal(): void
    {
        // Arrange
        $bigint = new MutableBigInteger(100);
        $originalValue = $bigint->value();

        // Act
        $bigint->subtract(new MutableBigInteger(25));

        // Assert
        static::assertNotSame($originalValue, $bigint->value());
        static::assertSame('75', $bigint->value());
    }
}
