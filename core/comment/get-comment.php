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
    $comment_id = $row['id'];
    $query_like = "SELECT * FROM likes WHERE comment_id = '$comment_id'";
    $likes = mysqli_query($conn, $query_like);
    $num_likes = mysqli_num_rows($likes);
    $responce = $responce. '<div class="comment">
    <div class="comment-avatar">
        <img src="/public/images/avatars/'.getUserByID($user_id)['avatar_image'].'" alt="">
    </div>
    <div class="comment-body">
        <div class="comment-body-author">
            <a href="/user/'.$row['user_id'].'"><span style="'.getUserByID($user_id)['style'].'">'.getUserById($row['user_id'])['username'].'</span></a>
        </div>
        <div class="comment-body-description">
            '.$row['message'].'
        </div>
        <div class="comment-body-date">
            <span class="date">'.time_convert($row['create_date']).' '.$num_likes.' <img src="/public/assets/like.png" onclick="like_comment(`'.$comment_id.'`)"></span>
        </div>
    </div>
</div>';

}

echo $responce;
?>