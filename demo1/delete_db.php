<?php

include_once ('connection.php');
session_start();


$sql1="TRUNCATE TABLE locations";
$result1=mysqli_query($conn, $sql1);
$sql2="TRUNCATE TABLE activity";
$result2=mysqli_query($conn, $sql2);
if($result1 && $result2)
{
    echo "Data successfully deleted";
    //prepei afou diagrafontai ola ta arxeia twn xristwn gia kathe xristi to lastupload sthn basi na ginetai "0000-00-00 00:00:00"
    $sql3="UPDATE users SET lastupload='0000-00-00 00:00:00'";
    $result3=mysqli_query($conn, $sql3);
}
else
{
    echo "Deletion failed";
}