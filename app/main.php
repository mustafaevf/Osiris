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
                    echo '<div class="section-bar">'.$row['section_name'].'</div>';
                    $section_id = $row['section_id'];
                    $query1 = "SELECT * FROM subsections WHERE section_id = '$section_id'";
                    $result1 = mysqli_query($conn, $query1); 
                    while($row1 = mysqli_fetch_array($result1)) {
                        echo '<li onclick="href(`/forums/'.$row1['subsection_id'].'`)">'.$row1['subsection_name'].'</li>';
                    }
                }
                ?>      
                
            </ul>
        </div>
        <div class="main-right">
            <h3>Темы</h3>
            <!-- <div class="sub-main">
                <button class="btn btn-line">Создать тему</button>
            </div> -->
            <div class="main-topics">
            <div class="blocks">
                <?php 
                    $query = "SELECT * FROM topics WHERE status=1";
                    $result = mysqli_query($conn, $query);
                    while($row = mysqli_fetch_array($result)) {
                        $user_id = $row['user_id'];
                        $query1 = "SELECT * FROM users WHERE id='$user_id'";
                        $result1 = mysqli_query($conn, $query1);
                        $row_user = mysqli_fetch_array($result1);
                        echo '<div class="block"><a href="/topic/'.$row['topic_id'].'">
                        <div class="block-container">
                           <div class="block-left">
                               <div class="block-left-title">
                                   '.$row['title'].'
                               </div>
                               <div class="block-left-user">
                                   <span style="'.$row_user['style'].'">'.$row_user['username'].'</span>
                               </div>
                               
                               
                           </div>
                           <div class="block-right">
                               <span class="date">'.time_convert($row['create_date']).'</span>
                           </div>
                        </div>
                       </a>
                       </div>';
                    }

                ?>
            </div>
        </div>
        </div>
        
    </div>
</main>

<?php 
footer();

?>