<?php 
require_once '../../function.php';
require_once('../../includes/config.php');
session_start();
$topic_id = $_GET['topic_id'];
$responce = '';
$query = "SELECT * FROM comments WHERE topic_id = '$topic_id' AND status = 1 ORDER BY create_date ASC";
$result = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($result)) {
    $user_id = $row['user_id'];
    $responce = $responce. '<div class="comment">
    <div class="comment-avatar">
        <img src="/public/images/avatars/nophoto.png" alt="">
    </div>
    <div class="comment-body">
        <div class="comment-body-author">
            <a href="/user/'.$row['user_id'].'"><span style="'.getUserByID($user_id)['style'].'">'.getUserById($row['user_id'])['username'].'</span></a>
        </div>
        <div class="comment-body-description">
            '.$row['message'].'
        </div>
        <div class="comment-body-date">
            <span class="date">'.time_convert($row['create_date']).'</span>
        </div>
    </div>
</div>';

}

echo $responce;
?>