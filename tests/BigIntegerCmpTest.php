<?php

namespace PHP\Math\BigIntegerTest;

use PHP\Math\BigInteger\BigInteger;
use PHPUnit\Framework\TestCase;

class BigIntegerCmpTest extends TestCase
{
    public function testWithNegativeNumber()
    {
        // Arrange
        $bigInteger = new BigInteger('123');

        // Act
        $result = $bigInteger->cmp('-123');

        // Assert
        $this->assertInternalType('int', $result);
        $this->assertEquals(1, $result);
    }

    public function testWithPositiveNumber()
    {
        // Arrange
        $bigInteger = new BigInteger('123');

        // Act
        $result = $bigInteger->cmp('246');

        // Assert
        $this->assertInternalType('int', $result);
        $this->assertEquals(-1, $result);
    }

    public function testWithEqualNumber()
    {
        // Arrange
        $bigInteger = new BigInteger('123');

        // Act
        $result = $bigInteger->cmp('123');

        // Assert
        $this->assertInternalType('int', $result);
        $this->assertEquals(0, $result);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testWithInvalidValue()
    {
        // Arrange
        $bigInteger = new BigInteger('123');

        // Act
        $bigInteger->cmp('123.456');

        // Assert
        // ...
    }
}
