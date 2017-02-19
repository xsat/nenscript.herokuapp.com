<?php

namespace App\Controllers;

use App\Controller;
use App\Libraries\Nen\Nen;

/**
 * Class IndexController
 * @package App\Controllers
 */
class IndexController extends Controller
{
    public function indexAction()
    {
        $this->setValue('title', 'Nen');
    }

    public function decodeAction()
    {
        $this->setValue('title', 'Decode');

        if (isset($_POST['content'])) {
            $content = $_POST['content'];
            $this->setValue('content', $content);
            $this->setValue('result', Nen::decode($content));
        }
    }

    public function encodeAction()
    {
        $this->setValue('title', 'Encode');

        if (isset($_POST['content'])) {
            $content = $_POST['content'];
            $this->setValue('content', $content);
            $this->setValue('result', Nen::encode($content));
        }
    }

    public function notFoundAction()
    {
        $this->setValue('title', 'Error 404');
        header('HTTP/1.0 404 Not Found');
    }
}
