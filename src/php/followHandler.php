<?php
	
	include 'auth.php';
	$user_id 	= $_SESSION['user'];

	/**
	 * Funktion som hanterar vilka användare som den inloggade användaren följer. SELECT-förfrågan ser om   
	 * en den inloggade användarens id matchar något user_id i UserFollowing-tabellen, samt om ett följar-id 
	 * matchar ett user_id i UserDetails. Resultatet ska sedan sorteras i bokstavsordning. Om svaret man får
	 * tillbaka innehåller fler är 0 rader så kommer en while-loop att gå igenom hela svaret och en echo skriver 
	 * sedan ut svaren. Och beroende på om man följer en användare eller inte så kan den antingen ha tillståndet 
	 * "Följ" eller "Avfölj". Ett sista alternativ (else-satsen) är om man inte följer någon användare.
	 */
	function followUser()
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
								UserFollowing.user_id = $user_id 
							AND 
								UserFollowing.follow_id = UserDetails.user_id 
							ORDER BY 
								fullname
							";
		
		$result    		= $db->query($loadUsers);

		if ($result->num_rows > 0)
		{
			
			while ($row = $result->fetch_assoc())
			{

				$follow_id = $row['user_id'];
				$filename 	= $row['user_id'] . ".png";

				echo 	"<ul class='user_feed_style'>" .
							"<li class='tweet_img'><img src='../img_profile/" . $row["picture"] . "'></li>" . 
							"<li class='tweet_username'>" . $row["username"] . "</li>" . 
							"<li class='tweet_fullname'>" . $row["fullname"] . "</li>";

				$getFollowers = $db->query("SELECT 
												* 
											FROM 
												UserFollowing 
											WHERE 
												user_id = $user_id 
											AND 
												follow_id = $follow_id
											");

				if ($getFollowers->num_rows > 0)
				{
					echo "<li class='tweet_unfollow_btn'><a href='unfollowUser.php?follow_id=" . $follow_id . "&following=1'>Avfölj</a></li>" .
						 "</ul>";
				}
				else
				{
					echo "<li class='tweet_follow_btn'><a href='followUser.php?follow_id=" . $follow_id . "&following=1'>Följ</a></li>" .
						 "</ul>";
				}
			}
		}
		else
		{
			echo "Du följer inte någon användare, gå till medlemssidan för att hitta nya medlemmar!";
		}
	}
followUser();
?>