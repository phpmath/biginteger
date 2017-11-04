<?php

namespace PHP\Math\BigIntegerTest;

use PHP\Math\BigInteger\BigInteger;
use PHPUnit_Framework_TestCase;

class BigIntegerPrimeNumberTest extends PHPUnit_Framework_TestCase
{
    public function testBigIntegerIsPrimeNumber()
    {
        // not prime number definitely
        $bigInteger = new BigInteger('6');

        $notPrimeNumber = $bigInteger->isPrimeNumber();

        // a prime number probably
        $bigInteger = new BigInteger('1111111111111111111');

        $isProbPrimeNumber = $bigInteger->isPrimeNumber();

        // a prime number definitely
        $bigInteger = new BigInteger('11');

        $isPrimeNumber = $bigInteger->isPrimeNumber();

        // Assert
        $this->assertTrue($isProbPrimeNumber);
        $this->assertTrue($isPrimeNumber);
        $this->assertFalse($notPrimeNumber);
    }
}
