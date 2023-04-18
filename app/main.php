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
                    echo '<li>'.$row['section_name'].'</li>';
                    $section_id = $row['section_id'];
                    $query1 = "SELECT * FROM subsections WHERE section_id = '$section_id'";
                    $result1 = mysqli_query($conn, $query1); 
                    while($row1 = mysqli_fetch_array($result1)) {
                        echo '<li onclick="href(`/forums/'.$row1['subsection_id'].'`)">'.$row1['subsection_name'].'</p>';
                    }
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