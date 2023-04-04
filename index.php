<?php
session_start();
include "includes/config.php";
ini_set('display_errors', 1);



$url = substr($_SERVER['REQUEST_URI'], 1);

if($_SESSION['auth'] == 1) {
    $page = explode('/', $url);
    if(count($page) == 2) {
        if($page[0] == 'users') {
            echo 'users/'. $page[1].'/';
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
} elseif($url == '') {
    include "app/main.php";
}



function top($title) {
    echo '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="public/styles/style.css">
                <title>'.$title.'</title>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            </head>
            <body> 
                <header>
                    <div class="header-container">
                        <div class="header-logo">   
                            asdasdas
                        </div>
                        <div>';

                        if($_SESSION['auth'] != 1) {
                            echo '<button class="btn btn-line" onclick="href(`login`)">Авторизация</button><button class="ml-5 btn btn-outline" onclick="href(`register`)">Регистрация</button>';
                        } else {
                            echo $_SESSION['username'];
                        }

    echo '         </div></div>
                </header>';

}

function footer() {
    echo '<script src="public/scripts/script.js"></script>
            </body>
        </html>';
    
}


?>

