<?php

namespace App;

/**
 * Interface ControllerInterface
 */
interface ControllerInterface
{
    /**
     * @param string $key
     * @param mixed $data
     */
    public function setValue(string $key, $data);

    /**
     * @param mixed $data
     */
    public function setValues($data);

    /**
     * @param string $key
     * @return null|mixed
     */
    public function getValue(string $key);

    /**
     * @return array
     */
    public function getValues(): array;
}
