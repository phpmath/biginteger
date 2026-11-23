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

#[CoversMethod(BigInteger::class, 'greatestCommonDivisor')]
final class GreatestCommonDivisorTest extends TestCase
{
    public function testGcdOfTwoPositiveNumbers(): void
    {
        // Arrange
        $a = new BigInteger('24');
        $b = new BigInteger('36');

        // Act
        $result = $a->greatestCommonDivisor($b);

        // Assert
        static::assertSame('12', $result->value());
    }

    public function testGcdWithOneIsOne(): void
    {
        // Arrange
        $a = new BigInteger('1');
        $b = new BigInteger('99');

        // Act
        $result = $a->greatestCommonDivisor($b);

        // Assert
        static::assertSame('1', $result->value());
    }

    public function testGcdOfTwoPrimesIsOne(): void
    {
        // Arrange
        $a = new BigInteger('17');
        $b = new BigInteger('19');

        // Act
        $result = $a->greatestCommonDivisor($b);

        // Assert
        static::assertSame('1', $result->value());
    }

    public function testGcdWithNegativeNumber(): void
    {
        // Arrange
        $a = new BigInteger('-24');
        $b = new BigInteger('36');

        // Act
        $result = $a->greatestCommonDivisor($b);

        // Assert
        static::assertSame('12', $result->value());
    }
}
