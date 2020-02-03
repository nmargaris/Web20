<?php
    include_once ("connection.php");

    $username = mysqli_real_escape_string($conn, $_POST["username"] );
    $password = mysqli_real_escape_string($conn, $_POST["password"] );
    $email = mysqli_real_escape_string($conn, $_POST["email"] );
    $lname = mysqli_real_escape_string($conn, $_POST["lname"] );
    $fname = mysqli_real_escape_string($conn, $_POST["fname"] );
    $uid = rand(0,50);

    $temp = $password;
    $password = (md5($password));

    //check the username unique
    $res = mysqli_query($conn, "SELECT username FROM users WHERE username='$username'");
    $row = mysqli_fetch_row($res);

    if ( empty($username) || empty($password) || empty($email) || empty($lname) || empty($fname) ) {
        echo "You must fill all your data. ";
    }
    elseif ( $row > 0 ) {
        //check if the username has already been taken
        echo "Username $username has already been taken";
    }
    //check the required length of the password
    elseif ( strlen($temp) < 8 ) {
        echo "Your password must be at least 8 characters ";
    }
    else {
        //make the instert to the database web20 , table users
        $sql = "INSERT INTO users VALUES('', '$username','$password','$email','$lname','$fname','$uid')";
        //check if the insertion was made
        if (mysqli_query($conn, $sql)) {
            echo "Inserted Successfully ";
            
        } else {
            echo "Insertion failed" ;
//
        }
    }

?>