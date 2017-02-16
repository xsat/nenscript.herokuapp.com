<?php

namespace Frontend;

/**
 * Class Controller
 * @package Frontend
 */
class Controller extends Container implements ControllerInterface
{
    /**
     * @var array
     */
    private $values = [];

    /**
     * @param string $key
     * @param mixed $data
     */
    public function setValue($key, $data)
    {
        $this->values[$key] = $data;
    }

    /**
     * @param mixed $data
     */
    public function setValues($data)
    {
        $this->values += $data;
    }

    /**
     * @param string $key
     * @return null|mixed
     */
    public function getValue($key)
    {
        if (isset($this->values[$key])) {
            return $this->values[$key];
        }

        return null;
    }

    /**
     * @return array
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * @param string $key
     * @param mixed $data
     */
    public function __set($key, $data)
    {
        $this->setValue($key, $data);
    }

    /**
     * @param string $key
     * @return null|mixed
     */
    public function __get($key)
    {
        return $this->getValue($key);
    }
}
