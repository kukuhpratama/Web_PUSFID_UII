<div id="page-wrapper">
	<div class="box-header">
		<h3 class="box-title" style="font-size: 20px; opacity: 0.7; margin-left: 4px;"><b>Edit Data Pegawai</b></h3>
	</div>
	<div id="page-inner">
		<div class="box box-info">

			<div class="box-body">
				<div class="row">
					<div class="col-md-4">
						<div class="thumbnail">
							<img src="<?php echo base_url("asset/img/$login[foto_tanda_pegawai]"); ?>" alt="<?php echo $login['foto_tanda_pegawai']?>" class="img-responsive">
						</div>
					</div>
					<div class="col-md-8">

						
						<form method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<label>NAMA</label>
								<input type="text" name="nama_pegawai" class="form-control" value="<?php echo $login['nama_pegawai'] ?>">
							</div>
							<div class="form-group">
								<label>EMAIL</label>
								<input type="text" name="email_pegawai" class="form-control" value="<?php echo $login['email_pegawai']?>">
							</div>
							<div class="form-group">
								<label>JABATAN</label>
								<input type="text" name="jabatan_pegawai" class="form-control" value="<?php echo $login['jabatan_pegawai'] ?>">
							</div>
							<div class="form-group">
								<label>PASSWORD</label>
								<input type="text" name="password_pegawai" class="form-control">
								<span class="text-danger">* Apabila password tidak diubah mohon dikosongkan!</span>
							</div>
							<div class="form-group">
								<label>ALAMAT</label>
								<textarea class="form-control" name="alamat_pegawai"><?php echo $login['alamat_pegawai'] ?></textarea>
							</div>
							<div class="form-group">
								<label>JENIS KELAMIN</label>
								<select class="form-control" name="jenis_kelamin">
									<option>- Pilih Jenis Kelamin</option>
									<option value="laki-laki" <?php if ($login['jenis_kelamin']=='laki-laki') { echo "selected";
									
								} ?>>Laki-Laki</option>
								<option value="Perempuan" <?php if ($login['jenis_kelamin']=='Perempuan') { echo "selected";

							} ?>>Perempuan</option>
						</select>
					</div>
					<div class="form-group">
						<label>TELEPHONE</label>
						<input type="text" name="telepone_pegawai" class="form-control" value="<?php echo $login['telepone_pegawai'] ?>">
					</div>
					<div class="form-group">
						<label>FOTO</label>
						<input type="file" name="foto_tanda_pegawai" class="form-control">
					</div>
					<a href="<?php echo base_url("admin/admin") ?>" class="btn btn-primary"><i class="fa fa-chevron-left"></i> Kembali</a>
					<button class="btn btn-success pull-right" onclick="return confirm('Apakah anda yakin mengubah data ?');" ><i class="fa fa-save"></i> Simpan</button>
				</form>
			</div>	
		</div>
	</div>
</div>
</div>

</div>