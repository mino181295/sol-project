<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript" src="sha512.js"></script>
	<script type="text/javascript" src="forms.js"></script>		

	<meta charset="utf-8">

	<title>Accedi</title>
	<link rel="stylesheet" href="../app/lib/Bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../app/lib/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">


</head>
<body>
	<div class="container">
	    <div class="row login">
	        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 well">
	            <form role="form" action="process_login.php" method="post" name="login_form">
	              <div class="form-group text-center">
	                <div class="logo">
	                    <!--<span class="glyphicon glyphicon-user set-logo"></span>-->
	                    <img src="../app/image/logo_unibo.png" alt="">
	                </div>
	              </div>
	              <?php
						if(isset($_GET['error'])) { 
						   $error = $_GET['error'];
							if($error == 1) {
								//email sbagliata
								echo
		              			'<div class="form-group">
									<label for="email" class="cols-sm-2 control-label">E-mail</label>
									<div class="cols-sm-10">
										<div class="input-group has-error has-feedback">
											<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
											<input type="email" class="form-control input-lg" name="email" id="email" autocomplete="on" placeholder="es. mario.rossi@studio.unibo.it"/>
										</div>
									</div>
								</div>

								<div class="form-group">
									<label for="password" class="cols-sm-2 control-label">Password</label>
									<div class="cols-sm-10">
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
											<input type="password" class="form-control input-lg" name="password" id="password"  placeholder="Password"/>
										</div>
									</div>
								</div>';
							} else if($error == 2) {
								//password sbagliata
								echo 
								'<div class="form-group">
									<label for="email" class="cols-sm-2 control-label">E-mail</label>
									<div class="cols-sm-10">
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
											<input type="text" class="form-control input-lg" name="email" id="email"  placeholder="es. mario.rossi@studio.unibo.it"/>
										</div>
									</div>
								</div>

								<div class="form-group">
									<label for="password" class="cols-sm-2 control-label">Password</label>
									<div class="cols-sm-10">
										<div class="input-group has-error has-feedback">
											<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
											<input type="password" class="form-control input-lg" name="password" id="password"  placeholder="Password"/>
										</div>
									</div>
								</div>';
							}
						} else {
							echo 
							'<div class="form-group">
								<label for="email" class="cols-sm-2 control-label">E-mail</label>
								<div class="cols-sm-10">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
										<input type="text" class="form-control input-lg" name="email" id="email"  placeholder="es. mario.rossi@studio.unibo.it"/>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label for="password" class="cols-sm-2 control-label">Password</label>
								<div class="cols-sm-10">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
										<input type="password" class="form-control input-lg" name="password" id="password"  placeholder="Password"/>
									</div>
								</div>
							</div>';
						}
					?>
					<!--<div class="form-group">
	                			<input type="email" class="form-control input-lg" name="email" autocomplete="on" placeholder="E-mail" required />
	              			</div>
	              			<div class="form-group">
	                			<input type="password" name="pw" id="password" class="form-control input-lg" placeholder="Password" required />
	              			</div>-->

	              		<!--<div class="form-group">
							<label for="email" class="cols-sm-2 control-label">Email</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="email" id="email"  placeholder="es. mario.rossi@unibo.it, mario.rossi@studio.unibo.it"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="password" class="cols-sm-2 control-label">Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="password" id="password"  placeholder="Password"/>
								</div>
							</div>
						</div>-->
	              <div class="form-group">
	                <button type="submit" class="btn btn-default btn-lg btn-block btn-success" onclick="formhash(this.form, this.form.password);">Accedi</button>
	              </div>
	            </form>
	        </div>
	    </div>
	</div>
</body>
</html>