<div id="page-wrapper">
	<div class="box-header">
		<h3 class="box-title" style="font-size: 20px; opacity: 0.7; margin-left: 4px;"><b>Riwayat Permohonan</b></h3>
	</div>
	<!-- <?php //print_r($permohonan); ?> -->
	<div id="page-inner">
		<div class="box box-info">
			<div class="box-body table-responsive">
				<table class="table table-bordered" id="thetable">
					<thead  >
						<tr class="success" >
							<th>No</th>
							<th>No Permohonan</th>
							<th>Judul Permohonan</th>
							<th>Tanggal</th>
							<th>Klien</th> 
							<th>Status</th>
							<th>Sampel</th>
							<th>Surat Permohonan</th>
							<th width="12%">Surat Verifikasi</th>
							<th width="14%">Laporan Pengujian</th>
							<th>Progres</th>
							<th width="10%">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($permohonan as $key=> $value): ?>
							<tr>
								<td><?php echo $key+1; ?></td>
								<td><?php echo $value["nomor_permohonan"]; ?></td>
								<td><?php echo $value['judul_permohonan'] ?></td>
								<td><?php echo $value["tgl_permohonan"]; ?></td>
								<td><?php echo $value["nama_klien"]; ?></td> 
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
										<td class="text-center">
												<a href="<?php echo base_url("klien/klien/surat_klien/$value[id_permohonan]") ?>" class="btn btn-primary" title="Surat Permohonan Klien"><i class="fa fa-file-text-o" ></i></a>
											</td>
											<td class="text-center">
												<?php if ($value['status_permohonan']!=="Pending"): ?>
													<a href="<?php echo base_url("klien/history/balasan/$value[id_permohonan]"); ?>" class="btn btn-primary"><i class="fa fa-file-text-o"></i></a>
												<?php endif ?>
											</td>
											<td class="text-center">
												<?php if ($cek_laporan[$key]['status_laporan']=="Ada"): ?>
													<a href="<?php echo base_url("klien/history/laporan/$value[id_permohonan]"); ?>" class="btn btn-primary"><i class="fa fa-file-text"></i></a>
												<?php endif ?>
											</td>
											<td>
												<?php
													if($value['status_permohonan']=='Pending' ){?>
														<a href="#" class="btn btn-warning" id="status" disabled="disabled" style="width: 138px;">Tahap verifikasi</a>
													<?php
													}elseif($value['status_permohonan']=='Tidak Diterima'){?>
														<a href="#" class="btn btn-danger" id="status" disabled="disabled" style="width: 138px;"> Tidak Dikerjakan</a>
													<?php
													}else{
														$hasil = $this->Mklien->aktivitas_permohonan($value['id_permohonan']);
														if($hasil>0){ ?>
															<a href="#" class="btn btn-success" id="status" disabled="disabled">Telah Diselasikan</a>
													<?php
														}else{ ?>
															<a href="#" class="btn btn-primary" id="status" disabled="disabled" style="width: 138px;">Tahap Pengerjaan</a>
													<?php
														}
													}
												?>	
											</td>
											<td class="text-center">
												
												<?php $hasil = $this->Mklien->aktivitas_permohonan($value['id_permohonan']); 
												if ($value['status_permohonan']=="Pending" OR ($value['status_permohonan']=="Diterima") AND $hasil==0): ?>
													<a href="<?php echo base_url("klien/history/edit_permohonan/$value[id_permohonan]") ?>" class="btn btn-primary" title="Tambah Sampel"><i class="fa fa-plus"></i></a>
													<?php if ($value['status_permohonan']=="Pending"): ?>
														<a href="<?php echo base_url("klien/history/hapus/$value[id_permohonan]") ?>" class="btn btn-danger" onclick="return confirm('Apakah yakin menghapus permohonan?')"><i class="fa fa-trash"></i></a>
													<?php else: ?>
													<a href="#" class="btn btn-danger" disabled="disabled"  onclick="return confirm"><i class="fa fa-trash"></i></a>
													<?php endif ?>

													<?php 
													else: 
														?>
														<a href="#" class="btn btn-primary" disabled="disabled" title="Tambah Sampel" ><i class="fa fa-plus" ></i></a>
													<a href="#" class="btn btn-danger" disabled="disabled" )"><i class="fa fa-trash"></i></a>

												<?php endif ?>
												
											</td>
									
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>

						</div>
					</div>
				</div>
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