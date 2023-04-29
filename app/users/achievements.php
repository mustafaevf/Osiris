<?php 
require_once('index.php');

$url = substr($_SERVER['REQUEST_URI'], 1);
$page = explode('/', $url);
if(!is_numeric($page[1])){
    header('Location: /error');
    return;
}
$user_id = $page[1];

$query = "SELECT * FROM users WHERE id='$user_id'";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) != 1) {
    header('Location: /error');
} else {
    $row = mysqli_fetch_array($result);
}

$query = "SELECT * FROM topics WHERE user_id='$user_id'";
$num_topics = mysqli_num_rows(mysqli_query($conn, $query));

$query = "SELECT * FROM comments WHERE user_id='$user_id'";
$num_messages = mysqli_num_rows(mysqli_query($conn, $query));

$query = "SELECT * FROM likes WHERE user_id='$user_id'";
$num_likes = mysqli_num_rows(mysqli_query($conn, $query));
top('Пользователь - '. $row['username']);

setActive(getUserByUsername($_SESSION['username'])['id'],'Смотрит профиль пользователя '. $row['username']);


?>
<div class="main-content">
    <div class="main-content-title">
        <h1><?php echo $row['username']?></h1>
    </div>
    <div class="main-content-body">
        <div class="main-content-other">
            <div class="main-content-other-left">
                <a href="/user/<?php echo $user_id;?>">Информация</a>
                <a href="/user/<?php echo $user_id;?>/achievements" class="active">Достижения</a>
                <a href="/user/<?php echo $user_id;?>/topics">Темы</a>
                <a href="">Жалобы</a>
                <?php 
                if($user_id == $_SESSION['id']) echo '<a href="/user/'.$user_id.'/edit">Редактировать</a>';
                ?>
            </div>
            <div class="main-content-other-right">
                <div class="card">
                    <div class="block-achievements-rating">
                        <div class="block-rating">
                            Количество тем: <?php echo $num_topics?>
                        </div>
                        <div class="block-rating">
                            Количество сообщений: <?php echo $num_messages?>
                        </div>
                        <div class="block-rating">
                            Количество лайков: <?php echo $num_likes?>
                        </div>
                    </div>
                    <div class="line">
                        
                    </div>
                    <span>Трофеи</span>
                </div>
            </div>
        </div>
    </div>
</div>



<?php footer(); ?>