<?php

namespace App\Components;

use App\Core\Session;

/**
 * Class UserComponent
 * @package App\Components
 */
class UserComponent
{
    private $sessionCore;

    /**
     * UserComponent constructor.
     */
    public function __construct()
    {
        $this->sessionCore = new Session();
    }

    /**
     * @param $userId
     */
    public function login($userId)
    {
        $this->sessionCore->set('userId', $userId);
    }

    public function logout()
    {
        $this->sessionCore->remove('userId');
    }

    /**
     * @return bool
     */
    public function checkIfLoggedIn()
    {
        if ($this->sessionCore->get('userId')) {
            return true;
        } else {
            return false;
        }
    }
}