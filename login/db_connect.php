<?php
	// Credenziali per l'accesso al database
	$HOST="localhost"; // nome server.
	$USER="sec_user"; // utente di accesso del db.
	$PASSWORD="eKcGZr59zAa2BEWU"; // password di accesso al db.
	$DATABASE="secure_login"; // nome del db
	$mysqli = new mysqli($HOST, $USER, $PASSWORD, $DATABASE);
	// Connessione al db
	if($mysqli->connect_error) {
		die("Connection error: " . $mysqli->connect_error);
	}
?>