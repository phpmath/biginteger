<?php

namespace PHP\Math\BigIntegerTest;

use PHP\Math\BigInteger\BigInteger;
use PHPUnit\Framework\TestCase;

class BigIntegerCopyTest extends TestCase
{
    public function testWithSettingNewValue()
    {
        // Arrange
        $x = new BigInteger('700');

        // Act
        $xTmp = $x->copy();
        $xTmp->setValue('800');

        // Assert
        $this->assertNotEquals($x->getValue(), $xTmp->getValue());
    }
}
