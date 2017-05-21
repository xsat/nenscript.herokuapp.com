<?php

namespace App\Controllers;

use App\Controller;
use App\Libraries\Nen\Nen;

/**
 * Class IndexController
 */
class IndexController extends Controller
{
    public function indexAction()
    {
        $this->setValue('title', 'Nen');
        $this->setValue('menu', 'home');

        $map = [];

        foreach (range(32, 126) as $code) {
            $letter = chr($code);
            $map[$letter] = Nen::decode($letter);
        }

        $this->setValue('map', $map);
    }

    public function decodeAction()
    {
        $this->setValue('title', 'Decode');
        $this->setValue('menu', 'decode');

        if (isset($_REQUEST['content'])) {
            $content = $_REQUEST['content'];
            $this->setValue('content', $content);
            $this->setValue('result', Nen::decode($content));
        }
    }

    public function encodeAction()
    {
        $this->setValue('title', 'Encode');
        $this->setValue('menu', 'encode');

        if (isset($_REQUEST['content'])) {
            $content = $_REQUEST['content'];
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
