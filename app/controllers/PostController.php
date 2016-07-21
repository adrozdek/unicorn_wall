<?php

namespace App\Controllers;

use App\Components\HtmlComponent;
use App\Components\UserComponent;
use App\Core\Controller;
use App\Models\Post;
use DateTime;

class PostController extends Controller
{
    private $htmlComp;
    private $userComp;

    /**
     * PostController constructor.
     */
    public function __construct()
    {
        $this->htmlComp = new HtmlComponent();
        $this->userComp = new UserComponent();
    }

    public function get()
    {

    }

    public function add()
    {
        $this->preventUnauthorized();

        $errors = [];
        $post = new Post();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $dt = (new DateTime())->format('Y-m-d H:i:s');
            $post->setUserId((int)$_SESSION['userId']);
            $post->setTitle($this->htmlComp->filterString($_POST['title']));
            $post->setText($this->htmlComp->filterString($_POST['text']));
            $post->setPostDate($dt);

            if ($post->validate()) {
                if ($post->save()) {
                    echo 'success';
                }
            } else {
                $errors = $post->getErrors();
            }
        }

        $action = '/post';
        $this->renderView('newPost', [
            'action' => $action,
            'errors' => $errors,
        ]);
    }

    public function delete()
    {

    }

}