<?php 
	/**
	 * När en besökare har klickat på knappen för att följa en användare skickas 
	 * en GET-förfrågan med ett id för personen som användaren vill följa. 
	 * Tabellen UserFollowing uppdateras därefter med id för vem som användaren
	 * vill följa och id för användaren själv. Förfrågan görs sedan till databasen
	 * och beroende från vilken sida som förfrågan görs ifrån så skickas användaren vidare till
	 * sidan den gjorde förfrågan.
	 */	
	include 'auth.php';
	$user_id 		= $_SESSION['user'];
	$getFollowId 	= $_GET['follow_id'];

	$insertFollowId  = "INSERT INTO 
							UserFollowing (user_id, follow_id) 
						VALUES 
							('$user_id', '$getFollowId')
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
?>