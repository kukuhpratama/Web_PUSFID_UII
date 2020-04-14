<div id="page-wrapper">
	<div class="box-header">
		<h3 class="box-title" style="font-size: 20px; opacity: 0.7; margin-left: 4px;"><b>Edit Profile</b></h3>
	</div>
	<section id="page-inner">
		<div class="box box-info">

			<div class="box-body">
				<div class="row">
					<div class="col-md-4">
						<div class="thumbnail">
							<img src="<?php echo base_url("asset/img/klien/$login[foto_klien]"); ?>" alt="<?php echo $login['foto_klien']?>" class="img-responsive">
						</div>
					</div>
					<div class="col-md-8">
						<form method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<label>Nama</label>
								<input type="text" class="form-control" name="nama_klien" value="<?php echo $login['nama_klien']; ?>" readonly>
							</div>
							<div class="form-group">
								<label>NIK</label>
								<input type="text" class="form-control" name="nik_klien" value="<?php echo $login['nik_klien']; ?>">
							</div>
							<div class="form-group">
								<label>Username</label>
								<input type="text" class="form-control" name="username_klien" value="<?php echo $login['username_klien']; ?>" >
							</div>
							<div class="form-group">
								<label>E-mail</label>
								<input type="email" name="email_klien" class="form-control" value="<?php echo $login['email_klien']; ?>">
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="text" class="form-control" name="password_klien">
								<span style="color: red;">* Apabila password tidak di ubah, mohon kosongkan form password</span>
							</div>
							<div class="form-group">
								<label>Telpone</label>
								<input type="text" class="form-control" name="telpon_klien" value="<?php echo $login['telpon_klien']; ?>">
							</div>
							<div class="form-group">
								<label>Alamat</label>
								<input type="text" class="form-control" name="alamat_klien" value="<?php echo $login['alamat_klien']; ?>">
							</div>
							<div class="form-group">
								<label>Foto</label>
								<input type="file" class="form-control" name="foto_klien" value="<?php echo $login['foto_klien']; ?>">
							</div>
							<a href="<?php echo base_url("klien/profile/") ?>" class="btn btn-primary"><i class="fa fa-chevron-left"></i> Kembali</a>
							<button class="btn btn-success pull-right" onclick="return confirm('Apakah anda yakin mengubah data ?');"><i class="fa fa-save"></i>  Simpan</button>
						</form>
					</div>
				</div>
			</div>
		</section>

	</div>