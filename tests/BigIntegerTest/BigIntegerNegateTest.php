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
}
