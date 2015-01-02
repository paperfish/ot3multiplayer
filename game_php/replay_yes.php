<?php
include("../php_config.php");
$matchId=$_SESSION["matchId"];
$row=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM matches WHERE matchId=$matchId"));
	$opp1_state=$row["opp1_state"];
	$opp2_state=$row["opp2_state"];
	if($_SESSION["playerNo"]==1)
		$opp1_state="ready_replay";
	else
		$opp2_state="ready_replay";
if($row["seed"]!==null){
	mysqli_query($con,"UPDATE matches SET opp1_state='$opp1_state', opp2_state='$opp2_state', seed=null, current_no=1,points1=0, points2=0, prev_no_owner=null WHERE matchId=$matchId");
	if ($error=mysqli_error($con))
		echo $error;
}
else{
	mysqli_query($con,"UPDATE matches SET opp1_state='$opp1_state', opp2_state='$opp2_state' WHERE matchId= $matchId") or die("error2");
}