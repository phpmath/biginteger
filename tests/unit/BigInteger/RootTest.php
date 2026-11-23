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

#[CoversMethod(BigInteger::class, 'root')]
final class RootTest extends TestCase
{
    public function testSquareRootOfPerfectSquare(): void
    {
        // Arrange
        $n = new BigInteger('16');

        // Act
        $result = $n->root(2);

        // Assert
        static::assertSame('4', $result->value());
    }

    public function testCubeRootOfPerfectCube(): void
    {
        // Arrange
        $n = new BigInteger('27');

        // Act
        $result = $n->root(3);

        // Assert
        static::assertSame('3', $result->value());
    }

    public function testRootOfNonPerfectPower(): void
    {
        // Arrange
        $n = new BigInteger('20');

        // Act
        $result = $n->root(2);

        // Assert
        // Floor of sqrt(20) = 4
        static::assertSame('4', $result->value());
    }

    public function testRootOfZero(): void
    {
        // Arrange
        $n = new BigInteger('0');

        // Act
        $result = $n->root(5);

        // Assert
        static::assertSame('0', $result->value());
    }

    public function testRootOfOne(): void
    {
        // Arrange
        $n = new BigInteger('1');

        // Act
        $result = $n->root(10);

        // Assert
        static::assertSame('1', $result->value());
    }

    public function testRootWithZeroDegreeThrowsException(): void
    {
        // Arrange
        $n = new BigInteger('8');

        // Assert
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage('The degree of the root must be at least 1.');

        // Act
        $n->root(0);
    }

    public function testRootWithNegativeDegreeThrowsException(): void
    {
        // Arrange
        $n = new BigInteger('8');

        // Assert
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage('The degree of the root must be at least 1.');

        // Act
        $n->root(-1);
    }

    public function testEvenRootOfNegativeNumberThrowsException(): void
    {
        // Arrange
        $n = new BigInteger('-8');

        // Assert
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage('Cannot calculate an even root of a negative number.');

        // Act
        $n->root(2);
    }

    public function testOddRootOfNegativeNumber(): void
    {
        // Arrange
        $n = new BigInteger('-27');

        // Act
        $result = $n->root(3);

        // Assert
        static::assertSame('-3', $result->value());
    }
}
