<?php
function is_valid_admin_login($email, $password)
{
    global $db;

    $password_hash = sha1($email . $password);

    $query = 'SELECT adminID, firstName, lastName 
              FROM administrators 
              WHERE emailAddress = :email AND password = :password';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $password_hash);
    $statement->execute();
    $admin = $statement->fetch();
    $statement->closeCursor();

    return $admin !== false;
}
?>