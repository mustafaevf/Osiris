<?php 

$url = substr($_SERVER['REQUEST_URI'], 1);
$page = explode('/', $url);
// if(!is_numeric($page[1])){
//     header('Location: /error');
//     return;
// }
$section_id = $page[1];
$query = "SELECT * FROM subsections WHERE subsection_id='$section_id' AND status=1";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) != 1) {
    header('Location: /error');
} else {
    $row = mysqli_fetch_array($result);
}
top('Создание темы | '. $row['subsection_name']);
?>
<div class="main-content">
    <div class="main-content-title">
        <h1>Создание темы в разделе <?php echo $row['subsection_name']; ?></h1>
    </div>
    <div class="editor-body">
        <div class="input">
            <span>Заголовок: </span>
            <input type="text" id="create-topic-title">
        </div>
        <div class="input">
            <span>Теги: </span>
            <input type="text" id="create-topic-tags">
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
            <textarea name="" id="create-topic-description"></textarea>
        </div>
        <button class="v2" onclick="createTopic(<?php echo $row['subsection_id'];?>)">Создать</button>
    </div>
</div>



<?php footer(); ?>