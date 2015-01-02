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

            #0r
            {
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
        </style>
        <script src='jquery.js'></script>
        <script>
            $(function() {
                setInterval(function() {
                    getMatches()
                }, 1000);
            });
            function getMatches() {
                $.ajax({type: "get", url: "php/get_matches.php", success: function(result) {
                        if (result != "")
                            $("#games").html(result);
                        else
                            $("#games").html("No Available Matches")
                    }, error: function() {
                        setTimeout(function() {
                            getMatches()
                        }, 2000);
                    }});
            }

            function mdim(content, pid, mid)
            {
                var x = window.innerWidth;
                var y = window.innerHeight;

                if (content == 'join')
                {
                    location.assign('waiting.php?content=join&pid=' + pid + '&mid=' + mid+'&x='+x+'&y='+y);
                }
                else
                {
                    location.assign('waiting.php?content=new&mdim=' + mdim +'&x='+x+'&y='+y );
                }
            }
        </script>

    </head>
    <body>
        <div id="header">
            <img id="menu-btn" src="png/menu.png">
        </div>
        <div id="main">
            <div id='newgame'>
                <div class="button" style="background:#0060FF;" onclick="mdim('new')">Create New Game</div>
            </div>

            <div id="or" class="button" style="height:0px; font-size:16px;"><span>or Join Game</span></div>
            <div id='games'>
            </div>
        </div>
    </body>
</html>