<?php

/* Funzioni per settare i select della WeekView */

function fillStudentYears() {
    if(isset($_SESSION['email'])) {
        include("../login/db_connect.php");
        $sql = "SELECT DurataAnni, ID FROM corsostudi c JOIN iscrizione i WHERE (Studente = '" . $_SESSION['email'] . "' AND ID = IDCorsoStudi AND AnnoAccademico >= (SELECT MAX(AnnoAccademico) FROM iscrizione))";

        $result = $mysqli->query($sql);

        if($result->num_rows >= 1) {
            while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $years = $row["DurataAnni"];
                $_SESSION["idCorso"] = $row["ID"]; // SETTO idCorso studente
                for($i = 1; $i <= $years; $i++) {
                    echo '<option value="' . $i . '">' . $i . '</option>';
                }
            }   
        }
    }
}

function fillTheachersCourses() {
    if(isset($_SESSION['email'])) {
        include("../login/db_connect.php");
        $sql = "SELECT DISTINCT Denominazione, ID FROM assegnamento JOIN corsostudi WHERE (ID = IDCorsoStudi AND Docente = '" . $_SESSION['email'] . "') ORDER BY Denominazione";

        $result = $mysqli->query($sql);

        if($result->num_rows >= 1) {
            while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $val = $row["Denominazione"] . "-" . $row["ID"];
                echo '<option value="' . $val . '">' . $val . '</option>';
            }
        }
    }
}
?>