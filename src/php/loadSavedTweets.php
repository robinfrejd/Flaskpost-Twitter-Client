<?php

	include 'auth.php';
	$user_id = $_SESSION['user'];
	
	/**
	 * Funktion som hämtar hämtar ut tweets från databasen. Detta görs med två olika SQL-frågor, 
	 * där den ena hämtar ut den inloggade användarens tweets och den andra hämtar ut tweets från användare
	 * som den inloggade användaren följer. En UNION ALL används för att para ihop de båda förfrågningarna. 
	 * Svaren sorteras i fallande ordning från när de postades. Slutligen sätts en gräns på att bara de 
	 * 50 senaste tweetsen ska hämtas. 
	 */
	function loadTweetsFromDb()
	{
		global $db;
		global $user_id;

		$loadSavedTweets  = "SELECT
								Tweet.id AS tweet_id,
								UserDetails.username,
								Tweet.user_id AS ui,
								Tweet.message,
								Tweet.time,
                                UserDetails.picture,
                                UserDetails.fullname
							FROM
								Tweet,
								UserDetails
							WHERE
								Tweet.user_id = $user_id
							AND 
								Tweet.user_id = UserDetails.user_id
							GROUP BY 
								Tweet.id
							UNION ALL
							SELECT								
								Tweet.id AS tweet_id,
								Followee.username,
								Tweet.user_id AS ui,
								Tweet.message,
								Tweet.time,
                                User.picture,
                                User.fullname
							FROM
								Tweet,
								UserDetails AS User,
								UserDetails AS Followee,
								UserFollowing
							WHERE
								Tweet.user_id = UserFollowing.follow_id
							AND
								UserFollowing.follow_id = Followee.user_id
							AND
								UserFollowing.user_id = $user_id
							AND
								User.picture = UserFollowing.follow_id
							GROUP BY 
								Tweet.id
							ORDER BY
								time DESC
							LIMIT 
								50
							";
		
		$result 		 	= $db->query($loadSavedTweets);
		
		/**
		 * If-sats som loopar igenom innehållet från SQL-frågan som ställdes ovan. Om det är användarens egna
		 * tweet som är aktuell så läggs ett extra li-element på som möjliggör att man kan ta bort tweetet. 
		 * Om inte så skrivs profilbild, användarnamn, namn, meddelande och tidpunkt då tweetet skrevs, vilket också
		 * gäller för den inloggade användarens tweets. Finns det inga tweets i databasen skrivs ett meddelande ut som beskriver detta. 
		 */
		if ($result->num_rows > 0)
		{
			while ($row = $result->fetch_assoc())
			{
				$tweetId  = $row['tweet_id'];
					
				if ($row['ui'] == $user_id)
				{
					echo 	"<ul class='tweet_feed_style'>" .
								"<li class='tweet_delete_btn'><a href='deleteTweet.php?tweetId=$tweetId&index=1'><img src='../img/delete_tweet.png'></a></li>" . 
								"<li class='tweet_img'><img src='../img_profile/" . $row["picture"] . "'></li>" . 
								"<li class='tweet_username'>" . $row["username"] . "</li>" . 
								"<li class='tweet_fullname'>" . $row["fullname"] . "</li>" .
								"<li class='tweet_message'>" . $row["message"] . "</li>" .
								"<li class='tweet_time'>" . $row["time"] . "</li>" .
					 		"</ul>";
				}
				else
				{
					echo 	"<ul class='tweet_feed_style'>" .
								"<li class='tweet_img'><img src='../img_profile/" . $row["picture"] . "'></li>" . 
								"<li class='tweet_username'>" . $row["username"] . "</li>" . 
								"<li class='tweet_fullname'>" . $row["fullname"] . "</li>" .
								"<li class='tweet_message'>" . $row["message"] . "</li>" .
								"<li class='tweet_time'>" . $row["time"] . "</li>" .
						 	"</ul>";
				}
			}
		}	
		else
		{
			echo "Inga inlägg i databasen!";	
		}
		
	}

loadTweetsFromDb();
?>