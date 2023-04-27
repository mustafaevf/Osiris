<?php
session_start();
include "function.php";

ini_set('display_errors', 1);


$url = substr($_SERVER['REQUEST_URI'], 1);

if($_SESSION['auth'] == 1) {
    $page = explode('/', $url);
    if(count($page) == 2) {
        if($page[0] == 'users') {
            echo 'user/'. $page[1].'/';
        }
    }
    if($page[0] == 'forums') {
        if(count($page) == 2) {
            if(is_numeric($page[1])) {
                $section_id = $page[1];
                $query = "SELECT * FROM subsections WHERE subsection_id='$section_id' AND status=1";
                $result = mysqli_query($conn, $query);
                // if(mysqli_num_rows($result) != 1) {
                //     header('Location: /error');
                // }
                include "app/forums.php";
            }
        }
        if(count($page) == 3) {
            if($page[2] == 'create-topic') {
                include "app/create-topic.php";
            }
        }
    }
    if($page[0] == 'user') {
        if(count($page) == 2) {
            if(is_numeric($page[1])) {
                $user_id = $page[1];
                $query = "SELECT * FROM users WHERE id='$user_id'";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result) != 1) {
                    header('Location: /error');
                }
                include "app/user.php";
            }
        }
        // if(count($page) == 3) {
        //     if($page[2] == 'create-topic') {
        //         include "app/create-topic.php";
        //     }
        // }
    }
    if($page[0] == 'topic') {
        if(count($page) == 2) {
            if(is_numeric($page[1])) {
                $topic_id = $page[1];
                $query = "SELECT * FROM topics WHERE topic_id='$topic_id' AND status=1";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result) != 1) {
                    header('Location: /error');
                }
                include "app/topic.php";
            }
        }
    }
} else {
    
}


if($url == 'login') {
    include "app/login.php";
} elseif($url == 'register') {
    include "app/register.php";
} elseif($url == 'recovery') {
    include "app/recovery.php";
} else if($url == 'error') {
    include 'app/error.php';
} elseif($url == '') {
    include "app/main.php";
}




function top($title) {
    include "includes/config.php";
    echo '<!DOCTYPE html>
            <html lang="en">
            <head>
                <link rel="preconnect" href="https://fonts.googleapis.com">
                <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="/public/styles/style.css">
                <script src="/public/scripts/jquery.min.js"></script>
                <title>'.$title.'</title>
                
            </head>
            <body> 
            <div class="wrap">
            <div class="modal" id="modal-login">
                <div class="overlay" onclick=close()></div>
                <div class="modal-card">
                    <div class="modal-card-header">Авторизация</div>
                    <div class="modal-card-content">
                        <div class="input">
                            <span>Логин</span>
                            <input type="text" onkeyup="filterAuthLogin()" id="auth-login">
                            <span class="error">Ошибка</span>
                        </div>
                        <div class="input">
                            <span>Пароль</span>
                            <input type="password" id="auth-password" onkeyup="filterAuthPassword()">
                            <span class="error">Ошибка</span>
                        </div>
                        <button class="v1" onclick="login()">Войти</button>
                    </div>
                </div>
            </div>
                <div class="left-sidebar">
                    <div class="left-sidebar-header"></div>
                    <div class="left-sidebar-content">
                        <a id="dropdown-forums">
                            <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-book mr-2">
                                <path d="M0 1.75A.75.75 0 0 1 .75 1h4.253c1.227 0 2.317.59 3 1.501A3.743 3.743 0 0 1 11.006 1h4.245a.75.75 0 0 1 .75.75v10.5a.75.75 0 0 1-.75.75h-4.507a2.25 2.25 0 0 0-1.591.659l-.622.621a.75.75 0 0 1-1.06 0l-.622-.621A2.25 2.25 0 0 0 5.258 13H.75a.75.75 0 0 1-.75-.75Zm7.251 10.324.004-5.073-.002-2.253A2.25 2.25 0 0 0 5.003 2.5H1.5v9h3.757a3.75 3.75 0 0 1 1.994.574ZM8.755 4.75l-.004 7.322a3.752 3.752 0 0 1 1.992-.572H14.5v-9h-3.495a2.25 2.25 0 0 0-2.25 2.25Z"></path>
                            </svg>
                            <div class="dropdown-content-block">
                                <span>Разделы</span>
                                <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-chevron-down ActionListItem-collapseIcon">
                                    <path d="M12.78 5.22a.749.749 0 0 1 0 1.06l-4.25 4.25a.749.749 0 0 1-1.06 0L3.22 6.28a.749.749 0 1 1 1.06-1.06L8 8.939l3.72-3.719a.749.749 0 0 1 1.06 0Z"></path>
                                </svg>
                            </div>
                        </a>
                        <div class="dropped-forums" style="display: none;">';
                            $query = "SELECT * FROM subsections WHERE status=1";
                            $result = mysqli_query($conn, $query);
                            while($row = mysqli_fetch_array($result)) {
                                echo '<a href="/forums/'.$row['subsection_id'].'"><span>'.$row['subsection_name'].'</span></a>';
                            }

                            
                        echo '</div>
                        <a href=""><svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-people ActionListItem-visual ActionListItem-visual--leading">
                        <path d="M2 5.5a3.5 3.5 0 1 1 5.898 2.549 5.508 5.508 0 0 1 3.034 4.084.75.75 0 1 1-1.482.235 4 4 0 0 0-7.9 0 .75.75 0 0 1-1.482-.236A5.507 5.507 0 0 1 3.102 8.05 3.493 3.493 0 0 1 2 5.5ZM11 4a3.001 3.001 0 0 1 2.22 5.018 5.01 5.01 0 0 1 2.56 3.012.749.749 0 0 1-.885.954.752.752 0 0 1-.549-.514 3.507 3.507 0 0 0-2.522-2.372.75.75 0 0 1-.574-.73v-.352a.75.75 0 0 1 .416-.672A1.5 1.5 0 0 0 11 5.5.75.75 0 0 1 11 4Zm-5.5-.5a2 2 0 1 0-.001 3.999A2 2 0 0 0 5.5 3.5Z"></path>
                    </svg><span>Пользователи</span></a>
                        <a href=""><span>О нас</span></a>
                    </div>
                </div>
                <div class="main">
                    <div class="main-header">
                        <div class="main-logo">
                            <a href="/">osiris</a>
                        </div>
                        <div class="main-links">
                        '; 
                        if($_SESSION['auth'] == 1) {
                            echo '<a href="/user/'.$_SESSION['id'].'">'.getUserByID($_SESSION['id'])['username'].'</a>';
                        } else {
                            echo '
                            <button class="v1" onclick=show(`login`)>Войти</button>';
                        }
                        
                        echo '</div>
                    </div>';

}

function footer() {
    echo '<script src="/public/scripts/script.js"></script>
    </div>
    </div>
</body>
</html>';
    
}


?>

