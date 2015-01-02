<?php
include($_SERVER["DOCUMENT_ROOT"]."/nambaRush/php_config.php");
$matchCode=$_GET["matchCode"];

$query=  mysqli_query($con, "SELECT * FROM matches WHERE matchId='$matchCode'");
$count=  mysqli_num_rows($query);
if($count===0){
    echo "code not found";
}
else if($count>0){
    $json=  mysqli_fetch_object($query);
    echo '{"match":'.json_encode($json).'}';
}
