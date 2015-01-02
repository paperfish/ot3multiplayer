<?php

include "../php_config.php";

$mid = $_SESSION["mid"];
$pid = $_SESSION["player_id"];

$result = mysqli_query($con, "select * from match_players,players where match_id=$mid and match_players.player_id = players.id order by match_players.id");
$str = "";
$count = mysqli_num_rows($result);
$mquery = mysqli_query($con,"select * from matches where id=$mid");
$mrow = mysqli_fetch_array($mquery);
$state=$mrow["state"];
if (mysqli_num_rows($result) > 0 and !isset($_GET['sa']))
{
    $i = 0;
    while ($row = mysqli_fetch_array($result))
    {
        //read and assign colors
        $color_arr = explode(",", file_get_contents("../colors.txt"));

        $str.=
                '<div class="player">' .
                '<table>' .
                '<tr>' .
                '<td><div class="color" style="background:' . $color_arr[$i] . '"></div>' . $row["name"] . '</td>' .
                '<td></td>' .
                '</tr>' .
                '<tr>' .
                '<td>' . $row["wins"] . ' wins</td>' .
                '<td>' . $row["losses"] . ' losses</td>' .
                '</tr>' .
                '<div style="display:none;" class="id"></div>' .
                '</table>' .
                '</div>';
        //store the color in db
        $spid=$row['player_id'];
        mysqli_query($con, "update match_players set color='$color_arr[$i]' where match_id=$mid and player_id=$spid");
       
        $i++;
        
    }

    $result = mysqli_query($con, "select * from match_players,players where match_id=$mid and match_players.player_id = players.id order by match_players.id asc");
    $row = mysqli_fetch_array($result);
    $f_id = $row["id"];
    if ($_SESSION["player_id"] == $f_id && $count > 1)
    {
        $str.='
            <div class="button" style="margin: 15px;color:#609cff;background:white;" id="startanyway" onclick="startAnyway()">Start Anyway</div>' ;
                
    }
    $str .='<div style="display:none;" id="hidden-no">' . $count . '</div>';
    echo $str;
    
    
    
}

if($state == "starting")
{
    echo '<div id="hidden" style="display:none;">fsfs</div>';
}

if(isset($_GET["sa"])){
    mysqli_query($con,"update matches set state = 'starting' where id = $mid");
}
?>