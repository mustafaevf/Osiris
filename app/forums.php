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
    <div class="main-content-base">
        <div class="main-content-base-filter">
            <div class="filter">
                <div class="filter-content">
                    <span>Сортировать по дате создания</span> 
                    <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-chevron-down ActionListItem-collapseIcon">
                        <path d="M12.78 5.22a.749.749 0 0 1 0 1.06l-4.25 4.25a.749.749 0 0 1-1.06 0L3.22 6.28a.749.749 0 1 1 1.06-1.06L8 8.939l3.72-3.719a.749.749 0 0 1 1.06 0Z"></path>
                    </svg>
                </div>
            </div>
            <?php if($_SESSION['auth'] == 1) echo '<button class="v2" onclick="create_topic('.$row['subsection_id'].')">Создать тему</button>'; ?>
        </div>
        <div class="theme-blocks">
            <?php 
                $query = "SELECT * FROM topics WHERE status=1 AND subsection_id='$subsection_id'";
                $result = mysqli_query($conn, $query);
                $i = 0;
                while($row = mysqli_fetch_array($result)) {
                    
                    if($i % 2 == 0) {
                        $theme = 'theme-grey';
                    } else {
                        $theme = 'theme-black';
                    }
                    echo '<a href="/topic/'.$row['topic_id'].'"><div class="theme-blocks-block '.$theme.'">
                    <div class="theme-block-title">'.$row['title'].'</div>
                    <div class="theme-block-user">
                        <img src="/public/images/avatars/'.getUserByID($row['user_id'])['avatar_image'].'" alt="">
                        <span>'.getUserByID($row['user_id'])['username'].'</span>
                    </div>
                    <div class="theme-block-date">'.time_convert($row['create_date']).'</div>
                    </div></a>';
                    $i++;   
                }

            ?>
           
        </div>
    </div>
</div>

    

<?php 
footer();

?>