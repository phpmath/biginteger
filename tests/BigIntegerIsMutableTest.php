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

class BigIntegerIsImmutableTest extends TestCase
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
