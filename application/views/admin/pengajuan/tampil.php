<style>
	.zoom:hover{
		transform: scale(3.5);
	}
</style>
<div id="page-wrapper">
	<div class="box-header">
		<h3 class="box-title" style="font-size: 20px; opacity: 0.7; margin-left: 4px;"><b>Data Administrasi Pengujian</b></h3>
		<a href="<?php echo base_url("admin/data/tambah_permohonan"); ?>" class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-plus"></i> Tambah</a>
	</div>
	<section id="page-inner">
		<div class="box box-info">
			<div class="box-body ">
				<div class="callout callout-info" style="margin-bottom: 1;">
					<h4><i class="fa fa-info"></i> INFORMASI :</h4>
					<span style="color: black; opacity: 0.6"><b>Tolong Periksa kembali Pengimputan Data, Pada Saat Pembuatan Surat Administrasi</b></span>
				</div>
				<table class="table table-bordered" id="thetable">
					<thead>
						<tr class="success">
							<th>No</th>
							<th>No Permohonan</th>
							<th>Judul Permohonan</th>
							<th width="60">Klien</th>
							<th>Tanggal Permohonan</th>
							<th>Status Permohonan</th>
							<th>Sampel</th>
							<th width="300">Aksi</th>
							<!-- <th>Note</th> -->
							<th>Resume</th>
						</tr>
					</thead>
					<tbody>
						<?php $no=0; ?>
						<?php foreach ($pengajuan as $key => $value): ?>	
							<?php if ($value['status_permohonan']=="Diterima"): ?>
								<?php if ($value['mk']!=='isi'): ?>
									<tr>
										<td><?php echo $no+=1; ?></td>
										<td><?php echo $value["nomor_permohonan"]; ?></td>
										<td><?php echo $value["judul_permohonan"]; ?></td>
										<td><?php echo $value["nama_klien"]; ?></td>
										<td><?php echo $value["tgl_permohonan"]; ?></td>
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
													<a href="#" data-toggle="modal" data-target="#foto1<?php echo $key ?>" class="btn btn-primary"><i class="fa fa-camera"></i></a>
												</td>
												<td>
													<a href="<?php echo base_url("admin/data/detail/$value[id_permohonan]") ?>" class="btn btn-success btn-sm" title="Surat Permohonan Klien">P1</a>
													<?php if ($value['status_permohonan']=="Pending"): ?>
														<a href="<?php echo base_url("admin/data/verifikasi/$value[id_permohonan]") ?>" class="btn btn-primary btn-sm" title="Surat Verifikasi Permohonan">P2</a>

													<?php endif ?>
													<?php if ($value['status_permohonan']=="Diterima"): ?>
														<a href="<?php echo base_url("admin/data/verifikasi/$value[id_permohonan]") ?>" class="btn btn-success btn-sm" title="Surat Verifikasi Permohonan">P2</a>

														<?php if ($value['s1']=="isi"): ?>

															<a href="<?php echo base_url("admin/data/sampel/$value[id_permohonan]") ?>" class="btn btn-success
																btn-sm" title="Input Sampel">S1 & S2</a>
																<?php if ($value['t1']=="isi"): ?>
																	<a href="<?php echo base_url("admin/data/penugasan/$value[id_permohonan]") ?>" class="btn btn-success btn-sm" title="Input Penugasan Pengujian">T1</a>
																	<?php else: ?>
																		<a href="<?php echo base_url("admin/data/penugasan/$value[id_permohonan]") ?>" class="btn btn-primary btn-sm">T1</a>	
																	<?php endif ?>
																<?php else: ?>
																	<a href="<?php echo base_url("admin/data/sampel/$value[id_permohonan]") ?>" class="btn btn-primary btn-sm">S1 & S2</a>
																	<a href="#" class="btn btn-primary btn-sm">T1</a>
																<?php endif ?>
																	<!-- akhir -->
																
																<?php if ($value['t1']=="isi"): ?>
																	<?php if ($cek_laporan[$key]['status_laporan']=="Belum Ada"): ?>

																		<a href="<?php echo base_url("admin/data/laporan/$value[id_permohonan]") ?>" class="btn btn-primary btn-sm" title="Upload Laporan Akhir Analisis">LAPORAN</a>
																		<a href="#" class="btn btn-primary btn-sm" disable="disabled" title="Surat Keputusan Sampel">MK1</a>
																		
																		<?php else: ?>

																			<?php if ($cek_laporan[$key]['hasil_laporan']=='Sesuai'): ?>
																				<a href="<?php echo base_url("admin/data/detail_laporan/$value[id_permohonan]") ?>" class="btn btn-success btn-sm" title="Upload Laporan Akhir Analisis">LAPORAN</a>
																				<?php else: ?>
																					<a href="<?php echo base_url("admin/data/detail_laporan/$value[id_permohonan]") ?>" class="btn btn-primary btn-sm" title="Upload Laporan Akhir Analisis">LAPORAN</a>
																				<?php endif ?>

																				<?php if ($value['mk']=="isi"): ?>
																					<a href="<?php echo base_url("admin/data/keputusan/$value[id_permohonan]") ?>" class="btn btn-success btn-sm" title="Surat Keputusan Sampel">MK1</a>
																					<?php else: ?>
																						<?php if ($cek_laporan[$key]['hasil_laporan']=='Sesuai'): ?>
																							<a href="<?php echo base_url("admin/data/keputusan/$value[id_permohonan]") ?>" class="btn btn-primary btn-sm" title="Surat Keputusan Sampel">MK1</a>
																							<?php else: ?>
																								<a href="#" class="btn btn-primary btn-sm" disable="disabled" title="Surat Keputusan Sampel">MK1</a>
																							<?php endif ?>
																						<?php endif ?>
																					<?php endif ?>
																					<?php else: ?>
																					<a href="#" class="btn btn-primary btn-sm" title="Upload Laporan Akhir Analisis">LAPORAN</a>
																					<a href="#" class="btn btn-primary btn-sm" disable="disabled" title="Surat Keputusan Sampel">MK1</a>
																					<?php endif ?>

																					<?php elseif($value['status_permohonan']=="Tidak Diterima"): ?>
																						<a href="<?php echo base_url("admin/data/verifikasi/$value[id_permohonan]") ?>" class="btn btn-success btn-sm" title="Surat Verifikasi Permohonan">P2</a>
																					<?php endif ?>
																				</td>
																				<!-- <td class="text-center">
																					<a href="<?php //echo base_url("admin/data/note/$value[id_permohonan]"); ?>" class="btn btn-primary" title="Catata Kasus"><i class="fa fa-paperclip" ></i></a>
																				</td> -->
																				<td class="text-center">
																					<a href="<?php echo base_url("admin/data/resume/$value[id_permohonan]"); ?>" class="btn btn-info" title="Arsip Surat"><i class="fa fa-file-text" ></i></a>
																				</td>
																			</tr>
																		<?php endif ?>
																	<?php endif ?>
																<?php endforeach ?>

															</tbody>

														</table>


													</div>
												</div>
											</section>
											<a href="" class="btn-help"><i class="fa fa-question"></i></a>
										</div>

										<?php foreach ($pengajuan as $key => $value): ?>
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
								<th>File Sampel</th>
								<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($value['foto'] as $no => $isi): ?>
								<tr>
								<td><?php echo ++$no ?></td>
								<td class="text-center">
								<?php $cek = pathinfo($isi['foto'],PATHINFO_EXTENSION); ?>
												<?php if ($cek=="jpg" OR $cek=="png"): ?>
													<img src="<?php echo base_url("asset/Kumpulan Kasus/$folder/$isi[foto]") ?>" width="250" class="zoom"> 
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
								<td class="text-center">
									<a href="<?php echo base_url("admin/data/hapus_foto_pengujian/$isi[id_foto_permohonan]/$value[id_permohonan]"); ?>" class="btn btn-danger " onclick="return confirm('Apakah Anda Yakin ?')"><i class="fa fa-trash"></i></a>
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

										<!-- <a href="" class="btn-help" data-toggle="modal" data-target="#baru"><i class="fa fa-question"></i></a>
 -->
										<!-- <div class="modal fade" id="baru" role="dialog" style="margin-top: 60px;" >
											<div class="modal-dialog" role="document">
												<div class="modal-content text-center" style="width: 160%; margin-left: -70px;">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body">
														<img src="<?php echo base_url("asset/img/administrasi.jpg") ?>" style="width: 100%">
													</div>
													<div class="modal-footer">
													</div>
												</div>
											</div>
										</div> -->
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