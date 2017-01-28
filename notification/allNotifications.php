<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tutte le notifiche</h4>
      </div>
      <div class="modal-body ativa-scroll">
        <script type="text/javascript">
          $(document).ready(ajustamodal);
          $(window).resize(ajustamodal);
          function ajustamodal() {
            var altura = $(window).height() - 155; //value corresponding to the modal heading + footer
            $(".ativa-scroll").css({"height":altura,"overflow-y":"auto"});
          }
        </script>
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
                      echo '<p><b>' . $mitrow['Nome'] . " " . $mitrow['Cognome'] . ":</b> ";
                    }
                    echo $row['Testo'] . '</p>';
                  
                  }
                } else {
                  
                  echo '<p>Nessuna notifica presente.</p>';
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