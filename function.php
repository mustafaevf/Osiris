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

?>