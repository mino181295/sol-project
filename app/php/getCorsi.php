<?php
        include '../login/db_connect.php';
        include '../login/functions.php';


        sec_session_start();

        $query = "SELECT IDCorsoStudi
                  FROM utente u, corsostudi c, iscrizione i
                  WHERE matricola = ? AND TipoUtente = 's' AND email = Studente AND ID = IDCorsoStudi  
                  LIMIT 1;";

        $stmt = $mysqli->stmt_init();
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $_SESSION['matricola']);
        $stmt->execute();
        $stmt->store_result();

        $num_of_rows = $stmt->num_rows;
        $stmt->bind_result($result);
     
        $id_corso = 0;

        if ($num_of_rows  == 1){
            while ($stmt->fetch()) {
                $id_corso = $result;
            }
        }

        $array_result = array();
        $query = "SELECT Denominazione FROM corso WHERE IDCorsoStudi=".$id_corso."";
        $stmt = $mysqli->prepare($query);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($result); 

        while ($stmt->fetch()) {
            array_push($array_result, $result);
        }

        echo '{ "response" :'.json_encode($array_result).'}';

?>