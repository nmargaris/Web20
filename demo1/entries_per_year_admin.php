<?php
include_once ('connection.php');
session_start();
$rows=array();
$table=array();
$year=array();
$table['cols'] = array(
    array('label' => 'year', 'type' => 'string'),
    array('label' => 'count', 'type' => 'number')
);

$sql="SELECT YEAR(timestamp), count(*) AS counter FROM locations GROUP BY YEAR(timestamp) ";
$result=mysqli_query($conn, $sql);

while ($row = mysqli_fetch_array($result)) {
        $year [] = array(
            'year' => $row['YEAR(timestamp)'],
            'count' => $row['counter'],
        );
}


foreach ($year as $row)
{
    $temp=array();
    $temp[] = array('v' => (string) $row['year']);
    $temp[] = array('v'=> (integer) $row['count']);
    $rows[] = array('c'=> $temp);

}

$table['rows'] = $rows;
$jsonTable = json_encode($table, true);
echo $jsonTable;
//print_r($year);


