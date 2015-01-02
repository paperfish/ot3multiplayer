<?php
include($_SERVER["DOCUMENT_ROOT"]."/nambaRush/php_config.php");
$playerNo=$_SESSION["playerNo"];
$matchId=$_SESSION["matchId"];
if($playerNo==1){
mysqli_query($con,"UPDATE matches SET opp1_state='ready_play' WHERE matchId=$matchId");
}
else if($playerNo==2){
    mysqli_query($con,"UPDATE matches SET opp2_state='ready_play' WHERE matchId=$matchId");
}