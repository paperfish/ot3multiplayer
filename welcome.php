<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1,max-scale=1,user-scalable=no">
    <title>Welcome <?php echo $_SESSION["user"] ?></title>

    <!-- styles -->
    <style>
        body{
            background:#17e1ff;
            font-family: roboto;
            color:#000;
            font-size:23px;
        }
        
        #welcome-header{
          
        }
        #welcome-header #name{
            font-weight:bold;
            font-size:32px;
        }
        #welcome-header .thin{
            font-weight:normal;
            font-size:25px;
        }
        #instructions-header{
            font-weight:200;
        }
    </style>
</head>
<body>
<div id="welcome-header">
    <div id="name"><?php echo $_SESSION["user"] ?>,</div>
    <div class="thin">
        
        Welcome To nambaRush
    </div>

</div>
<div id="welcome-main">
    <div id="instructions-header">
        How To Play:
    </div>
    <div id="instructions">
        Numbers appear in the game. Tap them in their respective order..
    </div>
    <div id="demo">

    </div>
</div>
</body>
</html>