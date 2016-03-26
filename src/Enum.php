<?php

namespace PhpEnum;

class Enum implements EnumInterface
{
    protected static $_values;

    protected static $_names;

    public static function assert($value)
    {
        if (!static::isValid($value)) {
            throw new \UnexpectedValueException(
                sprintf('%s is not a valid value for %s', $value, get_called_class())
            );
        }
        return $value;
    }

    public static function assertAll($values)
    {
        $result = array();
        foreach ($values as $value) {
            $result[] = static::assert($value);
        }
        return $result;
    }

    public static function coerce($value)
    {
        try {
            $value = static::assert($value);
        } catch (\UnexpectedValueException $e) {
            $value = null;
        }
        return $value;
    }

    public static function getNames()
    {
        $class = get_called_class();

        if (!isset(self::$_names[$class])) {
            self::$_names[$class] = array_flip(static::getValues());
        }

        return self::$_names[$class];
    }

    public static function getValues()
    {
        $class = get_called_class();

        if (!isset(self::$_values[$class])) {
            $constList = array();
            $refClass = new \ReflectionClass($class);

            while ($refClass) {
                $constList = array_merge($refClass->getConstants(), $constList);
                $refClass = $refClass->getParentClass();
            }

            self::$_values[$class] = $constList;
        }

        return self::$_values[$class];
    }

    public static function isValid($value, $strict = false)
    {
        return in_array($value, static::getValues(), $strict);
    }

    public static function isValidName($name)
    {
        $class = get_called_class();
        return defined($class . '::' . $name);
    }

    /**
     * Returns the enumeration constants of this enum class.
     *
     * @return array
     * @deprecated Use getValues() instead
     */
    public static function getConstants()
    {
        return static::getValues();
    }
}
