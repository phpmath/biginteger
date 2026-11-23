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

#[CoversMethod(BigInteger::class, 'bitwiseAnd')]
#[CoversMethod(BigInteger::class, 'fromGmp')]
final class BitwiseAndTest extends TestCase
{
    public function testBitwiseAndWithPositiveNumbers(): void
    {
        // Arrange
        $a = new BigInteger('6');  // 110 (binary)
        $b = new BigInteger('3');  // 011 (binary)

        // Act
        $result = $a->bitwiseAnd($b);

        // Assert
        static::assertSame('2', $result->value()); // 010 (binary)
    }

    public function testBitwiseAndWithZero(): void
    {
        // Arrange
        $a = new BigInteger('12345');
        $b = new BigInteger('0');

        // Act
        $result = $a->bitwiseAnd($b);

        // Assert
        static::assertSame('0', $result->value());
    }

    public function testBitwiseAndWithNegativeNumber(): void
    {
        // Arrange
        $a = new BigInteger('-1');  // all bits set
        $b = new BigInteger('42');  // 101010 (binary)

        // Act
        $result = $a->bitwiseAnd($b);

        // Assert
        static::assertSame('42', $result->value());
    }
}
