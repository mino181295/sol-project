<!DOCTYPE html>
<html lang="it">
<?php 
session_start();
$_SESSION["email"] = "mario.rossi@studio.unibo.it";
?>
<head>
    <title>Calendario</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- JQUERY + JAVASCRIPT -->
    <script type="text/javascript" src="../lib/jQuery/jquery.min.js"></script>
    <script type="text/javascript" src="calendar.js"></script>
    
    <!-- BOOTSTRAP + CSS -->
    
    <link type="text/css" rel="stylesheet" href="../lib/Bootstrap/css/bootstrap.min.css" />
    <script type="text/javascript" src="../lib/Bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="calendar.css" />

</head>
<body>
    <main class="container-fluid">        
        <header id="topTable" class="row">
            <form>
                <h1>Mese-Anno</h1>
                <div class="btn-group" role="group" aria-label="...">
                    <button type="button" id="prev" value="mese precedente" class="btn btn-default btn-arrow-left">
                        <span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>
                    </button>
                    <button type="button" id="monthMode" value="Mese" class="btn btn-default">Mese</button>
                    <button type="button" id="today" value="Oggi" class="btn btn-default">Oggi</button>
                    <button type="button" id="weekMode" value="Settimana" class="btn btn-default">Settimana</button>
                    <button type="button" id="next" value="mese successivo" class="btn btn-default btn-arrow-right">
                        <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
                    </button>
                </div>
            </form>
        </header>

        <div class="row">
            <div class="table-responsive">

                <!-- MONTHLY CALENDAR -->
                <table id="monthly-table" class="table monthView">
                    <caption class="sr-only">TipoCalendario-Mese-Anno</caption>
                    <thead>
                        <!-- CODE AUTOMATICALLY GENERATED HERE -->
                    </thead>
                    <tbody>
                        <!-- CODE AUTOMATICALLY GENERATED HERE -->
                    </tbody>
                </table>

                <!-- WEEKLY CALENDAR -->
                <table id="weekly-table" class="table weekView">
                    <caption class="sr-only">TipoCalendario-Mese-Anno</caption>
                    <thead>
                        <!-- CODE AUTOMATICALLY GENERATED HERE -->
                    </thead>
                    <tbody>
                        <!-- CODE AUTOMATICALLY GENERATED HERE -->
                    </tbody>
                </table>

            </div>
        </div>
        
        <div class="row weekView">
            <div class="container">
                <form>
                    <div class="form-group">
                        <label>Corso di studi:
                        <select class="selectpicker" id="sel-corsostudi" data-dropup-auto="true">
                                <?php
                                include("db_connect.php");
                                $sql = "SELECT ID, Denominazione FROM utente u, corsostudi c, iscrizione i WHERE (Email = '" . $_SESSION['email'] . "' AND TipoUtente = 's' AND 
                                Email = Studente AND ID = IDCorsoStudi AND AnnoAccademico >= (SELECT MAX(AnnoAccademico) FROM iscrizione)) ORDER BY 'Denominazione'";

                                $result = $mysqli->query($sql);

                                if($result->num_rows >= 1) {
                                    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                                        $val = $row["Denominazione"] . "-" . $row["ID"];
                                        echo '<option value="' . $val . '">' . $val . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </label>

                        <label>Anno:
                            <select class="selectpicker" id="sel-anno">
                            <!-- CODE AUTOMATICALLY GENERATED HERE -->
                            </select>
                        </label>
                    </div>
                </form>
            </div> 

        </div>

    </main>
</body>

</html>
