<?php

namespace App\Core;

use App\Components\HtmlComponent;
use App\Components\UserComponent;

/**
 * Class Controller
 * @package App\Core
 */
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
    
    protected function preventUnauthorized()
    {
        $userComponent = new UserComponent();
        if (!$userComponent->checkIfLoggedIn()) {
            $this->redirect('/');
        }
    }
}
