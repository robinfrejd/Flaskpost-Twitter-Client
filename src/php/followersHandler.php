<?php

	include 'auth.php';
	$user_id 	= $_SESSION['user'];

	/**
	 * Funktion som hanterar vilka användare som följer dig via en SELECT-förfrågan. 
	 * Resultatet loopas igenom så länge det finns inlägg i databasen och varje svar (användare) skrivs ut 
	 * i followers.php. Om ingen följer användaren skrivs ett echo-meddelande ut. 
	 *
	 */
	function getFollowers()
	{
		global $db;
		global $user_id;

		$loadUsers 		 = "SELECT 
								UserFollowing.*, 
								UserDetails.* 
						    FROM 
						   		UserDetails, 
						   		UserFollowing 
						   	WHERE 
						   		UserFollowing.follow_id = $user_id 
						   	AND 
						   		UserFollowing.user_id = UserDetails.user_id 
						   	ORDER BY 
						   		fullname
						   	";
		
		$result    		= $db->query($loadUsers);

		if ($result->num_rows > 0)
		{
			
			while ($row = $result->fetch_assoc())
			{
				$follow_id = $row['user_id'];

				echo 	"<ul class='user_feed_style'>" .
							"<li class='tweet_img'><img src='../img_profile/" . $row["picture"] . "'></li>" . 
							"<li class='tweet_username'>" . $row["username"] . "</li>" . 
							"<li class='tweet_fullname'>" . $row["fullname"] . "</li>" . 
						"</ul>";	
			}	
		}
		else
		{
			echo "Det är ingen som följer dig för tillfället!";
		}
	}

getFollowers();
?>