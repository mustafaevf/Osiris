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
} else {
    $row = mysqli_fetch_array($result);
}
$user_id = $row['user_id'];

$query1 = "SELECT * FROM users WHERE id='$user_id'";
$result1 = mysqli_query($conn, $query1);
$row_user = mysqli_fetch_array($result1);

top($row['title']);

?>

<main>
    <div class="routes">
        <!-- add routes -->
    </div>
    <div class="topic-main">
        <div class="topic-header">
            <div class="topic-header-title">
                <?php echo $row['title']?>
            </div>
            <div class="topic-header-date">
                <span class="date"><?php echo time_convert($row['create_date'])?></span>
            </div>
        </div>
        <div class="topic-body">
            <div class="topic-body-avatar">
                <img src="/public/images/avatars/<?php echo $row_user['avatar_image']?>" alt="">
            </div>
            <div class="topic-body-description">
                <div class="topic-body-description-author">
                    <span style="<?php echo $row_user['style'];?>"><?php echo $row_user['username']?></span>
                    <?php 
                        if($_SESSION['username'] == $row_user['username']) {
                            echo '<img src="/public/assets/edit.png"></img>';
                        } else {
                            echo '<img src="/public/assets/flag.png"></img>';
                            
                        }
                    ?>
                    
                </div>
                <div class="topic-body-sod">
                    <?php echo $row['description'] ?>
                </div>
                <span class="date"><?php echo time_convert($row['create_date'])?></span>
            </div>
            
        </div>
        <div class="topic-comments">
            <div class="dudas" id="up-com">
            <?php 
                $query = "SELECT * FROM comments WHERE topic_id = '$topic_id' AND status = 1 ORDER BY create_date ASC";
                $result = mysqli_query($conn, $query);
                while($row = mysqli_fetch_array($result)) {
                    $user_id = $row['user_id'];
                    echo '<div class="comment">
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
                            <span class="date">'.time_convert($row['create_date']).'</span>
                        </div>
                    </div>
                </div>';
                }

            ?>
            </div>
            
            <div class="add_comment">
                <input type="text" placeholder="Введите сообщение" id="comment-message">
                <button class="btn btn-line" onclick="createComments(<?php echo $topic_id; ?>)">Отправить</button>
            </div>
        </div>
    </div>
    
    

</main>


<?php 
footer();

?>

<script>
    

    setInterval(updateComments, 2500, <?php echo $topic_id ?>);
</script>