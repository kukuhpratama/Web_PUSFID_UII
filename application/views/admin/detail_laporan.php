<div id="page-wrapper">
	<div id="page-inner">
		<div class="row">
			<div class="box box-info">
				<div class="box-body">
					<div class="col-md-6">
				<div class="box table-bordered">
					<div class="box-header">
						<h3 class="box-title"><b>Laporan</b></h3>
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
										<th>Keterangan</th>
										<td><?php echo $laporan['keterangan_pengujian']; ?></td>
									</tr>
								</tbody>
							</table>
							<hr>
							<?php if ($laporan['status_pengujian']=="Tidak Sesuai"):?>
								<a href="<?php echo base_url("admin/data/laporan/$laporan[id_permohonan]"); ?>" class="btn btn-primary pull-right"><i class="fa fa-upload"></i> Upload</a>
							<?php endif ?>
							<a href="<?php echo base_url("admin/data/pengajuan"); ?>" class="btn btn-primary "><i class="fa fa-chevron-left"></i> Kembali</a>
						</div>
					</div>
				</div>
				<div class="col-md-6">
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