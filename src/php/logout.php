<?php
	/**
	 * Funktion som körs när användaren klickar på logga ut-knappen på webbplatsen. 
	 * Session_unset tar bort namnet för id som valt för session och session_destroy 
	 * tar bort all existerande data som finns sparad i den aktiva sessionen. Användaren
	 * skickas därefter ut till login-sidan.
	 */
	function onLogout()
	{
		session_start();
		session_unset();
		session_destroy();
		header('Location: ../../index.php');
	}
onLogout();
?>