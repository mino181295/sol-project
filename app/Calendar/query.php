<?php 

if (!isset($_GET["type"]))
    return;

$queryType = $_GET["type"];
include("db_connect.php");

if ($queryType == "getHours") {

    $cond = isset($_GET["fDay"]) && isset($_GET["lDay"]) &&
    isset($_GET["idCorso"]) && isset($_GET["year"]) &&
    isset($_GET["session"]);

    if ($cond) {
        $idCorso = $_GET["idCorso"]; 
        $year = $_GET["year"];
        $session = $_GET["session"]; // indica il semestre
        $fDay = $_GET["fDay"];
        $lDay = $_GET["lDay"];

        /*
        $sql = "SELECT * FROM Notifiche WHERE (Matricola_dest = '" 
        . $_SESSION['matricola'] . "' AND Materia ='" 
        . $_REQUEST['term'] . "') ORDER BY `Orario` DESC";

        //echo $sql;

        $result = $mysqli->query($sql);

        if($result->num_rows >= 1) {
            while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $myArray[] = $row;
            }
            echo '{ "results": ' . json_encode($myArray) . '}';
        }


        */


        echo '{"result": ' . json_encode($fDay . "-" . $lDay) .'}';
    }
} elseif ($queryType == "getYears") {
    //query tramite prepared statement
    if (isset($_GET["idCorso"])) {
        // prepare and bind
        $stmt = $mysqli->prepare("SELECT DurataAnni FROM corsostudi WHERE ID = (?)");
        $stmt->bind_param("s", $idCorso);

        // set parameters and execute
        $idCorso = $_GET["idCorso"];
        $stmt->execute();
        $stmt->bind_result($val);

        while($stmt->fetch()){
            $myArray[] = $val;
        }

        echo '{ "result": ' . json_encode($myArray) . '}';

        $stmt->free_result();

        /* close statement */
        $stmt->close();

        /* close connection */
        $mysqli->close();
    }
}
?>
