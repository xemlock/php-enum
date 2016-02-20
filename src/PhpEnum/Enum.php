<?php

namespace PhpEnum;

class Enum extends \SplEnum implements EnumInterface
{
    protected static $_constants;

    public function getValue()
    {
        // check for polyfill first
        if (property_exists($this, '__default')) {
            return $this->__default;
        }

        // since SplEnum instances are immutable, save result for later use
        static $hasValue = false, $value;
        if (!$hasValue) {
            $data = (array) $this;
            $value = $data['__default'];
            $hasValue = true;
        }
        return $value;
    }

    public function getName()
    {
        return array_search($this->getValue(), $this->getConstList(), true);
    }

    public function is($value)
    {
        if ($value instanceof EnumInterface) {
            $value = $value->getValue();
        }
        return $this->getValue() === $value;
    }

    public static function get($value, $strict = false)
    {
        if ($value instanceof EnumInterface) {
            $value = $value->getValue();
        }
        return new static($value, $strict);
    }

    public static function getConstants()
    {
        $class = get_called_class();
        if (!isset(self::$_constants[$class])) {
            $enum = new static();
            self::$_constants[$class] = $enum->getConstList();
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

    public static function __callStatic($name, $args)
    {
        $class = get_called_class();
        $const = $class . '::' . $name;

        if (!defined($const)) {
            throw new UnexpectedValueException(
                sprintf('Value not a const in enum %s', $class)
            );
        }

        return static::get(constant($const));
    }
}
