<?php

namespace Frontend;

/**
 * Class View
 * @package Frontend
 */
class View
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
     * @var Router
     */
    private $router;

    /**
     * @var Url
     */
    private $url;

    /**
     * View constructor.
     * @param Router $router
     * @param Url $url
     */
    public function __construct(Router $router, Url $url)
    {
        $this->router = $router;
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function render()
    {
        return $this->partial($this->layout);
    }

    /**
     * @return string
     */
    public function content()
    {
        return $this->partial($this->router->controller() . '/' . $this->router->action());
    }

    /**
     * @param $file string
     * @return string
     * @throws Exception
     */
    public function partial($file)
    {
        if (!is_file(VIEW_DIR . $file . $this->ext)) {
            throw new Exception('File not found');
        }

        ob_start();
        require VIEW_DIR . $file . $this->ext;
        return ob_get_clean();
    }
}
