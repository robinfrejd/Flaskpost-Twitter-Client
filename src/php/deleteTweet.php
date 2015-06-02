<?php
	
	/**
	 * Funktion som används för att ta bort en tweet ifrån databasen.
	 * Ett id för den aktuella tweeten tas emot via en GET-parameter
	 * och det matchas sedan mot matchande id:n i databasen. Finns
	 * en matchning raderas tweetet från databasen och beroende på
	 * vilken sida man har tagit bort tweeten ifrån så slussas användaren
	 * vidare till samma sida användaren gjorde anropet ifrån.
	 */
	include 'auth.php';
	$user_id = $_SESSION['user'];
	$tweetId = $_GET['tweetId'];

	$deleteTweet = "DELETE 
					FROM 
						Tweet 
					WHERE 
						id = $tweetId
					";
	$db->query($deleteTweet);

	if (isset($_GET['index']) == 1) 
	{
		header('Location: dashboard.php');
	}

	if (isset($_GET['profile']) == 1) 
	{
		header('Location: profile.php');
	}	
?>