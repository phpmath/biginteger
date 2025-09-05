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

#[CoversMethod(ImmutableBigInteger::class, 'sqrt')]
#[CoversMethod(ImmutableBigInteger::class, 'fromGmp')]
final class ImmutableBigIntegerSqrtTest extends TestCase
{
    public function testImmutableSqrt(): void
    {
        // Arrange
        $value = new ImmutableBigInteger('16');

        // Act
        $sqrt = $value->sqrt();

        // Assert
        static::assertInstanceOf(ImmutableBigInteger::class, $sqrt);
        static::assertEquals('4', $sqrt->value());
        static::assertEquals('16', $value->value(), 'Original value should remain unchanged');
    }

    public function testSqrtOfNonPerfectSquare(): void
    {
        // Arrange
        $value = new ImmutableBigInteger('20');

        // Act
        $sqrt = $value->sqrt();

        // Assert
        static::assertEquals('4', $sqrt->value(), 'Integer square root should floor the result');
    }

    public function testSqrtOfZeroAndOne(): void
    {
        // Arrange & Act
        $zero = (new ImmutableBigInteger('0'))->sqrt();
        $one = (new ImmutableBigInteger('1'))->sqrt();

        // Assert
        static::assertEquals('0', $zero->value());
        static::assertEquals('1', $one->value());
    }
}
