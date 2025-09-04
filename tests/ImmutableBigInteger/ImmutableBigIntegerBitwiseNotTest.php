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

#[CoversMethod(ImmutableBigInteger::class, 'bitwiseNot')]
#[CoversMethod(ImmutableBigInteger::class, 'fromGmp')]
final class ImmutableBigIntegerBitwiseNotTest extends TestCase
{
    public function testBitwiseNotOfZero(): void
    {
        // Arrange
        $n = new ImmutableBigInteger('0');

        // Act
        $result = $n->bitwiseNot();

        // Assert
        static::assertSame('-1', $result->value());
    }

    public function testBitwiseNotOfPositiveNumber(): void
    {
        // Arrange
        $n = new ImmutableBigInteger('5'); // binary 0101

        // Act
        $result = $n->bitwiseNot();

        // Assert
        static::assertSame('-6', $result->value());
    }

    public function testBitwiseNotOfNegativeNumber(): void
    {
        // Arrange
        $n = new ImmutableBigInteger('-1');

        // Act
        $result = $n->bitwiseNot();

        // Assert
        static::assertSame('0', $result->value());
    }
}
