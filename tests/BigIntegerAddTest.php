<?php

namespace PHP\Math\BigIntegerTest;

use PHP\Math\BigInteger\BigInteger;
use PHPUnit\Framework\TestCase;

class BigIntegerAddTest extends TestCase
{
    public function testWithInteger()
    {
        // Arrange
        $bigInteger = new BigInteger('123');

        // Act
        $bigInteger->add(123);

        // Assert
        $this->assertInternalType('string', $bigInteger->getValue());
        $this->assertEquals('246', $bigInteger->getValue());
    }

    public function testWithString()
    {
        // Arrange
        $bigInteger = new BigInteger('123');

        // Act
        $bigInteger->add('123');

        // Assert
        $this->assertInternalType('string', $bigInteger->getValue());
        $this->assertEquals('246', $bigInteger->getValue());
    }

    public function testWithBigInteger()
    {
        // Arrange
        $bigInteger = new BigInteger('123');
        $bigIntegerValue = new BigInteger('123');

        // Act
        $bigInteger->add($bigIntegerValue);

        // Assert
        $this->assertInternalType('string', $bigInteger->getValue());
        $this->assertEquals('246', $bigInteger->getValue());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testWithInvalidValue()
    {
        // Arrange
        $bigInteger = new BigInteger('123');

        // Act
        $bigInteger->add('123.123');

        // Assert
        // ...
    }

    public function testWithMutableFalse()
    {
        // Arrange
        $bigInteger = new BigInteger('5', false);

        // Act
        $newBigInteger = $bigInteger->add(5);

        // Assert
        $this->assertInstanceOf('PHP\Math\BigInteger\BigInteger', $bigInteger);
        $this->assertInstanceOf('PHP\Math\BigInteger\BigInteger', $newBigInteger);
        $this->assertEquals('5', $bigInteger->getValue());
        $this->assertEquals('10', $newBigInteger->getValue());
    }

    public function testWithMutableTrue()
    {
        // Arrange
        $bigInteger = new BigInteger('5', true);

        // Act
        $newBigInteger = $bigInteger->add(5);

        // Assert
        $this->assertInstanceOf('PHP\Math\BigInteger\BigInteger', $bigInteger);
        $this->assertInstanceOf('PHP\Math\BigInteger\BigInteger', $newBigInteger);
        $this->assertEquals('10', $bigInteger->getValue());
        $this->assertEquals('10', $newBigInteger->getValue());
    }
}
