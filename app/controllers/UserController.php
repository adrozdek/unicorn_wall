<?php

namespace App\Controllers;

use App\Components\HtmlComponent;
use App\Components\UserComponent;
use App\Core\Controller;
use App\Models\User;
use App\Repositories\UserRepository;

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
            $user->setBirthdate($_POST['birthDate']);

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

    /**
     * @return bool
     */
    public function login()
    {
        $action = '/';
        $error = '';
        $userComp = new UserComponent();

        if ($userComp->checkIfLoggedIn()) {
            return $this->renderView('main');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $htmlComp = new HtmlComponent();
            $email = $htmlComp->filterEmail($_POST['userEmail']);
            $password = $htmlComp->filterString($_POST['password']);

            $userRepo = new UserRepository();
            $user = $userRepo->findByEmail($email);

            if ($user) {
                $dbPassword = $user->getPassword();
                if (password_verify($password, $dbPassword)) {
                    $userComp->login($user->getId());
                    return $this->renderView('main');
                }
            }
            $error = 'Wrong email or password';
        }

        $this->renderView('login', [
            'action' => $action,
            'error' => $error,
        ]);
    }

    public function logout()
    {
        $userComp = new UserComponent();
        $userComp->logout();

        $action = '/';
        $this->renderView('login', [
            'action' => $action,
        ]);
    }
}
