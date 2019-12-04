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

class BigIntegerModTest extends TestCase
{
    public function testWithInteger()
    {
        // Arrange
        $bigInteger = new BigInteger('456');

        // Act
        $bigInteger->mod(123);

        // Assert
        $this->assertIsString($bigInteger->getValue());
        $this->assertEquals('87', $bigInteger->getValue());
    }

    public function testWithString()
    {
        // Arrange
        $bigInteger = new BigInteger('456');

        // Act
        $bigInteger->mod('123');

        // Assert
        $this->assertIsString($bigInteger->getValue());
        $this->assertEquals('87', $bigInteger->getValue());
    }

    public function testWithBigInteger()
    {
        // Arrange
        $bigInteger = new BigInteger('456');
        $bigIntegerValue = new BigInteger('123');

        // Act
        $bigInteger->mod($bigIntegerValue);

        // Assert
        $this->assertIsString($bigInteger->getValue());
        $this->assertEquals('87', $bigInteger->getValue());
    }

    public function testWithInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);

        // Arrange
        $bigInteger = new BigInteger('123');

        // Act
        $bigInteger->mod('123.123');

        // Assert
        // ...
    }

    public function testWithMutableFalse()
    {
        // Arrange
        $bigInteger = new BigInteger('15', false);

        // Act
        $newBigInteger = $bigInteger->mod('7');

        // Assert
        $this->assertInstanceOf('PHP\Math\BigInteger\BigInteger', $bigInteger);
        $this->assertInstanceOf('PHP\Math\BigInteger\BigInteger', $newBigInteger);
        $this->assertEquals('15', $bigInteger->getValue());
        $this->assertEquals('1', $newBigInteger->getValue());
    }

    public function testWithMutableTrue()
    {
        // Arrange
        $bigInteger = new BigInteger('15', true);

        // Act
        $newBigInteger = $bigInteger->mod('7');

        // Assert
        $this->assertInstanceOf('PHP\Math\BigInteger\BigInteger', $bigInteger);
        $this->assertInstanceOf('PHP\Math\BigInteger\BigInteger', $newBigInteger);
        $this->assertEquals('1', $bigInteger->getValue());
        $this->assertEquals('1', $newBigInteger->getValue());
    }
}
