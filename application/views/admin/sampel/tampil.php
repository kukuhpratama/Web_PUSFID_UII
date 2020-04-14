<div id="page-wrapper">
	<div class="box-header">
		<h3 class="box-title" style="font-size: 20px; opacity: 0.7; margin-left: 4px"><b>Data Sampel</b></h3>
	<!-- 	<?php //print_r($sampel); ?>
		<?php //print_r($penerima) ?> -->
		<?php if (count($sampel)<$penerima['jumlah_sampel']): ?>
			<a href="<?php echo base_url("admin/data/sampel/tambah/$penerima[id_penerima]"); ?>" class="pull-right btn btn-primary" style="margin-right: 5px"><i class="fa fa-plus"></i> Tambah</a>
			<?php else: ?>
				<a href="#" class="pull-right btn btn-primary disabled" style="margin-right: 5px"><i class="fa fa-plus"></i> Tambah</a>
			<?php endif ?>
			<a href="<?php echo base_url("admin/data/surat/$penerima[id_penerima]"); ?>" class="pull-right btn btn-success" style="margin-right: 10px;"><i class="fa fa-print"></i> Surat</a>
		</div>
		<section id="page-inner">
			<div class="box box-info">
				<div class="box-body table-responsive">
					<table class="table table-bordered" id="thetable">
						<thead>
							<tr class="success">
								<th>No</th>
								<th>Jenis</th>
								<th>Spesifikasi</th>
								<th>Jumlah</th>
								<th>Keterangan</th>
								<th>Identitas</th>
								<th>Foto </th>
								<th>Detail Sampel</th>
								<th>Ubah</th>
								<th>Hapus</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($sampel as $key => $value): ?>	
								<tr>
									<td><?php echo $key+1; ?></td>
									<td><?php echo $value["jenis_sampel"]; ?></td>
									<td><?php echo $value["spesifikasi_sampel"]; ?></td>
									<td><?php echo $value["jumlah_sampel"]; ?></td>
									<td><?php echo $value["ket_sampel"]; ?></td>
									<td><?php echo $value["identitas_sampel"]; ?></td>
									<td class="text-center">
											<a href="#" data-toggle="modal" data-target="#foto1<?php echo $key ?>" class="btn btn-primary"><i class="fa fa-camera"></i></a>
									</td>
									<td class="text-center">
										<a href="<?php echo base_url("admin/data/detail_surat/$value[id_sampel]"); ?>" class="btn btn-success"><i class="fa fa-print"></i> Surat</a>
									</td>
									<td class="text-center">
										<a href="<?php echo base_url("admin/data/ubah_sampel/$value[id_sampel]/$penerima[id_permohonan]"); ?>" class="btn btn-warning "><i class="fa fa-edit"></i></a>
									</td>
									<td class="text-center">
										<a href="<?php echo base_url("admin/data/hapus_sampel/$value[id_sampel]/$penerima[id_permohonan]"); ?>" class="btn btn-danger " onclick="return confirm('Apakah Anda Yakin ?')"><i class="fa fa-trash"></i></a>
									</td>

								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
					<br>
					<a href="<?php echo base_url("admin/data/pengajuan"); ?>" class="btn btn-primary btn-sm"><i class="fa fa-chevron-left"></i> Kembali</a>
				</div>
			</div>
		</section>
	</div>

	<?php foreach ($sampel as $key => $value): ?>

			<!-- Modal -->
			<div id="foto1<?php echo $key;  ?>" class="modal fade" role="dialog">
				<div class="modal-dialog">

					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title"><b>Sampel</b></h4>
						</div>
						<div class="modal-body">
							<table class="table table-striped table-bordered"  width="200">
								<thead class="text-center">
									<tr>
									<th>No</th>
									<th>Foto </th>
									</tr>
									
								</thead>
								<tbody>
									<tr>
										<td>1</td>
										<td>
											<?php $folder = $permohonan['judul_permohonan']." - ".date("d-m-Y H-i-s",strtotime($permohonan['tgl_permohonan'])) ?>
											<img src="<?php echo base_url("asset/Kumpulan Kasus/$folder/$value[foto_ime]") ?>" width="200" class="img-responsive">
										</td>
									</tr>
									
								</tbody>
							</table>
								
								
								

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary" data-dismiss="modal">Keluar</button>
						</div>
					</div>

				</div>
			</div>
		<?php endforeach ?>