<?php

namespace PHP\Math\BigInteger;

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
     * Initializes a new instance of this class.
     *
     * @param string|int|self $value The value to set.
     */
    public function __construct($value = 0)
    {
        $this->setValue($value);
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
     * @param string $value
     */
    public function setValue($value)
    {
        $this->checkValue($value);

        $this->value = gmp_init($value);
    }

    /**
     * Converts the value to an absolute number.
     */
    public function abs()
    {
        $this->value = gmp_abs($this->value);
    }

    /**
     * Adds the given value to this value.
     *
     * @param string $value The value to add.
     */
    public function add($value)
    {
        $this->checkValue($value);

        $gmp = gmp_init($value);

        $this->value = gmp_add($this->value, $gmp);
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

        // It could happpen that gmp_cmp returns a value greater than one (e.g. gmp_cmp('123', '-123')). That's why
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
     */
    public function divide($value)
    {
        $this->checkValue($value);

        $gmp = gmp_init($value);

        $this->value = gmp_div($this->value, $gmp, false);
    }

    /**
     * Performs a modulo operation with the given number.
     *
     * @param string $value The value to perform a modulo operation with..
     */
    public function mod($value)
    {
        $this->checkValue($value);

        $gmp = gmp_init($value);

        $this->value = gmp_mod($this->value, $gmp);
    }

    /**
     * Multiplies the given value with this value.
     *
     * @param string $value The value to multiply with.
     */
    public function multiply($value)
    {
        $this->checkValue($value);

        $gmp = gmp_init($value);

        $this->value = gmp_mul($this->value, $gmp);
    }

    /**
     * Negates the value.
     */
    public function negate()
    {
        $this->value = gmp_neg($this->value);
    }

    /**
     * Performs a power operation with the given number.
     *
     * @param string $value The value to perform a power operation with..
     */
    public function pow($value)
    {
        $this->checkValue($value);

        $this->value = gmp_pow($this->value, (string)$value);
    }

    /**
     * Subtracts the given value from this value.
     *
     * @param string $value The value to subtract.
     */
    public function subtract($value)
    {
        $this->checkValue($value);

        $gmp = gmp_init($value);

        $this->value = gmp_sub($this->value, $gmp);
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
     * Checks if the given value is valid.
     *
     * @param int|string $value The value to check.
     * @throws \InvalidArgumentException Thrown when the value is invalid.
     */
    private function checkValue(&$value)
    {
        $value = (string)$value;

        if (!preg_match('/^(-|\+)?[0-9]+$/', $value)) {
            throw new \InvalidArgumentException('Invalid number provided: ' . $value);
        }
    }
}
