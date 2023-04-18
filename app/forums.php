<?php 
require_once('index.php');

$url = substr($_SERVER['REQUEST_URI'], 1);
$page = explode('/', $url);
if(!is_numeric($page[1])){
    header('Location: /error');
    return;
}
$section_id = $page[1];
$query = "SELECT * FROM sections WHERE section_id='$section_id' AND status=1";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) != 1) {
    header('Location: /error');
} else {
    $row = mysqli_fetch_array($result);
}

top('Раздел | '. $row['section_name']);

?>

<div class="container">
    <button class="btn btn-neutral" onclick="href('<?php echo $section_id ?>/create-topic')">Создать тему</button>
    <div class="blocks" style="margin-top: 10px;">
    <?php 
    $query = "SELECT * FROM topics WHERE subsection_id = '$section_id' AND status = 1";
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result)) {
        echo '<div class="block"><a href="/topic/'.$row['topic_id'].'">
         <div class="block-container">
            <div class="block-left">
                <div class="block-left-title">
                    '.$row['title'].'
                </div>
                <div class="block-left-user">
                    '.$row['user_id'].'
                </div>
                
                
            </div>
            <div class="block-right">
                '.$row['create_date'].'
            </div>
         </div>
        </a>
        </div>';
        
    }

    ?>
    </div>
</div>


<?php 
footer();

?>