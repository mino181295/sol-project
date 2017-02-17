<?php
    include '../../login/functions.php';
    include '../../login/db_connect.php';

    sec_session_start();

    $stmt = $mysqli->stmt_init();

    $sql_idcorso = "SELECT IDCorsoStudi
                  FROM utente u, corsostudi c, iscrizione i
                  WHERE matricola = ? AND email = Studente AND ID = IDCorsoStudi  
                  LIMIT 1;";

    $stmt = $mysqli->prepare($sql_idcorso);
    $stmt->bind_param("i", $_SESSION['matricola']);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($risultato_corso);  

    if ($stmt->num_rows==1){
        while ($stmt->fetch()){
            $id_corso = $risultato_corso;
        }
    }

    $nomeMateria = $_POST['materia'];
    $notificationText = "Materiale caricato in $nomeMateria";
    $sql_inserimento = "INSERT INTO notifica(Matricola_mit, Matricola_dest, testo, Stato)
    VALUES (".$_SESSION['matricola'].", ?, '".$notificationText."', 1);";

    $stmt = $mysqli->prepare($sql_inserimento);
   
    $sql_utenti = "SELECT matricola 
                   FROM utente u, iscrizione i 
                   WHERE matricola <> ".$_SESSION['matricola']." 
                   AND email = Studente 
                   AND IDCorsoStudi = ".$id_corso.";";

	$result = $mysqli->query($sql_utenti);

    if ($result->num_rows > 0) {
	    while ($row = $result->fetch_assoc()) {
            $matricola_destinatario = $row['matricola'];
            $stmt->bind_param("i", $matricola_destinatario);
            $stmt->execute();
        }	    
	}   
	$stmt->close();
?>