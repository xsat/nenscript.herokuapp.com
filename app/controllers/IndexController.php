<?php

namespace Frontend\Controllers;

use Frontend\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        $this->setValue('title', 'Hi');

        $this->content = 'Lallalalal';
    }
}
