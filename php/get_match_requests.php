<?php
header("Content-Type: text/event-stream\n\n");
include("../php_config.php");
$uid = $_SESSION["userId"];
while (1)
{
    $query=mysqli_query($con, "SELECT * FROM matches WHERE opp2=$uid AND match_state='requested");
    $count=mysqli_num_rows($query);
    if($count>0){
        $json=array();
        while($obj=  mysqli_fetch_object($query)){
            $json[]=$obj;
        }
        echo '{"mreqs":'.json_encode($json).'}';
    }
    sleep(3);
}