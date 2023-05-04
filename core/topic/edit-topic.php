<?php 
require_once('../../includes/config.php');
session_start();
$title = htmlspecialchars($_POST['title']);
$description = htmlspecialchars($_POST['description']);
$tags = htmlspecialchars($_POST['tags']);
$topic_id = htmlspecialchars($_POST['topic_id']);
$username = $_SESSION['username'];

$query = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);
$user_id = $row['id'];
echo $user_id;
if($_SESSION['auth'] != 1) {
    echo 'Войдите в аккаунт';
    return;
}

$role = $row['role'];
$query = "SELECT * FROM roles WHERE role_id = '$role'";
$create_topic = mysqli_fetch_array(mysqli_query($conn, $query))['create_topic'];

if($create_topic != 1) {
    echo 'Вы не можете редактировать топики';
    return;
}



if(empty($title) || empty($description) || empty($tags)) {
    echo 'заполните все поля';
    return;
}

$query = "SELECT * FROM topics WHERE topic_id ='$topic_id'";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) == 0) {
    echo 'Такого топика не существует';
    return;
}
$row = mysqli_fetch_array($result);

if($title != $row['title']) {
    $query = "UPDATE topics SET title='$title' WHERE topic_id='$topic_id'";
    $result = mysqli_query($conn, $query);
}
if($tags != $row['tags']) {
    $query = "UPDATE topics SET tags='$tags' WHERE topic_id='$topic_id'";
    $result = mysqli_query($conn, $query);
}
if($description != $row['description']) {
    $query = "UPDATE topics SET description='$description' WHERE topic_id='$topic_id'";
    $result = mysqli_query($conn, $query);
}

echo 'Топик создан';


?>