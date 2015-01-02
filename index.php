<?php
if (isset($_SESSION["user"]))
{
    header("Location: home.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Ot3</title>
        <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
        <!-- css files -->
        <link rel="stylesheet" href="css/header.css">
        <link rel="stylesheet" href="css/main.css">
        <style>
            body,input,button
            {
                font-family:segoe print;
                color:#609cff;
            }

            body
            {
                background:#609cff;
            }

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
                width:50%;
            }
            body{
                color:#222222;
            }
            #main{
                position:absolute;
                top:50px;
                bottom:0;
                width:100%;

            }
            #main form{
                position:relative;
                top:90px;
                margin:auto auto;
            }
            #header{
                top:0;
                background:url('banner.png?v=9');
                background-size:auto 50px;
            }
            @font-face {
                font-family: segoe print;
                src: url(segoepr.ttf);
            }
            .error
            {
                color:red;
                text-align:center;
            }
        </style>
        <script>

        </script>
        <link rel="icon" href="logo.png">
    </head>
    <body>
        <div id="header" style="z-index:2;">
        </div>
        <div id="main">
            <form id="sign-in-member" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="get">
                <center><h2>Welcome</h2></center>
                <div class="error" style="color:white;">
                    <?php
                    if (isset($_GET['login']) or isset($_GET['signup']))
                    {
                        include("php_config.php");

                        $name = $_GET['name'];
                        $password = $_GET['password'];
                        if (isset($_GET['login']))
                        {
                            $result = mysqli_query($con, "select * from `players` where `name` = '" . $name . "' and `password` = '" . $password . "'");
                            if (mysqli_num_rows($result) != 1)
                            {
                                echo "Trouble logging in!<br>Carefully re-enter you details or create new account.";
                            }
                            else
                            {
                                $array = mysqli_fetch_array($result);
                                mysqli_query($con, "update `players` set `state` = 'online' where `id` = " . $array['id']);
                                $_SESSION["player_id"]=$array["id"];
                                $_SESSION['player_name'] = $_GET['name'];
                                
                                header("Location:home.php");
                            }
                        }
                        else if (isset($_GET['signup']))
                        {
                            $result = mysqli_query($con, "select * from `players` where `name` = '" . $name . "' ");
                            if (mysqli_num_rows($result) == 1)
                            {
                                echo "The name you have chosen belongs to an active account. Pick another name and try again.";
                            }
                            else
                            {
                                mysqli_query($con, 'insert into `players`(name,password,state) values("' . $name . '","' . $password . '","online")');
                                $_SESSION['player_name'] = $_GET['name'];
                                header("Location:home.php");
                            }
                        }
                    }
                    ?>
                </div>
                <input id="sign-in-username" class="form-input" type="text" placeholder="Username" name="name" required="required">
                <input id="sign-in-password" class="form-input" type="password" placeholder="Password" name="password" required="required">
                <button class="form-input btn" name='login'>Sign In</button>
                <button class="form-input btn" name='signup'>Sign Up</button>
            </form>
        </div>
    </body>
</html>