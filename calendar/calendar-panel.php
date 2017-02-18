<div class="container-fluid" id="calendar-panel">       
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
                        include("../login/functions.php");
                        sec_session_start();
                            // Nel caso di account docente viene automaticamente riempito il select per i corsi di laurea in cui insegna.
                        if(isset($_SESSION["tipo"]) && $_SESSION["tipo"] == 'd') {
                            ?>
                            <label>Corso di studi:
                                <select class="selectpicker" id="sel-corsostudi" data-dropup-auto="true">
                                    <option value="" selected="">&nbsp;</option>
                                    <?php 
                                    include("../calendar/functions.php");
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
                                    include("../calendar/functions.php");
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
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Chiudi">&times;</button>
                    <h2 class="modal-title">Eventi</h2>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <!-- CODE AUTOMATICALLY GENERATED HERE -->
                    </ul>
                </div>
                <div class="modal-footer">
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon-evento">Nuovo evento</span>

                        <label for="newEvent" class="sr-only">Aggiungi Evento</label>
                        <input type="text" id="newEvent" name="newEvent" class="form-control" />
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon-orario">Orario</span>

                        <label for="startEvent" class="sr-only">Ora inizio</label>
                        <input type="time" id="startEvent" name="startEvent" class="form-control" />

                        <label for="endEvent" class="sr-only">Ora fine</label>
                        <input type="time" id="endEvent" name="endEvent" class="form-control" />

                        <span class="input-group-btn">
                            <button class="btn btn-default" id="btn-addEvent" type="button">
                                <span class="glyphicon glyphicon-ok" aria-hidden="true" aria-label="Conferma"></span>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="../calendar/calendar.js"></script>
