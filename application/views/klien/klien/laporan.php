<div id="page-wrapper">
	<div class="box-header">
		<h3 class="box-title" style="font-size: 20px; opacity: 0.7; margin-left: 4px;"><b> Laporan Akhir Pengujian</b></h3>
	</div>
	<div id="page-inner">
		<div class="box box-info">
			<div class="box-body">
				<div class="row">
			<div class="col-md-6">
				<div class="box table-bordered">
					<div class="box-header">
						<h3 class="box-title"><b>Laporan Akhir</b></h3>
					</div>
					<div class="box-body">
						<table class="table">
							<tbody>
								<tr>
									<th>File</th>
									<td>
										<?php $folder = $permohonan['judul_permohonan']." - ".date("d-m-Y H-i-s",strtotime($permohonan['tgl_permohonan'])) ?>
										<a href="<?php echo base_url("asset/Kumpulan Kasus/$folder/$laporan[file_pengujian]") ?>" class="btn btn-primary"><i class="fa fa-download"></i> Download</a>
									</td>
								</tr>
								<tr>
									<th>Status</th>
									<?php if ($laporan['status_pengujian']=="Sesuai"): ?>
										<td ><span class="label label-success"><?php echo $laporan['status_pengujian']; ?></span></td>
										<?php else: ?>
											<td ><span class="label label-danger"><?php echo $laporan['status_pengujian']; ?></span></td>
										<?php endif ?>
									</tr>
									<tr>
										<th>Keterangan Klien</th>
										<td><?php echo $laporan['keterangan_pengujian']; ?></td>
									</tr>
									<tr>
										<th>Keterangan Admin</th>
										<td><?php echo $laporan['keterangan_pegawai']; ?></td>
									</tr>
								</tbody>	
							</table>
							<hr>
							<?php if ($laporan['status_pengujian']=="Sesuai"): ?>
									<div>		
										<a href="<?php echo base_url("klien/history") ?>" class="btn btn-primary"><i class="fa fa-chevron-left"> Kembali</i></a>
									</div>
									<?php endif ?>
							<?php if ($laporan['status_pengujian']=="" OR $laporan['status_pengujian']=='Tidak Sesuai'):?>
								<div class="box-header" style="text-align: center;">
									<h3 class="box-title"><b>Verifikasi Hasil</b></h3>
								</div>
								<form method="POST">
									<div class="form-group">
										<label>Status</label>
										<select name="status_pengujian" class="form-control">
											<option value="">- Pilih Status</option>
											<option value="Sesuai" >Sesuai</option>
											<option value="Tidak Sesuai">Tidak Sesuai</option>
											
										</select>
									</div>
									<div class="form-group">
										<label>Keterangan</label>
										<textarea name="keterangan_pengujian" class="form-control"></textarea>
									</div>
									<a href="<?php echo base_url("klien/history") ?>" class="btn btn-primary"><i class="fa fa-chevron-left"> Kembali</i></a>
									<button class="btn btn-success pull-right
									" onclick="Verifikasi berhasil dilakukan. Terimakasih"><i class=" fa fa-save"></i> Simpan</button>
								</form>
							<?php endif ?>
						</div>
					</div>
				</div>
				<div class="col-md-6">
				<div class="box  table-bordered">
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