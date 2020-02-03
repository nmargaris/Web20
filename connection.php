<?php
    $db_host = 'localhost';
    $db_name = 'web20';
    $db_username = 'root';
    $db_password = '';

    $conn = mysqli_connect($db_host,$db_username,$db_password,$db_name);

    if(!$conn){
        die("Connection failed:".mysqli_connect_error());
    }
?>
