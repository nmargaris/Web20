<?php
include_once ('connection.php');
session_start();
$tempusername = $_SESSION['uiduid'];


if($tempusername) {

    date_default_timezone_set('Europe/Athens');
    $current_month = date('m');
    $count_loc = 0;
    $eco_message = array();

    $count_eco = 0;

    $locations = array();

    $sql = "SELECT * FROM locations WHERE MONTH(timestamp) = MONTH(CURRENT_DATE()) AND YEAR(timestamp ) = YEAR(CURRENT_DATE()) ";
    $result = mysqli_query($conn, $sql);
//arithmos topothesiwn
    $count_loc = mysqli_num_rows($result);

    if ($count_loc == 0) {
        $eco_score = 0;
        $message = "You don't have any location history the current month";
        $eco_message[] = array("message" => $message);

        //echo $eco_message[0]["message"] ;
    } else {
        $query = "SELECT * FROM activity WHERE MONTH(timestamp) = MONTH(CURRENT_DATE()) AND YEAR(timestamp ) = YEAR(CURRENT_DATE()) AND username='$tempusername' AND (type='WALKING' OR type='ON_BICYCLE' OR type='ON_FOOT' OR type='RUNNING')";
        //arithmos oikologikwn type
        $result = mysqli_query($conn, $query);
        $count_eco = mysqli_num_rows($result);

        $eco_score = ($count_eco / $count_loc) * 100;

        $message = "Your eco score this month is " . $eco_score . "%";
        $eco_message[] = array("message" => $message);

        //echo $eco_message[0]["message"] ;
    }

    $response = json_encode($eco_message);
    echo $response;
}else{
    header("Location:../demo1/loginpage.php");
}

/*echo "Arithmos topothesiwn ",$count_loc;
echo "<br>";
echo  $current_month; */




