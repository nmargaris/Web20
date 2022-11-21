<?php

include_once('connection.php');
session_start();
$rows = array();
$table = array();
$month = array();
$table['cols'] = array(
    array('label' => 'month', 'type' => 'string'),
    array('label' => 'rate %', 'type' => 'number')
);


$sql = "SELECT MONTHNAME(timestamp), count(*) AS counter FROM locations GROUP BY MONTH(timestamp) ";
$result = mysqli_query($conn, $sql);

$sql2= "SELECT * FROM locations";
$result2=mysqli_query($conn, $sql2);
$total = mysqli_num_rows($result2);

while ($row = mysqli_fetch_array($result)) {
    $month [] = array(
        'month' => $row['MONTHNAME(timestamp)'],
        'rate %' => $row['counter']/$total*100,
    );
}

$N=sizeof($month);

for($i=0; $i<$N; $i++)
{
    $month[$i]['rate %']=round($month[$i]['rate %'], 0.005);
}



//print_r($month);




$month_last=array();
for($i=0; $i<12; $i++)
{
    if ($i==0)
    {
        $month_last[] = array(
            'month'=>'January',
            'rate %'=> 0
        );
    }
    if ($i==1)
    {
        $month_last[] = array(
            'month'=>'February',
            'rate %'=> 0
        );
    }
    if ($i==2)
    {
        $month_last[] = array(
            'month'=>'March',
            'rate %'=> 0
        );
    }
    if ($i==3)
    {
        $month_last[] = array(
            'month'=>'April',
            'rate %'=> 0
        );
    }
    if ($i==4)
    {
        $month_last[] = array(
            'month'=>'May',
            'rate %'=> 0
        );
    }
    if ($i==5)
    {
        $month_last[] = array(
            'month'=>'June',
            'rate %'=> 0
        );
    }
    if ($i==6)
    {
        $month_last[] = array(
            'month'=>'July',
            'rate %'=> 0
        );
    }
    if ($i==7)
    {
        $month_last[] = array(
            'month'=>'August',
            'rate %'=> 0
        );
    }
    if ($i==8)
    {
        $month_last[] = array(
            'month'=>'September',
            'rate %'=> 0
        );
    }
    if ($i==9)
    {
        $month_last[] = array(
            'month'=>'October',
            'rate %'=> 0
        );
    }
    if ($i==10)
    {
        $month_last[] = array(
            'month'=>'November',
            'rate %'=> 0
        );
    }
    if ($i==11)
    {
        $month_last[] = array(
            'month'=>'December',
            'rate %'=> 0
        );
    }
}

$n=sizeof($month);
for($i=0; $i<$n; $i++)
{
    for($j=0; $j<12; $j++)
    {
        if ($month_last[$j]['month']==$month[$i]['month'])
        {
            $month_last[$j]['rate %'] = $month[$i]['rate %'];
        }
    }

}




foreach ($month_last as $row) {
    $temp = array();
    $temp[] = array('v' => (string)$row['month']);
    $temp[] = array('v' => (integer)$row['rate %']);
    $rows[] = array('c' => $temp);

}

$table['rows'] = $rows;
$jsonTable = json_encode($table, true);
echo $jsonTable;