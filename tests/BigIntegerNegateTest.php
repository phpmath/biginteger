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
        $bigInteger = new BigInteger('10', false);

        // Act
        $newBigInteger = $bigInteger->negate();

        // Assert
        $this->assertInstanceOf('PHP\Math\BigInteger\BigInteger', $bigInteger);
        $this->assertInstanceOf('PHP\Math\BigInteger\BigInteger', $newBigInteger);
        $this->assertEquals('10', $bigInteger->getValue());
        $this->assertEquals('-10', $newBigInteger->getValue());
    }

    public function testWithMutableTrue()
    {
        // Arrange
        $bigInteger = new BigInteger('10', true);

        // Act
        $newBigInteger = $bigInteger->negate();

        // Assert
        $this->assertInstanceOf('PHP\Math\BigInteger\BigInteger', $bigInteger);
        $this->assertInstanceOf('PHP\Math\BigInteger\BigInteger', $newBigInteger);
        $this->assertEquals('-10', $bigInteger->getValue());
        $this->assertEquals('-10', $newBigInteger->getValue());
    }
}
