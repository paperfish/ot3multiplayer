<?php include("php_config.php"); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Ot3</title>
        <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
        <!-- css files -->
        <link rel="stylesheet" href="css/header.css?">
        <link rel="stylesheet" href="css/main.css?">
        <style>
            #main{
                position:relative;
                top:60px;
            }
            .button
            {
                width:90%;
                text-align:center;
                position:relative;
                border-radius:3px;
                height:50px;
                font-size:25px;
                color:white;
                background:#0060FF;
                cursor:pointer;
                margin:auto;
                margin-bottom:10px;
                box-sizing:border-box;
            }

            .button:active
            {
                background:#146cff;
            }



            #or:before {
                content: "";
                display: block;
                border-top: solid 1px black;
                width: 100%;
                height: 1px;
                position: absolute;
                top: 15px;
                z-index: 1;
            }

            #or span {
                background:#609cff;
                padding: 0 20px;
                position: relative;
                z-index: 5;
                margin:auto;
                display:block;
                width:120px;
            }
            #scores{
                color:#fff;
                margin-top:30px;
                text-align:center;
                
            }
            .match table{
                width:100%;
                align:center;
            }
            .name{
                text-align:left;
            }
            .value{
                text-align:right;
            }
            table tr:nth-child(odd)
            {
                background:#3D87FF;
            }
            table{
                border:none;
                width:100%;
            }
            td{
                padding:10px;
            }
            .color{
                width:12px;
                height:12px;
                border-radius:3px;
                background:green;
                float:left;
                margin:10px;
            }
            .players,#main{
                margin:auto;
            }
            #game-over{
                color:white;
                text-align: center;
                font-size: 2em;
            }
        </style>
        <script src='jquery.js'></script>
        <script>

        </script>

    </head>
    <body>
        <div id="header">
            <img id="menu-btn" src="png/menu.png">
        </div>
        <div id="main">
            <div id="game-over">Game Over</div>
            <div id='scores'>
                <?php
                $mid = $_GET["mid"];

                $query = mysqli_query($con, "select * from match_players,players where match_id=$mid and players.id=match_players.player_id order by match_players.score desc") or die("error");
                echo '<div class="players">';
                echo '<table cellspacing="0" cellpadding="0">';
                while ($row = mysqli_fetch_array($query))
                {

                    echo '<tr>';
                    echo '<td><div class="color" style="background:' . $row["color"] . '"></div></td>';
                    echo '<td><div class="name">' . $row["name"] . '</div></td>';
                    echo '<td><div class="score">' . $row["score"] . '</div></td>';
                    echo '</tr>';
                }
                echo '</table>';
                echo '</div>';
                ?>
            </div>
            <div class="button" style="margin-top:10px;font-size:1.4em;padding:10px;" onclick="location.assign('matches.php')">Start A New Game</div>
        </div>
    </body>
</html>
