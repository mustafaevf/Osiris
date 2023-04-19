<?php 

$url = substr($_SERVER['REQUEST_URI'], 1);
$page = explode('/', $url);
if(!is_numeric($page[1])){
    header('Location: /error');
    return;
}
$section_id = $page[1];
$query = "SELECT * FROM subsections WHERE section_id='$section_id' AND status=1";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) != 1) {
    header('Location: /error');
} else {
    $row = mysqli_fetch_array($result);
}
top('Создание темы | '. $row['subsection_name']);
?>
 <!-- <a href="/forum/<?php echo $row['subsection_id']; ?>"><?php echo $row['subsection_name']; ?></a> -->
<main>
    <div class="form">
        <div class="input">
            <p>Раздел</p>
            <input type="text" placeholder="<?php echo $row['subsection_name'] ?>" disabled>
        </div>
        <div class="input">
            <p>Заголовок</p>
            <input type="text" id="create-topic-title">
        </div>
        <div class="textarea">
            <p>Содержание</p>
            <textarea name="" id="create-topic-description"></textarea>
        </div>
        <div class="input">
            <p>Теги</p>
            <div class="tags">

            </div>
            <input type="text" id="create-topic-tags" onkeyup="filterTopicTags()">
        </div>
        <button class="btn btn-line" onclick="createTopic(<?php echo $row['section_id'] ?>)">Создать тему</button>
    </div>
    
</main>



<?php footer(); ?>