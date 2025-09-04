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

#[CoversMethod(ImmutableBigInteger::class, 'value')]
final class ImmutableBigIntegerValueTest extends TestCase
{
    public function testValueReturnsStringRepresentation(): void
    {
        // Arrange
        $bigint = new ImmutableBigInteger(12345);

        // Act
        $value = $bigint->value();

        // Assert
        static::assertSame('12345', $value);
        static::assertIsString($value);
    }

    public function testValueWithNegativeNumber(): void
    {
        // Arrange
        $bigint = new ImmutableBigInteger(-9876);

        // Act & Assert
        static::assertSame('-9876', $bigint->value());
    }

    public function testValueWithZero(): void
    {
        // Arrange
        $bigint = new ImmutableBigInteger(0);

        // Act & Assert
        static::assertSame('0', $bigint->value());
    }

    public function testValueWithVeryLargeNumber(): void
    {
        // Arrange
        $largeNumber = '123456789012345678901234567890123456789';
        $bigint = new ImmutableBigInteger($largeNumber);

        // Act & Assert
        static::assertSame($largeNumber, $bigint->value());
    }
}
