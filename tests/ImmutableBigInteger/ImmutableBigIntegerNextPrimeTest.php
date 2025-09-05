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

#[CoversMethod(ImmutableBigInteger::class, 'nextPrime')]
final class ImmutableBigIntegerNextPrimeTest extends TestCase
{
    public function testNextPrimeAfterPrime(): void
    {
        // Arrange
        $n = new ImmutableBigInteger('7');

        // Act
        $result = $n->nextPrime();

        // Assert
        static::assertSame('11', $result->value());
    }

    public function testNextPrimeAfterComposite(): void
    {
        // Arrange
        $n = new ImmutableBigInteger('8');

        // Act
        $result = $n->nextPrime();

        // Assert
        static::assertSame('11', $result->value());
    }

    public function testNextPrimeAfterNegativeNumber(): void
    {
        // Arrange
        $n = new ImmutableBigInteger('-5');

        // Act
        $result = $n->nextPrime();

        // Assert
        static::assertSame('2', $result->value());
    }

    public function testNextPrimeAfterZero(): void
    {
        // Arrange
        $n = new ImmutableBigInteger('0');

        // Act
        $result = $n->nextPrime();

        // Assert
        static::assertSame('2', $result->value());
    }

    public function testNextPrimeAfterOne(): void
    {
        // Arrange
        $n = new ImmutableBigInteger('1');

        // Act
        $result = $n->nextPrime();

        // Assert
        static::assertSame('2', $result->value());
    }
}
