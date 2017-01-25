function formhash(form, password) {
   // crea un elemento di input che verrà usato come campo di output per la password criptata.
   var p = document.createElement("input");
   // aggiungi un nuovo elemento al tuo form.
   form.appendChild(p);
   p.name = "pw";
   p.type = "hidden"
   p.value = hex_sha512(password.value);
   password.value = "";
   // come ultimo passaggio, esegui il 'submit' del form.
   form.submit();
}