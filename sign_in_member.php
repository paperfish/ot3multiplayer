<?php
$username=$_GET["username"];
require("php_config.php");
$query=mysqli_query($con,"SELECT * FROM users WHERE username='$username'");
$count=mysqli_num_rows($query);
if($count==1){
    $row=mysqli_fetch_array($query);
    session_start();
    $_SESSION["user"]=$username;
    $_SESSION["userId"]=$row["id"];
    header("Location: home.php");
}
else {
    echo "wrong username";
}