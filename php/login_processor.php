<?php

include("../php_config.php");
$_SESSION['login_flag'] = 0;

$name = $_POST['name'];
$password = $_POST['password'];
if ($_POST['content'] == "login")
{
	$result = mysqli_query($con,"select * from `players` where `name` = ".$name." and `password` = ".$password);
	if (mysqli_num_rows($result) != 1)
	{
		$_SESSION['login_flag'] = 1;
		header("location: ../index.php");
}
}
else if ($_POST['new'])
{

}
?>