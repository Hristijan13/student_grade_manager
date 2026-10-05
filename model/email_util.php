<?php
function send_grade_email($to_email, $student_name, $course_name, $grade, $points)
{
    $phpmailer_path = __DIR__ . '/../PHPMailer/PHPMailerAutoload.php';
    if (!file_exists($phpmailer_path)) {

        return false;
    }

    require_once($phpmailer_path);

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;


    $mail->Username = 'webappfeit@gmail.com';
    $mail->Password = 'webAppTest';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('admin@feit.ukim.edu.mk', 'ФЕИТ Оценки');
    $mail->addAddress($to_email, $student_name);
    $mail->CharSet = 'UTF-8';
    $mail->isHTML(true);

    $status = ($grade >= 6) ? 'ПОЛОЖИЛ' : 'НЕ ПОЛОЖИЛ';

    $mail->Subject = "Известување за оцена по предметот: " . $course_name;
    $mail->Body = "
        <h3>Здраво, " . htmlspecialchars($student_name) . "</h3>
        <p>Внесена е нова или ажурирана оцена во системот:</p>
        <ul>
            <li><strong>Предмет:</strong> " . htmlspecialchars($course_name) . "</li>
            <li><strong>Освоени поени:</strong> " . htmlspecialchars($points) . "</li>
            <li><strong>Конечна оцена:</strong> " . htmlspecialchars($grade) . "</li>
            <li><strong>Статус:</strong> " . $status . "</li>
        </ul>
        <p>Со почит,<br>Студентска служба - ФЕИТ</p>
    ";

    try {
        return $mail->send();
    } catch (Exception $e) {
        return false;
    }
}


function send_login_alert($admin_email)
{
    $phpmailer_path = __DIR__ . '/../PHPMailer/PHPMailerAutoload.php';
    if (!file_exists($phpmailer_path)) {
        return false;
    }

    require_once($phpmailer_path);

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;

    $mail->Username = 'hristijanstojanoski747@gmail.com';
    $mail->Password = 'sjjb bjhz vefk dxzw';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('admin@feit.ukim.edu.mk', 'ФЕИТ');
    $mail->addAddress('hristijanstojanoski747@gmail.com', 'Христијан');
    $mail->CharSet = 'UTF-8';
    $mail->isHTML(true);

    $time = date('d.m.Y H:i:s');
    $mail->Subject = 'Успешна најава на Системот за оценки';
    $mail->Body = "
        <h3>Безбедносно известување</h3>
        <p>Корисникот <strong>" . htmlspecialchars($admin_email) . "</strong> штотуку успешно се најави на веб апликацијата.</p>
        <p><strong>Време на најава:</strong> {$time}</p>
        <p>Доколку ова не бевте вие, веднаш проверете ја безбедноста на вашиот кориснички профил.</p>
        <br>
        <p>Со почит,<br>ФЕИТ - Систем за студентски оценки</p>
    ";

    try {
        return $mail->send();
    } catch (Exception $e) {
        return false;
    }
}
?>