<?php
include("../php_config.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Ot3</title>
        <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
        <!-- css files -->
        <link rel="stylesheet" href="../css/header.css?">
        <link rel="stylesheet" href="../css/main.css?">
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
			.color{
                width:12px;
                height:12px;
                border-radius:2px;
                background:green;
                float:left;
                margin:10px;
            }
			
        </style>
        <script src='../jquery.js'></script>
        
    </head>
    <body>
        
        <div id="main">
        
    </body>
</html>