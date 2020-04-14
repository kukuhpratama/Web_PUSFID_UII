<div id="page-wrapper">
	<div class="box-header">
		<h3 class="box-title" style="font-size: 20px; opacity: 0.7; margin-left: 4px;"><b>Tambah Klien</b></h3>
	</div>
	<div id="page-inner">
		<div class="box box-info">
			<div class="box-body">
				<form method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label>Nama Lengkap</label>
						<input type="text" name="nama_klien" class="form-control" required="">
					</div>

					<div class="form-group">
						<label>NIK</label>
						<input type="text" name="nik_klien" class="form-control" required="">
					</div>
					
					<div class="form-group">
						<label>E-mail</label>
						<input type="email" name="email_klien" class="form-control" required="">
					</div>

					<div class="form-group">
						<label>No.Handphone</label>
						<input type="number" name="telpon_klien" class="form-control" required="">
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
						<textarea name="alamat_klien" class="form-control" required=""></textarea>
					</div>

					<div class="form-group">
						<label>Upload Foto</label>
						<input type="file" name="foto_klien" class="form-control">
					</div>
					<a href="<?php echo base_url("admin/data/klien") ?>" class=" btn btn-primary"><i class="fa fa-chevron-left"></i> Kembali</a>
					<button class="btn btn-success pull-right"><i class="fa fa-save"></i> Simpan</button>
				</form>	
			</div>
		</div>
	</div>
</div>