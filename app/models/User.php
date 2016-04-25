<?php

namespace App\Models;

use App\Components\HtmlComponent;
use App\Core\DbConnector;

class User implements IModel
{
    private $id;
    private $firstName;
    private $lastName;
    private $email;
    private $password;
    private $city;
    private $age;
    private $unicorns;
    private $active;
    private $errors = [];

    /**
     * @return array|bool
     */
    public function validate()
    {
        if (empty($this->firstName)) {
            $this->errors[] = 'Invalid first name';
        }
        if (empty($this->lastName)) {
            $this->errors[] = 'Invalid last name';
        }
        if (empty($this->password)) {
            $this->errors[] = 'Invalid password';
        }
        if (empty($this->email)) {
            $this->errors[] = 'Invalid email';
        }

        if (empty($this->errors)) {
            return true;
        } else {
            return $this->errors;
        }
    }

    /**
     * @return bool
     */
    public function save()
    {
        if ($this->validate()) {
            $con = DbConnector::getConnection();
            $stmt = $con->prepare("INSERT INTO Users (first_name, last_name, email, password) VALUES (?,?,?,?)");
            if ($stmt->execute([$this->firstName, $this->lastName, $this->email, $this->password])) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param $password1
     * @param $password2
     * @return mixed|null
     */
    public function checkPassword($password1, $password2)
    {
        $comp = new HtmlComponent();

        $password1 = $comp->filterString($password1, 5);
        $password2 = $comp->filterString($password2, 5);
        if ($password1 !== null && $password1 === $password2) {
            $hashedPassword = $this->hashPassword($password1);
            return $hashedPassword;
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

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
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
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * @return mixed
     */
    public function getUnicorns()
    {
        return $this->unicorns;
    }

    /**
     * @param mixed $unicorns
     */
    public function setUnicorns($unicorns)
    {
        $this->unicorns = $unicorns;
    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $active
     */
    public function setActive($active)
    {
        $this->active = $active;
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
}
