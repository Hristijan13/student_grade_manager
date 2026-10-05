<?php include '../view/header.php'; ?>

<div id="main" style="display: block; max-width: 550px; margin: 0 auto; border: none;">
    <h2>Внесување на нов студент и оцена</h2>

    <form action="index.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="action" value="add_student" />

        <label>Предмет:</label>
        <select name="course_id">
            <?php foreach ($courses as $c): ?>
                <option value="<?php echo $c['courseID']; ?>">
                    <?php echo htmlspecialchars($c['courseName']); ?>
                </option>
            <?php endforeach; ?>
        </select><br />

        <label>Број на индекс:</label>
        <input type="text" name="index_number" placeholder="пр. 191055" /><br />

        <label>Име:</label>
        <input type="text" name="first_name" /><br />

        <label>Презиме:</label>
        <input type="text" name="last_name" /><br />

        <label>Емаил адреса:</label>
        <input type="text" name="email" placeholder="student@test.mk" /><br />

        <label>Освоени поени (0-100):</label>
        <input type="text" name="points" placeholder="пр. 85.5" /><br />

        <label>Слика (профил):</label>
        <input type="file" name="student_image" accept="image/*" /><br /><br />

        <input type="submit" value="Зачувај студент" class="btn-action" />
    </form>

    <p style="margin-top: 15px;"><a href="index.php?action=list_students">&larr; Врати се кон листата</a></p>
</div>

<?php include '../view/footer.php'; ?>