<?php 

	include 'auth.php';
	$user_id 		= $_SESSION['user'];
	$getFollowId 	= $_GET['follow_id'];

	/**
	 * Funktion som "avföljer" användare. Ett följ-id skickas in till funktionen. 
	 * Detta gör att en check görs där user_id i databasen matchas med det session-id 
	 * som skickats in i funktionen. Samma gäller för follow_id, som matchas emot det id som 
	 * skickats in. Efter borttagningen skickas användaren tillbaka till den webbsida som anropet gjordes ifrån. 
	 */
	function unfollowUser()
	{
		global $db;
		global $user_id;
		global $getFollowId;
		$insertFollowId  = "DELETE 
							FROM 
								UserFollowing 
							WHERE 
								user_id = $user_id 
							AND 
								follow_id = $getFollowId
							";
							
		$db->query($insertFollowId);

		if (isset($_GET['users']) == 1) 
		{
			header('Location: users.php');
		}

		if (isset($_GET['following']) == 1) 
		{
			header('Location: following.php');
		}

		if (isset($_GET['followers']) == 1) 
		{
			header('Location: followers.php');
		}
	}
unfollowUser();
?>