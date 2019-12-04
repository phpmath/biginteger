<?php

namespace PHP\Math\BigIntegerTest;

use PHP\Math\BigInteger\BigInteger;
use PHPUnit\Framework\TestCase;

class BigIntegerPrimeNumberTest extends TestCase
{
    public function testIsPrimeNumberWithouttPrimeNumber()
    {
        // Arrange
        $bigInteger = new BigInteger('6');

        // Act
        $withoutPrimeNumber = $bigInteger->isPrimeNumber();

        // Assert
        $this::assertFalse($withoutPrimeNumber);
    }

    public function testIsPrimeNumberWithPrimeNumber()
    {
        // Arrange
        $bigInteger = new BigInteger('11');

        // Act
        $withPrimeNumber = $bigInteger->isPrimeNumber();

        // Assert
        $this::assertTrue($withPrimeNumber);
    }

    public function testIsPrimeNumberWithoutProbabilePrimeNumber()
    {
        // Arrange
        $bigInteger = new BigInteger('1111111111111111111');

        // Act
        $probabilePrimeNumber = $bigInteger->isPrimeNumber();

        // Assert
        $this::assertTrue($probabilePrimeNumber);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testIsPrimeNumberProvidedProbabilityNumberIsLessThan5()
    {
        // Arrange
        $bigInteger = new BigInteger('1111111111111111111');

        // Act
        $probabilePrimeNumber = $bigInteger->isPrimeNumber(-1.0);

        // Assert
        // ...
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testIsPrimeNumberProvidedProbabilityNumberIsGreaterThan10()
    {
        // Arrange
        $bigInteger = new BigInteger('1111111111111111111');

        // Act
        $probabilePrimeNumber = $bigInteger->isPrimeNumber(2.0);

        // Assert
        // ...
    }
}
