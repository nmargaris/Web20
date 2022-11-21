<?php
session_start();
if (isset($_SESSION['uiduser'])) {
    unset($_SESSION['uiduser']);
    session_destroy();
    header('Location: ../demo1/loginpage.php');
}else {
    header('Location: ../demo1/loginpage.php');

}

?>
