<?php 

$url = substr($_SERVER['REQUEST_URI'], 1);
$page = explode('/', $url);
// if(!is_numeric($page[1])){
//     header('Location: /error');
//     return;
// }
$topic_id = $page[1];
if(!is_numeric($topic_id)) {
    header('Location: /');
    return;
}
$query = "SELECT * FROM topics WHERE topic_id='$topic_id'";
$result = mysqli_query($conn, $query);
if(!$result) {
    header('Location: /');
    return;
}
$row = mysqli_fetch_array($result);
if($_SESSION['id'] != $row['user_id']) {
    header('Location: /');
    return;
}
top('Редактирование темы | '. $row['title']);
?>
<div class="main-content">
    <div class="main-content-title">
        <h1>Редактирование темы <?php echo $row['title']; ?></h1>
    </div>
    <div class="editor-body">
        <div class="input">
            <span>Раздел</span>
            <input type="text">
        </div>
        <div class="input">
            <span>Заголовок: </span>
            <input type="text" id="create-topic-title" value="<?php echo $row['title']; ?>">
        </div>
        <div class="input">
            <span>Теги: </span>
            <input type="text" id="create-topic-tags" value="<?php echo $row['tags']; ?>">
        </div>
        <div class="editor-textarea">
            <div class="editor-bar">
                <div class="editor-bar-block" id="attach_img">
                    <img src="/public/assets/attach_file.png">
                </div>
                <div class="editor-bar-block" id="bold">
                    <img src="/public/assets/bold.png">
                </div>
                <div class="editor-bar-block" id="color">
                    <img src="/public/assets/format_color_fill_24px.png">
                </div>
                <div class="editor-bar-block" id="strike">
                    <img src="/public/assets/format_strikethrough_24px.png">
                </div>
                <div class="editor-bar-block" id="size">
                    <img src="/public/assets/format_size_24px.png">
                </div>
                <div class="editor-bar-block" id="left">
                    <img src="/public/assets/format_align_left_24px.png">
                </div>
                <div class="editor-bar-block" id="center">
                    <img src="/public/assets/format_align_center_24px.png">
                </div>
                <div class="editor-bar-block" id="right">
                    <img src="/public/assets/format_align_right_24px.png">
                </div>
            </div>
            <textarea name="" id="create-topic-description"><?php echo $row['description']; ?></textarea>
        </div>
        <button class="v2" onclick="editTopic(<?php echo $row['topic_id'] ?>)">Сохранить</button>
    </div>
</div>



<?php footer(); ?>