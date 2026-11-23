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

#[CoversMethod(BigInteger::class, 'bitwiseNot')]
#[CoversMethod(BigInteger::class, 'fromGmp')]
final class BitwiseNotTest extends TestCase
{
    public function testBitwiseNotOfZero(): void
    {
        // Arrange
        $n = new BigInteger('0');

        // Act
        $result = $n->bitwiseNot();

        // Assert
        static::assertSame('-1', $result->value());
    }

    public function testBitwiseNotOfPositiveNumber(): void
    {
        // Arrange
        $n = new BigInteger('5'); // binary 0101

        // Act
        $result = $n->bitwiseNot();

        // Assert
        static::assertSame('-6', $result->value());
    }

    public function testBitwiseNotOfNegativeNumber(): void
    {
        // Arrange
        $n = new BigInteger('-1');

        // Act
        $result = $n->bitwiseNot();

        // Assert
        static::assertSame('0', $result->value());
    }
}
