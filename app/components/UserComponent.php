<?php

namespace App\Components;

use App\Core\Session;

class UserComponent
{
    private $sessionCore;

    public function __construct()
    {
        $this->sessionCore = new Session();
    }

    public function login($userId)
    {
        $this->sessionCore->set('userId', $userId);
    }

    public function logout()
    {
        $this->sessionCore->remove('userId');
    }

    public function checkIfLoggedIn()
    {
        if ($this->sessionCore->get('userId')) {
            return true;
        } else {
            return false;
        }
    }
}