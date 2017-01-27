<?php
	include '../login/functions.php';
	sec_session_start();
	if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])) {

		include '../login/db_connect.php';
		$sql = "SELECT Matricola_mit, Matricola_dest, Testo, Orario FROM notifica WHERE (Matricola_dest = '" . $_SESSION['matricola'] ."' AND Stato = '1') ORDER BY `Orario` DESC";
				 
				$result = $mysqli->query($sql);

				if ($result->num_rows > 0) {
					
					while($row = $result->fetch_assoc()) {
						
						$mittente = $row['Matricola_mit'];

						$sql = "SELECT * from utente WHERE (Matricola='". $mittente ."')";

						$mitresult = $mysqli->query($sql);
						if($mitresult->num_rows == 1) {
							$mitrow = $mitresult->fetch_assoc();
							echo '<li><p class="dropdown-item"><b>' . $mitrow['Nome'] . " " . $mitrow['Cognome'] . ":</b> ";
						}
						echo $row['Testo'] . '</p></li>';
					
					}
				} else {
					
					echo '<p class="dropdown-item">Nessuna nuova notifica</p>';
				}

		// si presuppone che abbiamo appena letto le notifiche -> passano allo stato di lette
		include 'notificationsFunctions.php';
		updateStateNotifications();
	}


?>
