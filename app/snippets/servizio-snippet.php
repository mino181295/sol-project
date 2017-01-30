<?php
        include '../login/functions.php';
        include '../login/db_connect.php';

        sec_session_start();

        $query = "SELECT DurataAnni, IDCorsoStudi
                          FROM utente u, corsostudi c, iscrizione i
                          WHERE matricola = ? AND email = Studente AND ID = IDCorsoStudi  
                          LIMIT 1;";

        $stmt = $mysqli->stmt_init();
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $_SESSION['matricola']);
        $stmt->execute();
        $stmt->store_result();
        
        $num_of_rows = $stmt->num_rows;
        $stmt->bind_result($anni,$ID);     

        if ($num_of_rows  == 1){
            while ($stmt->fetch()) {
                $durata_anni = $anni;
                $IDCorsoStudi = $ID;
            }
        } else {
            $durata_anni = 0;
            $IDCorsoStudi = null;
        }
?>
<div class="container-fluid">
    <div class="row">
        <ul class="nav nav-tabs">
            <?php
                for($i = 1; $i <= $durata_anni; $i++){
                    if ($i == 1){
                        echo '<li class="active"><a data-toggle="pill" href="#anno'.$i.'">Anno '.$i.'</a></li>';
                    } else {
                        echo '<li><a data-toggle="pill" href="#anno'.$i.'">Anno '.$i.'</a></li>';
                    }
                }
            ?>

        </ul>

        <div class="tab-content">
            <?php 
                    $query = "SELECT c.Denominazione
                              FROM corso c
                              WHERE Anno = ? AND Ciclo = ? AND IDCorsoStudi = ".$IDCorsoStudi.";";
                    $stmt = $mysqli->prepare($query);

                    for($i = 1; $i <= $durata_anni; $i++){
                        if ($i == 1 ){
                            echo '<div id="anno'.$i.'" class="tab-pane fade in active">';
                        } else {
                            echo '<div id="anno'.$i.'" class="tab-pane fade">';
                        }
                        for($j = 1; $j <= 2; $j++){
                            echo '<div class="panel panel-default">';
                            if ($j == 1){
                               echo '<div class="panel-heading">Primo Semestre</div>'; 
                            } 
                            if ($j == 2){
                               echo '<div class="panel-heading">Secondo Semestre</div>'; 
                            }                        
                            echo '<div class="panel-body">';
                            echo ' <ul class="list-group">';                    
                                $stmt->bind_param("ii", $i, $j);
                                $stmt->execute();
                                $stmt->store_result();                                      
                                $stmt->bind_result($materia); 
                                while ($stmt->fetch()) {
                                    echo ' <a class="list-group-item">'.ucfirst($materia).'</a>';
                                }
                            echo ' </ul>';
                            echo '</div>';
                            echo '</div>';
                        }
                        echo '</div>';
                    }        
            ?>
        </div>
    </div>
</div>
