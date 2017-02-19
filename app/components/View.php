<?php

namespace App;

use DI\Container;

/**
 * Class View
 * @package App
 */
class View extends Injectable
{
    /**
     * @var string
     */
    private $ext = '.phtml';

    /**
     * @var string
     */
    private $layout = 'public';

    /**
     * @var ControllerInterface
     */
    private $controller;

    /**
     * View constructor.
     * @param Container $di
     * @param ControllerInterface $controller
     */
    public function __construct(Container $di, ControllerInterface $controller)
    {
        parent::__construct($di);

        $this->controller = $controller;
    }

    /**
     * @return string
     */
    public function render()
    {
        return $this->getPartial($this->layout);
    }

    /**
     * @return string
     */
    public function getContent()
    {
        $router = $this->getDI()->get('router');
        $route = $router->getRoute();

        return $this->getPartial($route->getController() . '/' . $route->getAction());
    }

    /**
     * @param $file
     * @param array $data
     * @return string
     * @throws Exception
     */
    public function getPartial($file, $data = [])
    {
        if (!is_file(VIEW_DIR . $file . $this->ext)) {
            throw new Exception('Partial does not found');
        }

        ob_start();

        if (!$data) {
            $data = $this->controller->getValues();
        }

        foreach ($data as $key => $value) {
            ${$key} = $value;
        }

        require VIEW_DIR . $file . $this->ext;

        return ob_get_clean();
    }
}
