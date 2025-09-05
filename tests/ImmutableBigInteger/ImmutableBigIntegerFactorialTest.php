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

#[CoversMethod(ImmutableBigInteger::class, 'factorial')]
#[CoversMethod(ImmutableBigInteger::class, 'fromGmp')]
final class ImmutableBigIntegerFactorialTest extends TestCase
{
    public function testFactorialZero(): void
    {
        // Arrange
        $bigint = new ImmutableBigInteger(0);

        // Act
        $result = $bigint->factorial();

        // Assert
        static::assertInstanceOf(ImmutableBigInteger::class, $result);
        static::assertSame('1', $result->value()); // 0! = 1
        static::assertNotSame($bigint, $result); // Immutability check
        static::assertSame('0', $bigint->value()); // Original unchanged
    }

    public function testFactorialOne(): void
    {
        // Arrange
        $bigint = new ImmutableBigInteger(1);

        // Act
        $result = $bigint->factorial();

        // Assert
        static::assertSame('1', $result->value()); // 1! = 1
    }

    public function testFactorialSmallNumbers(): void
    {
        // Test multiple small factorials
        $testCases = [
            [2, '2'],   // 2! = 2
            [3, '6'],   // 3! = 6
            [4, '24'],  // 4! = 24
            [5, '120'], // 5! = 120
        ];

        foreach ($testCases as [$input, $expected]) {
            // Arrange
            $bigint = new ImmutableBigInteger($input);

            // Act
            $result = $bigint->factorial();

            // Assert
            static::assertSame($expected, $result->value());
        }
    }

    public function testFactorialLargerNumber(): void
    {
        // Arrange
        $bigint = new ImmutableBigInteger(10);

        // Act
        $result = $bigint->factorial();

        // Assert
        static::assertSame('3628800', $result->value()); // 10! = 3,628,800
    }

    public function testFactorialVeryLargeResult(): void
    {
        // Arrange
        $bigint = new ImmutableBigInteger(15);

        // Act
        $result = $bigint->factorial();

        // Assert
        static::assertSame('1307674368000', $result->value()); // 15! = 1,307,674,368,000
    }

    public function testFactorialIsAlwaysPositive(): void
    {
        // Arrange & Act
        $factorials = [
            (new ImmutableBigInteger(0))->factorial(),
            (new ImmutableBigInteger(1))->factorial(),
            (new ImmutableBigInteger(5))->factorial(),
            (new ImmutableBigInteger(10))->factorial(),
        ];

        // Assert
        foreach ($factorials as $factorial) {
            static::assertTrue($factorial->isPositive() || $factorial->isZero());
            static::assertFalse($factorial->isNegative());
        }
    }

    public function testFactorialGrowsVeryFast(): void
    {
        // Arrange
        $small = new ImmutableBigInteger(5);
        $medium = new ImmutableBigInteger(10);

        // Act
        $smallFactorial = $small->factorial();
        $mediumFactorial = $medium->factorial();

        // Assert
        static::assertSame('120', $smallFactorial->value());
        static::assertSame('3628800', $mediumFactorial->value());
        static::assertTrue($mediumFactorial->cmp($smallFactorial) > 0);
    }

    public function testFactorialPreservesImmutability(): void
    {
        // Arrange
        $original = new ImmutableBigInteger(5);
        $originalValue = $original->value();

        // Act
        $factorial = $original->factorial();

        // Assert
        static::assertNotSame($original, $factorial);
        static::assertSame($originalValue, $original->value());
        static::assertSame('120', $factorial->value());
    }
}
