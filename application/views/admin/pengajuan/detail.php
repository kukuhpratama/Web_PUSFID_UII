<div id="page-wrapper">
	<div class="box-header">
        <h3 class="box-title hidden-print" style="font-size: 20px; opacity: 0.7; margin-left: 4px"><b>Surat Permohonan</b></h3>
		<a href="<?php echo base_url("admin/data/edit_surat/$detail[id_permohonan]"); ?>" class="btn btn-primary pull-right hidden-print" style="margin-right: 5px;"><i class="fa fa-edit"></i> Edit Surat</a>
	</div>
	<section id="page-inner">
		<div class="box box-info">
			<div class="box-body">
				<table class="table table-bordered tebal ">
					<thead>
						<tr>
							<th width="100">
								<img src="<?php echo base_url("asset/img/Bhantu.png") ?>" width="120" style="padding-bottom: 40px;">
							</th>
							<th>
								<h4 class="text-center"> FORMULIR PERMOHONAN <br> PENGUJIAN SAMPEL</h4>
								<h5 class="text-center" style="font-weight: 550;">LABORATORIUM FORENSIKA DIGITAL <br> PUSAT STUDI FORENSIKA DIGITAL</h5>
								<p class="text-center" style="font-weight: 200">
									Gedung KH Mas Mansur <br> Kampus terpadu Universitas Islam Indonesia <br> Jalan Kaliurang KM 14,5, Ngemplak, Sleman, <br> Yogyakarta
								</p>
							</th>
							<th>
								<h6 class="text-center". style="font-weight: 600;">Kode Form :</h6>
								<h1 class="text-center" style="font-size: 90px;padding-bottom: 30px">P</h1>
							</th>
						</tr>
					</thead>
				</table>
				<h4 class="text-center"><b>No: <?php echo $detail['nomor_permohonan']; ?></b></h4>
				<br>
				<br>
				<br>
				<br>
				<p>
					Bersama ini kami mengajukan kepada Laboratorium Forensika Digital Pusat Studi Forensika Digital, Universitas Islam Indonesia, Yogyakarta, untuk melakukan pengujian dengan lingkup sebagai berikut:
					<?php echo $detail['isi_permohonan']; ?>
					<br>
					Demikian permohonan pengujian sampel yang diajukan.
				</p>
					</p>
				<?php $pecah=explode("-", $detail['tgl_permohonan']); ?>
				<?php $tanggal = explode(" ", $pecah[2]); ?>
				<?php
				$bulan = bulan($pecah[1]);
				$tgl = $tanggal[0]." ".$bulan." ".$pecah[0];
				?>
				<p class="text-right">
					Yogyakarta, <?php echo $tgl; ?>
					<br>
					Yang Mengajukan Permohonan 
					<br>
					<br>
					<br>
					<br>
					<br><b><?php echo $detail['nama_klien']; ?></b>
				</p>
				<a href="<?php echo base_url("admin/data/pengajuan"); ?>" class="btn btn-primary  hidden-print"><i class="fa fa-chevron-left"></i> Kembali</a>
				<a href="#" onclick="window.print();" class="btn  btn-success hidden-print pull-right"><i class="fa fa-print"></i> Print</a>
				<!-- <a href="<?php echo base_url("admin/data/verifikasi/$detail[id_permohonan]") ?>" class="btn btn-danger btn-sm pull-right hidden-print">Lanjut Verifikasi</a> -->
			</div>
		</div>
	</section>
</div>