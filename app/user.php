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
top('Пользователь - '. $row['username']);

setActive(getUserByUsername($_SESSION['username'])['id'],'Смотрит профиль пользователя '. $row['username']);


?>
<main>
    <div class="user-block">
        <div class="user-block-image">
            <img src="/public/images/avatars/<?php echo $row['avatar_image']?>">
        </div>
        <div class="user-block-info">
            <div class="user-block-info-top">
                <span style="<?php echo getUserByID($user_id)['style']?>"><?php echo $row['username']?></span>
                <?php 
                    if($_SESSION['username'] == $row['username']) {
                        echo '<img src="/public/assets/edit.png" alt="">';
                    }
                ?>
                
                
                
            </div>
            <div class="user-block-inf-ba">
                <span class="date">Последний заход: <?php echo time_convert($row['last_login'])?> <?php echo $row['active']; ?></span>

                <span>Регистрация: <?php echo time_convert($row['date_register'])?></span>
                <span>Количество тем: <?php echo $num_topics;?></span>
                <span>Количество сообщений: <?php echo $num_messages;?></span>
            </div>
        </div>
        
    </div>
    
</main>

<?php footer(); ?>