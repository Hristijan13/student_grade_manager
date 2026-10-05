<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Грешка во податоците</title>
    <link rel="stylesheet" type="text/css" href="../main.css" />
</head>

<body>
    <div id="page">
        <div id="header">
            <h1>ФЕИТ - Систем за управување со оценки</h1>
        </div>
        <div id="main" style="display: block; padding: 35px 30px;">
            <h2 class="error" style="margin-top: 0;">Грешка во податоците</h2>
            <p style="font-size: 15px; margin: 15px 0; color: #4a5568;">
                <?php echo htmlspecialchars($error); ?>
            </p>
            <p style="margin-top: 25px;">
                <a href="javascript:history.back()" class="btn-action" style="padding: 8px 16px;">&larr; Врати се
                    назад</a>
            </p>
        </div>
        <div id="footer">
            <p>&copy; <?php echo date("Y"); ?> Факултет за електротехника и информациски технологии (ФЕИТ) - Скопје</p>
        </div>
    </div>
</body>

</html>