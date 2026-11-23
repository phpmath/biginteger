<?php
/**
 * phpmath / biginteger (https://github.com/phpmath/biginteger)
 *
 * @link https://github.com/phpmath/biginteger for the canonical source repository
 */

declare(strict_types=1);

namespace PHPMath\BigInteger\Tests\BigInteger;

use PHPMath\BigInteger\BigInteger;
use PHPMath\BigInteger\Exception\InvalidValueException;
use PHPMath\BigInteger\Exception\NotInvertibleException;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\TestCase;

#[CoversMethod(BigInteger::class, 'invert')]
final class InvertTest extends TestCase
{
    public function testInvertExists(): void
    {
        // Arrange
        $a = new BigInteger('3');
        $mod = new BigInteger('11');

        // Act
        $result = $a->invert($mod);

        // Assert
        static::assertSame('4', $result->value());
    }

    public function testInvertNoInverseThrowsException(): void
    {
        // Arrange
        $a = new BigInteger('6');
        $mod = new BigInteger('9'); // gcd(6,9) != 1 → no inverse

        // Assert
        $this->expectException(NotInvertibleException::class);
        $this->expectExceptionMessage('No modular inverse exists');

        // Act
        $a->invert($mod);
    }

    public function testInvertWithNegativeNumber(): void
    {
        // Arrange
        $a = new BigInteger('-3');
        $mod = new BigInteger('11');

        // Act
        $result = $a->invert($mod);

        // Assert
        static::assertSame('7', $result->value());
    }

    public function testInvertWithZeroModulusThrowsException(): void
    {
        // Arrange
        $a = new BigInteger('3');
        $modulus = new BigInteger('0');

        // Assert
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage('Invalid value provided: 0');

        // Act
        $a->invert($modulus);
    }
}
