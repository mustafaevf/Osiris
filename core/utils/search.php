<?php 
require_once('../../includes/config.php');


$search = htmlspecialchars($_POST['search']);

$query = "SELECT * FROM topics WHERE title LIKE '%$search%' AND status=1";
$result = mysqli_query($conn, $query);

$responce = '';

while($row = mysqli_fetch_array($result)) {
    $responce .= '<a href="/topic/'.$row['topic_id'].'">'.$row['title'].'</a>';

}

echo $responce;

?>