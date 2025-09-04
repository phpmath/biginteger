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

#[CoversMethod(ImmutableBigInteger::class, 'cmp')]
final class ImmutableBigIntegerCmpTest extends TestCase
{
    public function testCmpEqualNumbers(): void
    {
        // Arrange
        $bigint1 = new ImmutableBigInteger(42);
        $bigint2 = new ImmutableBigInteger(42);

        // Act
        $result = $bigint1->cmp($bigint2);

        // Assert
        static::assertSame(0, $result);
    }

    public function testCmpFirstNumberLarger(): void
    {
        // Arrange
        $bigint1 = new ImmutableBigInteger(100);
        $bigint2 = new ImmutableBigInteger(50);

        // Act
        $result = $bigint1->cmp($bigint2);

        // Assert
        static::assertSame(1, $result);
    }

    public function testCmpFirstNumberSmaller(): void
    {
        // Arrange
        $bigint1 = new ImmutableBigInteger(25);
        $bigint2 = new ImmutableBigInteger(75);

        // Act
        $result = $bigint1->cmp($bigint2);

        // Assert
        static::assertSame(-1, $result);
    }

    public function testCmpPositiveAndNegative(): void
    {
        // Arrange
        $positive = new ImmutableBigInteger(10);
        $negative = new ImmutableBigInteger(-10);

        // Act & Assert
        static::assertSame(1, $positive->cmp($negative));
        static::assertSame(-1, $negative->cmp($positive));
    }

    public function testCmpNegativeNumbers(): void
    {
        // Arrange
        $bigint1 = new ImmutableBigInteger(-25);
        $bigint2 = new ImmutableBigInteger(-50);

        // Act & Assert
        static::assertSame(1, $bigint1->cmp($bigint2)); // -25 > -50
        static::assertSame(-1, $bigint2->cmp($bigint1)); // -50 < -25
    }

    public function testCmpWithZero(): void
    {
        // Arrange
        $zero = new ImmutableBigInteger(0);
        $positive = new ImmutableBigInteger(10);
        $negative = new ImmutableBigInteger(-10);

        // Act & Assert
        static::assertSame(0, $zero->cmp(new ImmutableBigInteger(0)));
        static::assertSame(-1, $zero->cmp($positive));
        static::assertSame(1, $zero->cmp($negative));
        static::assertSame(1, $positive->cmp($zero));
        static::assertSame(-1, $negative->cmp($zero));
    }

    public function testCmpVeryLargeNumbers(): void
    {
        // Arrange
        $large1 = new ImmutableBigInteger('999999999999999999999999999999');
        $large2 = new ImmutableBigInteger('999999999999999999999999999998');
        $large3 = new ImmutableBigInteger('1000000000000000000000000000000');

        // Act & Assert
        static::assertSame(1, $large1->cmp($large2));
        static::assertSame(-1, $large1->cmp($large3));
        static::assertSame(0, $large1->cmp(new ImmutableBigInteger('999999999999999999999999999999')));
    }

    public function testCmpIsAntisymmetric(): void
    {
        // Arrange
        $bigint1 = new ImmutableBigInteger(100);
        $bigint2 = new ImmutableBigInteger(200);

        // Act
        $cmp1 = $bigint1->cmp($bigint2);
        $cmp2 = $bigint2->cmp($bigint1);

        // Assert
        static::assertSame(-1, $cmp1);
        static::assertSame(1, $cmp2);
        static::assertSame(-$cmp1, $cmp2);
    }

    public function testCmpIsTransitive(): void
    {
        // Arrange
        $small = new ImmutableBigInteger(10);
        $medium = new ImmutableBigInteger(50);
        $large = new ImmutableBigInteger(100);

        // Act & Assert
        static::assertSame(-1, $small->cmp($medium));  // small < medium
        static::assertSame(-1, $medium->cmp($large));   // medium < large
        static::assertSame(-1, $small->cmp($large));    // small < large (transitivity)
    }

    public function testCmpReflexive(): void
    {
        // Arrange
        $bigint = new ImmutableBigInteger(42);

        // Act & Assert
        static::assertSame(0, $bigint->cmp($bigint));
    }
}
