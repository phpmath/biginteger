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

#[CoversMethod(BigInteger::class, 'divideRemainder')]
final class DivideRemainderTest extends TestCase
{
    public function testDivideRemainderWithExactDivision(): void
    {
        // Arrange
        $a = new BigInteger('10');
        $b = new BigInteger('2');

        // Act
        $result = $a->divideRemainder($b);

        // Assert
        static::assertSame('0', $result->value());
    }

    public function testDivideRemainderWithRemainder(): void
    {
        // Arrange
        $a = new BigInteger('10');
        $b = new BigInteger('3');

        // Act
        $result = $a->divideRemainder($b);

        // Assert
        static::assertSame('1', $result->value());
    }

    public function testDivideRemainderWithNegativeDividend(): void
    {
        // Arrange
        $a = new BigInteger('-10');
        $b = new BigInteger('3');

        // Act
        $result = $a->divideRemainder($b);

        // Assert
        static::assertSame('-1', $result->value());
    }

    public function testDivideRemainderWithNegativeDivisor(): void
    {
        // Arrange
        $a = new BigInteger('10');
        $b = new BigInteger('-3');

        // Act
        $result = $a->divideRemainder($b);

        // Assert
        static::assertSame('1', $result->value());
    }

    public function testDivideRemainderWithNegativeDividendAndDivisor(): void
    {
        // Arrange
        $a = new BigInteger('-10');
        $b = new BigInteger('-3');

        // Act
        $result = $a->divideRemainder($b);

        // Assert
        static::assertSame('-1', $result->value());
    }

    public function testDivideRemainderByZeroThrowsException(): void
    {
        // Arrange
        $a = new BigInteger('10');
        $b = new BigInteger('0');

        // Assert
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage('Invalid value provided: 0');

        // Act
        $a->divideRemainder($b);
    }
}
