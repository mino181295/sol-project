<?php
function sec_session_start() {
        $session_name = 'file_sharing_session'; // Imposta un nome di sessione
        $secure = false; // Imposta il parametro a true se vuoi usare il protocollo 'https'.
        $httponly = true; // Questo impedirà ad un javascript di essere in grado di accedere all'id di sessione.
        ini_set('session.use_only_cookies', 1); // Forza la sessione ad utilizzare solo i cookie.
        $cookieParams = session_get_cookie_params(); // Legge i parametri correnti relativi ai cookie.
        session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly); 
        session_name($session_name); // Imposta il nome di sessione con quello prescelto all'inizio della funzione.
        session_start(); // Avvia la sessione php.
        session_regenerate_id(); // Rigenera la sessione e cancella quella creata in precedenza.
    }

    function sendAllertMail($email) {
      // definisco mittente e destinatario della mail
      $nome_mittente = "Direzione unibo";
      $mail_mittente = "lorenzo.chiana@gmail.com";
      $mail_destinatario = $email;

      // definisco il subject ed il body della mail
      $mail_oggetto = "Disattivato account";
      $mail_corpo = "A seguito di varie irregolarità e' stato disattivato l'account: " . $email;

      // aggiusto un po' le intestazioni della mail
      // E' in questa sezione che deve essere definito il mittente (From)
      $mail_headers = "From: " .  $nome_mittente . " <" .  $mail_mittente . ">\r\n";
      $mail_headers .= "Reply-To: " .  $mail_mittente . "\r\n";

      mail($mail_destinatario, $mail_oggetto, $mail_corpo, $mail_headers);

    }

    function login($email, $password, $mysqli) {
   // Usando statement sql 'prepared' non sarà possibile attuare un attacco di tipo SQL injection.
    	if ($stmt = $mysqli->prepare("SELECT id, username, password, salt FROM members WHERE email = ? LIMIT 1")) { 
      $stmt->bind_param('s', $email); // esegue il bind del parametro '$email'.
      $stmt->execute(); // esegue la query appena creata.
      $stmt->store_result();
      $stmt->bind_result($user_id, $username, $db_password, $salt); // recupera il risultato della query e lo memorizza nelle relative variabili.
      $stmt->fetch();
      $password = hash('sha512', $password.$salt); // codifica la password usando una chiave univoca.
      if($stmt->num_rows == 1) { // se l'utente esiste
         // verifichiamo che non sia disabilitato in seguito all'esecuzione di troppi tentativi di accesso errati.
      if(checkbrute($user_id, $mysqli) == true) { 
        checkcaptcha();
            // Account disabilitato
            // Invia un e-mail a chi di dovere che segnala l'irregolarità fatte dall'acount in questione e poi spetterà ad esso se riattivarla o no manulmente.
          //sendAllertMail($email);
      	return false;
      } else {
         if($db_password == $password) { // Verifica che la password memorizzata nel database corrisponda alla password fornita dall'utente.
            // Password corretta!            
               $user_browser = $_SERVER['HTTP_USER_AGENT']; // Recupero il parametro 'user-agent' relativo all'utente corrente.

               $user_id = preg_replace("/[^0-9]+/", "", $user_id); // ci proteggiamo da un attacco XSS
               $_SESSION['user_id'] = $user_id; 
               $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username); // ci proteggiamo da un attacco XSS
               $_SESSION['username'] = $username;
               $_SESSION['login_string'] = hash('sha512', $password.$user_browser);
               // Login eseguito con successo.
               return true;    
           } else {
            // Password incorretta.
            // Registriamo il tentativo fallito nel database.
           	$now = time();
           	$mysqli->query("INSERT INTO login_attempts (user_id, time) VALUES ('$user_id', '$now')");
           	return false;
           }
       }
   } else {
         // L'utente inserito non esiste.
   	return false;
   }
}
}

function checkcaptcha(){
        $LoginCaptcha = new Captcha('LoginCaptcha');
        $LoginCaptcha->UserInputID = 'CaptchaCode';
        $LoginCaptcha->ImageWidth = 200;
        $LoginCaptcha->CodeLength = 4;
        $LoginCaptcha->CodeStyle = CodeStyle::Alpha;

        // only show the Captcha if it hasn't been already solved 
        // for the current message
        if(!$LoginCaptcha->IsSolved) { ?>
          <label for="CaptchaCode">Retype the characters from the picture:</label>
          <?php echo $LoginCaptcha->Html(); ?>
          <input type="text" name="CaptchaCode" id="CaptchaCode" 
            class="textbox" /><?php

          // CAPTCHA validation failed, show error message
          if ('Captcha' == $error) { ?>
            <span class="incorrect">Incorrect code</span><?php
          }
        }
}

function checkbrute($user_id, $mysqli) {
   // Recupero il timestamp
	$now = time();
   // Vengono analizzati tutti i tentativi di login a partire dalle ultime due ore.
	$valid_attempts = $now - (2 * 60 * 60); 
	if ($stmt = $mysqli->prepare("SELECT time FROM login_attempts WHERE user_id = ? AND time > '$valid_attempts'")) { 
		$stmt->bind_param('i', $user_id); 
      // Eseguo la query creata.
		$stmt->execute();
		$stmt->store_result();
      // Verifico l'esistenza di più di 5 tentativi di login falliti.
		if($stmt->num_rows > 5) {
			return true;
		} else {
			return false;
		}
	}
}
?>