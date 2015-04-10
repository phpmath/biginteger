<?php

namespace PHP\Math\BigIntegerTest;

use PHP\Math\BigInteger\BigInteger;
use PHPUnit_Framework_TestCase;

class BigIntegerNegateTest extends PHPUnit_Framework_TestCase
{
    public function testNegate()
    {
        // Arrange
        $bigInteger = new BigInteger('123');

        // Act
        $bigInteger->negate();

        // Assert
        $this->assertInternalType('string', $bigInteger->getValue());
        $this->assertEquals('-123', $bigInteger->getValue());
    }

    public function testWithMutableFalse()
    {
        // Arrange
        $bigInteger = new BigInteger('0', false);

        // Act
        $newBigInteger = $bigInteger->negate();

        // Assert
        $this->assertInstanceOf('PHP\Math\BigInteger\BigInteger', $bigInteger);
        $this->assertInstanceOf('PHP\Math\BigInteger\BigInteger', $newBigInteger);
        $this->assertNotEquals(spl_object_hash($newBigInteger), spl_object_hash($bigInteger));
    }

    public function testWithMutableTrue()
    {
        // Arrange
        $bigInteger = new BigInteger('0', true);

        // Act
        $newBigInteger = $bigInteger->negate();

        // Assert
        $this->assertInstanceOf('PHP\Math\BigInteger\BigInteger', $bigInteger);
        $this->assertInstanceOf('PHP\Math\BigInteger\BigInteger', $newBigInteger);
        $this->assertEquals(spl_object_hash($newBigInteger), spl_object_hash($bigInteger));
    }
}
