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
        $user = new User();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user->setEmail($htmlComp->filterEmail($_POST['userEmail']));
            $user->setFirstName($htmlComp->filterString($_POST['firstName']));
            $user->setLastName($htmlComp->filterString($_POST['lastName']));
            $user->setPassword($user->checkPassword($_POST['password1'], $_POST['password2']));
            $user->setBirthDate($_POST['birthDate']);

            if ($user->validate()) {
                if ($user->save()) {
                    echo 'success';
                }
            } else {
                $errors = $user->getErrors();
            }
        }
        
        $action = '/register';
        $this->renderView('registration', [
            'action' => $action,
            'errors' => $errors,
            'user' => $user,
        ]);
    }
}
