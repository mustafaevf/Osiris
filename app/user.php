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


top('Пользователь - '. $row['username']);



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
            
        </div>
    </div>

</main>

<?php footer(); ?>