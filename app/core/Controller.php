<?php

namespace App\Core;

use App\Components\HtmlComponent;

class Controller
{
    /**
     * @param $viewName
     * @param array $data
     */
    protected function renderView($viewName, $data = [])
    {
        $htmlComponent = new HtmlComponent();
        require_once '../app/views/' . $viewName . '.php';
    }

    /**
     * @param $url
     */
    protected function redirect($url)
    {
        header('Location: ' . $url);
    }
}
