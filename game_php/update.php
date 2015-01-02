<?php
include($_SERVER["DOCUMENT_ROOT"]."/nambaRush/php_config.php");
$playerNo=$_SESSION["playerNo"];
$matchId=$_SESSION["matchId"];
$query=mysqli_query($con,"SELECT * FROM matches WHERE matchId=$matchId");
$row=mysqli_fetch_array($query);
echo '{"data":{';
echo '"current_no":'.'"'.$row["current_no"].'"';
echo ',"points1":'.'"'.$row["points1"].'"';
echo ',"points2":'.'"'.$row["points2"].'"';
echo ',"prev_no_owner":"'.$row["prev_no_owner"].'"';
echo '}}';