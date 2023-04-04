<?php 
require_once('../../includes/config.php');
session_start();
$username = htmlspecialchars($_POST['username']);
$email = htmlspecialchars($_POST['email']);
$password = htmlspecialchars($_POST['password']);
$password_hash = hash('sha256', htmlspecialchars($_POST['password']));;

if (strlen($username) < 2 || empty($email) || strlen($password) < 6 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo '[core] заполните все поля';
    return;
}

$query = "SELECT * FROM users WHERE username='$username'";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result)) {
    echo '[core] логин занят';
    return;
}
$date_register = date("Y-m-d H:i:s");
$ip = $_SERVER['REMOTE_ADDR'];
$query = "INSERT INTO users (username, password, email, balance, status, role, date_register, last_login, ip) VALUES('$username', '$password_hash', '$email', 0.0, 0, 0, '$date_register', '$date_register', '$ip')";
$result = mysqli_query($conn, $query);
if($result) {
    echo 'ok';
} else {
    echo 'error';
    echo mysqli_error($conn);
}



?>