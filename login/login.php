<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript" src="sha512.js"></script>
	<script type="text/javascript" src="forms.js"></script>

	<meta charset="utf-8">

	<title>Login</title>

	<link rel="stylesheet" href="css/style.css">

</head>

<body>

	<div id="login">

		<div id="header">
			<figure>
					<img src="img/logo.png" alt="">
			</figure>
		</div>

		<form action="process_login.php" method="post" name="login_form">

			<fieldset>

				<label for="email">Indirizzo e-mail</label></br></br>
				<input type="email" name="email" id="email" autocomplete="on" placeholder="es. mario.rossi@unibo.it, mario.rossi@studio.unibo.it" required /></br></br>

				<label for="password">Password</label></br></br>
				<input type="password" name="pw" id="password" placeholder="Password" required /></br></br>

				<input type="submit" value="Accedi" onclick="formhash(this.form, this.form.password);" >

			</fieldset>

		</form>

	</div>

	<div id="introduction" class="groupMargin">
		<div id="brandname">
			<p class="titoletto">Alma Mater Studiorum</p>
			<p class="nome">Università di Bologna</p>
		</div>
	</div>

</body>	
</html>