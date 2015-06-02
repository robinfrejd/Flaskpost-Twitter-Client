<?php
	
	include 'auth.php';
	$user_id 	= $_SESSION['user'];

	/**
	 * Funktion som laddar in alla registrerade användare på sidan. 
	 * En select-förfrågan görs till databasen för att få ut alla 
	 * användare exklusive den inloggade användaren. Efter förfrågan är gjord
	 * loopas resultatet igenom om det finns fler användare registrerade än personen som 
	 * är inloggad, annars skrivs ett meddelande ut. Grundinformationen med användarnamn, 
	 * namn och profil skrivs sedan ut för varje användare. Sedan görs en ny SQL-förfrågan 
	 * där tabellen UserFollowing hämtas ut. Det som avgörs sedan i loopen efter är om den inloggade 
	 * användaren följer den aktuelle användaren i loopen. Detta avgörs genom att man bara hämtar information
	 * från användare där user_id matchar den inloggade användarens id och där follow_id matchar user_id som hämtades
	 * ut från UserDeatails. Följer den inloggade användaren en användare ställs "statusen" till "Avfölj" 
	 * och en knapp som representerar det. Om den inloggade användaren inte följer användaren ställs "status" till "Följ"
	 * med tillhörande knapp. 
	 */
	function loadUsers()
	{
		global $db;
		global $user_id;

		$loadUsers 		 = "SELECT 
								* 
							FROM 
								UserDetails 
							WHERE 
								user_id != $user_id 
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
					echo "<li class='tweet_unfollow_btn'><a href='unfollowUser.php?follow_id=" . $follow_id . "&users=1'>Avfölj</a></li>" .
						 "</ul>";
				}
				else
				{
					echo "<li class='tweet_follow_btn'><a href='followUser.php?follow_id=" . $follow_id . "&users=1'>Följ</a></li>" .
						 "</ul>";
				}
			}
		}
		else
		{
			echo "Inga medlemmar i databasen!";
		}
	}
loadUsers();
?>