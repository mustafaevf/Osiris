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
                    echo '<li><a href="/section/'.$row['section_id'].'">'.$row['section_name'].'</a></li>';
                }
                ?>
                
            </ul>
        </div>
        <div class="main-topics">

        </div>
    </div>
</main>

<?php 
footer();

?>