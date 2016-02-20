<?php

namespace PhpEnum;

interface EnumInterface
{
    /**
     * Returns constant value of this enum.
     *
     * @return mixed
     */
    public function getValue();

    /**
     * Returns constant name of this enum.
     *
     * @return string
     */
    public function getName();

    /**
     * Tests if given value is equal to this enum value.
     *
     * @param $value
     * @return bool
     */
    public function is($value);

    /**
     * Creates enum instance from given value.
     *
     * @param mixed $value
     * @param bool $strict
     * @return PhpEnum_EnumInterface
     */
    public static function get($value, $strict = false);

    /**
     * Returns the enumeration constants of this enum class.
     *
     * @return array
     */
    public static function getConstants();

    /**
     * Tests if the specified value matches an existing constant name.
     *
     * @param mixed $value
     * @param bool $strict
     * @return bool
     */
    public static function isValid($value, $strict = false);

    /**
     * Tests if the specified constant name is a valid enum.
     *
     * @param string $name
     * @return bool
     */
    public static function isValidName($name);
}