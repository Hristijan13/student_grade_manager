<?php include '../view/header.php'; ?>

<div id="main" style="display: block; max-width: 550px; margin: 0 auto; border: none;">
    <h2>Ажурирање на податоци за студент</h2>

    <form action="index.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="action" value="update_student" />
        <input type="hidden" name="student_id" value="<?php echo $student['studentID']; ?>" />
        <input type="hidden" name="course_id" value="<?php echo $student['courseID']; ?>" />

        <div style="margin-bottom: 15px;">
            <label>Тековна слика:</label>
            <img src="../uploads/<?php echo htmlspecialchars($student['profileImage']); ?>" alt="Current Photo"
                class="student-thumb" style="display: inline-block; width: 50px; height: 50px;"
                onerror="this.src='https://via.placeholder.com/50?text=User'" />
        </div>

        <label>Студент:</label>
        <span><strong><?php echo htmlspecialchars($student['firstName'] . ' ' . $student['lastName']); ?></strong>
            (Индекс: <?php echo htmlspecialchars($student['indexNumber']); ?>)</span><br /><br />

        <label>Емаил:</label>
        <span><?php echo htmlspecialchars($student['email']); ?></span><br /><br />

        <label>Нови поени (0-100):</label>
        <input type="text" name="points" value="<?php echo htmlspecialchars($student['points']); ?>" /><br />

        <label>Промени слика:</label>
        <input type="file" name="student_image" accept="image/*" /><br />
        <small style="color: #718096; display: block; margin-left: 150px; margin-bottom: 15px;">
            *Оставете празно ако не сакате да ја промените сликата.
        </small>

        <input type="submit" value="Зачувај промени" class="btn-action" />
    </form>

    <p style="margin-top: 15px;"><a href="index.php?course_id=<?php echo $student['courseID']; ?>">&larr; Откажи и врати
            се назад</a></p>
</div>

<?php include '../view/footer.php'; ?>