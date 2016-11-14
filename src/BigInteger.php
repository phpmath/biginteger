<?php
/**
 * phpmath / biginteger (https://github.com/phpmath/biginteger)
 *
 * @link https://github.com/phpmath/biginteger for the canonical source repository
 * @copyright Copyright (c) 2015-2017 phpmath (https://github.com/phpmath)
 * @license https://github.com/phpmath/biginteger/blob/master/LICENSE.md MIT
 */

namespace PHP\Math\BigInteger;

use GMP;
use InvalidArgumentException;
use RuntimeException;

/**
 * A big integer value.
 */
class BigInteger
{
    /**
     * The value represented as a string.
     *
     * @var string
     */
    private $value;

    /**
     * A flag that indicates whether or not the state of this object can be changed.
     *
     * @var bool
     */
    private $mutable;

    /**
     * Initializes a new instance of this class.
     *
     * @param string|int|BigInteger $value The value to set.
     * @param bool $mutable Whether or not the state of this object can be changed.
     */
    public function __construct($value = 0, $mutable = true)
    {
        $this->internalSetValue($value);

        $this->mutable = $mutable;
    }

    /**
     * Gets the value of the big integer.
     *
     * @return string
     */
    public function getValue()
    {
        return gmp_strval($this->value);
    }

    /**
     * Sets the value.
     *
     * @param string $value The value to set.
     * @return BigInteger
     */
    public function setValue($value)
    {
        if (!$this->isMutable()) {
            throw new RuntimeException('Cannot set the value since the number is immutable.');
        }

        return $this->internalSetValue($value);
    }

    /**
     * Converts the value to an absolute number.
     *
     * @return BigInteger
     */
    public function abs()
    {
        $value = gmp_abs($this->value);

        return $this->assignValue($value);
    }

    /**
     * Adds the given value to this value.
     *
     * @param string $value The value to add.
     * @return BigInteger
     */
    public function add($value)
    {
        $this->checkValue($value);

        $gmp = gmp_init($value);

        $calculatedValue = gmp_add($this->value, $gmp);

        return $this->assignValue($calculatedValue);
    }

    /**
     * Compares this number and the given number.
     *
     * @return int Returns -1 is the number is less than this number. 0 if equal and 1 when greater.
     */
    public function cmp($value)
    {
        $this->checkValue($value);

        $result = gmp_cmp($this->value, $value);

        // It could happen that gmp_cmp returns a value greater than one (e.g. gmp_cmp('123', '-123')). That's why
        // we do an additional check to make sure to return the correct value.

        if ($result > 0) {
            return 1;
        } elseif ($result < 0) {
            return -1;
        }

        return 0;
    }

    /**
     * Divides this value by the given value.
     *
     * @param string $value The value to divide by.
     * @return BigInteger
     */
    public function divide($value)
    {
        $this->checkValue($value);

        $gmp = gmp_init($value);

        $calculatedValue = gmp_div($this->value, $gmp, false);

        return $this->assignValue($calculatedValue);
    }

    /**
     * Calculates factorial of this value.
     *
     * @return BigInteger
     */
    public function factorial()
    {
        $calculatedValue = gmp_fact($this->getValue());

        return $this->assignValue($calculatedValue);
    }

    /**
     * Performs a modulo operation with the given number.
     *
     * @param string $value The value to perform a modulo operation with.
     * @return BigInteger
     */
    public function mod($value)
    {
        $this->checkValue($value);

        $gmp = gmp_init($value);

        $calculatedValue = gmp_mod($this->value, $gmp);

        return $this->assignValue($calculatedValue);
    }

    /**
     * Multiplies the given value with this value.
     *
     * @param string $value The value to multiply with.
     * @return BigInteger
     */
    public function multiply($value)
    {
        $this->checkValue($value);

        $gmp = gmp_init($value);

        $calculatedValue = gmp_mul($this->value, $gmp);

        return $this->assignValue($calculatedValue);
    }

    /**
     * Negates the value.
     *
     * @return BigInteger
     */
    public function negate()
    {
        $calculatedValue = gmp_neg($this->value);

        return $this->assignValue($calculatedValue);
    }

    /**
     * Performs a power operation with the given number.
     *
     * @param string $value The value to perform a power operation with.
     * @return BigInteger
     */
    public function pow($value)
    {
        $this->checkValue($value);

        $calculatedValue = gmp_pow($this->value, (string)$value);

        return $this->assignValue($calculatedValue);
    }

    /**
     * Subtracts the given value from this value.
     *
     * @param string $value The value to subtract.
     * @return BigInteger
     */
    public function subtract($value)
    {
        $this->checkValue($value);

        $gmp = gmp_init($value);

        $calculatedValue = gmp_sub($this->value, $gmp);

        return $this->assignValue($calculatedValue);
    }

    /**
     * Checks if this object is mutable.
     *
     * @return bool
     */
    public function isMutable()
    {
        return $this->mutable;
    }

    /**
     * Converts this class to a string.
     *
     * @return string
     */
    public function toString()
    {
        return $this->getValue();
    }

    /**
     * Converts this class to a string.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toString();
    }

    /**
     * A helper method to assign the given value.
     *
     * @param int|string|BigInteger $value The value to assign.
     * @return BigInteger
     */
    private function assignValue($value)
    {
        $result = null;

        if ($this->isMutable()) {
            $result = $this->internalSetValue($value);
        } else {
            $result = new BigInteger($value, false);
        }

        return $result;
    }

    /**
     * A helper method to set the value on this class.
     *
     * @param int|string|BigInteger $value The value to assign.
     * @return BigInteger
     */
    private function internalSetValue($value)
    {
        $this->checkValue($value);

        $this->value = gmp_init($value);

        return $this;
    }

    /**
     * Checks if the given value is valid.
     *
     * @param int|string $value The value to check.
     * @throws InvalidArgumentException Thrown when the value is invalid.
     */
    private function checkValue(&$value)
    {
        if ($value instanceof GMP || is_resource($value)) {
            $value = gmp_strval($value);
        } else {
            $value = (string)$value;
        }

        if (!preg_match('/^(-|\+)?[0-9]+$/', $value)) {
            throw new InvalidArgumentException('Invalid number provided: ' . $value);
        }
    }
}
