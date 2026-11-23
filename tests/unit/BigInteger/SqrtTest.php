<?php
/**
 * phpmath / biginteger (https://github.com/phpmath/biginteger)
 *
 * @link https://github.com/phpmath/biginteger for the canonical source repository
 */

declare(strict_types=1);

namespace PHPMath\BigInteger\Tests\BigInteger;

use PHPMath\BigInteger\BigInteger;
use PHPMath\BigInteger\Exception\InvalidValueException;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\TestCase;

#[CoversMethod(BigInteger::class, 'sqrt')]
#[CoversMethod(BigInteger::class, 'fromGmp')]
final class SqrtTest extends TestCase
{
    public function testSqrt(): void
    {
        // Arrange
        $value = new BigInteger('16');

        // Act
        $sqrt = $value->sqrt();

        // Assert
        static::assertInstanceOf(BigInteger::class, $sqrt);
        static::assertEquals('4', $sqrt->value());
        static::assertEquals('16', $value->value(), 'Original value should remain unchanged');
    }

    public function testSqrtOfNonPerfectSquare(): void
    {
        // Arrange
        $value = new BigInteger('20');

        // Act
        $sqrt = $value->sqrt();

        // Assert
        static::assertEquals('4', $sqrt->value(), 'Integer square root should floor the result');
    }

    public function testSqrtOfZeroAndOne(): void
    {
        // Arrange & Act
        $zero = (new BigInteger('0'))->sqrt();
        $one = (new BigInteger('1'))->sqrt();

        // Assert
        static::assertEquals('0', $zero->value());
        static::assertEquals('1', $one->value());
    }

    public function testSqrtOfNegativeNumberThrowsException(): void
    {
        // Arrange
        $n = new BigInteger('-4');

        // Assert
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage('Cannot calculate the square root of a negative number.');

        // Act
        $n->sqrt();
    }
}
