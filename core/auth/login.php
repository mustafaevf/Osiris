<?php
require_once('../../includes/config.php');
session_start();
$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);

$query = "SELECT * FROM users WHERE username='$username'";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) == 0) {
    echo '[login] пользователь не найден';
    return;
}
$row = mysqli_fetch_array($result);

if(hash('sha256', $password) != $row['password']) {
    echo '[login] пароли не совпадают';
    return;
}

$last_login = date("Y-m-d H:i:s");
$query = "UPDATE users SET last_login='$last_login' WHERE username='$username'";
$result = mysqli_query($conn, $query);

if($result) {
    echo '[login] ok';
    $_SESSION['auth'] = 1;
    $_SESSION['id'] = $row['id'];
    $_SESSION['username'] = $username;
}
?>
