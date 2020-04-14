<div id="page-wrapper">
	<div class="box-header">
		<h3 class="box-title" style="font-size: 20px; opacity: 0.7; margin-left: 4px;"><b> Tambah Pengajuan Permohonan</b></h3>
	</div>
	<div id="page-inner">
		<div class="box box-info">

			<div class="box-body">
				<a href="<?php echo base_url("klien/klien/tambah_pengajuan") ?>" class="btn btn-primary "><i class="fa fa-plus"></i> Tambah</a>
				<br>
				<br>
				<div class="callout callout-warning" style="margin-bottom: 1;">
					<h4><i class="fa fa-info"></i> INFORMASI :</h4>
					<span style="color: black; opacity: 0.6"><b>Permohonan sedang dalam proses VERIFIKASI. Mohon Menunggu, Terimakasih.</b></span>
				</div>
				<table class="table table-bordered" id="thetable">
					<thead>
						<tr class="success">
							<th>No Permohonan</th>
							<th>Tanggal</th>
							<th>Judul</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($permohonan as $key=> $value):

							 ?>
							<tr>
								<td><?php echo $value["nomor_permohonan"]; ?></td>
								<td><?php echo $value["tgl_permohonan"]; ?></td>
								<td><?php echo $value["judul_permohonan"]; ?></td>
								<td><span class="label label-warning"><?php echo $value["status_permohonan"]; ?></span></td>

							</tr>

						<?php 
					
					endforeach ?>
					</tbody>
				</table>

			</div>
		</div>
	</div>
</div>