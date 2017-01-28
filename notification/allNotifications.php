<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tutte le notifiche</h4>
      </div>
      <div class="modal-body my-scroll">
        <script type="text/javascript">
          $(document).ready(ajustamodal);
          $(window).resize(ajustamodal);
          function ajustamodal() {
            var altezza = $(window).height() - 300; //value corresponding to the modal heading + footer
            $(".my-scroll").css({"height":altezza,"overflow-y":"auto"});
          }
        </script>
        <!--<ul class="list-group">
        <?php  
        if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])) {

          include '../login/db_connect.php';
          $sql = "SELECT Matricola_mit, Matricola_dest, Testo, Orario FROM notifica WHERE (Matricola_dest = '" . $_SESSION['matricola'] ."') ORDER BY `Orario` DESC";

          $result = $mysqli->query($sql);

          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {

              $mittente = $row['Matricola_mit'];

              $sql = "SELECT * from utente WHERE (Matricola='". $mittente ."')";

              $mitresult = $mysqli->query($sql);
              if($mitresult->num_rows == 1) {
                $mitrow = $mitresult->fetch_assoc();
                echo '<li class="list-group-item"><b>' . $mitrow['Nome'] . " " . $mitrow['Cognome'] . ":</b> ";
              }
              echo $row['Testo'] . '</li>';
            }
          } else {

            echo '<p id="no_notifications">Nessuna notifica presente.</p>';
          }
        }
        ?>
        </ul>-->

        <?php  
        if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])) {

          include '../login/db_connect.php';
          $sql = "SELECT Matricola_mit, Matricola_dest, Testo, Orario FROM notifica WHERE (Matricola_dest = '" . $_SESSION['matricola'] ."') ORDER BY `Orario` DESC";

          $result = $mysqli->query($sql);

          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {

              $mittente = $row['Matricola_mit'];

              $sql = "SELECT * from utente WHERE (Matricola='". $mittente ."')";

              $mitresult = $mysqli->query($sql);
              if($mitresult->num_rows == 1) {
                $mitrow = $mitresult->fetch_assoc();
                echo '<a href="#" class="list-group-item list-group-item-action flex-column align-items-start">';
                echo '<div class="d-flex w-100 justify-content-between">';
                echo '<h4 class="mb-1">' . $mitrow['Nome'] . " " . $mitrow['Cognome'] . "</h4>";
                echo '</div>';
                echo '<p class="mb-1">' . $row['Testo'] . '</p>';
                echo '<small>3 days ago.</small></a>';
              }
              
            }
          } else {

            echo '<p id="no_notifications">Nessuna notifica presente.</p>';
          }
        }
        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
      </div>
    </div>

  </div>
</div>