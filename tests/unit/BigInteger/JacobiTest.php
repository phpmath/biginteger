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

#[CoversMethod(BigInteger::class, 'jacobi')]
final class JacobiTest extends TestCase
{
    public function testJacobiOfOneOverThree(): void
    {
        // Arrange
        $a = new BigInteger('1');
        $b = new BigInteger('3');

        // Act
        $result = $a->jacobi($b);

        // Assert
        static::assertSame(1, $result);
    }

    public function testJacobiOfTwoOverThree(): void
    {
        // Arrange
        $a = new BigInteger('2');
        $b = new BigInteger('3');

        // Act
        $result = $a->jacobi($b);

        // Assert
        static::assertSame(-1, $result);
    }
}
