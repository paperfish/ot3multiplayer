<?php
$state = $_GET["state"];
$matchId = $_GET["matchId"];
$playerNo = $_GET["playerNo"];
if ($playerNo == 1)
    mysqli_query($con, "UPDATE matches SET opp1_state='$state' WHERE matchId=$matchId");
else if ($playerNo == 2)
    mysqli_query($con, "UPDATE matches SET opp2_state='$state' WHERE matchId=$matchId");
 