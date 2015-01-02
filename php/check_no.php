<?php
include ("../php_config.php");
$no=$_GET["no"];
$mid=$_SESSION['mid'];
$pid=$_SESSION['player_id'];
$query=mysqli_query($con,"select sstring from matches where id=$mid") or die("error");
$row=mysqli_fetch_array($query);
$sstring=$row[0];
$obj=json_decode($sstring);
$ustring='{"id":"'.$pid.'","no":"'.$no.'"}';

$nno=$obj->no+1;

if($no==$nno){
    
    mysqli_query($con,"update matches set sstring='$ustring' where id=$mid") or die("error");
    mysqli_query($con,"update match_players set match_players.score=match_players.score+1 where match_id=$mid and player_id=$pid");
    echo "accepted";
}
else{
   echo $sstring;
}