<?php 
require_once('index.php');
top('Пользователи');

?>
<div class="main-content">
    <div class="main-content-title">
        <h1><?php echo $row['username']?></h1>
    </div>
    <div class="main-content-body">
        <div class="main-content-other">
            <div class="main-content-other-left">
                <a href="/users" class="active">Все</a>
                <a href="/users/staff-members">Члены команды</a>
            </div>
            <div class="main-content-other-right">
                <div class="card">
                <?php 
                $query = "SELECT * FROM users";
                $result = mysqli_query($conn, $query);
                while($row = mysqli_fetch_array($result)) {
                    
                }
                ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
footer();

?>