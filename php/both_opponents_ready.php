<?php
include($_SERVER["DOCUMENT_ROOT"]."/nambaRush/php_config.php");
$matchId=$_SESSION["matchId"];
$query=mysqli_query($con,"SELECT * FROM matches WHERE matchId=$matchId");
$row=mysqli_fetch_array($query);
if($row["opp1_state"]=="ready" && $row["opp2_state"]=="ready"){
	echo "ready";
}