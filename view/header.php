<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Систем за управување со студентски оценки</title>
    <link rel="stylesheet" type="text/css" href="../main.css" />
</head>

<body>
    <div id="page">
        <div id="header">
            <h1>ФЕИТ - Систем за управување со оценки</h1>
            <div class="user-info">
                <?php if (isset($_SESSION['is_valid_admin'])): ?>
                    Најавен професор: <strong><?php echo htmlspecialchars($_SESSION['admin_name']); ?></strong>
                    | <a href="../account/index.php?action=logout">Одјави се</a>
                <?php else: ?>
                    <a href="../account/index.php?action=show_login">Најави се</a>
                <?php endif; ?>
            </div>
        </div>