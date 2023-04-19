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
                if(mysqli_num_rows($result) != 1) {
                    header('Location: /error');
                }
                include "app/forums.php";
            }
        }
        if(count($page) == 3) {
            if($page[2] == 'create-topic') {
                include "app/create-topic.php";
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
                <title>'.$title.'</title>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            </head>
            <body> 
                
                <header>
                    <div class="header-container">
                        <div class="header-logo">   
                            <div class="logo" onclick="href(`/`)">logo</div>
                            <div class="header-sub">
                                <div class="header-sub-list" id="list-information" onclick="show(`info`)">Информация <img src="/public/assets/down.png"></div>
                            </div>
                        </div>
                        <div class="header-menu">';

                        
                        if($_SESSION['auth'] != 1) {
                            echo '<button class="btn btn-line" onclick="href(`login`)">Авторизация</button><button class="ml-5 btn btn-outline" onclick="href(`register`)">Регистрация</button>';
                        } else {
                            echo '<img src="/public/assets/email.png" onclick="show(`message`)"></img>';
                            echo '<img src="/public/assets/notification.png" onclick="show(`notification`)"></img>';
                            echo '<img class="profile-photo" src="/public/images/avatars/nophoto.png"></img>';
                            $username = $_SESSION['username'];
                            $query1 = "SELECT * FROM users WHERE username = '$username'";
                            $result1 = mysqli_query($conn, $query1);
                            $row = mysqli_fetch_array($result1);
                            echo '<a href="/user/'.$row['id'].'"><span style="'.$row['style'].'">'.$row['username'].'</span></a>';
                        }

    echo '         </div></div>
                </header>';

}

function footer() {
    echo '<script src="/public/scripts/script.js"></script>
            <div class="popup popup-information show-off">
                <ul>
                    <li><a href="/pages/rules">Правила</a></li>
                    <li><a href="/pages/about">О нас</a></li>
                </ul>
            </div>
            <div class="popup popup-notification show-off">
                <ul>

                </ul>
            </div>
            </body>
        </html>';
    
}


?>

