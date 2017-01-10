<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript" src="sha512.js"></script>
	<script type="text/javascript" src="forms.js"></script>

	<meta charset="utf-8">

	<title>Accedi</title>
	<link href="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/style.css">


</head>
<body>
	<div class="container">
	    <div class="row login">
	        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 well">
	            <form role="form" action="process_login.php" method="post" name="login_form">
	              <div class="form-group text-center">
	                <div class="logo">
	                    <span class="glyphicon glyphicon-user set-logo"></span>
	                </div>
	              </div>
	              <div class="form-group">
	                <input type="email" class="form-control input-lg" name="email" autocomplete="on" placeholder="E-mail">
	              </div>
	              <div class="form-group">
	                <input type="password" class="form-control input-lg" name="pw" placeholder="Password">
	              </div>
	              <div class="form-group">
	                <button type="submit" class="btn btn-default btn-lg btn-block btn-success" onclick="formhash(this.form, this.form.password);">Accedi</button>
	              </div>
	              <div class="form-group last-row">
	                <label class="checklabel">
	                    <input type="checkbox"> Ricordami
	                </label>
	                <a href="#" class="pull-right">Password dimenticata</a>
	              </div>
	            </form>
	        </div>
	    </div>
	</div>
</body>
</html>