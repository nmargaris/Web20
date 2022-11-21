<?php

include_once ('connection.php');
session_start();
$tempusername = $_SESSION['uiduid'];
$users=array();
$sql="SELECT username FROM activity  GROUP BY username  ";
$result=mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result) )
{
    $users [] = array(
        'user' => $row['username'],
        'count' => 0
    ) ;
}
//echo  "THis the users array";
//echo "<br>";
//print_r($users);
//echo "<br>";
$sql1="SELECT username,count(*) AS counter FROM activity WHERE MONTH(timestamp) = MONTH(CURRENT_DATE()) AND YEAR(timestamp ) = YEAR(CURRENT_DATE()) AND (type='WALKING' OR type='ON_BICYCLE' OR type='ON_FOOT' OR type='RUNNING') GROUP BY username";
$result1=mysqli_query($conn, $sql1);
$scores = array();
while($row = mysqli_fetch_array($result1) )
{
    $scores [] = array(
        'user' => $row['username'],
        'count' => $row['counter']
    ) ;
}

//v size to xrismopoiw sto telos gia periptwsi poy einai entelws kenos o minas apo score wste na einai v=0 opote to top3 bazw aplis sinthiki oti se auth tin periptwsi bale onomata "-"
$v=sizeof($scores);
//echo "<br> size  ";
//echo $v;

// PRWTO SIMEIO EDWW POY DEN BGAZEI BUG GIA 2 MONO OIKOLOGOUS
//echo "<br>";
//echo  "THis the scores for each month";
//echo "<br>";
//print_r($scores);

$n=sizeof($users);


$m=sizeof($scores);

for($i=0; $i<$m; $i++)
{
    for($j=0; $j<$n; $j++)
    {
        if ($users[$j]['user']==$scores[$i]['user'])
        {

            $users[$j]['count']=$scores[$i]['count'];

        }
    }
}

//echo "<br>";echo "<br>";
//echo  "THis the scores for each month final";
//echo "<br>";
//print_r($users);

//menei na ta sortarw to users se fthinousa seira me to keyvalue count
function sortByOrder($a, $b) {
    return $b['count'] - $a['count'];
}

usort($users, 'sortByOrder');


//MEXRI EDW OLA KALA MOY BGAZEI STON PINAKA $users SE FTHINOUSA SEIRA OLA TA ONOMATA POY THELW. TO THEMA EINAI NA PERASV STO USER FINAL PINAKA WSTE GIA 3 KENH THESI NA VAZEI KENA
//echo "<br>";echo "<br>";
//echo  "THis the scores for each month before including the the top 3  $ user";

//echo "<br>";
//print_r($users);
$p=sizeof($users);
//echo "<br>";
//echo $p;
//echo "<br>";
$users_final= array();
if($p>=1)
{
    $users_final[0]['user'] = $users[0]['user'];
    $users_final[0]['count'] = $users[0]['count'];
    $users_final[0]['position'] = 1;
}
else
{
    $users_final[0]['user'] = "-";
    $users_final[0]['count'] = 0;
    $users_final[0]['position'] = 0;
}
if($p>=2)
{
    $users_final[1]['user'] = $users[1]['user'];
    $users_final[1]['count'] = $users[1]['count'];
    $users_final[1]['position'] = 2;
}
else
{
    $users_final[1]['user'] = "-";
    $users_final[1]['count'] = 0;
    $users_final[1]['position'] = 0;
}
if($p>=3)
{
    $users_final[2]['user'] = $users[2]['user'];
    $users_final[2]['count'] = $users[2]['count'];
    $users_final[2]['position'] = 3;
}
else
{
    $users_final[2]['user'] = "-";
    $users_final[2]['count'] = 0;
    $users_final[2]['position'] = 0;
}

//echo "<br>";
//echo  $users_final[0]['user'];
//echo "<br>";
//echo  $users_final[1]['user'];
//echo "<br>";
//echo  $users_final[2]['user'];
//echo "<br>";


//echo "<br>";echo "<br>";
//echo  "THis the scores for each month before including only the the top 3  user";
//echo "<br>";
//print_r($users_final);
//
$n=sizeof($users);

