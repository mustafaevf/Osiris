<?php 
require_once('../../includes/config.php');
session_start();
$title = htmlspecialchars($_POST['title']);
$description = htmlspecialchars($_POST['description']);
$tags = htmlspecialchars($_POST['tags']);
$forum_id = htmlspecialchars($_POST['forum_id']);
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
    echo 'Вы не можете создавать топики';
    return;
}



if(empty($title) || empty($description) || empty($tags)) {
    echo 'заполните все поля';
    return;
}

$query = "SELECT * FROM sections WHERE section_id ='$forum_id'";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) == 0) {
    echo 'Раздел не найден';
    return;
}


$create_date = date("Y-m-d H:i:s");
$query = "INSERT INTO topics (user_id, tags, subsection_id, views, status, title, description, create_date) VALUES('$user_id', '$tags', '$forum_id', 0, 1, '$title', '$description', '$create_date')";
$result = mysqli_query($conn, $query);
if($result) {
    echo 'Топик создан';
} else {
    echo 'Ошибка создания';
}

?>