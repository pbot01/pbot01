<html>
	<head> 
		<script>
			$.ajax({ 
			   type : "GET", 
			   url : "https://api.line.me/v2/bot/message/10016075093981/content", 
			   beforeSend: function(xhr){xhr.setRequestHeader('Authorization', 'Bearer la3nQ7rJ7FR8r0eTQPiYFfeE1vHNVIcdS4OoqTvWuRw/tGu9WG/joyP4vPOnQBqrv1yoQeM09Zpft/LYPj4FcqF0fEHWXLbqzb1gaTZSxuVOwQrSKYZLYDck8hN/7PCuKeEWSlXfuR2iLyUTTRgovwdB04t89/1O/w1cDnyilFU=');},
			   success : function(result) { 
			       //set your variable to the result 
			   }, 
			   error : function(result) { 
			     //handle the error 
			   } 
			 }); 
		</script>
	</head>
</html>
