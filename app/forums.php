<?php 
require_once('index.php');

$url = substr($_SERVER['REQUEST_URI'], 1);
$page = explode('/', $url);
if(!is_numeric($page[1])){
    // echo 'no numeric';
    header('Location: /error');
    return;
}
$subsection_id = $page[1];
$query = "SELECT * FROM subsections WHERE subsection_id='$subsection_id' AND status=1";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) != 1) {
    header('Location: /error');
} else {
    $row = mysqli_fetch_array($result);
    $name_section = $row['subsection_name'];
}

top('Раздел | '. $row['subsection_name']);

?>

<div class="main-content">
    <div class="main-content-title">
        <h1>Темы в разделе <?php echo $name_section ?></h1>
    </div>
    <div class="blocks">
                <?php 
                    $query = "SELECT * FROM topics WHERE subsection_id = '$subsection_id' AND status = 1";
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
<main>
    

<?php 
footer();

?>