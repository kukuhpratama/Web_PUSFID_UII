<div id="page-wrapper">
	<br>
	<div class="box-header">
		<h3 class="box-title" style="font-size: 20px; opacity: 0.7; margin-left: 4px;"><b>Data Permohonan</b></h3>
	</div>
	
	<div id="page-inner">
		<div class="box box-info">
			<br>
			<div class="box-body">
				<div class="callout callout-info" style="margin-bottom: 1;">
					<h4><i class="fa fa-info"></i> INFORMASI :</h4>
					<span style="color: black; opacity: 0.6"><b>Lanjutkan Pengisian Data Pada Halaman Administrasi Pengujian. Setelah Verifikasi </b></span><a style="color: black; text-decoration: none" class="btn btn-warning btn-xs" href="<?php echo base_url("admin/data/pengajuan") ?>"><b>KLIK</b></a>
				</div>
				<table class="table table-bordered" id="thetable">
					<thead>
						<tr class="success">
							<th>No</th>
							<th>No Permohonan</th>
							<th>Tanggal Permohonan</th>
							<th>Judul Permohonan</th>
							<th>Klien</th>
							<th>Surat Instansi</th>
							<th>Sampel</th>
							<th>Status Permohonan</th>
							<th>Surat Permohonan</th>
							<!-- <th>Status Pembayaran</th> -->
							<th>Verifikasi Permohonan</th>
						</tr>
					</thead>
					<tbody>
						<?php $no=0; ?>
						<?php foreach ($pengajuan as $key => $value): ?>
							<?php if ($value['status_permohonan']=="Pending"): ?>
								<tr>
									<td><?php echo $no+=1; ?></td>
									<td><?php echo $value["nomor_permohonan"]; ?></td>
									<td><?php echo $value["tgl_permohonan"]; ?></td>
									<td><?php echo $value["judul_permohonan"]; ?></td>
									<td><?php echo $value["nama_klien"]; ?></td>
									<td class="text-center">
										<?php $folder = $value['judul_permohonan']." - ".date("d-m-Y H-i-s",strtotime($value['tgl_permohonan'])) ?>
										<a href="<?php echo base_url("asset/Kumpulan Kasus/$folder/$value[surat_permohonan]") ?>" target="_blank" class="btn btn-info" ><i class="fa fa-download"></i></a>
									</td>
									<td class="text-center">
										<a href="#" data-toggle="modal" data-target="#foto1<?php echo $key ?>" class="btn btn-primary"><i class="fa fa-camera"></i></a>
									</td>
									<td class="text-center">
										<?php if ($value['status_permohonan']=="Diterima"): ?>
											<span class="label label-success">Diterima</span>
											<?php elseif($value['status_permohonan']=="Tidak Diterima"): ?>
												<span class="label label-danger">Tidak Diterima</span>
												<?php else: ?>
													<span class="label label-warning">Pending</span>
												<?php endif ?>
											</td>
											<td class="text-center">
												<?php if ($value['status_permohonan']=="Pending"): ?>
													<a href="<?php echo base_url("admin/data/surat_permohonan/$value[id_permohonan]") ?>" class="btn btn-success" title="Surat Permohonan Klien"><i class="fa fa-file-text-o" ></i></a>
												</td>
												<td class="text-center">
													<a href="<?php echo base_url("admin/data/verifikasi/$value[id_permohonan]") ?>" class="btn btn-primary " tutle="Surat Verifikasi"><i class="fa fa-hourglass-end"></i></a>

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

			<a href="" class="btn-help" data-toggle="modal" data-target="#baru"><i class="fa fa-question"></i></a>

		</div>

		<?php foreach ($permohonan as $key => $value): ?>
			<?php $folder = $value['judul_permohonan']." - ".date("d-m-Y H-i-s",strtotime($value['tgl_permohonan'])) ?>
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
										<th>No </th>
										<th>File </th>

									</tr>
								</thead>
								<tbody>
									<?php foreach ($value['foto'] as $no => $isi): ?>
										<tr>
											<td><?php echo ++$no ?></td>
											<td class="text-center">
												<?php $cek = pathinfo($isi['foto'],PATHINFO_EXTENSION); ?>
												<?php if ($cek=="jpg" OR $cek=="png"): ?>
													<img src="<?php echo base_url("asset/Kumpulan Kasus/$folder/$isi[foto]") ?>" width="250"> 
													<?php elseif ($cek=="mp3" OR $cek=="mpeg"): ?>
														<audio width="250" controls="">
															<source  src="<?php echo base_url("asset/Kumpulan Kasus/$folder/$isi[foto]") ?>" type="video/mp4">
														</audio>
														<?php elseif ($cek=="mp4"): ?>
															<video width="250" controls="">
																<source  src="<?php echo base_url("asset/Kumpulan Kasus/$folder/$isi[foto]") ?>" type="video/mp4">
																</video>
															<?php endif ?>
														</td>


													</tr>
												<?php endforeach ?>
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

					<div class="modal fade" id="baru" role="dialog" style="margin-top: 60px; margin-left: 100px;" >
						<div class="modal-dialog" role="document">
							<div class="modal-content text-center" style="width: 80%; margin-left: 95px">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<img src="<?php echo base_url("asset/img/permohonan.jpg") ?>" style="width: 100%">
								</div>
								<div class="modal-footer">
								</div>
							</div>
						</div>
					</div>
					<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
					<script> 
						$(window).on('load',function(){ 
							$('#baru').modal({ 
								show: true,
								backdrop: 'static',
								keyboard: false
							})
						})
					</script>