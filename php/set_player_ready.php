<?php
include($_SERVER["DOCUMENT_ROOT"]."/nambaRush/php_config.php");
$playerNo=$_GET["playerNo"];
$matchId=$_GET["matchId"];
if($playerNo==1){
mysqli_query($con,"UPDATE matches SET opp1_state='ready' WHERE matchId=$matchId");
}
else if($playerNo==2){
    mysqli_query($con,"UPDATE matches SET opp2_state='ready' WHERE matchId=$matchId");
}