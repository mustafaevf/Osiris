<?php

$user = 'root';
$password = '';
$host = 'localhost';
$database = 'osiris';
$conn = mysqli_connect($host, $user, $password, $database);



function time_convert($date) {
    $result = '';
    $unix_timestamp = strtotime($date);
    $now = time();
    $diff = $now - $unix_timestamp;
    if($diff < 60) {
        $result = "Только что";
    } elseif ($diff < 3600) {
        $result = floor($diff / 60)." минут назад";
    } 
    elseif ($diff < 86400 && date("d", $unix_timestamp) == date("d", $now)) {
        $result =  "сегодня в " . date("H:i", $unix_timestamp);
    } elseif ($diff < 172800 && date("d", $unix_timestamp) == date("d", strtotime("-1 day"))) {
        $result = "вчера в " . date("H:i", $unix_timestamp);
    } else {
        $result = date("d.m.Y в H:i", $unix_timestamp);
    }

    return $result;
}

function bbcode($var) {
    $search = array(
        '/\[b\](.*?)\[\/b\]/is',
        '/\[i\](.*?)\[\/i\]/is',
        '/\[u\](.*?)\[\/u\]/is',
        '/\[img\](.*?)\[\/img\]/is',
        '/\[url\](.*?)\[\/url\]/is',
        '/\[url\=(.*?)\](.*?)\[\/url\]/is',
        '/\[color\=(.*?)\](.*?)\[\/color\]/is',
        '/\[size\=(.*?)\](.*?)\[\/size\]/is',
        '/\[center\](.*?)\[\/center\]/is',
        '/\[left\](.*?)\[\/left\]/is',         // Добавлено: [left]text[/left]
        '/\[right\](.*?)\[\/right\]/is',       // Добавлено: [right]text[/right]
        '/\[strike\](.*?)\[\/strike\]/is'      // Добавлено: [strike]text[/strike]
    );
    
    $replace = array(
        '<strong>$1</strong>',
        '<em>$1</em>',
        '<u>$1</u>',
        '<img src="$1" />',
        '<a href="$1">$1</a>',
        '<a href="$1">$2</a>',
        '<span style="color:$1">$2</span>',
        '<span style="font-size:$1px">$2</span>',
        '<div style="text-align:center">$1</div>',
        '<div style="text-align:left">$1</div>',   // Добавлено: выравнивание по левому краю
        '<div style="text-align:right">$1</div>',  // Добавлено: выравнивание по правому краю
        '<strike>$1</strike>'                       // Добавлено: зачеркнутый текст
    );
    
    $result = preg_replace ($search, $replace, $var);
    return $result;
}


function getUserByTopic($topic_id) {
    $user = 'root';
    $password = '';
    $host = 'localhost';
    $database = 'osiris';

    $conn = mysqli_connect($host, $user, $password, $database);
    $query = "SELECT * FROM topics WHERE topic_id='$topic_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    return $row;
}

function getUserByUsername($username) {
    $user = 'root';
    $password = '';
    $host = 'localhost';
    $database = 'osiris';

    $conn = mysqli_connect($host, $user, $password, $database);
    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    return $row;
}

function getUserByID($id) {
    $user = 'root';
    $password = '';
    $host = 'localhost';
    $database = 'osiris';

    $conn = mysqli_connect($host, $user, $password, $database);
    $query = "SELECT * FROM users WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    return $row;
}


function setActive($id, $text) {
    $user = 'root';
    $password = '';
    $host = 'localhost';
    $database = 'osiris';

    $conn = mysqli_connect($host, $user, $password, $database);
    $query = "SELECT * FROM users WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) == 0) {
        return 'error';
    }
    $last_login = date("Y-m-d H:i:s");
    $query = "UPDATE users SET last_login='$last_login' WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    $query = "UPDATE users SET active='$text' WHERE id='$id'";
    $result = mysqli_query($conn, $query);
}
?>