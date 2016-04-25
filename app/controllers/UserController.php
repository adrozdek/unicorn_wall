<?php

namespace App\Controllers;

use App\Components\HtmlComponent;
use App\Core\Controller;
use App\Models\User;

class UserController extends Controller
{
    /**
     * @return bool
     */
    public function register()
    {
        $errors = [];
        $htmlComp = new HtmlComponent();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = new User();
            $user->setEmail($htmlComp->filterEmail($_POST['userEmail']));
            $user->setFirstName($htmlComp->filterString($_POST['firstName']));
            $user->setLastName($htmlComp->filterString($_POST['lastName']));
            $user->setPassword($user->checkPassword($_POST['password1'], $_POST['password2']));

            if ($user->validate() === true) {
                if ($user->save()) {
                    echo 'success';
                }
            } else {
                $errors = $user->getErrors();
            }
        }
        $firstName = isset($_POST['firstName']) ? $htmlComp->filterString($_POST['firstName'], -1) : '';
        $lastName = isset($_POST['lastName']) ? $htmlComp->filterString($_POST['lastName'], -1) : '';
        $userEmail = isset($_POST['userEmail']) ? $htmlComp->filterString($_POST['userEmail'], -1) : '';
        $action = '/';
        $this->renderView('registration', [
            'action' => $action,
            'errors' => $errors,
            'firstName' => $firstName,
            'lastName' => $lastName,
            'userEmail' => $userEmail
        ]);
    }
}
