<?php
date_default_timezone_set("America/New_York");
header("Content-Type: text/event-stream\n\n");

require("php_config.php");
$opp2=$_SESSION["userId"];
while (1) {
  // Every second, sent a "ping" event.
  
  echo "event: ping\n";
  $curDate = date(DATE_ISO8601);
  echo 'data: {"time": "' . $curDate . '"}';
  echo "\n\n";
  
  // Send a simple message at random intervals.
  

  $query=mysqli_query($con,"SELECT *FROM matches WHERE opponent2=$opp2 AND match_state='requested'");
  
  if (mysqli_num_rows($query)>0) {
      $obj=  mysqli_fetch_object($query);
  $str=  '{"matches":'.json_encode($obj).'}';
    echo 'data: '.$str. "\n\n";
  }
  
  ob_flush();
  flush();
  sleep(3);
}