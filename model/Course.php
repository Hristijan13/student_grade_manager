<?php
class Course
{
    private $courseID;
    private $courseCode;
    private $courseName;

    public function __construct($courseID, $courseCode, $courseName)
    {
        $this->courseID = $courseID;
        $this->courseCode = $courseCode;
        $this->courseName = $courseName;
    }

    public function getCourseID()
    {
        return $this->courseID;
    }

    public function getCourseCode()
    {
        return $this->courseCode;
    }

    public function getCourseName()
    {
        return $this->courseName;
    }
}
?>