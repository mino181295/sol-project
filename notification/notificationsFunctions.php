<?php
	function getNumNotifications(){
		
		if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])) {

			include '../login/db_connect.php';
			$sql = "SELECT Matricola_mit, Matricola_dest, Testo, Orario FROM notifica WHERE (Matricola_dest = '" . $_SESSION['matricola'] ."' AND Stato = '1')";
					 
			$result = $mysqli->query($sql);

			return $result->num_rows;
		}
	}
	
	function updateStateNotifications() {
		if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])) {

			include '../login/db_connect.php';
			$sql = 'UPDATE Notifica SET Stato="0" WHERE Stato="1"';
					 
			$result = $mysqli->query($sql);
		}
	}
?>
