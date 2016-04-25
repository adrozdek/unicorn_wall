<?php

namespace App\Controllers;

use App\Components\UserComponent;
use App\Core\Controller;
use App\Core\DbConnector;

class UserController extends Controller
{
    /**
     * @return bool
     */
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userComp = new UserComponent();
            $firstName = $userComp->setFirstName($_POST['firstName']);
            $lastName = $userComp->setLastName($_POST['lastName']);
            $hashedPassword = $userComp->setPassword($_POST['password1'], $_POST['password2']);
            $email = $userComp->setEmail($_POST['userEmail']);

            if (!empty($firstName) && !empty($lastName) && !empty($hashedPassword) && !empty($email)) {
                $con = DbConnector::getConnection();
                $stmt = $con->prepare("INSERT INTO Users (first_name, last_name, email, password) VALUES (?,?,?,?)");
                if ($stmt->execute([$firstName, $lastName, $email, $hashedPassword])) {
                    return true;
                } else {
                    $action = '/';
                    $this->renderView('registration', ['action' => $action]);
                }
            } else {
                $action = '/';
                $this->renderView('registration', ['action' => $action]);
            }
        }
        $action = '/';
        $this->renderView('registration', ['action' => $action]);
    }
}
