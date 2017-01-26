<?php 

session_start();

$cond = isset($_GET["fDay"]) && isset($_GET["lDay"]) &&
        isset($_GET["idCorso"]) && isset($_GET["year"]) &&
        isset($_GET["session"]);

if ($cond) {

    $idCorso = $_GET["idCorso"]; 
    $year = $_GET["year"];
    $session = $_GET["session"];
    $fDay = $_GET["fDay"];
    $lDay = $_GET["lDay"];



    include("database_connection.php");
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


/*
$content = $_SESSION["name"];

$fDay = $_POST["fDay"];
$lDay = $_POST["lDay"];
$fHour = 8;
$output = "";

for ($i = 0; $i < 10; $i++) { // ipotizzo 10 ore di scuola
    $output .= "<tr>";
    $output .= "<th class=\"hour\">" . $fHour++ . ":00" . "</th>"; // ora
    for ($j=0; $j < 5; $j++) {
        $output .= "<td>" . $content . "</td>";
    }
    $output .= "</tr>";
}

echo $output;*/
?>
