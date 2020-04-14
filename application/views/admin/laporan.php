<div id="page-wrapper">
	<div class="box-header">
		<h3 class="box-title" style="font-size: 20px; opacity: 0.7; margin-left: -9px"><b>Upload Laporan Pengujian</b></h3>
	</div>
	<div id="page-inner">
		<div class="row">
			<div class="box box-info">
				<div class="box-body">
					<div class="col-md-7">
				<div class="box table-bordered">
					<div class="box-body">
						<form method="POST" class="form-horizontal" enctype="multipart/form-data">
							<div class="form-group">
								<label class="control-label col-sm-2">Upload</label>
								<div class="col-sm-10">
									<input type="file" class="form-control" name="file_pengujian" required>
									<span style="color: red">*File yang di Upload hanya berbentuk PDF</span>
								</div>
								<label class="control-label col-md-2">Keterangan</label>
								<div class="col-sm-10">
									<textarea name="keterangan_admin" class="form-control" required></textarea>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-sm-10 col-sm-offset-2">
									<a href="<?php echo base_url("admin/data/pengajuan"); ?>" class="btn btn-primary btn-sm"><i class="fa fa-chevron-left"></i> Kembali</a>
									<button class="btn btn-success pull-right" name="simpan" value="simpan"><i class="fa fa-save"></i> Simpan</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-5">
				<div class="box table-bordered">
					<div class="box-header">
						<h3 class="box-title"><b>Log Aktivitas</b></h3>
					</div>
					<div class="box-body">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>No</th>
									<th>Waktu</th>
									<th>User</th>
									<th>Ket</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($riwayat as $key => $value): ?>
									<tr>
										<td><?php echo $key+1; ?></td>
										<td><?php echo $value['waktu']; ?></td>
										<td>
											<?php if ($value['keterangan']=="Upload"): ?>
												Admin
											<?php else: ?>
												Klien
											<?php endif ?>
										</td>
										<td><?php echo $value['keterangan']; ?></td>
									</tr>
								<?php endforeach ?>
								</tbody>
						</table>
					</div>
				</div>
			</div>
					
				</div>
			</div>
			
			
		</div>
	</div>
	
</div>