<?php 
require_once('../../includes/config.php');
session_start();

if($_SESSION['auth'] != 1) {
    echo 'войдите в аккаунт';
    return;
}

$username = $_SESSION['username'];
$result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
$row_user = mysqli_fetch_array($result);
$user_id = $row_user['id'];

$topic_id = $_POST['topic_id'];
$message = htmlspecialchars($_POST['message']);
echo $message;
if(empty($message)) {
    echo 'заполните правильно поля';
    return;
}

$query = "SELECT * FROM topics WHERE topic_id = '$topic_id'";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) == 0) {
    echo 'пост не найден';
    return;
}

$create_date = date("Y-m-d H:i:s");
$query = "INSERT INTO comments(topic_id, user_id, message, create_date, status) VALUES ('$topic_id', '$user_id', '$message', '$create_date', 1)";
$result = mysqli_query($conn, $query);
if($result) {
    echo 'ok';
} else {
    echo 'err';
}

