<?php
  function sec_session_start() {
    $session_name = 'sol_session'; // nome della sessione
    $secure = false; // impostato a true per usare il protocollo 'https'
    $httponly = true; // impedisce ad un javascript di essere in grado di accedere all'id di sessione
    ini_set('session.use_only_cookies', 1); // forza la sessione ad utilizzare solo i cookie
    $cookieParams = session_get_cookie_params(); // legge i parametri correnti relativi ai cookie
    session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly); 
    session_name($session_name); // imposta il nome di sessione con quello prescelto all'inizio della funzione
    session_start(); // avvia la sessione
    session_regenerate_id(); // rigenera la sessione e cancella quella creata in precedenza
  }

  function login($email, $password, $mysqli) {
    // Usando statement sql 'prepared' non sarà possibile attuare un attacco di tipo SQL injection
    if ($stmt = $mysqli->prepare("SELECT Matricola, TipoUtente, Nome, Cognome, Password, Salt FROM utente WHERE Email = ? LIMIT 1")) { 
      $stmt->bind_param('s', $email); // esegue il bind del parametro '$email'.
      $stmt->execute(); // esegue la query appena creata.
      $stmt->store_result();
      $stmt->bind_result($user_id, $tipo, $nome, $cognome, $db_password, $salt); // recupera il risultato della query e lo memorizza nelle relative variabili.
      $stmt->fetch();
      $password = hash('sha512', $password.$salt); // codifica la password usando una chiave univoca
      if($stmt->num_rows == 1) { // se l'utente esiste

        if($db_password == $password) { // verifica che la password memorizzata nel database corrisponda alla password fornita dall'utente
          // password corretta            
          $user_browser = $_SERVER['HTTP_USER_AGENT']; // recupero il parametro 'user-agent' relativo all'utente corrente
          $user_id = preg_replace("/[^0-9]+/", "", $user_id); // protezione da un attacco XSS
          $_SESSION['matricola'] = $user_id; 
          $tipo = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $tipo); // protezione da un attacco XSS
          $_SESSION['tipo'] = $tipo;
          $nome = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $nome); // protezione da un attacco XSS
          $_SESSION['nome'] = $nome;
          $cognome = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $cognome); // protezione da un attacco XSS
          $_SESSION['cognome'] = $cognome;
          $_SESSION['email'] = $email;
          $_SESSION['login_string'] = hash('sha512', $password.$user_browser);

          /*if($tipo == "s") {
            $sql = '';
            $sql->exectute();
            $sql->store_result();
            $sql->bind_result($user_id, $tipo, $nome, $cognome, $db_password, $salt);
            $stmt->fetch();
          }*/

          // login eseguito con successo.
          return true;
        } else {
          // l'utente inserito non esiste
       	  return false;
        }
      }
    }
  }

  function emailExist($email, $mysqli) {
    // controllo dell'esistenza dell'email inserita dall'utente
    if($stmt = $mysqli->prepare("SELECT Matricola FROM utente WHERE Email = ?")) {
      $stmt->bind_param('s', $email);
      // esecuzione della query creata
      $stmt->execute();
      $stmt->store_result();
      // verifica dell'esistenza della mail all'itnerno del db
      if($stmt->num_rows == 0) {
        return false;
      } else {
        return true;
      }
    }
  }

  function convertEventIntoNotification() {

    include 'db_connect.php';
    //sec_session_start();
    if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])) {
      $sql = "SELECT Descrizione, DATE_FORMAT(Inizio,'%H:%i') TIMEONLY, DATE_FORMAT(Fine,'%H:%i') TIMEONLY FROM evento WHERE Utente = (?)
        AND (
        (Inizio BETWEEN (?) AND (?))
        OR
        (Fine BETWEEN (?) AND (?))
        OR
        (Inizio <= (?) AND Fine >= (?))
        )";

      $stmt = $mysqli->prepare($sql);
      $stmt->bind_param("sssssss", $utente, $fDate, $lDate, $fDate, $lDate, $fDate, $lDate);

      // set parameters and execute
      $utente = $_SESSION['email'];
      $fDate = substr(date("Y-m-d 23:59:59"), 0, -5); 
      $lDate = substr(date("Y-m-d 00:00:00"), 0, -5); 
      $stmt->execute();
      $stmt->store_result();
      if($stmt->num_rows > 0) {
        $stmt->bind_result($desc, $iniz, $fin);
        $result = [];
        while($stmt->fetch()){
          $time = " (" . $iniz . "-" . $fin . ")";
          $result[] = [$desc, $time];
        }
        
        $sql = 'SELECT Testo FROM notifica WHERE Matricola_mit = "0"';
        $result = $mysqli->query($sql);
        $procedi = true;
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            if($row['Testo'] == ($desc . $time)) {
              $procedi = false;
            }
          }
        } 
        if($procedi) {
          $sql = 'INSERT INTO notifica (ID, Matricola_mit, Matricola_dest, Testo, Orario, Stato) VALUES (NULL, "0", "' . $_SESSION['matricola'] . '", "' . $desc . $time . '", CURRENT_TIMESTAMP, "1")';
          $result = $mysqli->query($sql);
        }
      }
    }
  }
?>