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
} else {
    echo '404';
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
            </head>
            <body> 
                <header>
                    <div class="header-container">
                        <div class="header-logo">
                            asdasdas
                        </div>
                        <div class="header-menu">
                            <ul>
                                <li><a href="">dsadsa</a></li>
                            </ul>
                        </div>
                    </div>
                </header>';

}

function footer() {
    echo '</body>
        </html>';
    
}


?>

