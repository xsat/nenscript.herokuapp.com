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
        $this->setValue('title', 'Decode - Nen');
        $this->setValue('menu', 'decode');

        if (isset($_REQUEST['text'])) {
            $this->setValue('content', $_REQUEST['text']);
            $this->setValue('result', Nen::decode($_REQUEST['text']));
        }
    }

    public function encodeAction()
    {
        $this->setValue('title', 'Encode - Nen');
        $this->setValue('menu', 'encode');

        if (isset($_REQUEST['text'])) {
            $this->setValue('text', $_REQUEST['text']);
            $this->setValue('result', Nen::encode($_REQUEST['text']));
        }
    }

    public function notFoundAction()
    {
        $this->setValue('title', 'Error 404');
        header('HTTP/1.0 404 Not Found');
    }
}
