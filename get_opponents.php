<?php
require("php_config.php");
$query = mysqli_query($con, "SELECT * FROM users") or die("failed to query");
$myId = $_SESSION["userId"];
$json = array();

while ($obj = mysqli_fetch_array($query))
{
    if ($obj["id"] != $myId)
    {
        $oppId=$obj["id"];
        $query2=mysqli_query($con,"SELECT * FROM matches WHERE opponent1=$oppId AND opponent2=$myId AND match_state='requested'");
        $count=mysqli_num_rows($query2);
        $query3=mysqli_query($con,"SELECT * FROM matches WHERE opponent1=$myId AND opponent2=$oppId AND match_state='requested'");
        $count2=mysqli_num_rows($query3);
        //echo "count:".$count;
        if($count!=0){ 
             $match=mysqli_fetch_object($query2);
            $obj["oppMatch"]=$match;  
            
            //echo json_encode($obj["match"]);
        }
        else if($count2!=0){
             $match2=mysqli_fetch_object($query3);
            $obj["myMatch"]=$match2;
        }
        $json[] = $obj;
    }
}
echo '{"users":' . json_encode($json) . '}';

