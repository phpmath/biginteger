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

#[CoversMethod(ImmutableBigInteger::class, 'bitwiseOr')]
#[CoversMethod(ImmutableBigInteger::class, 'fromGmp')]
final class ImmutableBigIntegerBitwiseOrTest extends TestCase
{
    public function testBitwiseOrWithZero(): void
    {
        // Arrange
        $a = new ImmutableBigInteger('0');
        $b = new ImmutableBigInteger('5');

        // Act
        $result = $a->bitwiseOr($b);

        // Assert
        static::assertSame('5', $result->value());
    }

    public function testBitwiseOrWithSameNumber(): void
    {
        // Arrange
        $a = new ImmutableBigInteger('6');
        $b = new ImmutableBigInteger('6');

        // Act
        $result = $a->bitwiseOr($b);

        // Assert
        static::assertSame('6', $result->value());
    }

    public function testBitwiseOrDifferentNumbers(): void
    {
        // Arrange
        $a = new ImmutableBigInteger('6'); // 110 in binary
        $b = new ImmutableBigInteger('3'); // 011 in binary

        // Act
        $result = $a->bitwiseOr($b);

        // Assert
        // 110 OR 011 = 111 (binary) = 7
        static::assertSame('7', $result->value());
    }

    public function testBitwiseOrWithNegativeNumber(): void
    {
        // Arrange
        $a = new ImmutableBigInteger('-2');
        $b = new ImmutableBigInteger('5');

        // Act
        $result = $a->bitwiseOr($b);

        // Assert
        static::assertSame('-1', $result->value());
    }
}
