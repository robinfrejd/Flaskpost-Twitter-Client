<?php 
	
	/**
	 * Funktion som hanterar registreringen av nya användare. 
	 * Variabler skapas som tar emot POST-anrop från login-sidan. 
	 * Ifall något går fel med uppkopplingen mot databasen skrivs ett felmeddelande ut. 
	 * Om inte något går fel läggs nya uppgifter in i tabellerna User och UserDetails. 
	 * Informationen som läggs till är email, lösenord (som krypteras med md5-kryptering),
	 * användar-id, namn och användarnamn. 
	 * Vid en lyckad registrering skickas användaren till inloggningssidan (index.php) och ett
	 * meddelande skrivs ut som säger att registreringen lyckades.
	 */
	function validateRegistration()
	{
		include 'auth.php';

		$username 	= $_POST['username'];
		$name 		= $_POST['fullname'];
		$email 		= $_POST['email'];
		$password 	= md5($_POST['password']);

		if ($db->connect_error) 
		{
		    die("Connection failed: " . $db->connect_error);
		}

		$addNewUser  = "INSERT INTO 
							User (email, password) 
						VALUES 
							('$email', '$password')
						";

		$result = $db->query($addNewUser) OR die($db->error);

		$addUserDetails  = "INSERT INTO 
								UserDetails (user_id, fullname, username) 
							VALUES 
								($db->insert_id, '$name', '$username')
							";

		$result = $db->query($addUserDetails) OR die($db->error);

		header('Location: ../../index.php?success=1');
	}
validateRegistration();
?>