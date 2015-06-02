<?php 
	include 'auth.php';
	$user_id 			= $_SESSION['user'];
	$changeName 		= $_POST['name_change'];
	$changeUsername 	= $_POST['username_change'];
	$arguments 			= "";

	/**
	 * Funktion vars mening är att uppdatera användarinformation för en specifik användare.
	 * En koll görs först för att se så att POST-anropet som tas emot inte är tomt. Om det finns
	 * information fortsätter funktionen att köras. Först hämtas alla användarnamn ut från databasen
	 * för att matchas mot det användarnamn som har skickats in. Om det är samma användarnamn skrivs ett felmeddelande ut 
	 * som beskriver detta. Annars uppdateras användarnamnet för den inloggade användaren i databasen. Efter detta görs mer eller mindre
	 * samma check för namnet på användaren. Detta kräver dock inte att namnet måste vara unikt, utan namnet uppdateras direkt i databasen. 
	 */
	function UpdateUserDetails()
	{
		global $changeUsername;
		global $changeName;
		global $user_id;
		global $db;
		global $arguments;

		if (!empty($changeUsername))
		{
			$getUserDetails  = "SELECT 
									username 
								FROM 
									UserDetails
								";
			$result = $db->query($getUserDetails);

			while ($user = mysqli_fetch_assoc($result))
			{
				if ($user['username'] == $changeUsername)
				{
					$arguments .= "?takenUsername=1";
				}
			}
			
			$updateUsername  = "UPDATE 
									UserDetails
								SET 
									username = '$changeUsername' 
								WHERE 
									user_id = $user_id
								";
			$result = $db->query($updateUsername);	

			header('Location: ../php/settings.php' . $arguments);
		}	
		
		if (!empty($_POST))
		{
			
			$updateName  = "UPDATE 
								UserDetails 
							SET 
								fullname = '$changeName' 
							WHERE 
								user_id = $user_id
							";
			
			$db->query($updateName);
		
			header('Location: ../php/settings.php' . $arguments);	
		}
	}
UpdateUserdetails();
?>