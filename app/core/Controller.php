<?php

namespace App\Core;

use App\Components\HtmlComponent;

class Controller
{
    protected function renderView($viewName, $data = [])
    {
        $htmlComponent = new HtmlComponent();
        require_once '../app/views/' . $viewName . '.php';
    }
}
