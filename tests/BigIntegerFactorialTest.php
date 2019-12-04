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

class BigIntegerFactorialTest extends TestCase
{
    public function testFactorial()
    {
        // Arrange
        $bigInteger = new BigInteger('5');

        // Act
        $bigIntegerValue = $bigInteger->factorial();

        // Assert
        $this->assertInternalType('string', $bigIntegerValue->getValue());
        $this->assertEquals('120', $bigIntegerValue->getValue());
    }

    public function testWithMutableFalse()
    {
        // Arrange
        $bigInteger = new BigInteger('5', false);

        // Act
        $newBigInteger = $bigInteger->factorial();

        // Assert
        $this->assertInstanceOf('PHP\Math\BigInteger\BigInteger', $bigInteger);
        $this->assertInstanceOf('PHP\Math\BigInteger\BigInteger', $newBigInteger);
        $this->assertEquals('5', $bigInteger->getValue());
        $this->assertEquals('120', $newBigInteger->getValue());
    }

    public function testWithMutableTrue()
    {
        // Arrange
        $bigInteger = new BigInteger('5', true);

        // Act
        $newBigInteger = $bigInteger->factorial();

        // Assert
        $this->assertInstanceOf('PHP\Math\BigInteger\BigInteger', $bigInteger);
        $this->assertInstanceOf('PHP\Math\BigInteger\BigInteger', $newBigInteger);
        $this->assertEquals('120', $bigInteger->getValue());
        $this->assertEquals('120', $newBigInteger->getValue());
    }
}
