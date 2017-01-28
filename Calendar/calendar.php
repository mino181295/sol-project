<!DOCTYPE html>
<html lang="it">
<?php 
session_start();

$_SESSION["email"] = "mario.rossi@studio.unibo.it";
$_SESSION["email"] = "gino.pino@unibo.it";
$_SESSION["email"] = "paolo.venturi9@studio.unibo.it";
$_SESSION["email"] = "stefano.rizzi@unibo.it";
$_SESSION["tipoUtente"] = 'd';
?>
<head>
    <title>Calendario</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- JQUERY + JAVASCRIPT -->
    <script type="text/javascript" src="../app/lib/jQuery/jquery.min.js"></script>
    <script type="text/javascript" src="calendar.js"></script>
    
    <!-- BOOTSTRAP + CSS -->
    
    <link type="text/css" rel="stylesheet" href="../app/lib/Bootstrap/css/bootstrap.min.css" />
    <script type="text/javascript" src="../app/lib/Bootstrap/js/bootstrap.min.js"></script>
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
                        <?php
                        // Nel caso di account docente viene automaticamente riempito il select per i corsi di laurea in cui insegna.
                        if(isset($_SESSION["tipoUtente"]) && $_SESSION["tipoUtente"] == 'd') {
                            ?>
                            <label>Corso di studi:
                                <select class="selectpicker" id="sel-corsostudi" data-dropup-auto="true">
                                    <option value="" selected="true"></option>
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
                                <option value="" selected="true"></option>
                                <?php 
                                // Nel caso di account studente viene automaticamente riempito il select per gli anni e viene mostrato solo questo (dato che uno studente può essere inscritto annualmente ad un solo corso di laurea).
                                if (isset($_SESSION["tipoUtente"]) && $_SESSION["tipoUtente"] == 's') {
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

   </main>
</body>

</html>