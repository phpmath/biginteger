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

#[CoversMethod(ImmutableBigInteger::class, 'bitwiseAnd')]
#[CoversMethod(ImmutableBigInteger::class, 'fromGmp')]
final class ImmutableBigIntegerBitwiseAndTest extends TestCase
{
    public function testBitwiseAndWithPositiveNumbers(): void
    {
        // Arrange
        $a = new ImmutableBigInteger('6');  // 110 (binary)
        $b = new ImmutableBigInteger('3');  // 011 (binary)

        // Act
        $result = $a->bitwiseAnd($b);

        // Assert
        static::assertSame('2', $result->value()); // 010 (binary)
    }

    public function testBitwiseAndWithZero(): void
    {
        // Arrange
        $a = new ImmutableBigInteger('12345');
        $b = new ImmutableBigInteger('0');

        // Act
        $result = $a->bitwiseAnd($b);

        // Assert
        static::assertSame('0', $result->value());
    }

    public function testBitwiseAndWithNegativeNumber(): void
    {
        // Arrange
        $a = new ImmutableBigInteger('-1');  // all bits set
        $b = new ImmutableBigInteger('42');  // 101010 (binary)

        // Act
        $result = $a->bitwiseAnd($b);

        // Assert
        static::assertSame('42', $result->value());
    }
}
