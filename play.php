<?php
include("php_config.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Ot3 multiplayer</title>
        <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
        <!-- css files -->
        <link rel="stylesheet" href="css/header.css?">
        <link rel="stylesheet" href="css/main.css?">
        <link rel="stylesheet" href="css/play.css?v=1">
        <style>
            #main{
                position:relative;
                top:40px;
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
            #games{
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
            #games div:nth-child(odd)
            {
                background:#3D87FF;
            }
            /*play css*/
            #header{
                height:40px;
                background:#0060ff;
            }
            .color{
                width:12px;
                height:12px;
                border-radius:2px;
                background:green;
                float:left;
                margin:4px;
            }
            .user{
                float:left;
                font-size:0.7em;
            }
            .user div{
                float:left;
            }
            #users{
                height:40px;
                float:left;
                font-size:0.9em;
            }
            #number{
                width:50px;
                padding:5px;
                font-size:0.8em;
                text-align:center;
                font-size:16px;
                color:#609cff;
                background:white;
                box-sizing:border-box;
                height:40px;
                margin:auto;
            }
            body{
                color:white;
            }
            #name{
                float:left;
            }
            #time{
                font-size:2em;
            }
            #timer{
                text-align:center;
                position:fixed;
                top:0;
                bottom:0;
                left:0;
                right:0;
                background:#609cff;
                z-index:8000000;
            }
            #user{
                width:100px;
                margin:auto;
            }
            .number,.cnumber{
                width:50px;
                height:50px;
                border-radius:50%;
                background: #ffffff;
                text-align: center;
                line-height: 50px;
                color:#000000;
                cursor:pointer;
                box-shadow: 0 0 8px black;
                -webkit-transition:background 0.5s;
                transition:background 0.5s;
            }

        </style>
        <script src='jquery.js'></script>
        <script src="game_js/load_game.js"></script>
        <script>
            var users = {
            }
            var game = {
                myId: <?php echo $_SESSION["player_id"]; ?>,
                currentNo: 1
            }
            var rnum = '{"id":"0","no":"0"}';
            $(function() {
                getIdsColors();
                getDim();
                loadNumbers(findHighestNo(game.x, game.y));
                painter();
                play();
            });
            function getIdsColors() {
                $.ajax({type: "get", async: false, url: "php/get_info.php", data: {content: "info"}, success: function(reply) {
                        var obj = JSON.parse(reply);
                        for (i = 0; i < obj.users.length; i++) {
                            users[obj.users[i].player_id] = obj.users[i].color;
                            //alert(users[obj.users[i].player_id]+" "+obj.users[i].player_id)
                        }
                    }, error: function() {
                        getIdsColors();
                    }});
            }
            function getDim() {
                $.ajax({type: "get", async: false, url: "php/get_info.php", data: {content: "dim"}, success: function(reply) {
                        var obj = JSON.parse(reply);
                        game.x = obj.dim.xdim;
                        game.y = obj.dim.ydim - 40;
                        winW = game.x;
                        winH = game.y;
                        game.mid = obj.dim.id;
                        seed = game.mid;
                        $("#game").css("width", game.x + "px").css("height", game.y + "px");
                    }, error: function() {
                        getDim();
                    }});
            }
            function play() {
                $(".number").on("click", function() {
                    nobj = $(this);
                    var no = nobj.html();
                    if (no == game.currentNo) {
                        $.ajax({type: "get", url: "php/check_no.php", data: {no: no}, success: function(reply) {
                                if (reply == "accepted") {
                                    //alert("accept")
                                    nobj.css("background-color", playerColor).attr("className", "cnumber");
                                }
                                else  {
                                    //alert("denied");
                                }
                            }
                            , error: function() {
                                alert("error");
                            }
                        });
                    }
                });
            }

            function painter()
            {
                var player = {
                };
                //$.get("test.php",function(data){var player = JSON.parse(data); alert(player.id);});
                $.ajax({type: "get", url: 'php/updater.php?content=check&checker=' + rnum, success: function(reply)
                    {
                        if (reply != "no")
                        {
                            rnum = reply;
                            player = JSON.parse(reply);
                            var playerColor = users[Number(player.id)];
                            //alert(Number(player.id));
                            var numId = "#num" + player.no;
                            $("#number").html(Number(player.no) + 1);
                            $(numId).css("background-color", playerColor).attr("className", "cnumber");
                            game.currentNo = Number(player.no)+1;
							if(game.currentNo > game.highestNo)
							{
								location.assign("score.php?mid="+<?php echo $_SESSION['mid']; ?>);
							}
                            painter();
                        }
                        else
                        {
                            setTimeout("painter()", 100);
                        }
                    },
                    error: function() {
                        painter();
                    }});
            }
        </script>
        <script>
            $(function() {

                var time_left = 4;
                setInterval(function() {
                    if (time_left == 0) {
                        $("#timer").css("display", "none");
                        //update();
                    }
                    else {
                        $("#time").html(time_left);
                        time_left = time_left - 1;
                    }
                }, 1000);
            });
        </script>
    </head>
    <body>
        <div id="header">
            <div id="users">
                <?php
                ?>
            </div>
            <div id="number">
                1
            </div>
        </div>
        <div id="main">
            <div id="game">
            </div>
        </div>
        <div id="timer">
            <table width="100%" height="100%">
                <tr>
                    <td>
                        <div id="user">
                            <div class="color" style="margin:8px;background:<?php
                            $pid = $_SESSION["player_id"];
                            $mid = $_SESSION["mid"];
                            $query = mysqli_query($con, "select * from match_players where player_id=$pid and match_id=$mid");
                            $row = mysqli_fetch_array($query);
                            echo $row["color"];
                            ?>"></div>
                            <div id="name"><?php echo $_SESSION["player_name"]; ?></div>
                        </div>
                        <div style="clear:both;">The game will start in </div>
                        <div id="time">5</div>
                    </td>
                </tr>
        </div>
    </body>
</html>