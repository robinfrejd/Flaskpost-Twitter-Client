<?php

	include 'auth.php';
	$tweetValue = $_POST['msg_textarea'];
	$user_id 	= $_SESSION['user'];

	/**
	 * En funktion som avgör om textsträngen som skickas med tweetet är mer eller mindre
	 * än 140 tecken. Om det är mindre än 140 tecken körs funktionen insertTweetToDb. Annars
	 * avslutas funktionen.
	 */
	function validateTweet()
	{
		if (strlen($tweetValue) < 140)
		{
			insertTweetToDb();
		}
		else 
		{
			return;	
		}
	}
	
	/**
	 * Om textsträngen från tweeten är mindre än 140 tecken så görs en ny insättning i databasen
	 * där användarens ID samt tweetet läggs till. Användaren skickas sedan tillbaka till dashboard.php.
	 */
	function insertTweetToDb()
	{
		global $db;
		global $tweetValue;
		global $user_id;

		$addNewTweet = "INSERT INTO 
							Tweet (user_id, message) 
						VALUES 
							('$user_id', '$tweetValue')
						";
		
		$result = $db->query($addNewTweet);

		header('Location: ../php/dashboard.php');
	}
validateTweet();
?>