<?php
	
	/**
	 * Användaren har skrivit in en emailadress samt lösenord och dessa skickas 
	 * för att sedan tas emot i den här funktionen. Lösenordet som tas emot är krypterat
	 * med md5-kryptering. En SQL-fråga ställs för att hämta ut alla användare som finns i User-tabellen. 
	 * En matchning görs därefter för att avgöra om email samt lösenord matchar någon att de inlägg som finns i tabellen. 
	 * Om en match finns så hämtas användarens id ut som ett objekt och en session skapas med det id:t. Användaren skickas till sist vidare 
	 * till dashboard.php som är startsidan man kommer till som inloggad användare. Finns ingen matchning i databasen så
	 * skrivs ett felmeddelande ut som beskriver detta och användaren får prova att antingen logga in igen eller registrera sig.
	 */
	function validateLogin()
	{
		include 'auth.php';
		$email 		= $_POST['email'];
		$password 	= md5($_POST['password']);

		if ($db->connect_error) 
		{
			die("Connection failed: " . $db->connect_error);
		}

		$loginValidation = "SELECT 
								* 
							FROM 
								User 
							WHERE 
								User.email = '$email' 
							AND 
								User.password = '$password' 
							";
		
		$result = $db->query($loginValidation);

		if ($result->num_rows == 1)
		{			
			$user = $result->fetch_object();
			$user = $user->id;
			$_SESSION['user'] = $user;

			header('location: dashboard.php');
		}	
		else
		{
			header('location: ../../index.php?fail=1');
		}
	}
validateLogin();
?>