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

            #main>div{
                position:relative;
                top:90px;
                margin:auto auto;
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

            .button:active
            {
                background:#146cff;
            }

        </style>
        <script>

        </script>
    </head>
    <body>
        <div id="header">
            <img id="menu-btn" src="png/menu.png">
        </div>
        <div id="main">
            <div id="sign-in-member">
                <label style="font-size:23px;"><center><h2>Welcome <?php
                            include 'php_config.php';
                            echo $_SESSION['player_name'];
                            ?></h2></center></label>
                <div class="button" onclick="location.assign('matches.php?content=new')">Play!</div>
                <div class="button">Leaderboards</div>
            </div>
        </div>
    </body>
</html>