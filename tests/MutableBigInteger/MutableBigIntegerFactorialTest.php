<?php
/**
 * phpmath / biginteger (https://github.com/phpmath/biginteger)
 *
 * @link https://github.com/phpmath/biginteger for the canonical source repository
 */

declare(strict_types=1);

namespace PHP\Math\BigInteger\Tests\MutableBigInteger;

use PHP\Math\BigInteger\MutableBigInteger;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\TestCase;

#[CoversMethod(MutableBigInteger::class, 'factorial')]
final class MutableBigIntegerFactorialTest extends TestCase
{
    public function testFactorialZero(): void
    {
        // Arrange
        $bigint = new MutableBigInteger(0);

        // Act
        $result = $bigint->factorial();

        // Assert
        static::assertSame($bigint, $result); // Returns same instance (mutable)
        static::assertSame('1', $bigint->value()); // 0! = 1
        static::assertSame('1', $result->value());
    }

    public function testFactorialOne(): void
    {
        // Arrange
        $bigint = new MutableBigInteger(1);

        // Act
        $result = $bigint->factorial();

        // Assert
        static::assertSame($bigint, $result);
        static::assertSame('1', $bigint->value()); // 1! = 1
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
            $bigint = new MutableBigInteger($input);

            // Act
            $result = $bigint->factorial();

            // Assert
            static::assertSame($bigint, $result);
            static::assertSame($expected, $bigint->value(), "Factorial of {$input} should be {$expected}");
        }
    }

    public function testFactorialLargerNumber(): void
    {
        // Arrange
        $bigint = new MutableBigInteger(10);

        // Act
        $result = $bigint->factorial();

        // Assert
        static::assertSame($bigint, $result);
        static::assertSame('3628800', $bigint->value()); // 10! = 3,628,800
    }

    public function testFactorialVeryLargeResult(): void
    {
        // Arrange
        $bigint = new MutableBigInteger(15);

        // Act
        $result = $bigint->factorial();

        // Assert
        static::assertSame($bigint, $result);
        static::assertSame('1307674368000', $bigint->value()); // 15! = 1,307,674,368,000
    }

    public function testFactorialIsAlwaysPositive(): void
    {
        // Arrange & Act
        $factorials = [
            (new MutableBigInteger(0))->factorial(),
            (new MutableBigInteger(1))->factorial(),
            (new MutableBigInteger(5))->factorial(),
            (new MutableBigInteger(10))->factorial(),
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
        $small = new MutableBigInteger(5);
        $medium = new MutableBigInteger(10);

        // Act
        $small->factorial();
        $medium->factorial();

        // Assert
        static::assertSame('120', $small->value());
        static::assertSame('3628800', $medium->value());
        static::assertTrue($medium->cmp($small) > 0);
    }

    public function testFactorialModifiesOriginal(): void
    {
        // Arrange
        $bigint = new MutableBigInteger(6);
        $originalValue = $bigint->value();

        // Act
        $bigint->factorial();

        // Assert
        static::assertNotSame($originalValue, $bigint->value());
        static::assertSame('720', $bigint->value()); // 6! = 720
    }

    public function testFactorialChaining(): void
    {
        // Arrange
        $bigint = new MutableBigInteger(4);

        // Act - First 4! = 24, then add 76 to get 100
        $result = $bigint->factorial()->add(new MutableBigInteger(76));

        // Assert
        static::assertSame($bigint, $result);
        static::assertSame('100', $bigint->value());
    }

    public function testFactorialZeroSpecialCase(): void
    {
        // Arrange
        $zero = new MutableBigInteger(0);

        // Act
        $result = $zero->factorial();

        // Assert
        static::assertSame($zero, $result);
        static::assertSame('1', $zero->value());
        static::assertTrue($zero->isPositive());
        static::assertFalse($zero->isZero()); // No longer zero after factorial
    }
}
