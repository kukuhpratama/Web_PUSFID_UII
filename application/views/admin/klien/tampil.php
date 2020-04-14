<div id="page-wrapper">
	<div class="box-header">
		<h3 class="box-title" style="font-size: 20px; opacity: 0.7; margin-left: 4px;"><b>Data Klien</b></h3>
		<?php if ($login['level']=="pegawai"): ?>
			<a href="<?php echo base_url("admin/data/tambah_klien") ?>" class="pull-right btn btn-primary" style="margin-right: 5px"><i class="fa fa-plus"></i> Tambah</a>
		<?php endif ?>
	</div>
	<section id="page-inner">
		<div class="box box-info">
			<div class="box-body table-responsive">
				<table class="table table-bordered" id="thetable">
					<thead>
						<tr class="success">
							<th>No</th>
							<th>Nik</th>
							<th>Nama</th>
							<th>Email</th>
							<th>Alamat</th>
							<!-- <th width="5%" >Hapus</th> -->
							<th width="5%">Ubah</th>
							<th>Status Klien</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($klien as $key => $value): ?>	
							<tr>
								<td><?php echo $key+1; ?></td>
								<td><?php echo $value["nik_klien"]; ?></td>
								<td><?php echo $value["nama_klien"]; ?></td>
								<td><?php echo $value["email_klien"]; ?></td>
								<td><?php echo $value["alamat_klien"]; ?></td>
							<!-- 	<td class="text-center">
									<a href="<?php //echo base_url("admin/data/hapus_klien/$value[id_klien]"); ?>" class="btn btn-danger" onclick="return confirm('Apakah yakin di Hapus?')"><i class="fa fa-trash-o"></i></a>
								</td> -->
								<td class="text-center">
									<a href="<?php echo base_url("admin/data/ubah_klien/$value[id_klien]");  ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
								</td>
								<td class="text-center">	
									<?php if ($value["status_klien"]== 'enabled'): ?>
									<a href="<?php echo base_url("admin/klien/status/$value[id_klien]/disable") ?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin mengubah status');">Disable</a></td>
									<?php else :?>
									<a href="<?php echo base_url("admin/klien/status/$value[id_klien]/enable") ?>" class="btn btn-success" onclick="return confirm('Apakah anda yakin mengubah status');">Enable</a></td>
									<?php endif ?>
							</tr>
						<?php endforeach ?>
					</tbody>

				</table>
			</div>
		</div>
	</section>
		
</div>

 