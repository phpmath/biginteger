<?php
/**
 * phpmath / biginteger (https://github.com/phpmath/biginteger)
 *
 * @link https://github.com/phpmath/biginteger for the canonical source repository
 */

declare(strict_types=1);

namespace PHPMath\BigInteger\Tests\BigInteger;

use PHPMath\BigInteger\BigInteger;
use PHPMath\BigInteger\Sign;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\TestCase;

#[CoversMethod(BigInteger::class, 'sign')]
final class SignTest extends TestCase
{
    public function testSignPositive(): void
    {
        // Arrange
        $n = new BigInteger('42');

        // Act
        $result = $n->sign();

        // Assert
        static::assertSame(Sign::Positive, $result);
    }

    public function testSignNegative(): void
    {
        // Arrange
        $n = new BigInteger('-42');

        // Act
        $result = $n->sign();

        // Assert
        static::assertSame(Sign::Negative, $result);
    }

    public function testSignZero(): void
    {
        // Arrange
        $n = new BigInteger('0');

        // Act
        $result = $n->sign();

        // Assert
        static::assertSame(Sign::Zero, $result);
    }
}
