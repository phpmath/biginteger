<?php
/**
 * phpmath / biginteger (https://github.com/phpmath/biginteger)
 *
 * @link https://github.com/phpmath/biginteger for the canonical source repository
 */

declare(strict_types=1);

namespace PHP\Math\BigInteger\Tests\ImmutableBigInteger;

use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\TestCase;
use PHP\Math\BigInteger\ImmutableBigInteger;

#[CoversMethod(ImmutableBigInteger::class, 'greatestCommonDivisor')]
final class ImmutableBigIntegerGreatestCommonDivisorTest extends TestCase
{
    public function testGcdOfTwoPositiveNumbers(): void
    {
        // Arrange
        $a = new ImmutableBigInteger('24');
        $b = new ImmutableBigInteger('36');

        // Act
        $result = $a->greatestCommonDivisor($b);

        // Assert
        static::assertSame('12', $result->value());
    }

    public function testGcdWithOneIsOne(): void
    {
        // Arrange
        $a = new ImmutableBigInteger('1');
        $b = new ImmutableBigInteger('99');

        // Act
        $result = $a->greatestCommonDivisor($b);

        // Assert
        static::assertSame('1', $result->value());
    }

    public function testGcdOfTwoPrimesIsOne(): void
    {
        // Arrange
        $a = new ImmutableBigInteger('17');
        $b = new ImmutableBigInteger('19');

        // Act
        $result = $a->greatestCommonDivisor($b);

        // Assert
        static::assertSame('1', $result->value());
    }

    public function testGcdWithNegativeNumber(): void
    {
        // Arrange
        $a = new ImmutableBigInteger('-24');
        $b = new ImmutableBigInteger('36');

        // Act
        $result = $a->greatestCommonDivisor($b);

        // Assert
        static::assertSame('12', $result->value());
    }
}
