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

#[CoversMethod(BigInteger::class, 'legendre')]
final class LegendreTest extends TestCase
{
    public function testLegendreSymbol(): void
    {
        // Arrange
        $a = new BigInteger('2');
        $p = new BigInteger('7');

        // Act
        $result = $a->legendre($p);

        // Assert
        static::assertSame(1, $result); // 2 is quadratic residue modulo 7
    }

    public function testLegendreSymbolNonResidue(): void
    {
        // Arrange
        $a = new BigInteger('3');
        $p = new BigInteger('7');

        // Act
        $result = $a->legendre($p);

        // Assert
        static::assertSame(-1, $result); // 3 is non-residue modulo 7
    }
}
