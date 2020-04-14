<div id="page-wrapper">
	<div class="box-header">
		<h3 class="box-title" style="font-size: 20px; opacity: 0.7; margin-left: 4px"><b>Data Pegawai</b></h3>
	</div>
	<section id="page-inner">
		<div class="box box-info">
			<div class="box-header">
				<a href="<?php echo base_url("admin/admin/tambah"); ?>" class="btn btn-primary pull-right"><i class=" fa fa-plus"></i> Tambah</a>
			</div>

			<div class="box-body table-responsive">
				<table class="table table-bordered" id="thetable">
					<thead >
						<tr class="success">
							<th >No</th>
							<th >NAMA</th>
							<th >EMAIL</th>
							<th >JABATAN</th>
							<th >FOTO</th>
							<th class="hidden">Hapus</th>
							<th>Ubah</th>
							<th>status_pegawai</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($pegawai as $key => $value): ?>	
							<tr>
								<td><?php echo $key+1; ?></td>
								<td><?php echo $value["nama_pegawai"]; ?></td>
								<td><?php echo $value["email_pegawai"]; ?></td>
								<td><?php echo $value["jabatan_pegawai"]; ?></td>
								<td><?php echo $value["foto_tanda_pegawai"]; ?></td>
								<td class="text-center hidden">
									<a href="<?php echo base_url("admin/admin/hapus_akun/$value[id_pegawai]"); ?>" class="btn btn-danger btn-sm"  onclick="return confirm('Apakah yakin di Hapus?')"><i class="fa fa-trash"></i></a>
								</td>
								<td class="text-center">
									<a href="<?php echo base_url("admin/admin/ubah_admin/$value[id_pegawai]"); ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
								</td>
								<td class="text-center">
									<?php if ($value["status_pegawai"]== 'enabled'): ?>
									<a href="<?php echo base_url("admin/admin/status/$value[id_pegawai]/disable") ?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin mengubah status');">Disable</a></td>
									<?php else :?>
									<a href="<?php echo base_url("admin/admin/status/$value[id_pegawai]/enable") ?>" class="btn btn-success" onclick="return confirm('Apakah anda yakin mengubah status');" >Enable</a></td>
									<?php endif ?>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>

				</table>
			</div>
		</div>
	</section>
</div>