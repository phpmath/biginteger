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

#[CoversMethod(ImmutableBigInteger::class, '__construct')]
final class ImmutableBigIntegerConstructorTest extends TestCase
{
    public function testConstructorWithPositiveInteger(): void
    {
        // Arrange & Act
        $bigint = new ImmutableBigInteger(42);

        // Assert
        static::assertInstanceOf(ImmutableBigInteger::class, $bigint);
        static::assertSame('42', $bigint->value());
    }

    public function testConstructorWithNegativeInteger(): void
    {
        // Arrange & Act
        $bigint = new ImmutableBigInteger(-123);

        // Assert
        static::assertSame('-123', $bigint->value());
    }

    public function testConstructorWithZero(): void
    {
        // Arrange & Act
        $bigint = new ImmutableBigInteger(0);

        // Assert
        static::assertSame('0', $bigint->value());
    }

    public function testConstructorWithPositiveStringNumber(): void
    {
        // Arrange & Act
        $bigint = new ImmutableBigInteger('123456789012345678901234567890');

        // Assert
        static::assertSame('123456789012345678901234567890', $bigint->value());
    }

    public function testConstructorWithNegativeStringNumber(): void
    {
        // Arrange & Act
        $bigint = new ImmutableBigInteger('-987654321098765432109876543210');

        // Assert
        static::assertSame('-987654321098765432109876543210', $bigint->value());
    }

    public function testConstructorWithOctalString(): void
    {
        // Arrange & Act
        $bigint = new ImmutableBigInteger('0755');

        // Assert
        static::assertSame('493', $bigint->value());
    }

    public function testConstructorWithHexString(): void
    {
        // Arrange & Act
        $bigint = new ImmutableBigInteger('0xFF');

        // Assert
        static::assertSame('255', $bigint->value());
    }

    public function testConstructorThrowsExceptionOnInvalidString(): void
    {
        // Assert
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage('Invalid number provided');

        // Act
        new ImmutableBigInteger('not-a-number');
    }

    public function testConstructorThrowsExceptionOnEmptyString(): void
    {
        // Assert
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage('Invalid number provided');

        // Act
        new ImmutableBigInteger('');
    }
}
