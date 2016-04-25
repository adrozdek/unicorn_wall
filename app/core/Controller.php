<?php

namespace App\Core;


class Controller
{
    protected function renderView($viewName, $data = [])
    {
        require_once '../app/views/' . $viewName . '.php';
    }
}
