<?php

namespace App\Models;

class User
{
    private $firstName;
    private $lastName;
    private $email;
    private $password;
    private $city;
    private $age;
    private $unicorns;

    /**
     * User constructor.
     * @param $id
     * @param $firstName
     * @param $lastName
     * @param $email
     * @param $password
     * @param $city
     * @param $age
     * @param $unicorns
     */
    public function __construct($id, $firstName, $lastName, $email, $password, $city, $age, $unicorns)
    {
        $this->id = $id;
        $this->setFirstName($firstName);
        $this->setLastName($lastName);
        $this->email = $email;
        $this->setPassword($password);
        $this->setCity($city);
        $this->setAge($age);
        $this->setUnicorns($unicorns);
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
}
