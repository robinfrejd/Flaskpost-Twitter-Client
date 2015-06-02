<?php
	include 'auth.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="../css/style_dashboard.css">
	<link rel="stylesheet" type="text/css" href="../css/style_menu.css">
</head>

<body>
	<div id="wrapper">
		
		<div id="nav">
			
			<div class="nav_icon">
				
				<a href="../php/dashboard.php"><img src="../img/logo_light.png" alt="logo"></a>
			
			</div>	
			
			<div id="nav_dropdown_menu">
				
				<ul>
					
					<li><a href="../php/dashboard.php"><img src="../img/home2.png" alt="Hem" title="Hem"></a></li>

					<li><a href="../php/users.php"><img src="../img/users.png" alt="Medlemmar" title="Medlemmar"></a></li>
					<li><a href="#"><img src="../img/profile2.png" alt="Profil" title="Din Profil"></a>
					<ul>
						<li><a href="../php/profile.php">Mina inlägg</a></li>
						<li><a href="../php/following.php">Följer</a></li>
						<li><a href="../php/followers.php">Följare</a></li>
						<li><a href="../php/logout.php">Logga ut</a></li>
					</ul>	
					</li>
					<li><a href="../php/settings.php"><img src="../img/settings2.png" alt="Inställningar" title="Inställningar"></a></li>
						
				</ul>

			</div>

		</div>

		<div id="content">
		
			<div id="tweet_box">
				<textarea id="msg_area" name="msg_textarea" form="msg_text_box" max-length="140" placeholder="Skriv nytt inlägg..." ></textarea>	
				<form action="../php/tweet.php" id="msg_text_box" method="post" name="tweet">						
					<input id="submitBtn" type="submit" name="submit_msg" value="Skicka inlägg!">
				</form>
			</div>	
		
			<div id="tweet_feed">
				<?php include 'loadSavedTweets.php';?>				
			</div>

		</div>
	
	</div>

</body>
</html>