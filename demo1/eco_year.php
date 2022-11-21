<?php
include_once ('connection.php');
session_start();
$tempusername = $_SESSION['uiduid'];
if($tempusername) {

    date_default_timezone_set('Europe/Athens');

   //$eco_type = array();

    $sql = "SELECT monthname(timestamp),count(*) AS counter FROM activity WHERE username='$tempusername' AND timestamp BETWEEN DATE_SUB(NOW(), INTERVAL 365 DAY) AND NOW() AND (type='WALKING' OR type='ON_BICYCLE' OR type='ON_FOOT' OR type='RUNNING' ) GROUP BY month(timestamp) ORDER BY month(timestamp)";
    $result = mysqli_query($conn, $sql);
    $eco_type = array();
    while ($row = mysqli_fetch_array($result)) {
        $eco_type [] = array(
            'Month' => $row['monthname(timestamp)'],
            'count' => $row['counter']
        );
    }

//print_r($eco_type);

    $sql1 = "SELECT MONTHNAME(timestamp),count(*) AS counter1 FROM activity  WHERE username='$tempusername' AND timestamp BETWEEN DATE_SUB(NOW(), INTERVAL 365 DAY) AND NOW()  GROUP BY MONTHNAME(timestamp) ORDER BY MONTH(timestamp) ";
    $result1 = mysqli_query($conn, $sql1);
    $eco_type_total = array();
    while ($row = mysqli_fetch_array($result1)) {
        $eco_type_total [] = array(
            'Month' => $row['MONTHNAME(timestamp)'],
            'count' => $row['counter1']
        );
    }

    $N = sizeof($eco_type);
    $M = sizeof($eco_type_total);
//echo "This is the eco type array";
//echo "<br>";
//for ($i=0; $i<$N; $i++)
//{
//    echo $eco_type[$i]['Month'];
//    echo " ";
//    echo $eco_type[$i]['count'];
//    echo " i=";
//    echo $i;
//    echo "<br>";
//}
//echo "<br>";
//echo "<br>";
//echo "This is the eco total array";
//echo "<br>";
//for ($i=0; $i<$M; $i++)
//{
//    echo $eco_type_total[$i]['Month'];
//    echo " ";
//    echo $eco_type_total[$i]['count'];
//    echo " i=";
//    echo $i;
//    echo "<br>";
//}
//
//echo "<br>";


    for ($i = 0; $i < 12; $i++) {
        if ($i == 0) {
            $eco_fill[] = array(
                'month' => 'January',
                'score' => 0
            );
        }
        if ($i == 1) {
            $eco_fill[] = array(
                'month' => 'February',
                'score' => 0
            );
        }
        if ($i == 2) {
            $eco_fill[] = array(
                'month' => 'March',
                'score' => 0
            );
        }
        if ($i == 3) {
            $eco_fill[] = array(
                'month' => 'April',
                'score' => 0
            );
        }
        if ($i == 4) {
            $eco_fill[] = array(
                'month' => 'May',
                'score' => 0
            );
        }
        if ($i == 5) {
            $eco_fill[] = array(
                'month' => 'June',
                'score' => 0
            );
        }
        if ($i == 6) {
            $eco_fill[] = array(
                'month' => 'July',
                'score' => 0
            );
        }
        if ($i == 7) {
            $eco_fill[] = array(
                'month' => 'August',
                'score' => 0
            );
        }
        if ($i == 8) {
            $eco_fill[] = array(
                'month' => 'September',
                'score' => 0
            );
        }
        if ($i == 9) {
            $eco_fill[] = array(
                'month' => 'October',
                'score' => 0
            );
        }
        if ($i == 10) {
            $eco_fill[] = array(
                'month' => 'November',
                'score' => 0
            );
        }
        if ($i == 11) {
            $eco_fill[] = array(
                'month' => 'December',
                'score' => 0
            );
        }
    }


    for ($i = 0; $i < $N; $i++) {
        for ($j = 0; $j < 12; $j++) {
            if ($eco_fill[$j]['month'] == $eco_type[$i]['Month']) {
//            echo "Hello";
//            echo " i=";
//            echo $i;
//            echo "<br>";
                $eco_fill[$j]['score'] = $eco_type[$i]['count'];

            }
        }
    }


    for ($i = 0; $i < $M; $i++) {
        for ($j = 0; $j < 12; $j++) {
            if ($eco_fill[$j]['month'] == $eco_type_total[$i]['Month']) {
                if ($eco_fill[$j]['score'] != 0) {
                    $eco_fill[$j]['score'] = ($eco_fill[$j]['score'] / $eco_type_total[$i]['count']) * 100;
                }
            }
        }
    }


//print_r($eco_fill);
    $table = array();
    $table['cols'] = array(
        array('label' => 'month', 'type' => 'string'),
        array('label' => 'score %', 'type' => 'number')
    );

    $rows = array();
    foreach ($eco_fill as $row) {
        $temp = array();
        $temp[] = array('v' => (string)$row['month']);
        $temp[] = array('v' => (integer)$row['score']);
        $rows[] = array('c' => $temp);

    }


    $table['rows'] = $rows;
    $jsonTable = json_encode($table, true);
    echo $jsonTable;

//$response = json_encode($table, true);
//echo $response;
}
else{
    header("Location:../demo1/loginpage.php");
}