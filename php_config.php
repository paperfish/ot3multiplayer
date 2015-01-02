<?php
$domain="sql207.byethost16.com";
$user="b16_15532243";
$password="android2014";
$db="b16_15532243_ot3";

$con=mysqli_connect($domain,$user,$password,$db) or die("cant connect to database");

session_start();