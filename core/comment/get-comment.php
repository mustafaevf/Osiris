<?php 
require_once '../../function.php';
require_once('../../includes/config.php');
session_start();
$topic_id = $_GET['topic_id'];
$responce = '';
$query = "SELECT * FROM comments WHERE status=1 AND topic_id='$topic_id'";
$result = mysqli_query($conn, $query);
$i = 0;
while($row = mysqli_fetch_array($result)) {
    $comment_id = $row['id'];
    $query1 = "SELECT * FROM likes WHERE comment_id='$comment_id'";
    $num_likes = mysqli_num_rows(mysqli_query($conn, $query1));
    if($i % 2 == 0) {
        $theme = 'theme-grey';
    } else {
        $theme = 'theme-black';
    }
    $responce = $responce .'<div class="comment-blocks-block '.$theme.'" >
    <div style="display: flex; flex-direction: column;">
    <div class="comment-block-title">'.$row['message'].'</div>
    <div class="comment-block-user">
        <img src="/public/images/avatars/'.getUserByID($row['user_id'])['avatar_image'].'" alt="">
        <span><a href="/user/'.$row['user_id'].'">'.getUserByID($row['user_id'])['username'].'</span></a>
    </div>
    <div class="comment-block-date">'.time_convert($row['create_date']).'</div>
    </div>
    <div class="main-content-header-right" style="display: none;">
        <div class="r_icon">
            <span>'.$num_likes.'</span>
            <div class="r_icon-contest">
                <img src="/public/assets/like.png" onclick="like_comment('.$row['id'].')" alt="">
            </div>
        </div>
        <div class="r_icon">
            <div class="r_icon-contest">
                <img src="/public/assets/flag.png" alt="">
            </div>
        </div>
    </div>
    </div>';
    $i++;   
}

echo $responce;
?>
