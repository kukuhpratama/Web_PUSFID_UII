<div id="page-wrapper">
	<div class="box-header">
		<h3 class="box-title" style="font-size: 20px; opacity: 0.7; margin-left: 4px"><b>Log Aktivitas</b></h3>
	</div>
	<div id="page-inner">
		<div class="box box-info">
				<div class="box-body">
					<table class="table table-bordered" id="thetable">
						<thead>
							<tr class="success">
								<th>Admin</th>
								<th>Tanggal</th>
								<th>Aktivitas</th>
								<?php if ($login['level']=="admin"): ?>
									<th>Hapus</th>
								<?php endif ?>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($history as $key => $value): ?>
								<?php if (!empty($value['aktivitas_pegawai'])): ?>
									<tr>
										<td><?php echo $value['nama_pegawai'] ?></td>
										<td>
											<ol>
											  <?php foreach ($value['aktivitas_pegawai'] as $no =>$isi): ?>
											  	<li>
											  		<?php echo date("d/M/Y H:i:s",strtotime($isi['waktu_history'])); ?>
											  	</li>
											  <?php endforeach ?>
											</ol>
										</td>
										<td>
											<ol>
											  <?php foreach ($value['aktivitas_pegawai'] as $no =>$isi): ?>
											  	<li>
											  		<?php echo $isi['aktivitas']; ?>
											  	</li>
											  <?php endforeach ?>
											</ol>
											
										</td>
										<?php if ($login['level']=="admin"): ?>
										<td class="text-center">
											<a href="<?php echo base_url("admin/history/hapus/$value[id_pegawai]") ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin?')"><i class="fa fa-trash" ></i></a>
										</td>
									<?php endif ?>
									</tr>
									
								<?php endif ?>
								
							<?php endforeach ?>
						</tbody>
					</table>
					
				</div>
		</div>
	</div>
</div>