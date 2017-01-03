<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript" src="sha512.js"></script>
	<script type="text/javascript" src="forms.js"></script>
	<title>login</title>
</head>
<body>
	<?php
		if(isset($_GET['error'])) { 
			$error = $_GET['error'];
			if($error == 1) {
				echo "E-mail sbagliata!";
			} else {
				echo "Password sbagliata!";
			}
		}
	?>
	<form action="process_login.php" method="post" name="login_form">
		<fieldset>
			<legend>Login</legend>
	   		Email: <input type="email" name="email" id="email" autocomplete="on" placeholder="Email" required /><br/>
	   		Password: <input type="password" name="pw" id="password" placeholder="Password" required /><br/>
	   		<input type="submit" name="go" onclick="formhash(this.form, this.form.password);" /> 
		</fieldset>
	</form>

</body>
</html>