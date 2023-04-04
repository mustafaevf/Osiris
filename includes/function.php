<?php 

function encrypt($text) {
    $result = hash('SHA256', $text, true);
    return $result;
}

function decrypt($text) {
    
}

?>