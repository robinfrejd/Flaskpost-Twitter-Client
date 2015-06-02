<?php
	/**
	 * Funktion som vid initiering ser ifall en aktiv session finns.
	 * Finns det inte någon session så skickas man vidare till login.php 
	 * där man får logga in igen för att skapa en ny session.
	 */
	if (!isset($_SESSION))
	{
		session_start();
	}
	
	if (empty($_SESSION['user']))
	{
		header('Location: ../../index.php?error=2');
	}

	$db = new mysqli("localhost", "root", "root", "u3_database");
?>