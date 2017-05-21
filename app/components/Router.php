<?php

namespace App;

/**
 * Class Router
 */
class Router
{
    /**
     * @var Route
     */
    private $default;

    /**
     * @var Route
     */
    private $error;

    /**
     * @var Route
     */
    private $route;

    /**
     * Router constructor.
     */
    public function __construct()
    {
        $this->default = new Route('index', 'index');
        $this->error = new Route('index', 'notFound');
        $this->setRoute();
    }

    /**
     * @throws Exception
     */
    private function setRoute()
    {
        if (isset($_REQUEST['_url'])) {
            $this->route = $this->error;

            foreach ($this->getRoutes() as $pattern => $route) {
                if ($this->match($pattern, $_REQUEST['_url'])) {
                    list($controller, $action) = explode('@', $route);
                    $this->route = new Route($controller, $action);
                    break;
                }
            }
        } else {
            $this->route = $this->default;
        }
    }

    /**
     * @return array
     *
     * @throws Exception
     */
    private function getRoutes(): array
    {
        if (!is_file(CONFIG_DIR . '/routes.php')) {
            throw new Exception('Routes not found');
        }

        return require CONFIG_DIR . '/routes.php';
    }

    /**
     * @param string $pattern
     * @param string $subject
     * @return bool
     */
    private function match($pattern, $subject): bool
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

        $this->route->setParams($matches);

        return true;
    }

    /**
     * @return Route
     */
    public function getRoute(): Route
    {
        return $this->route;
    }
}
