<?php
	include 'db_connect.php';
	include 'functions.php';
	sec_session_start();
	if(isset($_POST['email'], $_POST['pw'])) { 
		$email = $_POST['email'];
	  	$password = $_POST['pw']; 
	   	if(login($email, $password, $mysqli) == true) {
	      	// Login eseguito
	      	$_SESSION['loggedIn']=true;
	   		header('Location: ./../app/index.php');
	   	} else if(!emailExist($email, $mysqli)){ 
	      	// email sbagliata
	   		header('Location: ./login.php?error=1');
	  	} else {
	  		// password sbagliata
	  		header('Location: ./login.php?error=2');
	  	}
	} else { 
	   // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
		echo 'Invalid Request';
	}

?>