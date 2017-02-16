<?php

namespace Frontend;

/**
 * Class View
 * @package Frontend
 */
class View extends Container
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
     * @param Router $router
     * @param Url $url
     * @param ControllerInterface $controller
     */
    public function __construct(Router $router, Url $url, ControllerInterface $controller)
    {
        parent::__construct($router, $url);

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
        return $this->getPartial($this->router->getController() . '/' . $this->router->getAction());
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
            throw new Exception('File not found');
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
