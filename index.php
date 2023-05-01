<?php
session_start();
include "function.php";

ini_set('display_errors', 1);


$url = substr($_SERVER['REQUEST_URI'], 1);

if($_SESSION['auth'] != 1 || $_SESSION['auth'] == 1) {
    $page = explode('/', $url);
    
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
        if(count($page) == 3) {
            if($page[2] == 'achievements') {
                include "app/users/achievements.php";
            }
            if($page[2] == 'topics') {
                include "app/users/topic.php";
            }
        }
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
} elseif($url == 'users') {
    include "app/users.php";
} elseif($url == 'exit') {
    header('Location: /core/user/exit.php');
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
            <div class="popup" style="display: none;" id="popup-user">
                <div class="popup-content">
                    <a href="/user/'.$_SESSION['id'].'">Профиль</a>
                    <a href="/exit">Выход</a>
                </div>
            </div>
            <div class="popup" style="display: none;" id="popup-search">
                <div class="popup-content" id="search-content">
                    
                </div>
            </div>
            <div class="popup" style="display: none;" id="popup-notification">
                <div class="popup-content">
                    <div class="popup-content-title">
                    Уведомления
                    </div>
                    <div class="line"></div>
                    <div class="popup-content-body">
                        <div class="notification-content">
                            
                        </div>    
                    </div>
                </div>
            </div>
            <div class="modal-popup" id="modal-info">
                <div class="modal-popup-card">
                    <div class="modal-card-header">Информация</div>
                    <div class="modal-card-content" id="modal-info-text">
                       
                    </div>
                </div>
            </div>
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
                        <div class="alter-login"><a href="/register">Регистрация</a> или <a href="/recovery">Забыли пароль</a></div>
                    </div>
                </div>
            </div>
                <div class="left-sidebar">
                    <div class="left-sidebar-header"></div>
                    <div class="left-sidebar-content">';
                        $query = "SELECT * FROM sections WHERE status = 1";
                        $result = mysqli_query($conn, $query);
                        while($row = mysqli_fetch_array($result)) {
                            $section_id = $row['section_id'];
                            echo '<div class="open"><a class="dropdown-forums">
                            <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-book mr-2">
                                <path d="M0 1.75A.75.75 0 0 1 .75 1h4.253c1.227 0 2.317.59 3 1.501A3.743 3.743 0 0 1 11.006 1h4.245a.75.75 0 0 1 .75.75v10.5a.75.75 0 0 1-.75.75h-4.507a2.25 2.25 0 0 0-1.591.659l-.622.621a.75.75 0 0 1-1.06 0l-.622-.621A2.25 2.25 0 0 0 5.258 13H.75a.75.75 0 0 1-.75-.75Zm7.251 10.324.004-5.073-.002-2.253A2.25 2.25 0 0 0 5.003 2.5H1.5v9h3.757a3.75 3.75 0 0 1 1.994.574ZM8.755 4.75l-.004 7.322a3.752 3.752 0 0 1 1.992-.572H14.5v-9h-3.495a2.25 2.25 0 0 0-2.25 2.25Z"></path>
                            </svg>
                            <div class="dropdown-content-block">
                                <span>'.$row['section_name'].'</span>
                                <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-chevron-down ActionListItem-collapseIcon">
                                    <path d="M12.78 5.22a.749.749 0 0 1 0 1.06l-4.25 4.25a.749.749 0 0 1-1.06 0L3.22 6.28a.749.749 0 1 1 1.06-1.06L8 8.939l3.72-3.719a.749.749 0 0 1 1.06 0Z"></path>
                                </svg>
                            </div>
                         </a><div class="dropped-forums" style="display: none;">';
                         $query1 = "SELECT * FROM subsections WHERE status=1 AND section_id = '$section_id'";
                         $result1 = mysqli_query($conn, $query1);
                         while($row1 = mysqli_fetch_array($result1)) {
                             echo '<a href="/forums/'.$row1['subsection_id'].'"><span>'.$row1['subsection_name'].'</span></a>';
                         }
                         echo '</div></div>';
                        }
                            

                            
                        echo '
                        <a href="/users"><svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-people ActionListItem-visual ActionListItem-visual--leading">
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
                            echo '<div class="main-links-profile" >
                            <div class="input-search">
                                <input placeholder="Введите запрос" id="search">
                                <img src="/public/assets/search.png">
                            </div>
                            <svg style="margin-right: 7px;" id="dropdown-notification" aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-bell">
                                <path d="M8 16a2 2 0 0 0 1.985-1.75c.017-.137-.097-.25-.235-.25h-3.5c-.138 0-.252.113-.235.25A2 2 0 0 0 8 16ZM3 5a5 5 0 0 1 10 0v2.947c0 .05.015.098.042.139l1.703 2.555A1.519 1.519 0 0 1 13.482 13H2.518a1.516 1.516 0 0 1-1.263-2.36l1.703-2.554A.255.255 0 0 0 3 7.947Zm5-3.5A3.5 3.5 0 0 0 4.5 5v2.947c0 .346-.102.683-.294.97l-1.703 2.556a.017.017 0 0 0-.003.01l.001.006c0 .002.002.004.004.006l.006.004.007.001h10.964l.007-.001.006-.004.004-.006.001-.007a.017.017 0 0 0-.003-.01l-1.703-2.554a1.745 1.745 0 0 1-.294-.97V5A3.5 3.5 0 0 0 8 1.5Z"></path>
                            </svg>';
                            echo '<img src="/public/images/avatars/'.getUserByID($_SESSION['id'])['avatar_image'].'"</img>';
                            echo ' <svg aria-hidden="true" id="dropdown-profile" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-chevron-down ActionListItem-collapseIcon">
                            <path d="M12.78 5.22a.749.749 0 0 1 0 1.06l-4.25 4.25a.749.749 0 0 1-1.06 0L3.22 6.28a.749.749 0 1 1 1.06-1.06L8 8.939l3.72-3.719a.749.749 0 0 1 1.06 0Z"></path>
                        </svg>';
                            echo '</div>';
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

