<?php

namespace App\Controllers;

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
            $firstName = $this->checkFirstName($_POST['firstName']);
            $lastName = $this->checkLastName($_POST['lastName']);
            $hashedPassword = $this->checkPassword($_POST['password1'], $_POST['password2']);
            $email = $this->checkEmail($_POST['userEmail']);

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

    /**
     * @param $password
     * @return mixed
     */
    private function hashPassword($password)
    {
        $options = [
            'cost' => 11,
            'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
        ];
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);

        return $hashedPassword;
    }

    /**
     * @param $email
     * @return null
     */
    private function checkEmail($email)
    {
        $email = trim($email);
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $email;
        } else {
            return null;
        }
    }

    /**
     * @param $password1
     * @param $password2
     * @return mixed|null
     */
    private function checkPassword($password1, $password2)
    {
        $password1 = trim($password1);
        $password2 = trim($password2);
        if (strlen($password1) > 5 && $password1 === $password2) {
            $hashedPassword = $this->hashPassword($password1);
            return $hashedPassword;
        } else {
            return null;
        }
    }

    /**
     * @param $firstName
     * @return null
     */
    private function checkFirstName($firstName)
    {
        $firstName = trim($firstName);
        if (strlen($firstName) > 2) {
            return $firstName;
        } else {
            return null;
        }
    }

    /**
     * @param $lastName
     * @return null
     */
    private function checkLastName($lastName)
    {
        $lastName = trim($lastName);
        if (strlen($lastName) > 2) {
            return $lastName;
        } else {
            return null;
        }
    }
}
