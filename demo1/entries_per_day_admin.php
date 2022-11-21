<?php

include_once('connection.php');
session_start();
$rows = array();
$table = array();
$day=array();
$table['cols'] = array(
    array('label' => 'day', 'type' => 'string'),
    array('label' => 'count', 'type' => 'number')
);

$sql = "SELECT DAYNAME(timestamp), count(*) AS counter FROM locations GROUP BY WEEKDAY(timestamp) ";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_array($result)) {
    $day [] = array(
        'day' => $row['DAYNAME(timestamp)'],
        'count' => $row['counter'],
    );
}


foreach ($day as $row) {
    $temp = array();
    $temp[] = array('v' => (string)$row['day']);
    $temp[] = array('v' => (integer)$row['count']);
    $rows[] = array('c' => $temp);

}

$table['rows'] = $rows;
$jsonTable = json_encode($table, true);
echo $jsonTable;