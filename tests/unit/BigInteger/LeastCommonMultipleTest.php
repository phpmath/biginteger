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

#[CoversMethod(BigInteger::class, 'leastCommonMultiple')]
final class LeastCommonMultipleTest extends TestCase
{
    public function testLcmOfTwoNumbers(): void
    {
        // Arrange
        $a = new BigInteger('12');
        $b = new BigInteger('18');

        // Act
        $result = $a->leastCommonMultiple($b);

        // Assert
        static::assertSame('36', $result->value());
    }

    public function testLcmWithOne(): void
    {
        // Arrange
        $a = new BigInteger('1');
        $b = new BigInteger('99');

        // Act
        $result = $a->leastCommonMultiple($b);

        // Assert
        static::assertSame('99', $result->value());
    }
}
