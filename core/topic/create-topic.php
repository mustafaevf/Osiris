<?php 
require_once('../../includes/config.php');
session_start();
$title = htmlspecialchars($_POST['title']);
$description = htmlspecialchars($_POST['description']);
$tags = htmlspecialchars($_POST['tags']);




?>