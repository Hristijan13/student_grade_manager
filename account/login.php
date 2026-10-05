<?php include '../view/header.php'; ?>

<div id="main" style="display: block; max-width: 450px; margin: 0 auto; border: none;">
    <h2>Најава за администратор</h2>

    <?php if (!empty($login_message)): ?>
        <p class="error"><?php echo htmlspecialchars($login_message); ?></p>
    <?php endif; ?>

    <form action="index.php" method="post" id="login_form">
        <input type="hidden" name="action" value="login" />

        <label>Емаил адреса:</label><br />
        <input type="text" name="email" value="<?php echo htmlspecialchars($email ?? ''); ?>" /><br />

        <label>Лозинка:</label><br />
        <input type="password" name="password" /><br /><br />

        <input type="submit" value="Најави се" />
    </form>

</div>

<?php include '../view/footer.php'; ?>