<?php

namespace App\Models;

use App\Core\DbConnector;

class Post implements IModel
{
    private $id;
    private $userId;
    private $title;
    private $text;
    private $postDate;
    private $errors = [];
    /**
     * @return bool
     * @throws \Exception
     */
    public function validate()
    {
        if(!is_int($this->userId)) {
            throw new \Exception("userId is not an integer while trying to validate");
        }
        if (strlen($this->title) < 3) {
            $this->errors[] = 'Invalid title';
        }
        if (strlen(empty($this->text) < 3)) {
            $this->errors[] = 'Invalid text';
        }
        
        return empty($this->errors);
    }

    public function save()
    {
        if ($this->validate()) {
            $con = DbConnector::getConnection();
            $stmt = $con->prepare("
            INSERT INTO Posts (userId, title, postText, postDate) VALUES (?,?,?,?) 
            ON DUPLICATE KEY UPDATE
            title = VALUES (title),
            postText = VALUES (postText),
            postDate = VALUES (postDate)
            ");
            if ($stmt->execute(
                [
                    $this->userId,
                    $this->title,
                    $this->text,
                    $this->postDate
                ]
            )
            ) {
                return true;
            } else {
                throw new \Exception("Unable to Save Post to DB");
            }
        }
        return false;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getPostDate()
    {
        return $this->postDate;
    }

    /**
     * @param mixed $postDate
     */
    public function setPostDate($postDate)
    {
        $this->postDate = $postDate;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param array $errors
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }
}