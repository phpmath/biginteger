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

#[CoversMethod(BigInteger::class, 'isPerfectPower')]
final class IsPerfectPowerTest extends TestCase
{
    public function testNumberIsPerfectPower(): void
    {
        // Arrange
        $n = new BigInteger('27'); // 3^3

        // Act
        $result = $n->isPerfectPower();

        // Assert
        static::assertTrue($result);
    }

    public function testNumberIsNotPerfectPower(): void
    {
        // Arrange
        $n = new BigInteger('10');

        // Act
        $result = $n->isPerfectPower();

        // Assert
        static::assertFalse($result);
    }

    public function testOneIsPerfectPower(): void
    {
        // Arrange
        $n = new BigInteger('1'); // 1^k

        // Act
        $result = $n->isPerfectPower();

        // Assert
        static::assertTrue($result);
    }

    public function testNegativeNumberIsNotPerfectPower(): void
    {
        // Arrange
        $n = new BigInteger('-8');

        // Act
        $result = $n->isPerfectPower();

        // Assert
        static::assertFalse($result);
    }

    public function testLargePerfectPower(): void
    {
        // Arrange
        $n = new BigInteger('1024'); // 2^10

        // Act
        $result = $n->isPerfectPower();

        // Assert
        static::assertTrue($result);
    }
}
