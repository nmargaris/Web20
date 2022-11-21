<?php
session_start();
include_once ('connection.php');
$tempusername = $_SESSION['uiduid'];
if($tempusername) {
    date_default_timezone_set('Europe/Athens');
    $date_data = array();
    $message = array();


    $query = "SELECT lastupload FROM users WHERE user_id='$tempusername' ";
    $last = mysqli_query($conn, $query);
    while ($last1 = mysqli_fetch_array($last)) {
        $last_updates [] = array(
            'lastupload' => $last1['lastupload']
        );
    }

    if ($last_updates[0]['lastupload'] == "0000-00-00 00:00:00") {
        $last_update = "You have not uploaded data yet";
        $message[] = array("lastupdt" => $last_update);
    } else {
        $last_update = "Your last upload was on " . $last_updates[0]['lastupload'];


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
        $message[] = array("lastupdt" => $last_update,
            "startdt" => $first_date,
            "lastdt" => $last_date);
    }
    $response = json_encode($message);
    echo $response;
}
else{
    header("Location:../demo1/loginpage.php");
}
