<?php

namespace Frontend;

/**
 * Class Router
 * @package Frontend
 */
class Router
{
    /**
     * @var string
     */
    private $controller = 'index';

    /**
     * @var string
     */
    private $action = 'index';

    /**
     * @var array
     */
    private $params = [];

    public function __construct()
    {
        if (isset($_REQUEST['_url'])) {
            foreach ($this->routes() as $pattern => $route) {
                if ($this->match($pattern, $_REQUEST['_url'])) {
                    list($this->controller, $this->action) = explode('@', $route);
                    break;
                }
            }
        }
    }

    public function match($pattern, $subject)
    {
        if ($pattern == $subject) {
            return true;
        }

        if (!preg_match('#^' . $pattern . '#is', $subject, $matches)) {
            return false;
        }

        if (isset($matches[0])) {
            unset($matches[0]);
        }

        $this->params = $matches;

        return true;
    }

    /**
     * @return array
     */
    public function routes()
    {
        return [
            '/decode.html' => 'index@decode',
            '/encode.html' => 'index@encode',
            '/([0-9]+).html' => 'index@test',
        ];
    }

    /**
     * @return string
     */
    public function controller()
    {
        return $this->controller;
    }

    /**
     * @return string
     */
    public function action()
    {
        return $this->action;
    }
}
