<?php
require_once('../model/database.php');
require_once('../model/valid_admin.php');
require_once('../model/course_db.php');
require_once('../model/student_db.php');
require_once('../model/email_util.php');
require_once('../model/Person.php');
require_once('../model/Student.php');

if (isset($_POST['action'])) {
    $action = $_POST['action'];
} else if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'list_students';
}

switch ($action) {
    case 'list_students':
        $course_id = filter_input(INPUT_GET, 'course_id', FILTER_VALIDATE_INT);
        if ($course_id === null || $course_id === false) {
            $course_id = 1;
        }

        $course_name = get_course_name($course_id);
        $courses = get_courses();
        $students = get_students_by_course($course_id);

        include('student_list.php');
        break;

    case 'show_add_form':
        $courses = get_courses();
        include('student_add.php');
        break;

    case 'add_student':
        $course_id = filter_input(INPUT_POST, 'course_id', FILTER_VALIDATE_INT);
        $index_number = filter_input(INPUT_POST, 'index_number');
        $first_name = filter_input(INPUT_POST, 'first_name');
        $last_name = filter_input(INPUT_POST, 'last_name');
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $points_raw = filter_input(INPUT_POST, 'points');
        $points_raw = str_replace(',', '.', $points_raw);
        $points = filter_var($points_raw, FILTER_VALIDATE_FLOAT);

        if (!$course_id || empty($index_number) || empty($first_name) || empty($last_name) || !$email || $points === false || $points < 0 || $points > 100) {
            $error = "Невалидни податоци за студентот. Проверете ги сите полиња и обидете се повторно.";
            include('../errors/error.php');
            exit();
        }


        if ($points >= 90)
            $grade = 10;
        else if ($points >= 80)
            $grade = 9;
        else if ($points >= 70)
            $grade = 8;
        else if ($points >= 60)
            $grade = 7;
        else if ($points >= 50)
            $grade = 6;
        else
            $grade = 5;

        $profile_image = 'default.png';
        if (isset($_FILES['student_image']) && $_FILES['student_image']['error'] === UPLOAD_ERR_OK) {
            $tmp_name = $_FILES['student_image']['tmp_name'];
            $file_name = time() . '_' . basename($_FILES['student_image']['name']);
            $target_path = '../uploads/' . $file_name;
            if (move_uploaded_file($tmp_name, $target_path)) {
                $profile_image = $file_name;
            }
        }

        add_student($course_id, $index_number, $first_name, $last_name, $email, $points, $grade, $profile_image);


        $course_name = get_course_name($course_id);
        send_grade_email($email, $first_name . ' ' . $last_name, $course_name, $grade, $points);

        header("Location: .?course_id=$course_id");
        exit();
        break;

    case 'show_edit_form':
        $student_id = filter_input(INPUT_GET, 'student_id', FILTER_VALIDATE_INT);
        if ($student_id) {
            $student = get_student($student_id);
            include('student_edit.php');
        } else {
            header("Location: .");
        }
        break;

    case 'update_student':
        $student_id = filter_input(INPUT_POST, 'student_id', FILTER_VALIDATE_INT);
        $course_id = filter_input(INPUT_POST, 'course_id', FILTER_VALIDATE_INT);
        $points = filter_input(INPUT_POST, 'points', FILTER_VALIDATE_FLOAT);

        if (!$student_id || $points === false || $points < 0 || $points > 100) {
            $error = "Невалидни поени. Внесете вредност помеѓу 0 и 100.";
            include('../errors/error.php');
            exit();
        }

        if ($points >= 90)
            $grade = 10;
        else if ($points >= 80)
            $grade = 9;
        else if ($points >= 70)
            $grade = 8;
        else if ($points >= 60)
            $grade = 7;
        else if ($points >= 50)
            $grade = 6;
        else
            $grade = 5;

        $student = get_student($student_id);
        $profile_image = $student['profileImage'];


        if (isset($_FILES['student_image']) && $_FILES['student_image']['error'] === UPLOAD_ERR_OK) {
            $tmp_name = $_FILES['student_image']['tmp_name'];
            $file_name = time() . '_' . basename($_FILES['student_image']['name']);
            $target_path = '../uploads/' . $file_name;
            if (move_uploaded_file($tmp_name, $target_path)) {
                $profile_image = $file_name;
            }
        }

        update_student($student_id, $points, $grade, $profile_image);


        $course_name = get_course_name($course_id);
        send_grade_email($student['email'], $student['firstName'] . ' ' . $student['lastName'], $course_name, $grade, $points);

        header("Location: .?course_id=$course_id");
        exit();
        break;

    case 'delete_student':
        $student_id = filter_input(INPUT_POST, 'student_id', FILTER_VALIDATE_INT);
        $course_id = filter_input(INPUT_POST, 'course_id', FILTER_VALIDATE_INT);

        if ($student_id) {
            delete_student($student_id);
        }
        header("Location: .?course_id=$course_id");
        exit();
        break;

    case 'export_csv':
        $course_id = filter_input(INPUT_GET, 'course_id', FILTER_VALIDATE_INT) ?? 1;
        $course_name = get_course_name($course_id);
        $students = get_students_by_course($course_id);

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=ocenki_' . $course_id . '.csv');

        $output = fopen('php://output', 'w');
        fprintf($output, chr(0xEF) . chr(0xBB) . chr(0xBF));
        fputcsv($output, ['Индекс', 'Име', 'Презиме', 'Емаил', 'Поени', 'Оцена']);

        foreach ($students as $row) {
            fputcsv($output, [
                $row['indexNumber'],
                $row['firstName'],
                $row['lastName'],
                $row['email'],
                $row['points'],
                $row['grade']
            ]);
        }
        fclose($output);
        exit();
        break;

    default:
        header("Location: .?course_id=1");
        exit();
        break;
}
?>