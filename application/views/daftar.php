<!DOCTYPE html>
<html>
<head>
	<title >Daftar Akun Pusfid UII</title>
	<link rel="stylesheet" href=" <?php echo base_url("asset/css/bootstrap.css"); ?>">
	<link rel="stylesheet" href=" <?php echo base_url("asset/css/sendiri.css"); ?>">
</head>
<body style="padding-top: 20px; ">
	<div class="container">
		<!-- <h1 class="text-center" style="color: #476991; text-shadow: 1px 1px #999999; font-size: 50px;" ><b>Pusat Studi Forensika Digital UII</b></h1> -->
		<br>
		<br>
		<br>
		<div class="row center-block">
			<div>
				
			</div>
			<div class="col-md-12 form-login" style="background-color: #C4DFE6;">

				<div class="col-md-6">
					<div style="margin-top: 90px; margin-right: 10px; text-align: center;">
						<img src="asset/img/logo_garuda.png" >
					</div>
					<br>
					<div style="text-align: center;  text-shadow: 1px 1px 1px black;">
						<p style="font-size: 28px; color:#FF9900;">"CRIME LEAVES TRACE"</p>
						<p style="font-size: 28px; color: #330099">"Think Before Click"</p>  
					</div>
				</div>

				<div class="col-md-6">
					
				<div class="">
					<div class="title-login">
					<h3 style="text-shadow: 0px 0px 1px;"><b>DAFTAR AKUN PUSFID UII</b></h3>
					<p>Sudah punya akun PUSFID ?<a href="<?php echo base_url("login") ?>"> Masuk</a></p>
					</div>
				<form method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label>Username</label>
						<input type="text" name="username_klien" class="form-control" required="true" >
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password_klien" class="form-control" required="true">
					</div>
					<div class="form-group">
						<label>E-mail</label>
						<input type="email" name="email_klien" class="form-control" required="true" >
					</div>
					<div class="form-group">
						<label>Nama Lengkap</label>
						<input type="text" name="nama_klien" class="form-control" required="true">
					</div>
					<div class="form-group">
						<label>NIK</label>
						<input type="number" name="nik_klien" class="form-control" required="true">
					</div>
					<div class="form-group">
						<label>Telepon/No. HP</label>
						<input type="number" name="telpon_klien" class="form-control" required="true">
					</div>
					<div class="form-group">
						<label>Provinsi</label>
						<select name="provinsi" class="form-control" required="true">
							<option value="">- Pilih Provinsi -</option>
							<?php foreach ($provinsi as $key => $value): ?>
								<option value="<?php echo $value['province']; ?>"><?php echo $value['province']; ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="form-group">
						<label>Alamat</label>
						<textarea name="alamat_klien" class="form-control" required="true"></textarea>
				</div>
					</div>
					<div class="form-group">
						<label>Foto Pribadi</label>
						<input type="file" name="foto_klien" class="form-control" required="true">
					</div>

					<button class="btn btn-primary" style="width: 100%">Daftar</button>
					<div class="clearfix"></div>
				</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>