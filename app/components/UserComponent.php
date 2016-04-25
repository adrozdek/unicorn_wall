<?php

namespace App\Components;

class UserComponent
{
    /**
     * @param $email
     * @return null
     */
    public function setEmail($email)
    {
        $email = trim(strip_tags($email));
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
    public function setPassword($password1, $password2)
    {
        $password1 = trim(strip_tags($password1));
        $password2 = trim(strip_tags($password2));
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
    public function setFirstName($firstName)
    {
        $firstName = trim(strip_tags(($firstName)));
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
    public function setLastName($lastName)
    {
        $lastName = trim(strip_tags($lastName));
        if (strlen($lastName) > 2) {
            return $lastName;
        } else {
            return null;
        }
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
}
