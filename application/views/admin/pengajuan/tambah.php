<div id="page-wrapper">
	<div class="box-header">
		<h3 class="box-title" style="font-size: 20px; opacity: 0.7"><b>Pengajuan Permohonan</b></h3>
	</div>
	<div id="page-inner">
		<div class="box box-info">
			<div class="box-body">
				<form method="POST" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
						<div class="form-group">
						<label class=" control-label col-sm-3">Klien <span style="color: red">*</span></label>
						<div class="col-sm-9 ">
							<select name="id_klien" class="form-control select2">
								<option value="">- Pilih Klien -</option>
								<?php foreach ($klien as $key => $value): ?>
									<option value="<?php echo $value['id_klien'] ?>"><?php echo $value['nama_klien']; ?></option>
								<?php endforeach ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class=" control-label col-sm-3">Judul Permohonan <span style="color: red">*</span></label>
						<div class="col-sm-9 ">
							<input type="text" class="form-control" name="judul_permohonan" required="required">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3"> Isi Permohonan <span style="color: red">*</span></label>
						<div class="col-sm-9">
							<textarea id="theeditor" class="form-control" name="isi_permohonan" required="required">

							</textarea>
						</div>
					</div>
					<br>
					<div class="form-group">
						<label class="control-label col-sm-3">File Surat <span style="color: red">*</span></label>
						<div class="col-sm-9">
							<input type="file" name="file_surat" required="required">
						</div>
						<span style="color: red;">*Hanya File dengan Ekstensi PDF yang bisa di UPLOAD</span>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3">Jumlah Sampel <span style="color: red">*</span></label>
						<div class="col-sm-9">
							<input type="number" class="form-control" name="jumlah_sampel" id="tambah" required="required">
						</div>
					</div>
					<div id="inputan">
						
					</div>


					

					<a href="<?php echo base_url("admin/data/pengajuan") ?>" class="btn btn-primary"><i class="fa fa-chevron-left"></i> Kembali</a>
					<button class="btn btn-success pull-right" ><i class="fa fa-send"></i>  Kirim</button>
				</form>

			</div>

		</div>

	</div>
</div>