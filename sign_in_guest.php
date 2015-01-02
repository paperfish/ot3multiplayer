<?php
$username=$_GET["username"];
require("php_config.php");
mysqli_query($con,"INSERT INTO users(username,online_state) VALUES('$username',true)");
session_start();
$_SESSION["user"]=$username;
$query=mysqli_query($con,"SELECT * FROM users WHERE username='$username'");
$row=mysqli_fetch_array($query);
$_SESSION["userId"]=$row["id"];
echo "success creating user. going to game";
header("Location:home.php");