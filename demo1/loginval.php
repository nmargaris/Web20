<?php


if (isset($_POST['submit'])) {
    require 'connection.php';
    $username = $_POST['username'];
    $password = $_POST['password'];

//    $errorEmpty = false;
//    $errorUsername = false;
//    $errorPassword = false;
   // $res = mysqli_query($conn, "SELECT username FROM users WHERE username='$username'");
   // $row = mysqli_fetch_row($res);


    if (empty($username) || empty($password)) {
//        $errorEmpty = true;
        echo "<span class='errormsg'>Fill in all fields</span>";
    } else{
        $sql = "SELECT * FROM admin WHERE username=? ";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "Sql error";
        } else {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $result1 = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                $hashedpwd = md5($password);
                $pwdcheck = strcmp($hashedpwd, $row['password']);
                if ($pwdcheck !== 0) {
                    echo "<span class='errormsg'>Password is wrong</span>";
//                    $errorpassword = true;
                } else if ($pwdcheck == 0) {
                    session_start();
                    $_SESSION['uid'] = $row['username'];
                    echo "success as admin";
                } else {
                    echo "Something Happened";
                }
            } else {
                echo "<span class='errormsg'>Username is wrong</span>";
//                $errorUsername = true;
            }
        }
    }

}

else {
    header("Location:../demo1/loginpage.php");
}






