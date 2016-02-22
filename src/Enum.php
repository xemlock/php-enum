<?php

namespace PhpEnum;

class Enum implements EnumInterface
{
    protected static $_constants;

    public static function getConstants()
    {
        $class = get_called_class();

        if (!isset(self::$_constants[$class])) {
            $constList = array();
            $refClass = new \ReflectionClass($class);

            while ($refClass) {
                $constList = array_merge($refClass->getConstants(), $constList);
                $refClass = $refClass->getParentClass();
            }

            self::$_constants[$class] = $constList;
        }

        return self::$_constants[$class];
    }

    public static function isValid($value, $strict = false)
    {
        return in_array($value, static::getConstants(), $strict);
    }

    public static function isValidName($name)
    {
        $class = get_called_class();
        return defined($class . '::' . $name);
    }

    public static function assert($value)
    {
        if (!static::isValid($value)) {
            throw new \UnexpectedValueException(
                sprintf('%s is not a valid value for %s', $value, get_called_class())
            );
        }
        return $value;
    }
}
