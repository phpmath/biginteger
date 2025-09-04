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

#[CoversMethod(MutableBigInteger::class, 'sqrt')]
final class MutableBigIntegerSqrtTest extends TestCase
{
    public function testMutableSqrt(): void
    {
        // Arrange
        $value = new MutableBigInteger("25");

        // Act
        $result = $value->sqrt();

        // Assert
        static::assertInstanceOf(MutableBigInteger::class, $result);
        static::assertEquals("5", $value->value(), 'Mutable value should be modified');
        static::assertSame($value, $result, 'Method should return $this for chaining');
    }
}
