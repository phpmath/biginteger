<?php
/**
 * phpmath / biginteger (https://github.com/phpmath/biginteger)
 *
 * @link https://github.com/phpmath/biginteger for the canonical source repository
 * @copyright Copyright (c) 2015-2017 phpmath (https://github.com/phpmath)
 * @license https://github.com/phpmath/biginteger/blob/master/LICENSE.md MIT
 */

namespace PHP\Math\BigIntegerTest;

use PHP\Math\BigInteger\BigInteger;
use PHPUnit_Framework_TestCase;

class BigIntegerSetValueTest extends PHPUnit_Framework_TestCase
{
    public function testWithInteger()
    {
        // Arrange
        $bigInteger = new BigInteger('0');

        // Act
        $bigInteger->setValue(123);

        // Assert
        $this->assertInternalType('string', $bigInteger->getValue());
        $this->assertEquals('123', $bigInteger->getValue());
    }

    public function testWithString()
    {
        // Arrange
        $bigInteger = new BigInteger('0');

        // Act
        $bigInteger->setValue('123');

        // Assert
        $this->assertInternalType('string', $bigInteger->getValue());
        $this->assertEquals('123', $bigInteger->getValue());
    }

    public function testWithBigInteger()
    {
        // Arrange
        $bigInteger = new BigInteger('0');
        $bigIntegerValue = new BigInteger('123');

        // Act
        $bigInteger->setValue($bigIntegerValue);

        // Assert
        $this->assertInternalType('string', $bigInteger->getValue());
        $this->assertEquals('123', $bigInteger->getValue());
    }

    /**
     * @expectedException RuntimeException
     */
    public function testWithMutableFalse()
    {
        // Arrange
        $bigInteger = new BigInteger('0', false);

        // Act
        $bigInteger->setValue('123');

        // Assert
        // ...
    }

    public function testWithMutableTrue()
    {
        // Arrange
        $bigInteger = new BigInteger('0', true);

        // Act
        $newBigInteger = $bigInteger->setValue('123');

        // Assert
        $this->assertInstanceOf('PHP\Math\BigInteger\BigInteger', $bigInteger);
        $this->assertInstanceOf('PHP\Math\BigInteger\BigInteger', $newBigInteger);
        $this->assertEquals('123', $bigInteger->getValue());
        $this->assertEquals('123', $newBigInteger->getValue());
    }
}
