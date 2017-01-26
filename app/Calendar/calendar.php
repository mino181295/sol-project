<!DOCTYPE html>
<html lang="it">
<?php 
session_start();
$_SESSION["nome"] = "ciao";
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
            <h1>Mese-Anno</h1>
            <div class="btn-group" role="group" aria-label="...">
                <button type="button" id="prev" class="btn btn-default btn-arrow-left">
                    <span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>
                </button>
                <button type="button" id="monthMode" class="btn btn-default">Mese</button>
                <button type="button" id="today" class="btn btn-default">Oggi</button>
                <button type="button" id="weekMode" class="btn btn-default">Settimana</button>
                <button type="button" id="next" class="btn btn-default btn-arrow-right">
                    <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
                </button>
            </div>
        </header>

        <div class="row">
            <div class="table-responsive">

                <!-- MONTHLY CALENDAR -->
                <table id="monthly-table" class="table">
                    <caption class="sr-only">TipoCalendario-Mese-Anno</caption>
                    <thead>
                        <!-- CODE AUTOMATICALLY GENERATED HERE -->
                    </thead>
                    <tbody>
                        <!-- CODE AUTOMATICALLY GENERATED HERE -->
                    </tbody>
                </table>

                <!-- WEEKLY CALENDAR -->
                <table id="weekly-table" class="table">
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

        <div class="row" id="bottomTable">
            <div class="btn-group dropup ">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Anno <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
            </ul>
        </div>
    </div>

</main>
</body>

</html>
