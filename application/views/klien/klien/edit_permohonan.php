<div id="page-wrapper">
	<div class="box-header">
		<h3 class="box-title" style="font-size: 20px; opacity: 0.7; margin-left: 4px;"><b>Tambah Sampel</b></h3>
	</div>
	<div id="page-inner">
		<div class="box box-info">
			<div class="box-body">
				<form method="POST" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
			<!-- 		<div class="form-group">
						<label class=" control-label col-sm-3">Judul Permohonan <span style="color: red">*</span></label>
						<div class="col-sm-9 ">
							<input type="text" class="form-control" required value="<?php //echo $permohonan['judul_permohonan']; ?>">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3"> Isi Permohonan <span style="color: red">*</span></label>
						<div class="col-sm-9">
							<textarea id="theeditor" class="form-control"  required >
								<?php //echo $permohonan['judul_permohonan']; ?>
							</textarea>
						</div>
					</div>
					<br>
					<div class="form-group">
						<label class="control-label col-sm-3">File Surat <span style="color: red">*</span></label>
						<div class="col-sm-9">
							<input type="file"  required value="<?php //echo $permohonan['surat_permohonan']; ?>">
						</div>
						<span style="color: red;">*Hanya File dengan Ekstensi PDF yang bisa di UPLOAD</span>
					</div> -->
					<h4><b>Tambah Sampel Permohonan</b></h4>
					<br>
					<div class="form-group">
						<label class="control-label col-sm-2">Jumlah Sampel <span style="color: red">*</span></label>
						<div class="col-sm-10">
							<input type="number" class="form-control" name="jumlah_sampel" id="tambah" >
						</div>
					</div>
					<div id="inputan">
						
					</div>
					<a href="<?php echo base_url("klien/history"); ?>" class="btn btn-primary btn-sm"><i class="fa fa-chevron-left"></i> Kembali</a>
					<button class="btn btn-success pull-right" ><i class="fa fa-send"></i>  Kirim</button>
				</form>

			</div>

		</div>

	</div>