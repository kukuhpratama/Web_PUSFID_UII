<div id="page-wrapper">
	<section id="page-inner">
		<div class="box box-info">
			<div class="box-body">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th width="100">
								<img src="<?php echo base_url("asset/img/Bhantu.png") ?>" width="120" style="padding-bottom: 40px;">
							</th>
							<th>
								<h4 class="text-center"> 	BERITA ACARA <br> PENERIMAAN SAMPEL PENGUJIAN</h4>
								<h5 class="text-center" style="font-weight: 550;">LABORATORIUM FORENSIKA DIGITAL <br> PUSAT STUDI FORENSIKA DIGITAL</h5>
								<p class="text-center" style="font-weight: 200">
									Gedung KH Mas Mansur <br> Kampus terpadu Universitas ISlam Indonesia <br> Jalan Kaliurang KM 14,5, Ngemplak, Sleman, <br> Yogyakarta
								</p>
							</th>
							<th>
								<h6 class="text-center". style="font-weight: 600;">Kode Form :</h6>
								<h1 class="text-center" style="font-size: 90px;padding-bottom: 30px">S</h1>
							</th>
						</tr>
					</thead>
				</table>
				<h4 class="text-center"><b>No: <?php echo $penerima['nomor_penerima']; ?></b></h4>
				<br>
				<br>
				<br>
				<br>
				<p>
					Pada hari ini: <?php echo $tanggal; ?> (<?php echo date("d-m-Y",strtotime($penerima['tgl_penerima'])); ?>), telah diserahkan <?php echo count($sampel); ?> jenis sampel pengujian yaitu:
				</p>
				<table class="table table-bordered">
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
						<?php foreach ($sampel as $key => $value): ?>
							<tr>
								<td><?php echo $value['id_sampel']; ?></td>
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
					Sampel tersebut selanjutkan diserahkan untuk diuji/dianalisis lebih lanjut oleh Pusat Studi Forensika Digital, Universitas Islam Indonesia, Yogyakarta. Sampel yang diterima telah diperiksa sesuai dengan spesifikasi dan keterangan yang tercantum pada tabel di atas.
				</p>
				<p class="text-center">
					<?php $pecah=explode("-", $penerima['tgl_penerima']); ?>
					<?php $tanggal = explode(" ", $pecah[2]); ?>
					<?php
					$bulan = bulan($pecah[1]);
					$tgl = $tanggal[0]." ".$bulan." ".$pecah[0];
					?>
					Yogyakarta, <?php echo $tgl; ?>
				</p>
				<div class="row" style="padding: 0 20px;">
					<div class="pull-left">
						<p class="text-left">
							<br>
							Yang Menyerahkan Sampel, 
							<br>
							<br>
							<br>
							<br>
							<br>
							<br><b><?php echo $penerima['nama_klien'] ?></b>
						</p>
					</div>
					<div class="pull-right">
						<p class="text-right">
							<br>
							Yang Menerima Sampel, 
							<br>
							<br>
							<br>
							<br>
							<br>
							<br><b><?php echo $penerima['nama_pegawai'] ?></b>
						</p>
					</div>
					<div class="clearfix"></div>
				</div>
				<a href="<?php echo base_url("admin/data/sampel_arsip/$penerima[id_permohonan]") ?>" class="btn btn-primary hidden-print"><i class="fa fa-chevron-left"></i> Kembali</a>
				<a href="#" onclick="window.print();" class="btn btn-success hidden-print pull-right"><i class="fa fa-print"></i> Print</a>
			</div>
		</div>
	</section>
</div>