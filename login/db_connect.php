<?php
	// Credenziali per l'accesso al database
	$HOST="localhost"; // nome server.
	/*$USER="secure_user"; // utente di accesso del db.*/
	$USER="sec_user";
	$PASSWORD="eKcGZr59zAa2BEWU"; // password di accesso al db.
	/*$DATABASE="myalma"; // nome del db*/
	$DATABASE="secure_login";
	$mysqli = new mysqli($HOST, $USER, $PASSWORD, $DATABASE);
	// Connessione al db
	if($mysqli->connect_error) {
		die("Connection error: " . $mysqli->connect_error);
	}
?>