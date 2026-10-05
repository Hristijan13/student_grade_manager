<?php
require_once('Person.php');

class Student extends Person
{
    private $studentID;
    private $courseID;
    private $indexNumber;
    private $points;
    private $grade;
    private $profileImage;

    public function __construct($studentID, $courseID, $indexNumber, $firstName, $lastName, $email, $points, $grade, $profileImage = 'default.png')
    {
        parent::__construct($firstName, $lastName, $email);
        $this->studentID = $studentID;
        $this->courseID = $courseID;
        $this->indexNumber = $indexNumber;
        $this->points = $points;
        $this->grade = $grade;
        $this->profileImage = $profileImage;
    }

    public function getStudentID()
    {
        return $this->studentID;
    }

    public function getCourseID()
    {
        return $this->courseID;
    }

    public function getIndexNumber()
    {
        return $this->indexNumber;
    }

    public function getPoints()
    {
        return $this->points;
    }

    public function setPoints($value)
    {
        $this->points = $value;
    }

    public function getGrade()
    {
        return $this->grade;
    }

    public function setGrade($value)
    {
        $this->grade = $value;
    }

    public function getProfileImage()
    {
        return $this->profileImage;
    }

    public function setProfileImage($value)
    {
        $this->profileImage = $value;
    }


    public function hasPassed()
    {
        return $this->grade >= 6;
    }

    public function getStatusText()
    {
        return ($this->hasPassed()) ? 'Положил' : 'Не положил';
    }

    public function getFormattedPoints()
    {
        return number_format($this->points, 2);
    }
}
?>