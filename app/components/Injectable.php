<?php

namespace App;

use DI\Container;

/**
 * Class Injectable
 */
class Injectable
{
    /**
     * @var Container
     */
    private $di;

    /**
     * Injectable constructor.
     * @param Container $di
     */
    public function __construct(Container $di)
    {
        $this->di = $di;
    }

    /**
     * @param Container $di
     */
    public function setDI(Container $di)
    {
        $this->di = $di;
    }

    /**
     * @return Container
     */
    public function getDI(): Container
    {
        return $this->di;
    }
}
