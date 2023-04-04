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

} elseif($url == 'register') {

} elseif($url == 'recovery') {

} elseif($url == '') {
    include "app/main.php";
} else {
    echo '404';
    // $page = explode('/', $url);
    // echo $page[2];
    // echo count($page);
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
            <body>';

}

function footer() {
    echo '</body>
        </html>';
    
}


?>

