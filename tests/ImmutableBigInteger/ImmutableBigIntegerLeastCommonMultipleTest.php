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

#[CoversMethod(ImmutableBigInteger::class, 'leastCommonMultiple')]
final class ImmutableBigIntegerLeastCommonMultipleTest extends TestCase
{
    public function testLcmOfTwoNumbers(): void
    {
        // Arrange
        $a = new ImmutableBigInteger('12');
        $b = new ImmutableBigInteger('18');

        // Act
        $result = $a->leastCommonMultiple($b);

        // Assert
        static::assertSame('36', $result->value());
    }

    public function testLcmWithOne(): void
    {
        // Arrange
        $a = new ImmutableBigInteger('1');
        $b = new ImmutableBigInteger('99');

        // Act
        $result = $a->leastCommonMultiple($b);

        // Assert
        static::assertSame('99', $result->value());
    }
}
