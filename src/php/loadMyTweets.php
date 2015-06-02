<?php

	include 'auth.php';
	$user_id = $_SESSION['user'];

	/**
	 * Funktionen gör en SQL-förfrågan till databasen där endast Tweets
	 * vars user_id matchar den inloggade användarens id ($user_id). 
	 * Svaret tas sedan emot och loopas igenom. Resultatet skrivs sedan ut via ett echo
	 * och informationen som finns i databasen implementeras i echot.  
	 * Finns det inga inlägg i databasen skrivs ett meddelande ut. 
	 */
	function loadMyTweetsFromDb()
	{
		global $db;
		global $user_id;

		$loadSavedTweets 	 = "SELECT 
									Tweet.*, 
									UserDetails.* 
								FROM 
									Tweet, 
									UserDetails 
								WHERE 
									Tweet.user_id = '$user_id' 
								AND 
									UserDetails.user_id = '$user_id' 
								ORDER BY 
									time DESC
								";

		$result 		 	= $db->query($loadSavedTweets);
		
		if ($result->num_rows > 0)
		{
			while ($row = $result->fetch_assoc())
			{
				$filename = $row['user_id'] . ".png";
				$tweetId  = $row['id'];
				
				echo 
					 "<ul class='tweet_feed_style'>" .
						 "<li class='tweet_delete_btn'><a href='deleteTweet.php?tweetId=$tweetId&profile=1'><img src='../img/delete_tweet.png'></a></li>" . 
						 "<li class='tweet_img'><img src='../img_profile/" . $row["picture"] . "'></li>" . 
						 "<li class='tweet_username'>" . $row["username"] . "</li>" . 
						 "<li class='tweet_fullname'>" . $row["fullname"] . "</li>" .
						 "<li class='tweet_message'>" . $row["message"] . "</li>" .
						 "<li class='tweet_time'>" . $row["time"] . "</li>" .
					 "</ul>";
			}
		}	
		else
		{
			echo "Inga inlägg i databasen!";	
		}
	}
loadMyTweetsFromDb();
?>