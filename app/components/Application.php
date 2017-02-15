<?php

namespace Frontend;

/**
 * Class Application
 * @package Frontend
 */
class Application
{
    /**
     * @var Router
     */
    private $router;

    /**
     * @var Url
     */
    private $url;

    /**
     * @var View
     */
    private $view;

    /**
     * @var Controller
     */
    private $controller;

    /**
     * Application constructor.
     */
    public function __construct()
    {
        $this->router = new Router();
        $this->url = new Url();
        $this->view = new View($this->router, $this->url);
    }

    /**
     * @return string
     */
    public function main()
    {
        return $this->view->render();
    }
}
