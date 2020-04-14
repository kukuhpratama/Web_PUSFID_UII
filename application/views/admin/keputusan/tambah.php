<div id="page-wrapper">
	<div class="box-header">
		<h3 class="box-title" style="font-size: 20px; opacity: 0.7; margin-left: 4px"><b>Keputusan Sampel</b></h3>
	</div>
	<div id="page-inner">
		<div class="box box-info">
			<div class="box-body">
				<form method="POST" class="form-horizontal">
					<div class="form-group">
						<label class="control-label col-sm-2">Keputusan</label>
						<div class="col-sm-10">
							<select name="status_keputusan" class="form-control" required>
								<option value="">- Pilih Keputusan</option>
								<option value="Di Kembalikan">Di Kembalikan</option>
								<option value="Di Musnahkan">Di Musnahkan</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-10 col-sm-offset-2">
							<a href="<?php echo base_url("admin/data/pengajuan"); ?>" class="btn btn-primary"><i class="fa fa-chevron-left"></i> Kembali</a>
							<button class="btn btn-success pull-right"><i class="fa fa-save"></i> Simpan</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		
	</div>
	
</div>