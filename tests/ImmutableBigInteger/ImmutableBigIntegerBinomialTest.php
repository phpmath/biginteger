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

#[CoversMethod(ImmutableBigInteger::class, 'binomial')]
#[CoversMethod(ImmutableBigInteger::class, 'fromGmp')]
final class ImmutableBigIntegerBinomialTest extends TestCase
{
    public function testBinomialWithSmallNumbers(): void
    {
        // Arrange
        $n = new ImmutableBigInteger('5');

        // Act
        $result = $n->binomial(2);

        // Assert
        static::assertSame('10', $result->value());
    }

    public function testBinomialWithKEqualsZero(): void
    {
        // Arrange
        $n = new ImmutableBigInteger('7');

        // Act
        $result = $n->binomial(0);

        // Assert
        static::assertSame('1', $result->value());
    }

    public function testBinomialWhereKEqualsN(): void
    {
        // Arrange
        $n = new ImmutableBigInteger('7');

        // Act
        $result = $n->binomial(7);

        // Assert
        static::assertSame('1', $result->value());
    }

    public function testBinomialWithLargeNumbers(): void
    {
        // Arrange
        $n = new ImmutableBigInteger('50');

        // Act
        $result = $n->binomial(6);

        // Assert
        static::assertSame('15890700', $result->value());
    }
}
