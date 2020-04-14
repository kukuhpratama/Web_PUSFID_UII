<div id="page-wrapper">
	<div class="box-header">
		<h3 class="box-title" style="font-size: 20px; opacity: 0.7; margin-left: 4px"><b>Penugasan Pengujian Permohonan</b></h3>
	</div>
	<section id="page-inner">
		<div class="box box-info">
			<div class="box-body">
				<form method="POST">
					<div class="form-group">
						<label>Nama Petugas</label>
						<select name="id_pegawai" class="form-control" required="">
							<option value="">- Pilih Petugas</option>
							<?php foreach ($admin as $value): ?>
								<option value="<?php echo $value['id_pegawai']; ?>" <?php if($detail['id_pegawai']==$value['id_pegawai']){echo"selected";} ?>><?php echo $value['nama_pegawai']; ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="form-group">
						<label>Deskripsi Tugas</label>
						<textarea name="tugas" class="form-control" ><?php echo $detail['tugas']; ?></textarea>
					</div>
					<a href="<?php echo base_url("admin/data/penugasan/$detail[id_detail_penugasan]") ?>" class="btn btn-primary"><i class="fa fa-chevron-left"></i> Kembali</a>
					<button class="btn btn-success pull-right" onclick="return confirm('Apakah anda yakin mengubah data?')"><i class="fa fa-save"></i> Simpan</button>
				</form>
			</div>
		</div>
	</section>
</div>