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

#[CoversMethod(BigInteger::class, 'kronecker')]
final class KroneckerTest extends TestCase
{
    public function testKroneckerOfThreeOverFive(): void
    {
        // Arrange
        $a = new BigInteger('3');
        $b = new BigInteger('5');

        // Act
        $result = $a->kronecker($b);

        // Assert
        static::assertSame(-1, $result);
    }

    public function testKroneckerOfTwoOverSeven(): void
    {
        // Arrange
        $a = new BigInteger('2');
        $b = new BigInteger('7');

        // Act
        $result = $a->kronecker($b);

        // Assert
        static::assertSame(1, $result);
    }
}
