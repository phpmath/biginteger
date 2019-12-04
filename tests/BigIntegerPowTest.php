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
use PHPUnit\Framework\TestCase;

class BigIntegerPowTest extends TestCase
{
    public function testWithInteger()
    {
        // Arrange
        $bigInteger = new BigInteger('123');

        // Act
        $bigInteger->pow(20);

        // Assert
        $this->assertInternalType('string', $bigInteger->getValue());
        $this->assertEquals('628206215175202159781085149496179361969201', $bigInteger->getValue());
    }

    public function testWithMutableFalse()
    {
        // Arrange
        $bigInteger = new BigInteger('2', false);

        // Act
        $newBigInteger = $bigInteger->pow(2);

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
        $newBigInteger = $bigInteger->pow(2);

        // Assert
        $this->assertInstanceOf('PHP\Math\BigInteger\BigInteger', $bigInteger);
        $this->assertInstanceOf('PHP\Math\BigInteger\BigInteger', $newBigInteger);
        $this->assertEquals('4', $bigInteger->getValue());
        $this->assertEquals('4', $newBigInteger->getValue());
    }
}
