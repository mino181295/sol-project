<?php
    
    function getNomeUtente(){
        return $_SESSION['nome']." ".$_SESSION['cognome'];
    }

    function getNomeScuola(){
        include '../login/db_connect.php';

    
        $query = "SELECT Denominazione
                  FROM utente u, corsostudi c, iscrizione i
                  WHERE matricola = ? AND TipoUtente = 's' AND email = Studente AND ID = IDCorsoStudi  
                  LIMIT 1;";
        $stmt = $mysqli->stmt_init();
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $_SESSION['matricola']);
        $stmt->execute();
        $stmt->store_result();
        $num_of_rows = $stmt->num_rows;
        $stmt->bind_result($denominazione);
     

        if ($num_of_rows  == 1){
            while ($stmt->fetch()) {
                $scuola = $denominazione;
            }
        } else {
            $scuola = "Non iscritto";
        }
        return $scuola;       
    }


  
?>