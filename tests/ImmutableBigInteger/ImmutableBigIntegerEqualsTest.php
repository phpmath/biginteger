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

#[CoversMethod(ImmutableBigInteger::class, 'equals')]
final class ImmutableBigIntegerEqualsTest extends TestCase
{
    public function testEqualsWithSameValues(): void
    {
        // Arrange
        $bigint1 = new ImmutableBigInteger(42);
        $bigint2 = new ImmutableBigInteger(42);

        // Act
        $result = $bigint1->equals($bigint2);

        // Assert
        static::assertTrue($result);
    }

    public function testEqualsWithDifferentValues(): void
    {
        // Arrange
        $bigint1 = new ImmutableBigInteger(42);
        $bigint2 = new ImmutableBigInteger(24);

        // Act
        $result = $bigint1->equals($bigint2);

        // Assert
        static::assertFalse($result);
    }

    public function testEqualsWithZero(): void
    {
        // Arrange
        $zero1 = new ImmutableBigInteger(0);
        $zero2 = new ImmutableBigInteger(0);
        $nonZero = new ImmutableBigInteger(1);

        // Act & Assert
        static::assertTrue($zero1->equals($zero2));
        static::assertFalse($zero1->equals($nonZero));
        static::assertFalse($nonZero->equals($zero1));
    }

    public function testEqualsWithNegativeNumbers(): void
    {
        // Arrange
        $negative1 = new ImmutableBigInteger(-42);
        $negative2 = new ImmutableBigInteger(-42);
        $positive = new ImmutableBigInteger(42);

        // Act & Assert
        static::assertTrue($negative1->equals($negative2));
        static::assertFalse($negative1->equals($positive));
        static::assertFalse($positive->equals($negative1));
    }

    public function testEqualsWithLargeNumbers(): void
    {
        // Arrange
        $large1 = new ImmutableBigInteger('123456789012345678901234567890');
        $large2 = new ImmutableBigInteger('123456789012345678901234567890');
        $different = new ImmutableBigInteger('123456789012345678901234567891');

        // Act & Assert
        static::assertTrue($large1->equals($large2));
        static::assertFalse($large1->equals($different));
    }

    public function testEqualsIsReflexive(): void
    {
        // Arrange
        $bigint = new ImmutableBigInteger(100);

        // Act & Assert
        static::assertTrue($bigint->equals($bigint));
    }

    public function testEqualsIsSymmetric(): void
    {
        // Arrange
        $bigint1 = new ImmutableBigInteger(100);
        $bigint2 = new ImmutableBigInteger(100);
        $bigint3 = new ImmutableBigInteger(200);

        // Act & Assert
        static::assertTrue($bigint1->equals($bigint2));
        static::assertTrue($bigint2->equals($bigint1));
        static::assertFalse($bigint1->equals($bigint3));
        static::assertFalse($bigint3->equals($bigint1));
    }

    public function testEqualsIsTransitive(): void
    {
        // Arrange
        $bigint1 = new ImmutableBigInteger(100);
        $bigint2 = new ImmutableBigInteger(100);
        $bigint3 = new ImmutableBigInteger(100);

        // Act & Assert
        static::assertTrue($bigint1->equals($bigint2));
        static::assertTrue($bigint2->equals($bigint3));
        static::assertTrue($bigint1->equals($bigint3)); // Transitivity
    }

    public function testEqualsWithStringAndIntegerRepresentation(): void
    {
        // Arrange
        $fromInt = new ImmutableBigInteger(42);
        $fromString = new ImmutableBigInteger('42');

        // Act & Assert
        static::assertTrue($fromInt->equals($fromString));
        static::assertTrue($fromString->equals($fromInt));
    }

    public function testEqualsBasedOnCmp(): void
    {
        // This test verifies that equals() correctly uses cmp()
        // Arrange
        $bigint1 = new ImmutableBigInteger(50);
        $bigint2 = new ImmutableBigInteger(50);
        $bigint3 = new ImmutableBigInteger(75);

        // Act & Assert
        static::assertSame(0, $bigint1->cmp($bigint2));
        static::assertTrue($bigint1->equals($bigint2));

        static::assertNotSame(0, $bigint1->cmp($bigint3));
        static::assertFalse($bigint1->equals($bigint3));
    }
}
