<div id="page-wrapper">
	<div class="box-header">
		<h3 class="box-title" style="font-size: 20px; opacity: 0.7; margin-left: 4px;"><b>Data Arsip</b></h3>
	</div>

	<div id="page-inner">
		<div class="box box-info">
			<div class="box-body">
				<!-- <section id="page-inner" class="col-md-3">
					<div class="box table-bordered">
						<div class="box-header">
							<h3 class="box-title"><b>Filter Data Arsip</b></h3>
						</div>
						<div class="box-body table-responsive">
							<form method="POST">

								<select class="form-control" name="status" onchange="submit();">
									<option value="">- Pilih Kasus - </option>
									<option value="Diterima" <?php //if($status=="Diterima"){echo "selected";} ?>>Diterima</option>
									<option value="Tidak Diterima" <?php //if($status=="Tidak Diterima"){echo "selected";} ?>>Tidak Diterima</option>
								</select>

								<br>
								<?php //if ($status=="Diterima" OR $status=="Tidak Diterima"): ?>
									<h4><b>Surat Administrasi</b></h4>
								<?php //endif ?>
								<div class="form-group">
									<?php //if ($status=="Diterima"): ?>

										<div class="checkbox">
											<label>
												<input type="checkbox" name="P1" onclick="submit()" value="P1" <?php //if($P1=="P1"){echo "checked";} ?>>
												P1 - Permohonan
											</label>
										</div>

										<div class="checkbox">
											<label>
												<input type="checkbox" name="P2" onclick="submit()" value="P2" <?php //if($P2=="P2"){echo "checked";} ?>>
												P2 - Verifikasi
											</label>
										</div>

										<div class="checkbox">
											<label>
												<input type="checkbox" name="S1" onclick="submit()" value="S1" <?php //if($S1=="S1"){echo "checked";} ?>>
												S1&S2 - Sampel
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="T1" onclick="submit()" value="T1" <?php //if($T1=="T1"){echo "checked";} ?>>
												T1 - Penugasan Pengujian
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="Laporan" onclick="submit()" value="Laporan" <?php //if($Laporan=="Laporan"){echo "checked";} ?>>
												Laporan Analisis
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="MK" onclick="submit()" value="MK" <?php //if($MK=="MK"){echo "checked";} ?>>
												MK1 - Keputusan Sampel
											</label>
										</div>
										<?php //elseif($status=="Tidak Diterima"): ?>
											<div class="checkbox">
												<label>
													<input type="checkbox" name="P1" onclick="submit()" value="P1" <?php //if($P1=="P1"){echo "checked";} ?>>
													P1 - Permohonan
												</label>
											</div>

											<div class="checkbox">
												<label>
													<input type="checkbox" name="P2" onclick="submit()" value="P2" <?php //if($P2=="P2"){echo "checked";} ?>>
													P2 - Verifikasi
												</label>
											</div>
										<?php //endif ?>
									</div>

								</form>
							</div>
						</div>
					</section> -->

					<section id="page-inner" >
						<div class="box table-bordered" class="col-md-6">
							<div class="box-header">
								<h3 class="box-title"><b>Filter Data Arsip</b></h3>
							</div>
							<div class="box-body table-responsive">
								<form method="POST">
									<label>Status</label>
									<select class="form-control" name="status">
										<option value="">- Pilih Kasus -</option>
										<option value="Diterima" <?php if($status=="Diterima"){echo "selected";} ?>>Diterima</option>
										<option value="Tidak Diterima" <?php if($status=="Tidak Diterima"){echo "selected";} ?>>Tidak Diterima</option>
									</select>
								</div>
								<div class="box-body table-responsive">
									<div class="form-group">
										<label>Tahun</label>
										<select name="tahun" class="form-control">
											<option value="">- Pilih Tahun -</option>
											<?php for ($i=2000;$i<=date("Y");$i++): ?>
												<option value="<?php echo $i; ?>" <?php if($tahun==$i){echo "selected";} ?>><?php echo $i ?></option>
											<?php endfor ?>  
										</select>
									</div>
									<div class="form-group">
										<label>Bulan</label>
										<select name="bulan" class="form-control ">
											<option value="">- Pilih Bulan -</option>
											<?php foreach ($bulan as $key => $value): ?>
												<?php $no = $key+1; ?>
												<option value="<?php echo $key+1 ?>" <?php if($no==$bulann){echo "selected";} ?>><?php echo $value ?></option>
											<?php endforeach ?>  
										</select>
									</div>
									<a href="<?php echo base_url("admin/data/arsip") ?>" style="margin-left:  10px;" class="btn btn-primary pull-right"><i class="fa fa-refresh"></i> Reload</a>
									<button  name="cari" value="cari" class="btn btn-primary pull-right"><i class="fa fa-search"></i> Cari</button>
								</div>
							</div>



							<br>
							<br>

							<div class="box table-bordered">
								<div class="box-body table-responsive">
								 <!-- <pre> 
									<?php //print_r($pengajuan); ?>
								</pre> -->
								<?php if (!empty($pengajuan)): ?>
									<table class="table table-bordered" id="thetable">
										<thead>
											<tr class="success">
												<th>No</th>
												<th>No Permohonan</th>
												<th>Judul Permohonan</th>
												<th>Tanggal Permohonan</th>
												<th>Klien</th>
												<th>Status Permohonan</th>
												<th>Sampel</th>
												<th>Surat Instansi</th>
												<th>Laporan Akhir</th>
												<th>All Arsip</th>
												<th>Note</th>
												<!-- <th>Action</th> -->
												<th>Hapus</th>
											</tr>
										</thead>
										<tbody>
											<?php $no=0; ?>
											<?php foreach ($pengajuan as $key => $value): ?>	
												<?php if ($value['status_permohonan']!=="Pending" && $value['status_akhir']== true ): ?>
													<?php if($value['mk']!="kosong" || ($value['status_permohonan']=="Tidak Diterima" && $value['mk']=="kosong")):?>
														<tr>
															<td><?php echo $no+=1;  ?></td>
															<td><?php echo $value["nomor_permohonan"]; ?></td>
															<td><?php echo $value["judul_permohonan"]; ?></td>
															<td><?php echo $value["tgl_permohonan"]; ?></td>
															<td><?php echo $value["nama_klien"]; ?></td>
															<td>
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
																		<?php $folder = $value['judul_permohonan']." - ".date("d-m-Y H-i-s",strtotime($value['tgl_permohonan'])) ?>
																		<a href="<?php echo base_url("asset/Kumpulan Kasus/$folder/$value[surat_permohonan]") ?>" target="_blank" class="btn btn-info" ><i class="fa fa-download"></i></a>
																	</td>
																	<td class="text-center">
																		<?php if ($value['status_permohonan']=='Diterima'): ?>
																			<?php $folder = $value['judul_permohonan']." - ".date("d-m-Y H-i-s",strtotime($value['tgl_permohonan'])) ?>
																			<a href="<?php echo base_url("asset/Kumpulan Kasus/$folder/$value[file_pengujian]") ?>" target="_blank" class="btn btn-info" ><i class="fa fa-download"></i></a>
																			<?php else: ?>
																				<a href="#"  class="btn btn-info" disabled
																				><i class="fa fa-download"></i></a>
																			<?php endif ?>

																		</td>
																		<td class="text-center">

																			<a href="<?php echo base_url("admin/data/resume_arsip/$value[id_permohonan]"); ?>" class="btn btn-info" title="Arsip Surat"><i class="fa fa-file-text" ></i></a>
																		</td>
																<!-- <td>
																	<?php// if ($P1=="P1"): ?>
																		<a href="<?php //echo base_url("admin/data/surat_permohonan_arsip/$value[id_permohonan]"); ?>" class="btn btn-xs btn-success btn-block">P1</a>
																	<?php //endif ?>
																	<?php //if ($P2=="P2"): ?>
																		<a href="<?php //echo base_url("admin/data/surat_verifikasi_arsip/$value[id_permohonan]"); ?>" class="btn btn-xs btn-success btn-block">P2</a>
																	<?php //endif ?>
																	<?php //if ($S1=="S1"): ?>
																		<a href="<?php //echo base_url("admin/data/sampel_arsip/$value[id_permohonan]"); ?>" class="btn btn-xs btn-success btn-block">S1&S2</a>
																	<?php //endif ?>
																	<?php //if ($T1=="T1"): ?>
																		<a href="<?php //echo base_url("admin/data/surat_penugasan_arsip/$value[id_permohonan]"); ?>" class="btn btn-xs btn-success btn-block">T1</a>
																	<?php //endif ?>
																	<?php //if ($Laporan=="Laporan"): ?>
																		<a href="<?php //echo base_url("admin/data/laporan_arsip/$value[id_permohonan]"); ?>" class="btn btn-xs btn-success btn-block">Laporan</a>
																	<?php //endif ?>
																	<?php //if ($MK=="MK"): ?>
																		<a href="<?php //echo base_url("admin/data/keputusan_sampel_arsip/$value[id_permohonan]"); ?>" class="btn btn-xs btn-success btn-block">MK1</a>
																	<?php //endif ?>
																</td> -->
																<td class="text-center">
																	<a href="<?php echo base_url("admin/data/note_arsip/$value[id_permohonan]"); ?>" class="btn btn-primary" title="Catata Kasus"><i class="fa fa-paperclip" ></i></a>
																</td>
																<td class="text-center">
																	<a href="<?php echo base_url("admin/data/hapus_arsip/$value[id_permohonan]"); ?>" onclick="return confirm('Apakah anda yakin ?');" class="btn btn-danger"><i class="fa fa-trash"></i></a>
																</td>
															</tr>
															<?php
														endif;
														?>
													<?php endif ?>
												<?php endforeach ?>
											</tbody>

										</table>
										<?php else: ?>
											<div class="alert alert-warning" ><b><i class="fa fa-warning"></i> Tidak Ada Data Arsip</b></div>
										<?php endif ?>


									</div>


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
													<h4 class="modal-title"><b>Foto Sampel</b></h4>
												</div>
												<div class="modal-body">
													<table class="table table-striped table-bordered"  width="200">
														<thead class="text-center">
															<tr>
																<th>No </th>
																<th>Foto </th>

															</tr>
														</thead>
														<tbody>
															<?php foreach ($value['foto'] as $no => $isi): ?>
																<tr>
																	<td><?php echo $no+=1; ?></td>
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
											</section>

										</div>
									</div>
								</div>


							</div>