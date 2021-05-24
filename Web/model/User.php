<?php
class User
{
    public $id;
    public $userTypeId;
    public $firstName;
    public $lastName;
    public $email;
    public $password;
    public $created;
    public $updated;

    public function __construct($_firstName, $_lastName, $_email, $_password, $_id = null, $_userTypeId = null, $_created = null, $_updated = null)
    {
        $this->id = $_id;
        $this->userTypeId = $_userTypeId;
        $this->firstName = $_firstName;
        $this->lastName = $_lastName;
        $this->email = $_email;
        $this->password = $_password;
        $this->created = $_created;
        $this->updated = $_updated;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getFullName()
    {
        return $this->firstName . ' ' . $this->lastName;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getUserTypeId()
    {
        return $this->userTypeId;
    }
}
