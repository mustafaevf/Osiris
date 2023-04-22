<?php 
require_once('../../includes/config.php');
require_once('../../function.php');
session_start();

if($_SESSION['auth'] != 1) {
    echo 'войдите в аккаунт';
    return;
}

$comment_id = $_POST['comment_id'];

if(!is_numeric($comment_id)) {
    echo 'non valid';
    return;
}



$username = $_SESSION['username'];
$user_id = getUserByUsername($username)['id'];
$query = "SELECT * FROM comments WHERE id = '$comment_id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);
if($row['user_id'] == $user_id) {
    echo 'вы не можете лайкать свой комментарий';
    return;
}
$query = "SELECT * FROM likes WHERE comment_id='$comment_id' AND from_user_id = '$user_id'";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0) {
    echo 'вы уже лайкали';
    return;
}


$get_like_user = $row['user_id'];

$query = "INSERT INTO likes(user_id, topic_id, comment_id, from_user_id) VALUES ('$get_like_user', 0, $comment_id, '$user_id')";
$result = mysqli_query($conn, $query);
if($result) {
    echo 'ok';
} else {
    echo 'err';
}