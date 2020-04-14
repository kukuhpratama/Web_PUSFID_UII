<div id="page-wrapper">
	<div class="box-header">
		<h3 class="box-title" style="font-size: 20px; opacity: 0.7; margin-left: 4px"><b>Data Sampel</b></h3>
		<!-- <a href="<?php //echo base_url("admin/data/tambah_sampel_arsip/$penerima[id_penerima]"); ?>" class="pull-right btn btn-primary" style="margin-right: 5px"><i class="fa fa-plus"></i> Tambah</a> -->
		<a href="<?php echo base_url("admin/data/surat_sampel_arsip/$penerima[id_penerima]"); ?>" class="pull-right btn btn-success" style="margin-right: 10px;"><i class="fa fa-print"></i> Surat All Sampel</a>
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
							<th>Detail Sampel</th>
							<!-- <th>Edit</th>
							<th>Delete</th> -->
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
									<a href="<?php echo base_url("admin/data/surat_detail_sampel_arsip/$value[id_sampel]"); ?>" class="btn btn-success"><i class="fa fa-print"></i> Surat</a>
								</td>
								<!-- <td class="text-center">
									<a href="<?php //echo base_url("admin/data/ubah_sampel_arsip/$value[id_sampel]/$penerima[id_permohonan]"); ?>" class="btn btn-warning "><i class="fa fa-edit"></i></a>
								</td> -->
							<!-- 	<td class="text-center">
									<a href="<?php //echo base_url("admin/data/hapus_sampel/$value[id_sampel]/$penerima[id_permohonan]"); ?>" class="btn btn-danger " onclick="return confirm('Apakah Anda Yakin ?')"><i class="fa fa-trash"></i></a>
								</td> -->
									
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
				<br>
				<a href="<?php echo base_url("admin/data/arsip"); ?>" class="btn btn-primary btn-sm"><i class="fa fa-chevron-left"></i> Kembali</a>
			</div>
		</div>
	</section>
</div>