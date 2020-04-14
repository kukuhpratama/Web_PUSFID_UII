<div id="page-wrapper">
	<div class="box-header">
		<h3 class="box-title" style="font-size: 20px; opacity: 0.7; margin-left: 4px;"><b>Tambah Pegawai</b></h3>
	</div>
	<div id="page-inner">
		<div class="box box-info">
			<div class="box-body">
				<form method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label>NAMA</label>
						<input type="text" name="nama_pegawai" class="form-control" required>
					</div>
					<div class="form-group">
						<label>EMAIL</label>
						<input type="text" name="email_pegawai" class="form-control" required>
					</div>
					<div class="form-group">
						<label>JABATAN</label>
						<input type="text" name="jabatan_pegawai" class="form-control" required>
					</div>
					<div class="form-group">
						<label>PASSWROD</label>
						<input type="password" name="password_pegawai" class="form-control" required>
					</div>
					<div class="form-group">
						<label>ALAMAT</label>
						<textarea class="form-control" name="alamat_pegawai" required></textarea>
					</div>
					<div class="form-group">
						<label>JENIS KELAMIN</label>
						<select class="form-control" name="jenis_kelamin">
							<option>- Pilih Jenis Kelamin</option>
							<option value="laki-laki">Laki-Laki</option>
							<option value="Perempuan">Perempuan</option>
						</select>
					</div>
					<div class="form-group">
						<label>TELEPHONE</label>
						<input type="text" name="telepone_pegawai" class="form-control" required>
					</div>
					<div class="form-group">
						<label>FOTO</label>
						<input type="file" name="foto_pegawai" class="form-control">
					</div>
					<a href="<?php echo base_url("admin/admin ") ?>" class=" btn btn-primary"><i class="fa fa-chevron-left"></i> Kembali</a>
					<button class="btn btn-success pull-right"><i class="fa fa-save"></i> Simpan</button>
					
				</form>
			</div>
		</div>
	</div>
	
</div>