<?php
require("../php_config.php");
$result=mysqli_query($con,"SELECT * FROM matches WHERE state='waiting'");
if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_array($result)){
    $match_id=$row["id"];
    $player_result=mysqli_query($con,"SELECT * FROM match_players WHERE match_id=$match_id");
    $player_count=mysqli_num_rows($player_result);
    $first_player=mysqli_fetch_array($player_result);
    $f_player_id=$first_player["player_id"];
    $pr=mysqli_query($con,"SELECT * FROM players WHERE id=$f_player_id");
    $player_row=mysqli_fetch_array($pr);
    $f_player_name=$player_row["name"];
    echo '<div class="match" onclick="mdim(\'join\','.$_SESSION["player_id"].','.$match_id.')">';
    echo '<table>';
    echo    '<tr>';
    echo        '<td class="name">Match '.$row["id"].'</td>';
    echo        '<td class="value">'.$f_player_name.'</td>';
    echo    '</tr>';
    echo    '<tr>';
    echo        '<td class="name">Players</td>';
    echo        '<td class="value"><span>'.$player_count.'<span>/5</span></td>';
    echo    '</tr>';
    
    echo '</table>';
    echo '</div>';
    }
}
?>
