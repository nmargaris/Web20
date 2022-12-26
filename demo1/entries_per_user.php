<?php
include_once ('connection.php');
session_start();

$user_count=array();
$sql="SELECT * FROM locations ";
$result=mysqli_query($conn, $sql);
$total = mysqli_num_rows($result);


$sql1= "SELECT username,count(*) AS counter FROM locations GROUP BY username ";
$result=mysqli_query($conn,$sql1);

while($row = mysqli_fetch_array($result) )
{
    $user_count [] = array(
        'user' => $row['username'],
        'rate %' => $row['counter']/$total*100
    ) ;
}


$N=sizeof($user_count);

for($i=0; $i<$N; $i++)
{
      $user_count[$i]['rate %']=round($user_count[$i]['rate %'], 0.005);
}



function sortByOrder($a, $b) {
    return $b['rate %'] - $a['rate %'];
}

usort($user_count, 'sortByOrder');



$user_final=array();
//An allaksw to i=5 me i=6 gia paradeigma tha tous top6 se %. Opote to i allazei posous xristes thelw na dw sinolika

for($i=0; $i<5; $i++)
{
    $user_final[$i]['user']=$user_count[$i]['user'];
    $user_final[$i]['rate %']=$user_count[$i]['rate %'];
}


$table = array();
$table['cols'] = array(
    array('label' => 'user', 'type' => 'string'),
    array('label' => 'rate %', 'type'=> 'number')
);

$rows = array();
foreach ($user_final as $row)
{
    $temp=array();
    $temp[] = array('v' => (string) $row['user']);
    $temp[] = array('v'=> (integer) $row['rate %']);
    $rows[] = array('c'=> $temp);

}
$table['rows'] = $rows;
$jsonTable = json_encode($table, true);
//echo "<br>";
echo $jsonTable;
