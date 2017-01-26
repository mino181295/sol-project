<?php
	include '../login/functions.php';
	sec_session_start();
	if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])) {

		include '../login/db_connect.php';
		
		$sql = "SELECT * FROM Notificaricevuta WHERE (Utente = '" . $_SESSION['matricola'] ."' AND Mittente = '" . $_REQUEST['term'] . "' ) ORDER BY `Orario` DESC ";
					 
		$result = $mysqli->query($sql);

		if ($result->num_rows >= 1) {
			while($row = $result->fetch_array(MYSQL_ASSOC)) {
		
			    
			//$array['value']=htmlentities(stripslashes($row['Materia']));
			//$array['id']=(int)$row['Matricola_mit'];
			//$row_set[] = $row;
			   //echo $row['Materia'] . "\n";
				$myArray[] = $row;
		    	}
		    	echo '{ "results" : '. json_encode($myArray) . '}';
		} 

		/*foreach ($aItemInfo as $aValues) {

			echo $aValues['country_name'] . "\n";

		}*/


	}

?>