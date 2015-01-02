<?php
include("../php_config.php");
$opp1=$_SESSION["userId"];
$opp2=$_GET["uid"];
$count1=mysqli_num_rows(mysqli_query($con,"SELECT * FROM matches WHERE opponent1=$opp1 AND opponent2=$opp2 AND match_state='requested'"));
$count2=mysqli_num_rows(mysqli_query($con,"SELECT * FROM matches WHERE opponent1=$opp2 AND opponent2=$opp1 AND match_state='requested'"));
if($count1==0 && $count2==0){
mysqli_query($con,"INSERT INTO matches(opponent1,opponent2,match_state) VALUES($opp1,$opp2,'requested')") or die("could not query");
$_SESSION[$opp2]=mysqli_insert_id($con);
echo $_SESSION[18];
}