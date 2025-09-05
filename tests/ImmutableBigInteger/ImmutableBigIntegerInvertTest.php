<?php
/**
 * phpmath / biginteger (https://github.com/phpmath/biginteger)
 *
 * @link https://github.com/phpmath/biginteger for the canonical source repository
 */

declare(strict_types=1);

namespace PHP\Math\BigInteger\Tests\ImmutableBigInteger;

use PHP\Math\BigInteger\Exception\InvalidValueException;
use PHP\Math\BigInteger\ImmutableBigInteger;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\TestCase;

#[CoversMethod(ImmutableBigInteger::class, 'invert')]
final class ImmutableBigIntegerInvertTest extends TestCase
{
    public function testInvertExists(): void
    {
        // Arrange
        $a = new ImmutableBigInteger('3');
        $mod = new ImmutableBigInteger('11');

        // Act
        $result = $a->invert($mod);

        // Assert
        static::assertSame('4', $result->value());
    }

    public function testInvertNoInverseThrowsException(): void
    {
        // Arrange
        $a = new ImmutableBigInteger('6');
        $mod = new ImmutableBigInteger('9'); // gcd(6,9) != 1 → no inverse

        // Assert
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage('No modular inverse exists');

        // Act
        $a->invert($mod);
    }

    public function testInvertWithNegativeNumber(): void
    {
        // Arrange
        $a = new ImmutableBigInteger('-3');
        $mod = new ImmutableBigInteger('11');

        // Act
        $result = $a->invert($mod);

        // Assert
        static::assertSame('7', $result->value());
    }
}
