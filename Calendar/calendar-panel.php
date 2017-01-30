<!DOCTYPE html>
<html lang="it">
<!--
<?php 
session_start(); // METTERE sec_session_start

$_SESSION["email"] = "mario.rossi@studio.unibo.it";
$_SESSION["email"] = "gino.pino@unibo.it";
$_SESSION["email"] = "paolo.venturi9@studio.unibo.it";
$_SESSION["email"] = "paolo.venturi9@studio.unibo.it";
$_SESSION["email"] = "paolo.venturi9@studio.unibo.it";
$_SESSION["email"] = "stefano.rizzi@unibo.it";
$_SESSION["tipo"] = 'd';
?>
-->
<head>
    <title>Calendario</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- JQUERY + JAVASCRIPT -->
    <script type="text/javascript" src="../app/lib/jQuery/jquery.min.js"></script>
    <script type="text/javascript" src="calendar.js"></script>
    <!-- Include jQuery ScrollTo -->
    <script src="jquery-scrollto/lib/jquery-scrollto.js"></script>
    
    <!-- BOOTSTRAP + CSS -->
    
    <link type="text/css" rel="stylesheet" href="../app/lib/Bootstrap/css/bootstrap.min.css" />
    <script type="text/javascript" src="../app/lib/Bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="calendar.css" />

</head>
<body>
    <main class="container-fluid">       
        <div class="panel panel-default">
            <div class="panel-heading" id="top-table">
                <h1>Mese-Anno</h1>
                <div class="btn-group" role="group" aria-label="Navigazione calendario">
                    <button type="button" id="prev" aria-label="mese precedente" class="btn btn-default btn-arrow-left">
                        <span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>
                    </button>
                    <button type="button" id="month-mode" aria-label="Mese" class="btn btn-default">Mese</button>
                    <button type="button" id="today" aria-label="Oggi" class="btn btn-default">Oggi</button>
                    <button type="button" id="week-mode" aria-label="Settimana" class="btn btn-default">Settimana</button>
                    <button type="button" id="next" aria-label="mese successivo" class="btn btn-default btn-arrow-right">
                        <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
                    </button>
                </div>
            </div>
            <div class="panel-body table-responsive">

                <!-- MONTHLY CALENDAR -->
                <table id="monthly-table" class="table month-view">
                    <caption class="sr-only">TipoCalendario-Mese-Anno</caption>
                    <thead>
                        <!-- CODE AUTOMATICALLY GENERATED HERE -->
                    </thead>
                    <tbody>
                        <!-- CODE AUTOMATICALLY GENERATED HERE -->
                    </tbody>
                </table>

                <!-- WEEKLY CALENDAR -->
                <table id="weekly-table" class="table week-view">
                    <caption class="sr-only">TipoCalendario-Mese-Anno</caption>
                    <thead>
                        <!-- CODE AUTOMATICALLY GENERATED HERE -->
                    </thead>
                    <tbody>
                        <!-- CODE AUTOMATICALLY GENERATED HERE -->
                    </tbody>
                </table>
            </div>        
            <div class="panel-footer week-view">
                <div class="container">
                    <form>
                        <div class="form-group">
                            <?php
                            // Nel caso di account docente viene automaticamente riempito il select per i corsi di laurea in cui insegna.
                            if(isset($_SESSION["tipo"]) && $_SESSION["tipo"] == 'd') {
                                ?>
                                <label>Corso di studi:
                                    <select class="selectpicker" id="sel-corsostudi" data-dropup-auto="true">
                                        <option value="" selected="">&nbsp;</option>
                                        <?php 
                                        include("functions.php");
                                        fillTheachersCourses(); 
                                        ?>
                                    </select>
                                </label>
                                <?php
                            }
                            ?>

                            <label>Anno:
                                <select class="selectpicker" id="sel-anno">
                                    <option value="" selected>&nbsp;</option>
                                    <?php 
                                    // Nel caso di account studente viene automaticamente riempito il select per gli anni e viene mostrato solo questo (dato che uno studente può essere inscritto annualmente ad un solo corso di laurea).
                                    if (isset($_SESSION["tipo"]) && $_SESSION["tipo"] == 's') {
                                     include("functions.php");
                                     fillStudentYears();
                                 }
                                 ?>
                             </select>
                         </label>
                     </div>
                 </form>
             </div> 
         </div>
     </div>
     <!-- Events Modal -->
     <div id="events-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Chiudi">&times;</button>
                    <h2 class="modal-title">Eventi del giorno</h2>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                    </ul>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>