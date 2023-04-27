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
                        <a href=""><span>Разделы</span></a>
                        <a href=""><span>Пользователи</span></a>
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

