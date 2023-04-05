<?php 
top('Создание темы');
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
?>
 <a href="/section/<?php echo $row['section_id']; ?>"><?php echo $row['section_name']; ?></a>
<div class="container">
    <div class="form">
       
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
        <button class="btn btn-line" onclick="createTopic()">Создать тему</button>
    </div>
    
</div>



<?php footer(); ?>