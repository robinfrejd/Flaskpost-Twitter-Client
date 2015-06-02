<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="src/css/style_login.css">	
</head>

<body>
	
	<div id="content">
		
		<img src="src/img/logo.png" alt="logo" width="500">		
		
		<h1>Logga in</h1>

		<form action="src/php/login.php" method="post">
			<input class="inputField" type="email" name="email" placeholder="E-mail"><br>
			<input class="inputField" type="password" name="password" placeholder="Lösenord"><br>
			<?php if (isset($_GET['fail']) == 1) {echo "<p class='error_msg'>Fel e-mail eller lösenord!</p>";}?>	
			<input id="submitBtn" type="submit" name="Submit" value="Logga in">
		</form>

		
		<h1>Inte medlem?</h1>
		
		<form action="src/php/registration.php" method="post">
			<input class="inputField" type="text" name="username" placeholder="Användarnamn"><br>
			<input class="inputField" type="text" name="fullname" placeholder="Fullständigt namn"><br>
			<input class="inputField" type="email" name="email" placeholder="E-mail"><br>
			<input class="inputField" type="password" name="password" placeholder="Lösenord"><br>
			<?php if (isset($_GET['success']) == 1) {echo "<p class='success_msg'>Du är nu registrerad! Logga in ovan!</p>";}?>	
			<input id="submitBtn" type="submit" name="Submit" value="Registrera dig!">

		</form>
	
	</div>

</body>
</html>