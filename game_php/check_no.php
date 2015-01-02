<?php
include($_SERVER["DOCUMENT_ROOT"]."/nambaRush/php_config.php");
$client_no=$_GET["no"];
$matchId=$_SESSION["matchId"];
$playerNo=$_SESSION["playerNo"];
$query=mysqli_query($con,"SELECT * FROM matches WHERE matchId=$matchId");
$row=mysqli_fetch_array($query);
$server_no=$row["current_no"];
$my_points=$row["points".$playerNo];

if($client_no==$server_no){
	echo 1;
	$server_no++;
	$my_points++;
	mysqli_query($con,"UPDATE matches SET current_no=$server_no WHERE matchId=$matchId");
	mysqli_query($con,"UPDATE matches SET prev_no_owner=$playerNo WHERE matchId=$matchId");
	if($playerNo==1){
		mysqli_query($con,"UPDATE matches SET points1=$my_points WHERE matchId=$matchId");
	}
	else if($playerNo==2){
		mysqli_query($con,"UPDATE matches SET points2=$my_points WHERE matchId=$matchId");
	}
}
else{
	echo 0;
}