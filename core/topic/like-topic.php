<?php 
require_once('../../includes/config.php');
require_once('../../function.php');
session_start();

if($_SESSION['auth'] != 1) {
    echo 'войдите в аккаунт';
    return;
}

$topic_id = $_POST['topic_id'];

if(!is_numeric($topic_id)) {
    echo 'non valid';
    return;
}

$username = $_SESSION['username'];
$user_id = getUserByUsername($username)['id'];

$query = "SELECT * FROM likes WHERE topic_id='$topic_id' AND from_user_id = '$user_id'";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) != 0) {
    echo 'вы уже лайкали';
    return;
}

$query = "SELECT * FROM topics WHERE topic_id = '$topic_id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);
if($row['user_id'] == $user_id) {
    echo 'вы не можете лайкать свой пост';
    return;
}
$get_like_user = $row['user_id'];

$query = "INSERT INTO likes(user_id, topic_id, comment_id, from_user_id) VALUES ('$get_like_user', $topic_id, 0, '$user_id')";
$result = mysqli_query($conn, $query);
if($result) {
    echo 'ok';
} else {
    echo 'err';
}