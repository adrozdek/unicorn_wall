<?php

namespace App\Controllers;

use App\Core\Controller;

/**
 * Class MainController
 * @package App\Controllers
 */
class MainController extends Controller
{
    public function main()
    {
        $this->renderView('main');
    }
}