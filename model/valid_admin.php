<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['is_valid_admin'])) {
    header('Location: ../account/index.php?action=show_login');
    exit();
}
?>