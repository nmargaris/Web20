<?php
include_once ("connection.php");

$username = mysqli_real_escape_string($conn, $_POST["username"] );
$password = mysqli_real_escape_string($conn, $_POST["password"] );
$email = mysqli_real_escape_string($conn, $_POST["email"] );
$lname = mysqli_real_escape_string($conn, $_POST["lname"] );
$fname = mysqli_real_escape_string($conn, $_POST["fname"] );
$cipher_method = 'aes-128-ctr';
$enc_iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($cipher_method));
$uid = openssl_encrypt($email ,$cipher_method,$password,0, $enc_iv );

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
elseif ( 0 == preg_match('~[0-9]~', $temp) ) {
    echo "You must have at least one number at your password";
}
elseif ( 0 == preg_match('~[A-Z]~', $temp) ) {
    echo "You must have at least one upper letter at your password";
}
elseif ( 0 == preg_match('/[#$%^&@*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/', $temp) ) {
    echo "You must have at one special symbol in your password (@!$%^....)";
}
else {
    //make the instert to the database web20 , table users
    $sql = "INSERT INTO users VALUES('', '$username','$password','$email','$lname','$fname','$uid','')";
    //check if the insertion was made
    if (mysqli_query($conn, $sql)) {
        echo "Inserted Successfully";

    } else {
        echo "Insertion failed" ;
//
    }
}
exit;
?>