<?php

namespace PHP\Math\BigIntegerTest;

use PHP\Math\BigInteger\BigInteger;
use PHPUnit_Framework_TestCase;

class BigIntegerIsImmutableTest extends PHPUnit_Framework_TestCase
{
    public function testIsMutableEmpty()
    {
        // Arrange
        $bigInteger = new BigInteger('123');

        // Act
        $result = $bigInteger->isMutable();

        // Assert
        $this->assertTrue($result);
    }

    public function testIsMutableFalse()
    {
        // Arrange
        $bigInteger = new BigInteger('123', false);

        // Act
        $result = $bigInteger->isMutable();

        // Assert
        $this->assertFalse($result);
    }

    public function testIsMutableTrue()
    {
        // Arrange
        $bigInteger = new BigInteger('123', true);

        // Act
        $result = $bigInteger->isMutable();

        // Assert
        $this->assertTrue($result);
    }
}
