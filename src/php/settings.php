<?php
	include 'auth.php';
	//include 'settingsHandler.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Settings</title>
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
			
			<h1>Inställningar</h1>

			<p>Här kan du ändra inställningar för ditt användarkonto.</p>

			<form action="settingsHandler.php" method="post" enctype="multipart/form-data">

				<h1>Namn</h1>

				<p>Ändra namn:</p>
				<input class="inputField" type="text" name="name_change">

				<h1>Användarnamn</h1>
				<p>Ändra användarnamn:</p>
			
				<input class="inputField" type="text" name="username_change"><br>
				<br>
				<input action="updateUserSettings" id="submitBtn" type="submit" value="Spara namn och användarnamn" name="submit">

			</form>
			
			<form action="profileImgHandler.php" method="post" enctype="multipart/form-data">	
				
				<h1>Profilbild</h1>
				
		    	<p>Välj en fil att ladda upp:</p>
		    	<input id="openFileBtn" type="file" name="file_upload"><br>

		    	<input id="submitBtn" type="submit" value="Spara profilbild" name="submitProfileImg">
		    
		    </form>
			
			<?php if (isset($_GET['success']) == 2) {echo "<p class='success_msg'>Dina inställningar är nu sparade!</p>";}?>
			<?php if (isset($_GET['takenUsername']) == 1) {echo "<p class='error_msg'>Användarnamnet är upptaget!</p>";}?>	
		</div>
	
	</div>

</body>
</html>