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

#[CoversMethod(BigInteger::class, 'factorial')]
#[CoversMethod(BigInteger::class, 'fromGmp')]
final class FactorialTest extends TestCase
{
    public function testFactorialZero(): void
    {
        // Arrange
        $bigint = new BigInteger(0);

        // Act
        $result = $bigint->factorial();

        // Assert
        static::assertInstanceOf(BigInteger::class, $result);
        static::assertSame('1', $result->value()); // 0! = 1
        static::assertNotSame($bigint, $result); // Immutability check
        static::assertSame('0', $bigint->value()); // Original unchanged
    }

    public function testFactorialOne(): void
    {
        // Arrange
        $bigint = new BigInteger(1);

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
            $bigint = new BigInteger($input);

            // Act
            $result = $bigint->factorial();

            // Assert
            static::assertSame($expected, $result->value());
        }
    }

    public function testFactorialLargerNumber(): void
    {
        // Arrange
        $bigint = new BigInteger(10);

        // Act
        $result = $bigint->factorial();

        // Assert
        static::assertSame('3628800', $result->value()); // 10! = 3,628,800
    }

    public function testFactorialVeryLargeResult(): void
    {
        // Arrange
        $bigint = new BigInteger(15);

        // Act
        $result = $bigint->factorial();

        // Assert
        static::assertSame('1307674368000', $result->value()); // 15! = 1,307,674,368,000
    }

    public function testFactorialIsAlwaysPositive(): void
    {
        // Arrange & Act
        $factorials = [
            (new BigInteger(0))->factorial(),
            (new BigInteger(1))->factorial(),
            (new BigInteger(5))->factorial(),
            (new BigInteger(10))->factorial(),
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
        $small = new BigInteger(5);
        $medium = new BigInteger(10);

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
        $original = new BigInteger(5);
        $originalValue = $original->value();

        // Act
        $factorial = $original->factorial();

        // Assert
        static::assertNotSame($original, $factorial);
        static::assertSame($originalValue, $original->value());
        static::assertSame('120', $factorial->value());
    }

    public function testFactorialOfNegativeNumberThrowsException(): void
    {
        // Arrange
        $n = new BigInteger('-5');

        // Assert
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage('Cannot calculate the factorial of a negative number.');

        // Act
        $n->factorial();
    }
}
