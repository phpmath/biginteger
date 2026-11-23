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

#[CoversMethod(BigInteger::class, 'isPerfectSquare')]
final class IsPerfectSquareTest extends TestCase
{
    public function testNumberIsPerfectSquare(): void
    {
        // Arrange
        $n = new BigInteger('16'); // 4^2

        // Act
        $result = $n->isPerfectSquare();

        // Assert
        static::assertTrue($result);
    }

    public function testNumberIsNotPerfectSquare(): void
    {
        // Arrange
        $n = new BigInteger('15');

        // Act
        $result = $n->isPerfectSquare();

        // Assert
        static::assertFalse($result);
    }

    public function testOneIsPerfectSquare(): void
    {
        // Arrange
        $n = new BigInteger('1'); // 1^2

        // Act
        $result = $n->isPerfectSquare();

        // Assert
        static::assertTrue($result);
    }

    public function testZeroIsPerfectSquare(): void
    {
        // Arrange
        $n = new BigInteger('0'); // 0^2

        // Act
        $result = $n->isPerfectSquare();

        // Assert
        static::assertTrue($result);
    }

    public function testNegativeNumberIsNotPerfectSquare(): void
    {
        // Arrange
        $n = new BigInteger('-16');

        // Act
        $result = $n->isPerfectSquare();

        // Assert
        static::assertFalse($result);
    }

    public function testLargePerfectSquare(): void
    {
        // Arrange
        $n = new BigInteger('100000000'); // 10000^2

        // Act
        $result = $n->isPerfectSquare();

        // Assert
        static::assertTrue($result);
    }
}
