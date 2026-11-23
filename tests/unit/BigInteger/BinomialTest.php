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

#[CoversMethod(BigInteger::class, 'binomial')]
#[CoversMethod(BigInteger::class, 'fromGmp')]
final class BinomialTest extends TestCase
{
    public function testBinomialWithSmallNumbers(): void
    {
        // Arrange
        $n = new BigInteger('5');

        // Act
        $result = $n->binomial(2);

        // Assert
        static::assertSame('10', $result->value());
    }

    public function testBinomialWithKEqualsZero(): void
    {
        // Arrange
        $n = new BigInteger('7');

        // Act
        $result = $n->binomial(0);

        // Assert
        static::assertSame('1', $result->value());
    }

    public function testBinomialWhereKEqualsN(): void
    {
        // Arrange
        $n = new BigInteger('7');

        // Act
        $result = $n->binomial(7);

        // Assert
        static::assertSame('1', $result->value());
    }

    public function testBinomialWithLargeNumbers(): void
    {
        // Arrange
        $n = new BigInteger('50');

        // Act
        $result = $n->binomial(6);

        // Assert
        static::assertSame('15890700', $result->value());
    }

    public function testBinomialWithNegativeKThrowsException(): void
    {
        // Arrange
        $n = new BigInteger('5');

        // Assert
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage('The number of elements to choose must not be negative.');

        // Act
        $n->binomial(-1);
    }

    public function testBinomialWithKLargerThanNReturnsZero(): void
    {
        // Arrange
        $n = new BigInteger('5');

        // Act
        $result = $n->binomial(9);

        // Assert
        static::assertSame('0', $result->value());
    }
}
