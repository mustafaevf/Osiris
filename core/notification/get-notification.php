<?php
require_once '../../function.php';
require_once('../../includes/config.php');
session_start();

if($_SESSION['auth'] != 1) {
    echo 'Войдите в аккаунт';
    return;
}

$responce = '';
$user_id = $_SESSION['id'];
$query = "SELECT * FROM notifications WHERE user_id = '$user_id' AND views = 0";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) == 0) {
    echo 'У вас нет уведомлений';
    return;
} 
while($row = mysqli_fetch_array($result)) {
    if($row['from_user'] == -1) {
        $img = '/public/images/avatars/nophoto.png';
    } else {
        $img = '/public/images/avatars/'.getUserByID($row['from_user'])['avatar_image'];
    }
    $responce .= '<div class="notification-content-block">
    <img src="'.$img.'">
    <div class="notification-content-block-right">
        <span>'.$row['message'].'</span>
        <div class="theme-block-date">'.time_convert($row['date']).'</div>
    </div>
</div>';
}
echo $responce;

?>