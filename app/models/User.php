<?php

namespace App\Models;

use App\Components\HtmlComponent;
use App\Core\DbConnector;
use App\Repositories\UserRepository;

class User implements IModel
{
    private $id;
    private $firstName;
    private $lastName;
    private $email;
    private $password;
    private $city;
    private $birthdate;
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
        if ($this->checkIfUserExists($this->email)) {
            $this->errors[] = 'Email already used';
        }
        if (!$this->checkIfValidBirthDate($this->birthdate)) {
            $this->errors[] = 'Invalid birthdate';
        }
        return empty($this->errors);
    }

    /**
     * @param $email
     * @return bool
     */
    public function checkIfUserExists($email)
    {
        $userRepo = new UserRepository();
        if ($userRepo->findByEmail($email)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $birthdate
     * @return bool
     */
    private function checkIfValidBirthDate($birthdate)
    {
        $date = explode('-', $birthdate);
        if (count($date) == 3) {
            $year = preg_match('/^[\d]{4}$/', $date[0]);
            $month = preg_match('/^[\d]{2}$/', $date[1]);
            $day = preg_match('/^[\d]{2}$/', $date[2]);
            if ($year && $month && $day) {
                return true;
            }
        }
        return false;
    }

    /**
     * @return bool
     */
    public function save()
    {
        if ($this->validate()) {
            $con = DbConnector::getConnection();
            $stmt = $con->prepare("
            INSERT INTO Users (firstName, lastName, email, password, city, birthdate, unicorns, active) 
            VALUES (?,?,?,?,?,?,?,?) ON DUPLICATE KEY UPDATE 
            firstName = VALUES (firstName),
            lastName = VALUES (lastName),
            email = VALUES (email),
            password = VALUES (password),
            city = VALUES (city),
            birthdate = VALUES (birthdate),
            unicorns = VALUES (unicorns),
            active = VALUES (active)
            ");
            if ($stmt->execute([
                $this->firstName,
                $this->lastName,
                $this->email,
                $this->password,
                $this->city,
                $this->birthdate,
                $this->unicorns,
                $this->active,
            ])
            ) {
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

        $password1 = $comp->filterString($password1, 4);
        $password2 = $comp->filterString($password2, 4);
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
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * @param mixed $birthdate
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
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
