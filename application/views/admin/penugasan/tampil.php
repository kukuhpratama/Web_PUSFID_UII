<div id="page-wrapper">
	<div class="box-header">
		<h3 class="box-title" style="font-size: 20px; opacity: 0.7; margin-left: 4px"><b>Data Penugasan</b></h3>
		<a href="<?php echo base_url("admin/data/tambah_penugasan/$id_penugasan/$penerima[id_permohonan]"); ?>" class="pull-right btn btn-primary" style="margin-right: 5px;"><i class="fa fa-plus" ></i> Tambah</a>
		<a href="<?php echo base_url("admin/data/surat_penugasan/$id_penugasan"); ?>" class="pull-right btn btn-success" style="margin-right: 10px;"><i class="fa fa-print"></i> Surat</a>
	</div>
	<section id="page-inner">
		<div class="box box-info">
			<div class="box-body table-responsive">
				<!-- <pre> -->
					<!-- <?php //print_r($pengajuan); ?> -->
					<!-- </pre>   -->
					<table class="table table-bordered" id="thetable">
						<thead>
							<tr class="success">
								<th>No</th>
								<th>Nama</th>
								<th>Pekerjaan</th>
								<th>Deskripsi Tugas</th>
								<th>Ubah</th>
								<th>Hapus</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($penugasan as $key => $value): ?>	
								<tr>
									<td><?php echo $key+1;?></td>
									<td><?php echo $value["nama_pegawai"]; ?></td>
									<td><?php echo $value["jabatan_pegawai"]; ?></td>
									<td><?php echo $value["tugas"]; ?></td>
									<td  class="text-center">
										<a href="<?php echo base_url("admin/data/edit_penugasan/$value[id_detail_penugasan]/$penerima[id_permohonan]"); ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
										
									</td>
									<td class="text-center">
										<a href="<?php echo base_url("admin/data/hapus_penugasan/$value[id_detail_penugasan]/$penerima[id_permohonan]"); ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin ?')"><i class="fa fa-trash"></i></a>
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