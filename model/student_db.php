<?php
function get_students_by_course($course_id)
{
    global $db;
    $query = 'SELECT * FROM students 
              WHERE courseID = :course_id 
              ORDER BY studentID';
    $statement = $db->prepare($query);
    $statement->bindValue(':course_id', $course_id);
    $statement->execute();
    $students = $statement->fetchAll();
    $statement->closeCursor();
    return $students;
}

function get_student($student_id)
{
    global $db;
    $query = 'SELECT * FROM students WHERE studentID = :student_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':student_id', $student_id);
    $statement->execute();
    $student = $statement->fetch();
    $statement->closeCursor();
    return $student;
}

function delete_student($student_id)
{
    global $db;
    $query = 'DELETE FROM students WHERE studentID = :student_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':student_id', $student_id);
    $statement->execute();
    $statement->closeCursor();
}

function add_student($course_id, $index_number, $first_name, $last_name, $email, $points, $grade, $profile_image)
{
    global $db;
    $query = 'INSERT INTO students
                 (courseID, indexNumber, firstName, lastName, email, points, grade, profileImage)
              VALUES
                 (:course_id, :index_number, :first_name, :last_name, :email, :points, :grade, :profile_image)';
    $statement = $db->prepare($query);
    $statement->bindValue(':course_id', $course_id);
    $statement->bindValue(':index_number', $index_number);
    $statement->bindValue(':first_name', $first_name);
    $statement->bindValue(':last_name', $last_name);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':points', $points);
    $statement->bindValue(':grade', $grade);
    $statement->bindValue(':profile_image', $profile_image);
    $statement->execute();
    $statement->closeCursor();
}
function update_student($student_id, $points, $grade, $profile_image)
{
    global $db;
    $query = 'UPDATE students 
              SET points = :points, 
                  grade = :grade, 
                  profileImage = :profile_image 
              WHERE studentID = :student_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':points', $points);
    $statement->bindValue(':grade', $grade);
    $statement->bindValue(':profile_image', $profile_image);
    $statement->bindValue(':student_id', $student_id);
    $statement->execute();
    $statement->closeCursor();
}