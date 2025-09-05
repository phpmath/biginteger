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

#[CoversMethod(ImmutableBigInteger::class, 'jacobi')]
final class ImmutableBigIntegerJacobiTest extends TestCase
{
    public function testJacobiOfOneOverThree(): void
    {
        // Arrange
        $a = new ImmutableBigInteger('1');
        $b = new ImmutableBigInteger('3');

        // Act
        $result = $a->jacobi($b);

        // Assert
        static::assertSame(1, $result);
    }

    public function testJacobiOfTwoOverThree(): void
    {
        // Arrange
        $a = new ImmutableBigInteger('2');
        $b = new ImmutableBigInteger('3');

        // Act
        $result = $a->jacobi($b);

        // Assert
        static::assertSame(-1, $result);
    }
}
