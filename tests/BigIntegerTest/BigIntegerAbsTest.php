<?php

namespace PHP\Math\BigIntegerTest;

use PHP\Math\BigInteger\BigInteger;
use PHPUnit_Framework_TestCase;

class BigIntegerAbsTest extends PHPUnit_Framework_TestCase
{
    public function testWithNegativeNumber()
    {
        // Arrange
        $bigInteger = new BigInteger('-123');

        // Act
        $bigInteger->abs();

        // Assert
        $this->assertInternalType('string', $bigInteger->getValue());
        $this->assertEquals('123', $bigInteger->getValue());
    }

    public function testWithPositiveNumber()
    {
        // Arrange
        $bigInteger = new BigInteger('123');

        // Act
        $bigInteger->abs();

        // Assert
        $this->assertInternalType('string', $bigInteger->getValue());
        $this->assertEquals('123', $bigInteger->getValue());
    }

    public function testWithZeroNumber()
    {
        // Arrange
        $bigInteger = new BigInteger('0');

        // Act
        $bigInteger->abs();

        // Assert
        $this->assertInternalType('string', $bigInteger->getValue());
        $this->assertEquals('0', $bigInteger->getValue());
    }
}
