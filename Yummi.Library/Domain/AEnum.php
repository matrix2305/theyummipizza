<?php
declare(strict_types=1);
namespace Yummi\Domain;

use BadMethodCallException;
use JsonSerializable;
use ReflectionClass;
use ReflectionException;
use RuntimeException;

abstract class AEnum implements JsonSerializable
{
    /**
     * Enum value
     *
     * @var mixed
     * @psalm-var T
     */
    protected int $value;

    /**
     * Store existing constants in a static cache per object.
     *
     *
     * @var array
     * @psalm-var array<class-string, array<string, mixed>>
     */
    protected static $cache = [];


    /**
     * AEnum constructor.
     * @param $value
     * @throws ReflectionException
     */
    public function __construct($value)
    {
        if ($value instanceof static) {
            /** @psalm-var T */
            $value = $value->getValue();
        }

        if (!$this->isValid($value)) {
            /** @psalm-suppress InvalidCast */
            throw new RuntimeException("Value '$value' is not part of the enum " . static::class);
        }

        /** @psalm-var T */
        $this->value = $value;
    }

    /**
     * @psalm-pure
     * @return mixed
     * @psalm-return T
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return mixed
     * @throws ReflectionException
     */
    public function getDescription()
    {
        $array = static::toArray();
        if (array_key_exists('DESCRIPTION', $array)) {
            if (isset($array['DESCRIPTION'][$this->value])){
                return $array['DESCRIPTION'][$this->value];
            }else{
                throw new ReflectionException("Description value is not exist");
            }
        }
        else {
            throw new ReflectionException("DESCRIPTION for enum value is not exist, you must implement");
        }
    }

    /**
     * @return array
     * @throws ReflectionException
     */
    public function getAllEnumValues() : array
    {
        $array = static::toArray();
        if (array_key_exists('DESCRIPTION', $array)) {
            return $array['DESCRIPTION'];
        }
        throw new ReflectionException("DESCRIPTION for enum value is not exist, you must implement");
    }


    /**
     * @return false|int|string
     * @throws ReflectionException
     */
    public function getKey()
    {
        return static::search($this->value);
    }

    /**
     * @psalm-pure
     * @psalm-suppress InvalidCast
     * @return string
     */
    public function __toString()
    {
        return (string)$this->value;
    }

    /**
     * Determines if Enum should be considered equal with the variable passed as a parameter.
     * Returns false if an argument is an object of different class or not an object.
     *
     * This method is final, for more information read https://github.com/myclabs/php-enum/issues/4
     *
     * @psalm-pure
     * @psalm-param mixed $variable
     * @param null $variable
     * @return bool
     */

    final public function equals($variable = null): bool
    {
        return $variable instanceof self
            && $this->getValue() === $variable->getValue()
            && static::class === get_class($variable);
    }


    /**
     * @return array
     * @throws ReflectionException
     */
    public static function keys()
    {
        return array_keys(static::toArray());
    }

    /**
     * @return array
     * @throws ReflectionException
     */
    public static function values()
    {
        $values = array();

        /** @psalm-var T $value */
        foreach (static::toArray() as $key => $value) {
            $values[$key] = new static($value);
        }

        return $values;
    }


    /**
     * @return mixed
     * @throws ReflectionException
     */
    public static function toArray()
    {
        $class = static::class;

        if (!isset(static::$cache[$class])) {
            $reflection            = new ReflectionClass($class);
            static::$cache[$class] = $reflection->getConstants();
        }

        return static::$cache[$class];
    }


    /**
     * @param $value
     * @return bool
     * @throws ReflectionException
     */
    public static function isValid($value)
    {
        return in_array($value, static::toArray(), true);
    }


    /**
     * @param $key
     * @return bool
     * @throws ReflectionException
     */
    public static function isValidKey($key)
    {
        $array = static::toArray();

        return isset($array[$key]) || array_key_exists($key, $array);
    }


    /**
     * @param $value
     * @return false|int|string
     * @throws ReflectionException
     */
    public static function search($value)
    {
        return array_search($value, static::toArray(), true);
    }

    /**
     * @param $name
     * @param $arguments
     * @return static
     * @throws ReflectionException
     */
    public static function __callStatic($name, $arguments)
    {
        $array = static::toArray();
        if (isset($array[$name]) || array_key_exists($name, $array)) {
            return new static($array[$name]);
        }

        throw new BadMethodCallException("No static method or enum constant '$name' in class " . static::class);
    }

    /**
     * Specify data which should be serialized to JSON. This method returns data that can be serialized by json_encode()
     * natively.
     *
     * @return mixed
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @psalm-pure
     */
    public function jsonSerialize()
    {
        return $this->getValue();
    }
}