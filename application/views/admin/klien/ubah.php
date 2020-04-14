<div id="page-wrapper">
	<div class="box-header">
		<h3 class="box-title" style="font-size: 20px; opacity: 0.7; margin-left: 4px"><b>Edit Data Klien</b></h3>
	</div>
	<div id="page-inner">
		<div class="box box-info">

			<div class="box-body">
				<div class="row">
					<div class="col-md-4">
						<div class="thumbnail">
							<img src="<?php echo base_url("asset/img/klien/$ambil[foto_klien]"); ?>" alt="<?php echo $ambil['foto_klien']?>" class="img-responsive">
						</div>
					</div>

					<div class="col-md-8">
						<form method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label>Nama Lengkap</label>
						<input type="text" name="nama_klien" class="form-control" value="<?php echo $ambil['nama_klien']; ?>">
					</div>

					<div class="form-group">
						<label>NIK</label>
						<input type="text" name="nik_klien" class="form-control" value="<?php echo $ambil['nik_klien']; ?>">
					</div>
					
					<div class="form-group">
						<label>E-mail</label>
						<input type="email" name="email_klien" class="form-control" value="<?php echo $ambil['email_klien']; ?>">
					</div>
					<div>
						<label>Username</label>
						<input type="text" class="form-control" name="username_klien" value="<?php echo $ambil['username_klien']; ?>" >
					</div>
					<div>
						<label>Password</label>
						<input type="text" class="form-control" name="password_klien">
					</div>

					<div class="form-group">
						<label>No.Handphone</label>
						<input type="number" name="telpon_klien" class="form-control" value="<?php echo $ambil['telpon_klien']; ?>">
					</div>

					<div class="form-group">
						<label>Alamat</label>
						<textarea name="alamat_klien" class="form-control"><?php echo $ambil['alamat_klien']; ?></textarea>
					</div>

					<div class="form-group">
						<label>Upload Foto</label>
						<input type="file" name="foto_klien" class="form-control">
					</div>
					<a href="<?php echo base_url("admin/data/klien") ?>" class="btn btn-primary"><i class="fa fa-chevron-left"></i> Kembali</a>
					<button class="btn btn-success pull-right" onclick="return confirm('Apakah anda yakin mengubah data?');"><i class="fa fa-save"></i> Simpan</button>
				</form>	
					</div>
				</div>
			</div>
		</div>
	</div>
</div>