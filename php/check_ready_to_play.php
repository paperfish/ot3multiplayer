<?php
include($_SERVER["DOCUMENT_ROOT"]."/nambaRush/php_config.php");
$matchId=$_SESSION["matchId"];
$query=mysqli_query($con,"SELECT * FROM matches WHERE matchId=$matchId");
$row=mysqli_fetch_array($query);
echo '{"states":{';
echo '"opp1":'.'"'.$row["opp1_state"].'"';
echo ',"opp2":'.'"'.$row["opp2_state"].'"';
echo '}}';