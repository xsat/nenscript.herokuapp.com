<?php

namespace Frontend;

/**
 * Class Application
 * @package Frontend
 */
class Application extends Container
{
    /**
     * @var View
     */
    private $view;

    /**
     * @var ControllerInterface
     */
    private $controller;

    /**
     * Application constructor.
     */
    public function __construct()
    {
        parent::__construct(new Router(), new Url());

        $controller = '\\Frontend\\Controllers\\' . ucfirst($this->router->getController()) . 'Controller';

        if (!class_exists($controller)) {
            throw new Exception('Controller des\'n exist');
        }

        $action = $this->router->getAction() . 'Action';

        if (!method_exists($controller, $action)) {
            throw new Exception('Method des\'n exist');
        }

        $this->controller = new $controller($this->router, $this->url);
        $this->controller->{$action}();
        $this->view = new View($this->router, $this->url, $this->controller);
    }

    /**
     * @return string
     */
    public function main()
    {
        return $this->compress($this->view->render());
    }

    /**
     * @param $content
     * @return string
     */
    public function compress($content)
    {
        $search = ['/\>[^\S ]+/s', '/[^\S ]+\</s', '/(\s)+/s', '/>(\s)+</', '/\n/', '/\r/', '/\t/'];
        $replace = ['>', '<', '\\1', '> <', '', '', ''];
        return preg_replace($search, $replace, $content);
    }
}
