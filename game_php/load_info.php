<?php
include($_SERVER["DOCUMENT_ROOT"]."/nambaRush/php_config.php");
$matchId=$_SESSION["matchId"];
$playerNo=$_SESSION["playerNo"];
$playerId=$_SESSION["userId"];
$playerName=$_SESSION["user"];
$query=mysqli_query($con,"SELECT * FROM matches WHERE matchId=$matchId");
$row=  mysqli_fetch_array($query);
if($playerNo==1){
	$oppNo=2;
    $oppId=$row["opponent2"];
}
else{
	$oppNo=1;
    $oppId=$row["opponent1"];
}
$query=mysqli_query($con,"SELECT * FROM users WHERE id=$oppId");
$row=  mysqli_fetch_array($query);
$oppName=$row["username"];

$arr=array("matchId"=>$matchId,"playerNo"=>$playerNo,"playerId"=>$playerId,"playerName"=>$playerName,"oppId"=>$oppId,"oppName"=>$oppName,"oppNo"=>$oppNo);
echo '{"game":'.json_encode($arr).'}';