<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Грешка со базата на податоци</title>
    <link rel="stylesheet" type="text/css" href="../main.css" />
</head>

<body>
    <div id="page">
        <div id="header">
            <h1>ФЕИТ - Систем за управување со оценки</h1>
        </div>
        <div id="main" style="display: block; padding: 35px 30px;">
            <h2 class="error" style="margin-top: 0;">Грешка со базата на податоци</h2>
            <p style="font-size: 15px; color: #4a5568;">Настана грешка при комуникацијата со базата на податоци.</p>
            <p><strong>Порака:</strong> <?php echo htmlspecialchars($error_message); ?></p>
            <p style="margin-top: 25px;">
                <a href="javascript:history.back()" class="btn-action">&larr; Врати се назад</a>
            </p>
        </div>
        <div id="footer">
            <p>&copy; <?php echo date("Y"); ?> Факултет за електротехника и информациски технологии (ФЕИТ) - Скопје</p>
        </div>
    </div>
</body>

</html>