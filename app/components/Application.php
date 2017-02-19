<?php

namespace App;

use DI\ContainerBuilder;
use DI\NotFoundException;

/**
 * Class Application
 * @package App
 */
class Application extends Injectable
{
    /**
     * @var ControllerInterface
     */
    private $controller;

    /**
     * Application constructor.
     */
    public function __construct()
    {
        parent::__construct(ContainerBuilder::buildDevContainer());

        $this->createModules();
        $this->createController();

        $this->getDI()->set('view', new View($this->getDI(), $this->controller));
    }

    private function createModules()
    {
        $this->getDI()->set('router', new Router());
        $this->getDI()->set('url', new Url());
    }

    /**
     * @throws Exception
     * @throws NotFoundException
     */
    private function createController()
    {
        $router = $this->getDI()->get('router');
        $route = $router->getRoute();

        $controller = '\\App\\Controllers\\' . ucfirst($route->getController()) . 'Controller';

        if (!class_exists($controller)) {
            throw new Exception('Controller does not exist');
        }

        $action = $route->getAction() . 'Action';

        if (!method_exists($controller, $action)) {
            throw new Exception('Method does not exist');
        }

        $this->controller = new $controller($this->getDI());
        $this->controller->{$action}();
    }

    /**
     * @return string
     * @throws NotFoundException
     */
    public function main()
    {
        return $this->compress($this->getDI()->get('view')->render());
    }

    /**
     * @param string $content
     * @return string
     */
    public function compress($content)
    {
        $search = ['/\>[^\S ]+/s', '/[^\S ]+\</s', '/(\s)+/s', '/>(\s)+</', '/\n/', '/\r/', '/\t/'];
        $replace = ['>', '<', '\\1', '> <', '', '', ''];
        return preg_replace($search, $replace, $content);
    }
}
