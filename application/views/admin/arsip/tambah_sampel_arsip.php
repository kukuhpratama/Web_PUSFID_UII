<div id="page-wrapper">
	<div class="box-header">
		<h3 class="box-title" style="font-size: 20px; opacity: 0.7; margin-left: 4px"><b>Sampel</b></h3>
	</div>
	<section id="page-inner">
		<div class="box box-info">
			<div class="box-body">
				<form method="POST" autocomplete="off">
					<div class="form-group">
						<label>Jenis Sampel</label>
						<input type="text" name="jenis_sampel" class="form-control">
					</div>
					<div class="form-group">
						<label>Spesifikasi Sampel</label>
						<input type="text" name="spesifikasi_sampel" class="form-control">
					</div>
					<div class="form-group">
						<label>Jumlah Sampel</label>
						<input type="text" name="jumlah_sampel" class="form-control">
					</div>
					<div class="form-group">
						<label>Keterangan</label>
						<textarea class="form-control ckeditor" name="ket_sampel"></textarea> 
					</div>
					<div class="form-group">
						<label>Identitas Sampel</label>
						<textarea class="form-control ckeditor". name="identitas_sampel" placeholder="Masukan IME atau Kode Sampel"></textarea> 
					</div>
					<a href="<?php echo base_url("admin/data/sampel_arsip/$permohonan[id_permohonan]") ?>" class="btn btn-primary"><i class="fa fa-chevron-left"> Kembali</i></a>
					<button class="btn btn-success pull-right"><i class="fa fa-save"></i> Simpan</button>
				</form>
					
			</div>
		</div>
	</section>
</div>