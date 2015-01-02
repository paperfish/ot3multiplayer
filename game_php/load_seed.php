<?php
include($_SERVER["DOCUMENT_ROOT"]."/nambaRush/php_config.php");
$playerNo=$_SESSION["playerNo"];
$matchId=$_SESSION["matchId"];

if($playerNo==1){
    $seed=time()/10;
    mysqli_query($con, "UPDATE matches SET seed=$seed WHERE matchId=$matchId");
    $query=mysqli_query($con,"SELECT * FROM matches WHERE matchId=$matchId");
    $row=mysqli_fetch_array($query);
    echo $row["seed"];
}
else{
    
        $query=  mysqli_query($con, "SELECT * FROM matches WHERE matchId=$matchId");
        $row=  mysqli_fetch_array($query);
        
    if($row["seed"]==null){

    }
    else{
    echo $row["seed"];
}
}