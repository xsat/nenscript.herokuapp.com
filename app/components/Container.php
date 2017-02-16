<?php

namespace Frontend;

/**
 * Class Container
 * @package Frontend
 */
class Container
{
    /**
     * @var Router
     */
    protected $router;

    /**
     * @var Url
     */
    protected $url;

    /**
     * Container constructor.
     * @param Router $router
     */
    public function __construct(Router $router, Url $url)
    {
        $this->router = $router;
        $this->url = $url;
    }
}
