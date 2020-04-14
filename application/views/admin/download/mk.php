 <div id="page-wrapper">
	<section id="page-inner">
		<div class="box box-info">
			<div class="box-body">
				<table class="table table-bordered tebal">
					<thead>
						<tr>
							<th width="100">
								<img src="<?php echo base_url("asset/img/Bhantu.png") ?>" width="120" style="padding-bottom: 40px;">
							</th>
							<th>
								<h4 class="text-center"> 	BERITA ACARA <br> PENGEMBALIAN / PEMUSNAHAN <br> SAMPEL PENGUJIAN</h4>
								<h5 class="text-center" style="font-weight: 550;">LABORATORIUM FORENSIKA DIGITAL <br> PUSAT STUDI FORENSIKA DIGITAL</h5>
								<p class="text-center" style="font-weight: 200">
									Gedung KH Mas Mansur <br> Kampus terpadu Universitas Islam Indonesia <br> Jalan Kaliurang KM 14,5, Ngemplak, Sleman, <br> Yogyakarta
								</p>
							</th>
							<th>
								<h6 class="text-center". style="font-weight: 600;">Kode Form :</h6>
								<h1 class="text-center" style="font-size: 90px;padding-bottom: 30px">MK</h1>
							</th>
						</tr>
					</thead>
				</table>
				<h4 class="text-center"><b>No: <?php echo $keputusan['nomor_keputusan']; ?></b></h4>
				<br>
				<br>
				<br>
				<br>
				<p>
					Pada hari ini: <?php echo $tanggal; ?> (<?php echo date("d-m-Y",strtotime($keputusan['tgl_keputusan'])); ?>), telah <?php if ($keputusan['status_keputusan']=="Di kembalikan"): ?> dikembalikan / <strike>dimusnakan</strike>
					<?php else: ?>
						dimusnahkan / <strike>dikembalikan</strike>
					<?php endif ?>
					<?php echo count($sampel); ?> jenis pengujian yaitu:
				</p>
				<table class="table table-bordered tebal">
					<thead>
						<tr>
							<th>No</th>
							<th>Jenis sampel</th>
							<th>Spesifikasi</th>
							<th>Jumlah</th>
							<th>Keterangan</th>
							<th>Identitas sampel</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$nomor=1;
						foreach ($sampel as $key => $value): ?>
							<tr>
								<td><?php echo $nomor++; ?></td>
								<td><?php echo $value['jenis_sampel']; ?></td>
								<td><?php echo $value['spesifikasi_sampel']; ?></td>
								<td><?php echo $value['jumlah_sampel']; ?></td>
								<td><?php echo $value['ket_sampel']; ?></td>
								<td><?php echo $value['identitas_sampel'] ?></td>
							</tr>	
						<?php endforeach ?>
					</tbody>
				</table>
				<p>
					sampel tersebiut selanjutnya :
					<ol>
						<?php if ($keputusan['status_keputusan']=="Di Kembalikan"): ?>
							<li>
								diserahkan kembali pada
								<ol type="a">
									<li>
										Nama : <?php echo $penerima['nama_klien']; ?>
									</li>
									<li>
										Alamat : <?php echo $penerima['alamat_klien'] ?>
									</li>
								</ol>
							</li>
							<li>
								<strike>Dimusnahkan oleh pusat studi Forensika Digital, Universitas Islam Indonesia, Yogyakarta</strike>
							</li>
							<?php else: ?>
								<strike>
									<li>
										diserahkan kembali kepada
										<ol type="a">
											<li>
												Nama : <?php echo $penerima['nama_klien']; ?>
											</li>
											<li>
												Alamat : <?php echo $penerima['alamat_klien'] ?>
											</li>

										</ol>
									</li>
								</strike>
								<li>
									Dimusnahkan oleh Pusat Studi Forensika Digital, Universitas Islam Indonesia, Yogyakarta
								</li>
							<?php endif ?>
						</ol>
					</p>
					<p class="text-center">
						<?php $pecah=explode("-", $keputusan['tgl_keputusan']); ?>
						<?php $tanggal = explode(" ", $pecah[2]); ?>
						<?php
						$bulan = bulan($pecah[1]);
						$tgl = $tanggal[0]." ".$bulan." ".$pecah[0];
						?>
						Yogyakarta, <?php echo $tgl; ?>
					</p>
					<div class="row">
						<div class="col-md-6 pull-left">
							<p class="text-center">
								<br>
								<?php if ($keputusan['status_keputusan']=="Di Kembalikan"): ?>
									Yang menyerahkan/<strike>memusnahkan sampel,</strike>
									<?php else: ?>
										<strike>Yang menyerahkan</strike>memusnahkan sampel,
									<?php endif ?>
									<br>
									<br>
									<br>
									<br>
									<br>
									<br>
									<u><b><?php echo $keputusan['nama_pegawai']; ?></b></u>
								</p>
							</div>
							<div class="col-md-6 pull-right">
								<p class="text-center">
									<br>
									<?php if ($keputusan['status_keputusan']=="Di Kembalikan"): ?>
										Yang menerima sampel/<strike>menyaksikan,</strike>
										<?php else: ?>
											<strike>Yang menerima sampel/</strike>menyaksikan,
										<?php endif ?>
										<br>
										<br>
										<br>
										<br>
										<br>
										<br>
										<u><b><?php echo $penerima['nama_klien']?></b></u>
									</p>
								</div>
							</div>
							<a href="<?php echo base_url("admin/data/resume/$penerima[id_permohonan]"); ?>" class="btn btn-primary hidden-print"><i class="fa fa-chevron-left"></i> Kembali</a>
							<a href="#" onclick="window.print();" class="btn btn-success pull-right hidden-print"><i class="fa fa-print"></i> Print</a> 
						</div>
					</div>
				</section>
			</div>
			<script>
				$(window).load(function(){
					window.print();
				})
			</script>