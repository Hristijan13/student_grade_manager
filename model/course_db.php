<?php
function get_courses()
{
    global $db;
    $query = 'SELECT * FROM courses ORDER BY courseID';
    $statement = $db->prepare($query);
    $statement->execute();
    $courses = $statement->fetchAll();
    $statement->closeCursor();
    return $courses;
}

function get_course_name($course_id)
{
    global $db;
    $query = 'SELECT courseName FROM courses WHERE courseID = :course_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':course_id', $course_id);
    $statement->execute();
    $course = $statement->fetch();
    $statement->closeCursor();
    return $course ? $course['courseName'] : '';
}
?>