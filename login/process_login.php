<?php
	include 'db_connect.php';
	include 'functions.php';
	sec_session_start(); // usiamo la nostra funzione per avviare una sessione php sicura
	if(isset($_POST['email'], $_POST['pw'])) { 
		$email = $_POST['email'];
	  	$password = $_POST['pw']; // Recupero la password criptata.
	   	if(login($email, $password, $mysqli) == true) {
	      	// Login eseguito
	   		//echo 'Success: You have been logged in!';
	   		header('Location: ./home.html');
	   	} else {
	      // Login fallito
	   		header('Location: ./login.php?error=1');
	  	}
	} else { 
	   // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
		echo 'Invalid Request';
	}

?>