if($tempusername!=$users_final[0]['user'] && $tempusername!=$users_final[1]['user'] && $tempusername!=$users_final[2]['user'] )
{
    for($i=0; $i<$n; $i++)
    {
        if ($users[$i]['user']==$tempusername)
        {
            $users_final[3]['user']=$users[$i]['user'];
            $users_final[3]['position']=$i+1;
            $users_final[3]['count']=$users[$i]['count'];
        }

    }
}

//echo "<br>";echo "<br>";
//echo  "THis if the final final top 3 (or more) users  ";
//echo " " .$tempusername;
//echo "<br>";
//print_r($users_final);


//echo "<br>";echo "<br>";
//echo "now i need to have the firstName and the lastName ";
//this query is to include the firstname and last name
$sql2="SELECT firstName, lastName, username, user_id FROM users GROUP BY username" ;
$result2=mysqli_query($conn, $sql2);

while($row = mysqli_fetch_array($result2) )
{
    $users_temp[] = array(
        'user' => $row['username'],
        'first' => $row['firstName'],
        'last'=>$row['lastName'],
        'user_id'=>$row['user_id']
    ) ;
}
//echo "<br>";echo "<br>";
//print_r($users_temp);

$n=sizeof($users_temp);
for($i=0; $i<$n; $i++)
{
    $users_temp[$i]['last']=substr($users_temp[$i]['last'], 0 , 1) . '.';
}
//echo "<br>";echo "<br>";
//print_r($users_temp);


//exw ton pinaka $users_temp me keys to username FIrsname kai PRwto gramma lastname  me .
//exw to pinaka $users_final  pou exei tous top 3 (+thesi user)
//prepei na ta enwsw  ftiaxnontas pinaka $top3[] me key values firstname lastname count (isws kai position)
//to size tou $users_temp exei size $n
//to size tou $users_final exei size $k
$top3=array();

//echo "<br>";
//echo "<br>";
$l=0;
$k=sizeof($users_final);
for($i=0; $i<$n; $i++)
{
    for($j=0; $j<$k; $j++)
    {
        if($users_temp[$i]['user_id']==$users_final[$j]['user'])
        {
            $top3[$l]['name']=$users_temp[$i]['first'] . ' ' . $users_temp[$i]['last'];
            $top3[$l]['score']= $users_final[$j]['count'];
            $top3[$l]['position']= $users_final[$j]['position'];
            $l=$l+1;
        }
    }
}
//echo "<br>";
//echo "<br>";
//echo "This is the big change";
//echo "<br>";
//print_r($users_final);



function sortArray($a, $b) {
    return $b['score'] - $a['score'];
}

usort($top3, 'sortArray');
//echo "<br>";
//echo "<br>";
//echo "This is the FINAL big change";
//echo "<br>";
//print_r($top3);

if($users_final[0]['user']=="-" || $v==0)
{
    $top3[0]['name']="-";
    $top3[0]['score']= 0;
    $top3[0]['position']= 0;
}

//echo "<br>";
//echo $top3[0]['name'];
//echo "<br>";



if($users_final[1]['user']=="-" || $v==0)
{
    $top3[1]['name']="-";
    $top3[1]['score']= 0;
    $top3[1]['position']= 0;
}


if($users_final[2]['user']=="-" || $v==0)
{
    $top3[2]['name']="-";
    $top3[2]['score']= 0;
    $top3[2]['position']= 0;
}




$table = array();
$table['cols'] = array(
    array('label' => 'name', 'type' => 'string'),
    array('label' => 'position', 'type'=> 'number'),
    array('label' => 'score', 'type'=> 'number'),
);

$rows = array();
foreach ($top3 as $row)
{
    $temp=array();
    $temp[] = array('v' => (string) $row['name']);
    $temp[] = array('v'=> (integer) $row['position']);
    $temp[] = array('v'=> (integer) $row['score']);
    $rows[] = array('c'=> $temp);

}


$table['rows'] = $rows;
$jsonTable = json_encode($table, true);
//echo "<br>";
echo $jsonTable;


