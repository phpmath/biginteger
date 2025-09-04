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

#[CoversMethod(MutableBigInteger::class, 'add')]
final class MutableBigIntegerAddTest extends TestCase
{
    public function testAddPositiveNumbers(): void
    {
        // Arrange
        $bigint1 = new MutableBigInteger(100);
        $bigint2 = new MutableBigInteger(50);

        // Act
        $result = $bigint1->add($bigint2);

        // Assert
        static::assertSame($bigint1, $result); // Returns same instance (mutable)
        static::assertSame('150', $bigint1->value());
        static::assertSame('150', $result->value());
    }

    public function testAddNegativeNumbers(): void
    {
        // Arrange
        $bigint1 = new MutableBigInteger(-25);
        $bigint2 = new MutableBigInteger(-75);

        // Act
        $result = $bigint1->add($bigint2);

        // Assert
        static::assertSame($bigint1, $result);
        static::assertSame('-100', $bigint1->value());
    }

    public function testAddPositiveAndNegative(): void
    {
        // Arrange
        $bigint1 = new MutableBigInteger(100);
        $bigint2 = new MutableBigInteger(-30);

        // Act
        $result = $bigint1->add($bigint2);

        // Assert
        static::assertSame($bigint1, $result);
        static::assertSame('70', $bigint1->value());
    }

    public function testAddWithZero(): void
    {
        // Arrange
        $bigint1 = new MutableBigInteger(42);
        $bigint2 = new MutableBigInteger(0);

        // Act
        $result = $bigint1->add($bigint2);

        // Assert
        static::assertSame($bigint1, $result);
        static::assertSame('42', $bigint1->value());
    }

    public function testAddZeroToZero(): void
    {
        // Arrange
        $bigint1 = new MutableBigInteger(0);
        $bigint2 = new MutableBigInteger(0);

        // Act
        $result = $bigint1->add($bigint2);

        // Assert
        static::assertSame($bigint1, $result);
        static::assertSame('0', $bigint1->value());
    }

    public function testAddVeryLargeNumbers(): void
    {
        // Arrange
        $bigint1 = new MutableBigInteger('999999999999999999999999999999');
        $bigint2 = new MutableBigInteger('111111111111111111111111111111');

        // Act
        $result = $bigint1->add($bigint2);

        // Assert
        static::assertSame($bigint1, $result);
        static::assertSame('1111111111111111111111111111110', $bigint1->value());
    }

    public function testAddChaining(): void
    {
        // Arrange
        $bigint = new MutableBigInteger(10);

        // Act
        $result = $bigint->add(new MutableBigInteger(20))
                         ->add(new MutableBigInteger(30));

        // Assert
        static::assertSame($bigint, $result);
        static::assertSame('60', $bigint->value());
    }

    public function testAddModifiesOriginal(): void
    {
        // Arrange
        $bigint = new MutableBigInteger(100);
        $originalValue = $bigint->value();

        // Act
        $bigint->add(new MutableBigInteger(50));

        // Assert
        static::assertNotSame($originalValue, $bigint->value());
        static::assertSame('150', $bigint->value());
    }
}
