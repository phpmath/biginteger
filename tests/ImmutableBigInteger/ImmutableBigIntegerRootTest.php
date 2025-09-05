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

#[CoversMethod(ImmutableBigInteger::class, 'root')]
final class ImmutableBigIntegerRootTest extends TestCase
{
    public function testSquareRootOfPerfectSquare(): void
    {
        // Arrange
        $n = new ImmutableBigInteger('16');

        // Act
        $result = $n->root(2);

        // Assert
        static::assertSame('4', $result->value());
    }

    public function testCubeRootOfPerfectCube(): void
    {
        // Arrange
        $n = new ImmutableBigInteger('27');

        // Act
        $result = $n->root(3);

        // Assert
        static::assertSame('3', $result->value());
    }

    public function testRootOfNonPerfectPower(): void
    {
        // Arrange
        $n = new ImmutableBigInteger('20');

        // Act
        $result = $n->root(2);

        // Assert
        // Floor of sqrt(20) = 4
        static::assertSame('4', $result->value());
    }

    public function testRootOfZero(): void
    {
        // Arrange
        $n = new ImmutableBigInteger('0');

        // Act
        $result = $n->root(5);

        // Assert
        static::assertSame('0', $result->value());
    }

    public function testRootOfOne(): void
    {
        // Arrange
        $n = new ImmutableBigInteger('1');

        // Act
        $result = $n->root(10);

        // Assert
        static::assertSame('1', $result->value());
    }
}
