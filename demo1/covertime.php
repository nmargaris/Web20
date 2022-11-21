<?php
include_once ('connection.php');
session_start();
$tempusername = $_SESSION['uiduid'];
if($tempusername) {
    $date_data = array();

    $sql = "SELECT timestamp FROM locations WHERE username='$tempusername' ORDER BY timestamp ";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $date_data [] = array(
            'timestamp' => $row['timestamp']
        );

    }

//$cover_json =json_encode($date_data);

    $first_date = $date_data[0]['timestamp'];
    $last_date = $date_data[sizeof($date_data) - 1]['timestamp'];
    echo "Your data covers from ", $first_date, " until ", $last_date;

    exit;
}
else{
    header("Location:../demo1/loginpage.php");
}