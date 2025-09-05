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

#[CoversMethod(ImmutableBigInteger::class, 'legendre')]
final class ImmutableBigIntegerLegendreTest extends TestCase
{
    public function testLegendreSymbol(): void
    {
        // Arrange
        $a = new ImmutableBigInteger('2');
        $p = new ImmutableBigInteger('7');

        // Act
        $result = $a->legendre($p);

        // Assert
        static::assertSame(1, $result); // 2 is quadratic residue modulo 7
    }

    public function testLegendreSymbolNonResidue(): void
    {
        // Arrange
        $a = new ImmutableBigInteger('3');
        $p = new ImmutableBigInteger('7');

        // Act
        $result = $a->legendre($p);

        // Assert
        static::assertSame(-1, $result); // 3 is non-residue modulo 7
    }
}
