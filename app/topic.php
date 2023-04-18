<?php 
require_once('index.php');

$url = substr($_SERVER['REQUEST_URI'], 1);
$page = explode('/', $url);
if(!is_numeric($page[1])){
    header('Location: /error');
    return;
}
$topic_id = $page[1];
$query = "SELECT * FROM topics WHERE topic_id='$topic_id' AND status=1";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) != 1) {
    header('Location: /error');
} else {
    $row = mysqli_fetch_array($result);
}

top($row['title']);

?>

<main>
    <div class="routes">
        
    </div>
    <p><?php echo $row['title']?></p>
    <p><?php echo $row['description'] ?></p>

</main>



<?php 
footer();

?>