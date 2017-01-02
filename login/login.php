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
		   echo 'Error Logging In!';
		}
	?>
	<form action="process_login.php" method="post" name="login_form">
		<fieldset>
			<legend>Login</legend>
			Email: <input type="text" name="email" /><br/>
	   		Password: <input type="password" name="pw" id="password"/><br/>
	   		<input type="button" value="Login" onclick="formhash(this.form, this.form.password);" />
		</fieldset>
	</form>

</body>
</html>