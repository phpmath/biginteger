<?php
/**
 * phpmath / biginteger (https://github.com/phpmath/biginteger)
 *
 * @link https://github.com/phpmath/biginteger for the canonical source repository
 */

declare(strict_types=1);

namespace ImmutableBigInteger;

use PHP\Math\BigInteger\ImmutableBigInteger;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\TestCase;

#[CoversMethod(ImmutableBigInteger::class, 'sign')]
final class ImmutableBigIntegerSignTest extends TestCase
{
    public function testSignPositive(): void
    {
        // Arrange
        $n = new ImmutableBigInteger('42');

        // Act
        $result = $n->sign();

        // Assert
        static::assertSame(\PHP\Math\BigInteger\Sign::Positive, $result);
    }

    public function testSignNegative(): void
    {
        // Arrange
        $n = new ImmutableBigInteger('-42');

        // Act
        $result = $n->sign();

        // Assert
        static::assertSame(\PHP\Math\BigInteger\Sign::Negative, $result);
    }

    public function testSignZero(): void
    {
        // Arrange
        $n = new ImmutableBigInteger('0');

        // Act
        $result = $n->sign();

        // Assert
        static::assertSame(\PHP\Math\BigInteger\Sign::Zero, $result);
    }
}
