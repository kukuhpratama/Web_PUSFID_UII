<!DOCTYPE html>
<html>
<head>
	<title>Login Pusfid UII</title>
	<link rel="stylesheet" href=" <?php echo base_url("asset/css/bootstrap.css"); ?>">
	<link rel="stylesheet" href=" <?php echo base_url("asset/css/sendiri.css"); ?>">
</head>
<body class="body-login" >
	<div class="container" >
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="form-login" style="background-color: #C4DFE6;">
					<div class="title-login">
					<img src="asset/img/logo_garuda.png" style="width: 150px">
					<h3 style="text-shadow: 0px 0px 1px"><b>LOGIN PUSFID</b></h3>
					<p>Belum punya akun PUSFID ?<a href="<?php echo base_url("daftar") ?>"> Daftar</a></p>
					</div>
				<form method="POST">
					<div class="form-group">
						<label>Username</label>
						<input type="text" name="username" class="form-control" placeholder="masukan username(email)">
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" class="form-control" placeholder="******">
					</div>
					<button class="btn btn-primary btn-lg" style="width: 100%" style="background-color: #C4DFE6;">Login</button>
					<div class="clearfix"></div>
				</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>