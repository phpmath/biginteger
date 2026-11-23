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
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\TestCase;

#[CoversMethod(BigInteger::class, 'hammingDistance')]
final class HammingDistanceTest extends TestCase
{
    public function testHammingDistanceOfSameNumberIsZero(): void
    {
        // Arrange
        $a = new BigInteger('42');
        $b = new BigInteger('42');

        // Act
        $distance = $a->hammingDistance($b);

        // Assert
        static::assertSame(0, $distance);
    }

    public function testHammingDistanceOfDifferentNumbers(): void
    {
        // Arrange
        $a = new BigInteger('6'); // 110
        $b = new BigInteger('3'); // 011

        // Act
        $distance = $a->hammingDistance($b);

        // Assert
        // 110 XOR 011 = 101 → two bits differ
        static::assertSame(2, $distance);
    }

    public function testHammingDistanceWithNegativeNumber(): void
    {
        // Arrange
        $a = new BigInteger('-1');  // all bits set
        $b = new BigInteger('0');

        // Assert
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage('Negative numbers do not have a Hamming distance.');

        // Act
        $a->hammingDistance($b);
    }
}
