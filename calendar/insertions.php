<?php 
include("../login/functions.php");
sec_session_start();

include("../login/db_connect.php");
$cond = isset($_POST["date"]) && isset($_SESSION['email']) && isset($_POST["fTime"]) && isset($_POST["lTime"]) && isset($_POST["desc"]);

//query tramite prepared statement
if ($cond) {
    // prepare and bind
    $sql = "INSERT INTO `evento`(`Utente`, `Numero`, `Inizio`, `Fine`, `Descrizione`)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("sisss", $utente, $num, $start, $end, $desc);

        // set parameters and execute
    $utente =  $_SESSION['email'];
    $num = null;
    $start = $_POST["date"] . " " . $_POST["fTime"]; 
    $end = $_POST["date"] . " " . $_POST["lTime"];
    $desc = $_POST["desc"]; 
    $stmt->execute();

    /* close statement */
    $stmt->close();

    /* close connection */
    $mysqli->close();

    echo "{utente: $utente, numero: $num, inizio: $start, fine: $end, desc: $desc}";
}
?>
