<html>
    <head>
        <style>
            
        </style>
        <script src="jquery.js"></script>
        <script>
		
		
		function painter()
		{
			var player = {
			};
			//$.get("test.php",function(data){var player = JSON.parse(data); alert(player.id);});
		$.ajax({type:"get", url:'updater.php?content=check&checker='+rnum, success: function(reply)
		{
			alert(reply);
			player = JSON.parse(reply);
			//playerColor = users[player.id];
			numId = "num" + player.no;
			
			alert(numId);
		}, 
		error: function(){alert("error");}});
		}
		</script>
    </head>
    <body>
        <div class="ans" onClick="painter()">no</div>
    </body>
</html>