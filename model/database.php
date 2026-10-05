<?php
$dsn = 'mysql:host=localhost;dbname=student_grade_db;charset=utf8';
$username = 'root';
$password = '';

try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    include(__DIR__ . '/../errors/database_error.php');
    exit();
}
?>