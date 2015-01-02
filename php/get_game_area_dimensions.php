<?php
include($_SERVER["DOCUMENT_ROOT"]."/nambaRush/php_config.php");
$gameH=$_GET["gameH"];
$gameW=$_GET["gameW"];
$playerNo=$_SESSION["playerNo"];
$matchId=$_SESSION['matchId'];
$query=mysqli_query($con,"SELECT * FROM matches WHERE matchId=$matchId");
$row=mysqli_fetch_array($query);

if($playerNo==1){
	mysqli_query($con,"UPDATE matches SET gameW1=$gameW, gameH1=$gameH WHERE matchId=$matchId");
		$query=mysqli_query($con,"SELECT *FROM matches WHERE matchId=$matchId");
		$row=mysqli_fetch_array($query);
		$gameW2=$row["gameW2"];
		$gameH2=$row["gameH2"];
		
	if($gameH2==null || $gameW2==null){

	}
	else{

	$minH=$gameH;
	if($gameH2<$minH){
		$minH=$gameH2;
	}
	$minW=$gameW;
	if($gameW2<$minW){
		$minW=$gameW2;
	}
	//return smallest width and height as json
echo '{"size":'.'{"width":'.$minW.','.'"height":'.$minH.'}'.'}';
}
}
else if($playerNo==2){
	mysqli_query($con,"UPDATE matches SET gameW2=$gameW, gameH2=$gameH WHERE matchId=$matchId");
	
		$query=mysqli_query($con,"SELECT *FROM matches WHERE matchId=$matchId");
		$row=mysqli_fetch_array($query);
		$gameW1=$row["gameW1"];
		$gameH1=$row["gameH1"];
		
	if($gameH1==null || $gameW1==null){

	}
	else{

	$minH=$gameH;
	if($gameH1<$minH){
		$minH=$gameH1;
	}
	$minW=$gameW;
	if($gameW1<$minW){
		$minW=$gameW1;
	}
	//return smallest width and height as json
echo '{"size":'.'{"width":'.$minW.','.'"height":'.$minH.'}'.'}';
}
}

