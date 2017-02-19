<?php

namespace App;

/**
 * Interface ControllerInterface
 * @package App
 */
interface ControllerInterface
{
    /**
     * @param string $key
     * @param mixed $data
     */
    public function setValue($key, $data);

    /**
     * @param mixed $data
     */
    public function setValues($data);

    /**
     * @param $key
     * @return null|mixed
     */
    public function getValue($key);

    /**
     * @return array
     */
    public function getValues();
}