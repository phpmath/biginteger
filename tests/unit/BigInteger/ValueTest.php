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

#[CoversMethod(BigInteger::class, 'value')]
final class ValueTest extends TestCase
{
    public function testValueReturnsStringRepresentation(): void
    {
        // Arrange
        $bigint = new BigInteger(12345);

        // Act
        $value = $bigint->value();

        // Assert
        static::assertSame('12345', $value);
    }

    public function testValueWithNegativeNumber(): void
    {
        // Arrange
        $bigint = new BigInteger(-9876);

        // Act & Assert
        static::assertSame('-9876', $bigint->value());
    }

    public function testValueWithZero(): void
    {
        // Arrange
        $bigint = new BigInteger(0);

        // Act & Assert
        static::assertSame('0', $bigint->value());
    }

    public function testValueWithVeryLargeNumber(): void
    {
        // Arrange
        $largeNumber = '123456789012345678901234567890123456789';
        $bigint = new BigInteger($largeNumber);

        // Act & Assert
        static::assertSame($largeNumber, $bigint->value());
    }
}
