<?php
include 'php_config.php';
$_SESSION["mid"] = $mid = $_GET['mid'];
if (isset($_GET['content']) and $_GET['content'] == 'new')
{
    mysqli_query($con, 'insert into `matches`(xdim,ydim) values(' . $_GET['x'] . ',' . $_GET['y'] . ')');
    $mid = mysqli_insert_id($con);
    $_SESSION["mid"] = $mid;
    $pid = $_SESSION['player_id'];
    mysqli_query($con, 'insert into `match_players`(player_id,match_id) values(' . $pid . ',' . $mid . ')');
}
else if (isset($_GET['content']) and $_GET['content'] == 'join')
{
    $mid = $_GET['mid'];
    $pid = $_GET['pid'];
    $q_player = mysqli_query($con, "select * from match_players where match_id=$mid and player_id=$pid");
    $q_no_players = mysqli_query($con, "select * from match_players where match_id=$mid");
    if (mysqli_num_rows($q_player) == 0 && mysqli_num_rows($q_no_players) < 5)
    {
        $dims = mysqli_query($con, "select `xdim`,`ydim` from `matches` where `id` = " . $_GET['mid']);

        $dims = mysqli_fetch_array($dims);
        $dimx = $dims['xdim'];
        $dimy = $dims['ydim'];

        if ($dimx > $_GET['x'])
            $dimx = $_GET['x'];

        if ($dimy > $_GET['y'])
            $dimy = $_GET['y'];


        mysqli_query($con, 'update `matches` set `xdim` = ' . $dimx . ', `ydim` = ' . $dimy . ' where id=' . $_GET["mid"]) or die("tell me your secrets");



        $pid = $_GET['pid'];
        mysqli_query($con, 'insert into `match_players`(player_id,match_id) values(' . $pid . ',' . $mid . ')');
    }
    else if (mysqli_num_rows($q_no_players) >= 5)
    {
        header("Location: matches.php");
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Ot3</title>
        <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
        <!-- css files -->
        <link rel="stylesheet" href="css/header.css?">
        <link rel="stylesheet" href="css/main.css?">
        <style>
            .form-input{
                display:block;
                width:50%;

                padding:10px;
            }

            #sign-up,#sign-in-member{

                width:250px;
                margin:auto;
            }

            #create-username-input,#sign-in-username,#sign-in-password{
                width:227px;
                text-align:center;
                margin-bottom:10px;
                border:1px solid #888888;
            }

            .btn{
                float:left;
                width:90%;
                margin:auto;
                margin:10px 0px 10px 0px;
            }


            .button
            {
                width:90%;
                text-align:center;
                position:relative;
                margin-left:5%;
                border-radius:3px;
                height:50px;
                font-size:25px;
                color:white;
                background:#0060FF;
                cursor:pointer;
                margin-bottom:7px;
            }
            #main{
                width:96%;
            }
            .button:active
            {
                background:#146cff;
            }
            .player{
                padding:5px;
                margin:auto;
            }
            #players{
                padding:5px;
            }
            div{
                box-sizing:border-box;
            }

            #players div:nth-child(odd)
            {
                background:#3D87FF;
            }
            #match-info{
                text-align:center;
            }
            body{
                color:white;
            }
            #wait{
                display:none;
                z-index:1000;
                position:fixed;
                top:50px;
                bottom:0;
                left:0;
                right:0;
                background:white;

            }
            .color{
                width:12px;
                height:12px;
                border-radius:2px;
                background:green;
                float:left;
                margin:10px;
            }

        </style>
        <script src="jquery.js"></script>
        <script>
            var c = 0;
            var f = "";
            var d = {
                do: ""
            };
            d.do = "nah!";
            $(function() {
                getPlayers();

            });
            function getPlayers() {

                c++;
                //$("#no").html(c);
                $.ajax({type: "get", url: "php/players.php", success: function(reply) {

                        $("#players").html(reply);
                        var num = (document.getElementById("hidden-no").innerHTML);
                        try {
                            if (document.getElementById("hidden").innerHTML = "fsfs")
                                num = 5;
                        }
                        catch (e) {

                        }
                        if (num == 5) {
                            location.assign("play.php");
                        }
                        else {
                            setTimeout(function() {
                                getPlayers();
                            }, 250);
                        }
                    }, error: function() {
                        setTimeout(function() {
                            getPlayers()
                        }, 1000);
                    }}
                );
            }
            function startAnyway() {
                $.get("php/players.php?sa=1");

            }
        </script>
    </head>
    <body>
        <div id="header">
            <img id="menu-btn" src="png/menu.png">
        </div>
        <div id="main">
            <div id="match-info">
                <div style="font-size:2em;">Match by 
                    <?php
                    $result = mysqli_query($con, "select * from match_players,players where match_id=$mid and match_players.player_id = players.id order by match_players.id");
                    $row = mysqli_fetch_array($result);
                    $f_player_name = $row["name"];

                    echo $f_player_name;
                    ?>
                </div>
                <div>Standing by...</div>

            </div>
            <div style="margin-top:10px;font-size:1.2em;text-align:center">Players</div>
            <div id="players">

            </div>
            <div id="no"></div>

        </div>
    </body>
</html>