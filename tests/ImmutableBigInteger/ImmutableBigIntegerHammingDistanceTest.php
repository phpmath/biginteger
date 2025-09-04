<?php
/**
 * phpmath / biginteger (https://github.com/phpmath/biginteger)
 *
 * @link https://github.com/phpmath/biginteger for the canonical source repository
 */

declare(strict_types=1);

namespace PHP\Math\BigInteger\Tests\ImmutableBigInteger;

use PHP\Math\BigInteger\Exception\InvalidValueException;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\TestCase;
use PHP\Math\BigInteger\ImmutableBigInteger;

#[CoversMethod(ImmutableBigInteger::class, 'hammingDistance')]
final class ImmutableBigIntegerHammingDistanceTest extends TestCase
{
    public function testHammingDistanceOfSameNumberIsZero(): void
    {
        // Arrange
        $a = new ImmutableBigInteger('42');
        $b = new ImmutableBigInteger('42');

        // Act
        $distance = $a->hammingDistance($b);

        // Assert
        static::assertSame(0, $distance);
    }

    public function testHammingDistanceOfDifferentNumbers(): void
    {
        // Arrange
        $a = new ImmutableBigInteger('6'); // 110
        $b = new ImmutableBigInteger('3'); // 011

        // Act
        $distance = $a->hammingDistance($b);

        // Assert
        // 110 XOR 011 = 101 → two bits differ
        static::assertSame(2, $distance);
    }

    public function testHammingDistanceWithNegativeNumber(): void
    {
        // Arrange
        $a = new ImmutableBigInteger('-1');  // all bits set
        $b = new ImmutableBigInteger('0');

        // Assert
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage('Negative numbers do not have a Hamming distance.');

        // Act
        $a->hammingDistance($b);
    }
}
