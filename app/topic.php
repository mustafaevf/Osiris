<?php 
require_once('index.php');

$url = substr($_SERVER['REQUEST_URI'], 1);
$page = explode('/', $url);
if(!is_numeric($page[1])){
    header('Location: /error');
    return;
}
$topic_id = $page[1];
$query = "SELECT * FROM topics WHERE topic_id='$topic_id' AND status=1";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) != 1) {
    header('Location: /error');
    return;
} else {
    $row = mysqli_fetch_array($result);
}
$user_id = $row['user_id'];

$query1 = "SELECT * FROM users WHERE id='$user_id'";
$result1 = mysqli_query($conn, $query1);
$row_user = mysqli_fetch_array($result1);

setActive(getUserByUsername($_SESSION['username'])['id'],'Смотрит тему '. $row['title']);
$who_watch = getUserByUsername($_SESSION['username'])['id'];

top($row['title']);

$query = "SELECT * FROM likes WHERE topic_id='$topic_id'";
$num_likes = mysqli_num_rows(mysqli_query($conn, $query));

$query = "SELECT * FROM views WHERE topic_id='$topic_id' AND user_id='$who_watch'";
$result = mysqli_query($conn, $query);
$num_watch = mysqli_num_rows($result);
if($num_watch == 0) {
    $query = "INSERT INTO views(user_id, topic_id) VALUES('$who_watch', '$topic_id')";
    $result = mysqli_query($conn, $query);
}
?>

<div class="main-content">
    <div class="main-content-header">
        <div class="main-content-header-left">
            <div class="main-content-image">
                <img src="/public/images/avatars/<?php echo getUserByID($user_id)['avatar_image']?>" alt="">
            </div>
            <div class="main-content-information">
                <div class="main-content-information-title">
                    <?php echo $row['title'] ?>
                    
                </div>
                <a href="/user/<?php echo $user_id; ?>"><?php echo getUserByID($user_id)['username']; ?></a>
                <div class="main-content-information-date">
                    <?php echo time_convert($row['create_date']) ?>
                </div>
            </div>
        </div>
        <div class="main-content-header-right">
            <div class="r_icon">
                <span><?php echo $num_likes;?></span>
                <div class="r_icon-contest">
                    <img src="/public/assets/like.png" onclick="like_topic(<?php echo $topic_id; ?>)" alt="">
                </div>
            </div>
            <div class="r_icon">
                <div class="r_icon-contest">
                    <img src="/public/assets/flag.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="main-content-body-topic">
        <?php echo $row['description']?>
    </div>
    <div class="comment-blocks">
            <?php 
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
                    echo '<div class="comment-blocks-block '.$theme.'" >
                    <div style="display: flex; flex-direction: column;">
                    <div class="comment-block-title">'.$row['message'].'</div>
                    <div class="comment-block-user">
                        <img src="/public/images/avatars/'.getUserByID($row['user_id'])['avatar_image'].'" alt="">
                        <span><a href="/user/'.$row['user_id'].'">'.getUserByID($row['user_id'])['username'].'</span></a>
                    </div>
                    <div class="comment-block-date">'.time_convert($row['create_date']).' '.($_SESSION['id'] != $row['user_id'] ? "Ответить" : "") .'</div>
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

            ?>
    </div>
    <?php 
    if($_SESSION['auth'] == 1) {
        echo ' <div class="create-comment">
        <input type="text" placeholder="Сообщение" id="comment-message">
        <button class="v2" onclick="createComments('.$topic_id.')">Отправить</button>
    </div>';
    }

    ?>
   
                
</div>

<?php 
footer();

?>

<script>
    $('#comment-message').keydown(function(event) {
    if (event.which === 13) {
        createComments(<?php echo $topic_id; ?>);
    }
    });
    setInterval(updateComments, 2500, <?php echo $topic_id ?>);
</script>