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

#[CoversMethod(BigInteger::class, 'nextPrime')]
final class NextPrimeTest extends TestCase
{
    public function testNextPrimeAfterPrime(): void
    {
        // Arrange
        $n = new BigInteger('7');

        // Act
        $result = $n->nextPrime();

        // Assert
        static::assertSame('11', $result->value());
    }

    public function testNextPrimeAfterComposite(): void
    {
        // Arrange
        $n = new BigInteger('8');

        // Act
        $result = $n->nextPrime();

        // Assert
        static::assertSame('11', $result->value());
    }

    public function testNextPrimeAfterNegativeNumber(): void
    {
        // Arrange
        $n = new BigInteger('-5');

        // Act
        $result = $n->nextPrime();

        // Assert
        static::assertSame('2', $result->value());
    }

    public function testNextPrimeAfterZero(): void
    {
        // Arrange
        $n = new BigInteger('0');

        // Act
        $result = $n->nextPrime();

        // Assert
        static::assertSame('2', $result->value());
    }

    public function testNextPrimeAfterOne(): void
    {
        // Arrange
        $n = new BigInteger('1');

        // Act
        $result = $n->nextPrime();

        // Assert
        static::assertSame('2', $result->value());
    }
}
