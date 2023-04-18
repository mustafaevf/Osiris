<?php 
require_once('index.php');
top('123');

?>


<main>
    <div class="main-container">
        <div class="main-menu">
            <ul>
                <?php 
                $query = "SELECT * FROM sections WHERE status=1";
                $result = mysqli_query($conn, $query);
                while($row = mysqli_fetch_array($result)) {
                    echo '<li onclick="href(`/forums/'.$row['section_id'].'`)">'.$row['section_name'].'<img src="/public/assets/down.png"></img></li>';
                }
                ?>      
                
            </ul>
        </div>
        <div class="main-topics">
            <div class="block">
                
            </div>
        </div>
    </div>
</main>

<?php 
footer();

?>