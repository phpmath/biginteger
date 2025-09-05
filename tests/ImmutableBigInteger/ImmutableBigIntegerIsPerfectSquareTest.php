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

#[CoversMethod(ImmutableBigInteger::class, 'isPerfectSquare')]
final class ImmutableBigIntegerIsPerfectSquareTest extends TestCase
{
    public function testNumberIsPerfectSquare(): void
    {
        // Arrange
        $n = new ImmutableBigInteger('16'); // 4^2

        // Act
        $result = $n->isPerfectSquare();

        // Assert
        static::assertTrue($result);
    }

    public function testNumberIsNotPerfectSquare(): void
    {
        // Arrange
        $n = new ImmutableBigInteger('15');

        // Act
        $result = $n->isPerfectSquare();

        // Assert
        static::assertFalse($result);
    }

    public function testOneIsPerfectSquare(): void
    {
        // Arrange
        $n = new ImmutableBigInteger('1'); // 1^2

        // Act
        $result = $n->isPerfectSquare();

        // Assert
        static::assertTrue($result);
    }

    public function testZeroIsPerfectSquare(): void
    {
        // Arrange
        $n = new ImmutableBigInteger('0'); // 0^2

        // Act
        $result = $n->isPerfectSquare();

        // Assert
        static::assertTrue($result);
    }

    public function testNegativeNumberIsNotPerfectSquare(): void
    {
        // Arrange
        $n = new ImmutableBigInteger('-16');

        // Act
        $result = $n->isPerfectSquare();

        // Assert
        static::assertFalse($result);
    }

    public function testLargePerfectSquare(): void
    {
        // Arrange
        $n = new ImmutableBigInteger('100000000'); // 10000^2

        // Act
        $result = $n->isPerfectSquare();

        // Assert
        static::assertTrue($result);
    }
}
