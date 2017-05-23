<?php

namespace App\Controllers;

use App\Controller;
use App\Libraries\Nen\Nen;

/**
 * Class ApiController
 */
class ApiController extends Controller
{
    public function indexAction()
    {
        $this->setValue('title', 'Api - Nen');
        $this->setValue('menu', 'api');
    }

    public function decodeAction()
    {
        header('Content-Type: application/json; charset=UTF-8');

        return json_encode([
            'decoded' => Nen::decode($_POST['text'] ?? ''),
        ]);
    }

    public function encodeAction()
    {
        header('Content-Type: application/json; charset=UTF-8');

        return json_encode([
            'encoded' => Nen::encode($_POST['text'] ?? ''),
        ]);
    }
}
