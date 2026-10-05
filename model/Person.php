<?php
class Person
{
    protected $firstName;
    protected $lastName;
    protected $email;

    public function __construct($firstName, $lastName, $email)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($value)
    {
        $this->firstName = $value;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($value)
    {
        $this->lastName = $value;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($value)
    {
        $this->email = $value;
    }

    public function getFullName()
    {
        return $this->firstName . ' ' . $this->lastName;
    }
}
?>