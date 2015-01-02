<?php

include("../php_config.php");
$mid = $_SESSION["mid"];
if ($_GET["content"] == "info")
{
    $query = mysqli_query($con, "select player_id,color from match_players where match_id=$mid");
    $json = array();
    while ($row = mysqli_fetch_object($query))
    {
        $json[] = $row;
    }
    echo '{"users":' . json_encode($json) . '}';
}
else if ($_GET["content"] == "dim")
{
    $query = mysqli_query($con, "select id,xdim,ydim from matches where id=$mid");
    $json = array();
    $row = mysqli_fetch_object($query);
   
    echo '{"dim":' . json_encode($row) . '}';
}