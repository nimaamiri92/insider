<?php


namespace App\Components;

use ArrayAccess;

/**
 * Class DottedArray
 * @package App\Components
 */
class DottedArray implements ArrayAccess
{
    /**
     * The stored array
     *
     * @var array
     */
    protected $array;

    /**
     * Create a new Dot instance
     *
     * @param array $array Array to store
     */
    public function __construct($array = [])
    {
        $this->setArray($array);
    }
    /**
     * Store an array
     *
     * @param array $array
     */
    public function setArray($array)
    {
        if ($this->accessible($array)) {
            $this->array = $array;
        }
    }
    /**
     * Determine whether the given value is array accessible
     *
     * @param  mixed $value Array to verify
     * @return bool
     */
    public function accessible($value)
    {
        return is_array($value) || $value instanceof ArrayAccess;
    }
    /**
     * Delete a path or an array of paths
     *
     * @param mixed $key Path or an array of paths to delete
     */
    public function delete($key)
    {
        if (is_string($key)) {
            // Iterate a path
            $keys = explode('.', $key);
            $array = &$this->array;
            $last = array_pop($keys);
            foreach ($keys as $key) {
                if (!$this->exists($array, $key)) {
                    return;
                }
                $array = &$array[$key];
            }
            unset($array[$last]);
        } elseif (is_array($key)) {
            // Iterate an array of paths
            foreach ($key as $k) {
                $this->delete($k);
            }
        }
    }
    /**
     * Check if a path exists
     *
     * @param  string $key Path
     * @return bool
     */
    public function has($key)
    {
        $keys = explode('.', (string)$key);
        $array = &$this->array;
        foreach ($keys as $key) {
            if (!$this->exists($array, $key)) {
                return false;
            }
            $array = &$array[$key];
        }
        return true;
    }
    /**
     * Get all the stored values
     *
     * @return array
     */
    public function all()
    {
        return $this->array;
    }
    /**
     * Get a value from a path or default value if the path doesn't exist
     *
     * @param  string $key     Path
     * @param  mixed  $default Default value
     * @return mixed
     */
    public function get($key, $default = null)
    {
        $keys = explode('.', (string)$key);
        $array = &$this->array;
        foreach ($keys as $key) {
            if (!$this->exists($array, $key)) {
                return $default;
            }
            $array = &$array[$key];
        }
        return $array;
    }
    /**
     * Determine if the given key exists in the provided array
     *
     * @param  ArrayAccess|array $array
     * @param  string|int        $key
     * @return bool
     */
    public function exists($array, $key)
    {
        if ($array instanceof self) {
            return isset($array[$key]);
        }
        return array_key_exists($key, $array);
    }
    /**
     * Set a value to a given path or an array of paths and values
     *
     * @param mixed $key Path or an array of paths and values
     * @param mixed $value Value to set if the path is not an array
     */
    public function set($key, $value = null)
    {
        if (is_string($key)) {
            if (is_array($value) && !empty($value)) {
                // Iterate the values
                foreach ($value as $k => $v) {
                    $this->set("$key.$k", $v);
                }
            } else {
                // Iterate a path
                $keys = explode('.', $key);
                $array = &$this->array;
                foreach ($keys as $key) {
                    if (!isset($array[$key]) || !is_array($array[$key])) {
                        $array[$key] = [];
                    }
                    $array = &$array[$key];
                }
                // Set a value
                $array = $value;
            }
        } elseif (is_array($key)) {
            // Iterate an array of paths and values
            foreach ($key as $k => $v) {
                $this->set($k, $v);
            }
        }
    }

    /*
     * --------------------------------------------------------------
     * ArrayAccess Abstract Methods
     * --------------------------------------------------------------
     */
    public function offsetSet($offset, $value)
    {
        $this->set($offset, $value);
    }

    public function offsetExists($offset)
    {
        return $this->has($offset);
    }

    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    public function offsetUnset($offset)
    {
        $this->delete($offset);
    }

    /*
    * --------------------------------------------------------------
    * Magic Methods
    * --------------------------------------------------------------
    */
    public function __set($key, $value = null)
    {
        $this->set($key, $value);
    }

    public function __get($key)
    {
        return $this->get($key);
    }

    public function __isset($key)
    {
        return $this->has($key);
    }

    public function __unset($key)
    {
        $this->delete($key);
    }

}