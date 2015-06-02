<?php
	
	include 'auth.php';
	$user_id 			= $_SESSION['user'];
	$fileUpload 		= $_FILES['file_upload'];
	
	/**
	 * Funktion som sköter hanteringen av profilbilden för användaren. 
	 * Den uppladdade bilden tas emot via $_FILES. Om bilden kan tas emot görs
	 * en uppdatering i UserDetails-tabellen och url:en till profilbilden byts ut 
	 * i picture, under förutsättning att session-id matchar user_id i tabellen. 
	 * Om uppladdningen lyckas den tidigare profilbilden ut mot den genom att 
	 * en ny fil skapas, där filnamnet baseras på den inloggade användarens id. ".png"
	 * läggs till för att slutföra filnamnet. Användaren skickas sedan tillbaka till settings-sidan.
	 * Misslyckas uppladdningen skickas användaren tillbaka till settings.php och ett felmeddelande visas
	 * som beskriver händelsen. 
	 */
	function profilePicHandler()
	{
		if (!empty($_POST))
		{
				
			global $db;
			global $user_id;
			global $fileUpload;

			$filename 		 = $user_id . ".png";
			$fileUrl 		 = $_SERVER["DOCUMENT_ROOT"] . '/U3/src/img_profile/' . $filename;
			$updateFilename	 = "UPDATE 
									UserDetails 
								SET 
									picture = '$filename' 
								WHERE 
									user_id = $user_id
								";

			if ($db->query($updateFilename) == TRUE) 
			{
				move_uploaded_file($_FILES['file_upload']['tmp_name'], $fileUrl);
				header('Location: ../php/settings.php');
			}
			else
			{	
				header('Location: ../php/settings.php?fail=1');
			}	
		}
	}
profilePicHandler();
?>