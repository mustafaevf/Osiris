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
                <img src="/public/images/avatars/nophoto.png" alt="">
            </div>
            <div class="topic-body-description">
                <div class="topic-body-description-author">
                    <span style="<?php echo $row_user['style'];?>"><?php echo $row_user['username']?></span>
                    <?php 
                        if($_SESSION['username'] == $row_user['username']) {
                            echo '<button class="btn btn-line">Редактировать</button>';
                        } else {
                            echo '<button class="btn btn-line">Пожаловаться</button>';
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
            <div class="comment">
                <div class="comment-avatar">
                    <img src="/public/images/avatars/nophoto.png" alt="">
                </div>
                <div class="comment-body">
                    <div class="comment-body-author">
                            ghjkjdhsfhsjdfs
                    </div>
                    <div class="comment-body-description">
                        +
                    </div>
                    <div class="comment-body-date">
                        3 мая
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    

</main>



<?php 
footer();

?>