<?php
include_once('connection.php');
session_start();
$tempusername = $_SESSION['uiduid'];
if($tempusername) {
    $date = mysqli_real_escape_string($conn, $_POST['datefilter']);

    $date1 = substr("$date", 0, 19);

    $date1_end = substr("$date1", 6, 4);

    $date1_start = substr("$date1", 0, 2);

    $date1_mid = substr("$date1", 2, 4);

    $date1_time = substr("$date1", 10, 9);
    $date1_insert = $date1_end . $date1_mid . $date1_start . $date1_time;


    $date2 = substr("$date", 22, 40);

    $date2_end = substr("$date2", 6, 4);

    $date2_start = substr("$date2", 0, 2);

    $date2_mid = substr("$date2", 2, 4);

    $date2_time = substr("$date2", 10, 9);
    $date2_insert = $date2_end . $date2_mid . $date2_start . $date2_time;
    $location_data = array();


    $sql = "SELECT lat, lng FROM locations WHERE username = '$tempusername' AND timestamp BETWEEN '$date1_insert' AND '$date2_insert' ";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $location_data [] = [
            'lat' => $row["lat"],
            'lng' => $row["lng"],
            'count' => 1
        ];


        //convert the array and return the json file
    }
//print_r($location_data);
//echo json_encode($location_data);


    $rows = array();
    $table = array();
    $table['cols'] = array(
        array('label' => 'Type', 'type' => 'string'),
        array('label' => 'Count', 'type' => 'number')
    );

    $sql1 = "SELECT type,count(*) AS counter FROM activity WHERE username = '$tempusername' AND timestamp BETWEEN '$date1_insert' AND '$date2_insert' GROUP BY type";
    $result1 = mysqli_query($conn, $sql1);
    foreach ($result1 as $r) {
        $temp = array();
        if ($r['type'] != '') {
            $temp[] = array('v' => (string)$r['type']);
            $temp[] = array('v' => (int)$r['counter']);
            $rows[] = array('c' => $temp);
        }
    }
    $result1->free();
    $table['rows'] = $rows;

    date_default_timezone_set('Europe/Athens');

    $busiest_days_r = array();
    $busiest_d_table = array();
    $busiest_d_table['cols'] = array(
        array('label' => 'Day', 'type' => 'string'),
        array('label' => 'Type', 'type' => 'string'),
        array('label' => 'Count', 'type' => 'number')
    );
    $sql2 = "SELECT type,dayname(timestamp),count(*) AS counter FROM activity WHERE username = '$tempusername' AND timestamp BETWEEN '$date1_insert' AND '$date2_insert'  GROUP BY type,WEEKDAY(timestamp) ORDER BY type,count(*) DESC";
    $result2 = mysqli_query($conn, $sql2);

    $current_type_d = '';
    $next_type_d = '';
    foreach ($result2 as $row2) {
        $temp1 = array();
        $next_type_d = $row2['type'];
        if ($row2['type'] != '') {
            if ($current_type_d != $next_type_d) {
                $current_type_d = $next_type_d;
                $temp1[] = array('v' => (string)$row2['dayname(timestamp)']);
                $temp1[] = array('v' => (string)$row2['type']);
                $temp1[] = array('v' => (int)$row2['counter']);
                $busiest_days_r[] = array('c' => $temp1);
            }
        }
    }
    $result2->free();
    $busiest_d_table['rows'] = $busiest_days_r;


    $busiest_hours_r = array();
    $busiest_hours_table = array();
    $busiest_hours_table['cols'] = array(
        array('label' => 'Busiest Hour (24hr)', 'type' => 'number'),
        array('label' => 'Type', 'type' => 'string'),
        array('label' => 'Count', 'type' => 'number')
    );

    $sql = "SELECT type,HOUR(timestamp),count(*) AS counter FROM activity WHERE username = '$tempusername' AND timestamp BETWEEN '$date1_insert' AND '$date2_insert'   GROUP BY type,HOUR(timestamp) ORDER BY type,count(*) DESC";
    $result3 = mysqli_query($conn, $sql);


    $current_type = '';
    $next_type = '';
    foreach ($result3 as $hour) {
        $temp2 = array();
        $next_type = $hour['type'];
        if ($next_type != '') {
            if ($current_type != $next_type) {
                $current_type = $next_type;
                $temp2[] = array('v' => (int)$hour['HOUR(timestamp)']);
                $temp2[] = array('v' => (string)$hour['type']);
                $temp2[] = array('v' => (int)$hour['counter']);
                $busiest_hours_r[] = array('c' => $temp2);
            }
        }
    }
    $result3->free();
    $busiest_hours_table['rows'] = $busiest_hours_r;

    $allresults = array($location_data, $table, $busiest_d_table, $busiest_hours_table);
    echo json_encode($allresults);

}
else{
    header("Location:../demo1/loginpage.php");
}


