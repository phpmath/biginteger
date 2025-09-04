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

#[CoversMethod(ImmutableBigInteger::class, 'bitwiseXor')]
#[CoversMethod(ImmutableBigInteger::class, 'fromGmp')]
final class ImmutableBigIntegerBitwiseXorTest extends TestCase
{
    public function testBitwiseXorWithZero(): void
    {
        // Arrange
        $a = new ImmutableBigInteger('0');
        $b = new ImmutableBigInteger('7');

        // Act
        $result = $a->bitwiseXor($b);

        // Assert
        static::assertSame('7', $result->value());
    }

    public function testBitwiseXorWithSameNumber(): void
    {
        // Arrange
        $a = new ImmutableBigInteger('9');

        // Act
        $result = $a->bitwiseXor($a);

        // Assert
        static::assertSame('0', $result->value());
    }

    public function testBitwiseXorDifferentNumbers(): void
    {
        // Arrange
        $a = new ImmutableBigInteger('6'); // 110 in binary
        $b = new ImmutableBigInteger('3'); // 011 in binary

        // Act
        $result = $a->bitwiseXor($b);

        // Assert
        // 110 XOR 011 = 101 (binary) = 5
        static::assertSame('5', $result->value());
    }

    public function testBitwiseXorWithNegativeNumber(): void
    {
        // Arrange
        $a = new ImmutableBigInteger('-2');
        $b = new ImmutableBigInteger('3');

        // Act
        $result = $a->bitwiseXor($b);

        // Assert
        // -2 (111...1110) XOR 3 (0011) = -3
        static::assertSame('-3', $result->value());
    }
}
