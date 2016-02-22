<?php

namespace PhpEnum;

interface EnumInterface
{
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
     * @return bool
     */
    public static function isValid($value);

    /**
     * Tests if the specified constant name is a valid enum.
     *
     * @param string $name
     * @return bool
     */
    public static function isValidName($name);

    /**
     * @param mixed $value
     * @return mixed
     * @throws \UnexpectedValueException
     */
    public static function assert($value);
}
