<?php
require_once('../model/database.php');
require_once('../model/admin_db.php');
require_once('../model/secure_conn.php');
require_once('../model/email_util.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['action'])) {
    $action = $_POST['action'];
} else if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'show_login';
}

switch ($action) {
    case 'show_login':
        $login_message = '';
        include('login.php');
        break;

    case 'login':
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');

        if (!$email || empty($password)) {
            $login_message = 'Ве молиме внесете валиден емаил и лозинка.';
            include('login.php');
        } else if (is_valid_admin_login($email, $password)) {

            $_SESSION['is_valid_admin'] = true;
            $_SESSION['admin_name'] = $email;

            send_login_alert($email);

            header('Location: ../grade_manager/');
            exit();
        } else {
            $login_message = 'Погрешен емаил или лозинка. Обидете се повторно.';
            include('login.php');
        }
        break;

    case 'logout':

        $_SESSION = array();
        session_destroy();

        $login_message = 'Успешно се одјавивте.';
        include('login.php');
        break;

    default:
        include('login.php');
        break;
}
?>