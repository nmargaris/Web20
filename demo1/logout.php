<?php
session_start();
if (isset($_SESSION['uid'])) {
    unset($_SESSION['uid']);
    session_destroy();
    header('Location: ../demo1/loginpage.php');
}

?>