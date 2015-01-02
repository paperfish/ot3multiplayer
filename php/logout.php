<?php
require($_SERVER["DOCUMENT_ROOT"]."/nambaRush/php_config.php");
$userId=$_SESSION["userId"];
mysqli_query($con,"UPDATE users SET online_state=false WHERE id=$userId");
session_destroy();
header("Location: ../index.php");