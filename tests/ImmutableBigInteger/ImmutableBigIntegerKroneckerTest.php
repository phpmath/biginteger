<?php
/**
 * phpmath / biginteger (https://github.com/phpmath/biginteger)
 *
 * @link https://github.com/phpmath/biginteger for the canonical source repository
 */

declare(strict_types=1);

namespace PHP\Math\BigInteger\Tests\ImmutableBigInteger;

use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\TestCase;
use PHP\Math\BigInteger\ImmutableBigInteger;

#[CoversMethod(ImmutableBigInteger::class, 'kronecker')]
final class ImmutableBigIntegerKroneckerTest extends TestCase
{
    public function testKroneckerOfThreeOverFive(): void
    {
        // Arrange
        $a = new ImmutableBigInteger('3');
        $b = new ImmutableBigInteger('5');

        // Act
        $result = $a->kronecker($b);

        // Assert
        static::assertSame(-1, $result);
    }

    public function testKroneckerOfTwoOverSeven(): void
    {
        // Arrange
        $a = new ImmutableBigInteger('2');
        $b = new ImmutableBigInteger('7');

        // Act
        $result = $a->kronecker($b);

        // Assert
        static::assertSame(1, $result);
    }
}
