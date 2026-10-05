<?php include '../view/header.php'; ?>

<div id="main">
    <div id="sidebar">
        <h2>Предмети</h2>
        <ul class="nav">
            <?php foreach ($courses as $c): ?>
                <li>
                    <a href="?course_id=<?php echo $c['courseID']; ?>">
                        <?php echo htmlspecialchars($c['courseName']); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div id="content">
        <h2>Оценки за предмет: <?php echo htmlspecialchars($course_name); ?></h2>
        <table>
            <tr>
                <th class="col-center">Слика</th>
                <th class="col-center">Индекс</th>
                <th>Име и презиме</th>
                <th>Емаил</th>
                <th class="col-center">Поени</th>
                <th class="col-center">Оцена</th>
                <th class="col-center">Статус</th>
                <th class="col-center">Акции</th>
            </tr>
            <?php if (empty($students)): ?>
                <tr>
                    <td colspan="8" class="col-center">Нема внесено студенти за овој предмет.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($students as $s):
                    $student_obj = new Student(
                        $s['studentID'],
                        $s['courseID'],
                        $s['indexNumber'],
                        $s['firstName'],
                        $s['lastName'],
                        $s['email'],
                        $s['points'],
                        $s['grade'],
                        $s['profileImage']
                    );
                    ?>
                    <tr>
                        <td class="col-center">
                            <img src="../uploads/<?php echo htmlspecialchars($student_obj->getProfileImage()); ?>" alt="Student"
                                class="student-thumb" />
                        </td>
                        <td class="col-center"><?php echo htmlspecialchars($student_obj->getIndexNumber()); ?></td>
                        <td><?php echo htmlspecialchars($student_obj->getFullName()); ?></td>
                        <td><?php echo htmlspecialchars($student_obj->getEmail()); ?></td>
                        <td class="col-center"><?php echo $student_obj->getFormattedPoints(); ?></td>
                        <td class="col-center"><strong><?php echo $student_obj->getGrade(); ?></strong></td>
                        <td class="col-center <?php echo $student_obj->hasPassed() ? 'passed' : 'failed'; ?>">
                            <?php echo $student_obj->getStatusText(); ?>
                        </td>
                        <td class="col-center">

                            <a href="?action=show_edit_form&student_id=<?php echo $s['studentID']; ?>" class="btn-action"
                                style="margin-right: 5px;">Измени</a>


                            <form action="index.php" method="post" style="display:inline;"
                                onsubmit="return confirm('Дали сте сигурни за бришење?');">
                                <input type="hidden" name="action" value="delete_student" />
                                <input type="hidden" name="student_id" value="<?php echo $s['studentID']; ?>" />
                                <input type="hidden" name="course_id" value="<?php echo $s['courseID']; ?>" />
                                <input type="submit" value="Избриши" class="btn-action btn-delete" />
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>

        <p>
            <a href="?action=show_add_form" class="btn-action">Внеси нов студент</a>
            <a href="?action=export_csv&course_id=<?php echo $course_id; ?>" class="btn-action"
                style="background-color: #2b6cb0; margin-left: 10px;">📥 Извези CSV</a>
        </p>
    </div>
</div>

<?php include '../view/footer.php'; ?>