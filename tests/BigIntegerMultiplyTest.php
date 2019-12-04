<?php
/**
 * phpmath / biginteger (https://github.com/phpmath/biginteger)
 *
 * @link https://github.com/phpmath/biginteger for the canonical source repository
 * @copyright Copyright (c) 2015-2017 phpmath (https://github.com/phpmath)
 * @license https://github.com/phpmath/biginteger/blob/master/LICENSE.md MIT
 */

namespace PHP\Math\BigIntegerTest;

use InvalidArgumentException;
use PHP\Math\BigInteger\BigInteger;
use PHPUnit\Framework\TestCase;

class BigIntegerMultiplyTest extends TestCase
{
    public function testWithInteger()
    {
        // Arrange
        $bigInteger = new BigInteger('123');

        // Act
        $bigInteger->multiply(123);

        // Assert
        $this->assertIsString($bigInteger->getValue());
        $this->assertEquals('15129', $bigInteger->getValue());
    }

    public function testWithString()
    {
        // Arrange
        $bigInteger = new BigInteger('123');

        // Act
        $bigInteger->multiply('123');

        // Assert
        $this->assertIsString($bigInteger->getValue());
        $this->assertEquals('15129', $bigInteger->getValue());
    }

    public function testWithBigInteger()
    {
        // Arrange
        $bigInteger = new BigInteger('123');
        $bigIntegerValue = new BigInteger('123');

        // Act
        $bigInteger->multiply($bigIntegerValue);

        // Assert
        $this->assertIsString($bigInteger->getValue());
        $this->assertEquals('15129', $bigInteger->getValue());
    }

    public function testWithInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);

        // Arrange
        $bigInteger = new BigInteger('123');

        // Act
        $bigInteger->multiply('123.123');

        // Assert
        // ...
    }

    public function testWithMutableFalse()
    {
        // Arrange
        $bigInteger = new BigInteger('2', false);

        // Act
        $newBigInteger = $bigInteger->multiply('2');

        // Assert
        $this->assertInstanceOf('PHP\Math\BigInteger\BigInteger', $bigInteger);
        $this->assertInstanceOf('PHP\Math\BigInteger\BigInteger', $newBigInteger);
        $this->assertEquals('2', $bigInteger->getValue());
        $this->assertEquals('4', $newBigInteger->getValue());
    }

    public function testWithMutableTrue()
    {
        // Arrange
        $bigInteger = new BigInteger('2', true);

        // Act
        $newBigInteger = $bigInteger->multiply('2');

        // Assert
        $this->assertInstanceOf('PHP\Math\BigInteger\BigInteger', $bigInteger);
        $this->assertInstanceOf('PHP\Math\BigInteger\BigInteger', $newBigInteger);
        $this->assertEquals('4', $bigInteger->getValue());
        $this->assertEquals('4', $newBigInteger->getValue());
    }
}
