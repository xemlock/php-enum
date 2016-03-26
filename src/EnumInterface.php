<?php

namespace PhpEnum;

interface EnumInterface
{
    /**
     * Converts the given value to the enum's underlying type.
     *
     * @param mixed $value
     * @return mixed
     * @throws \UnexpectedValueException
     */
    public static function assert($value);

    /**
     * Converts the given collection of values to the enum's underlying type.
     *
     * @param array|\Traversable $values
     * @return array
     */
    public static function assertAll($values);

    /**
     * Converts the given value to the enum’s underlying type.
     *
     * @param $value
     * @return mixed
     */
    public static function coerce($value);

    /**
     * Returns a map-like array of enumeration constant values and their names.
     *
     * @return array
     */
    public static function getNames();

    /**
     * Returns a map-like array of enumeration constant names and their values.
     *
     * @return array
     */
    public static function getValues();

    /**
     * Tests whether the given value is one of the values in the enum.
     *
     * @param mixed $value
     * @return bool
     */
    public static function isValid($value);

    /**
     * Tests if the specified constant name corresponds to a valid enum value.
     *
     * @param string $name
     * @return bool
     */
    public static function isValidName($name);
}
