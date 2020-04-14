<div id="page-wrapper">
	<div class="box-header">
		<h3 class="box-title" style="font-size: 20px; opacity: 0.7; margin-left: 4px"><b>Arsip Administrasi</b></h3>
		<a href="<?php echo base_url("admin/zip/all_surat/$resume[id_permohonan]"); ?>" class="btn btn-primary pull-right"><i class="fa fa-download"></i>  ALL Arsip</a>
	</div>
	<section id="page-inner">
		<div class="box box-info">
			<div class="box-body table-responsive">
				<table class="table table-bordered" id="thetable">
					<tbody>

						<tr>
							<th>P1 = (Surat Permohonan Klien)</th>
							<th>			
								<label class="label label-success">Sudah Dibuat</label>
							</th>
							<th>
								<a href="<?php echo base_url("admin/download_arsip/p1/$resume[id_permohonan]"); ?>" target="_blank">Download</a>
							</th>
						</tr>
						<tr>
							<th>P2 = (Surat Verifikasi Permohonan)</th>
							<th>
								<?php if ($resume['status_permohonan']=="Diterima" OR $resume['status_permohonan']=="Tidak Diterima"): ?>
									<label class="label label-success">Sudah Dibuat</label>
								<?php endif ?>
							</th>
							<?php if ($resume['status_permohonan']=="Diterima" OR $resume['status_permohonan']=="Tidak Diterima"): ?>
								<th>
									<a href="<?php echo base_url("admin/download_arsip/p2/$resume[id_permohonan]"); ?>" target="_blank">Download</a>
								</th>
							<?php endif ?>
						</tr>
						<tr>
							<th>S1 = (Surat Kumpulan Sampel)</th>
							<th>
								<?php if ($resume['S1']=="isi"): ?>
									<label class="label label-success">Sudah Dibuat</label>
								<?php endif ?>
							</th>
							<?php if ($resume['S1']=="isi"): ?>
								<th>
									<a href="<?php echo base_url("admin/download_arsip/s1/$resume[id_permohonan]"); ?>" target="_blank">Download</a>
								</th>
							<?php endif ?>
						</tr>
						<tr>
							<th>S2 = (Surat Detail Setiap Sampel)</th>
							<th>
								<?php if ($resume['S1']=="isi"): ?>
									<label class="label label-success">Sudah Dibuat</label>
								<?php endif ?>
							</th>
							<?php if ($resume['S1']=="isi"): ?>
								<th>
									<?php foreach ($sampel as $key => $value): ?>
										<a href="<?php echo base_url("admin/download_arsip/s2/$value[id_sampel]"); ?>" target="_blank">Download</a> | 
									<?php endforeach ?>
								</th>
							<?php endif ?>
						</tr>
						<tr>
							<th>T1 = (Surat Penugasan)</th>
							<th>
								<?php if ($resume['T1']=="isi"): ?>
									<label class="label label-success">Sudah Dibuat</label>
								<?php endif ?>
							</th>
							<?php if ($resume['T1']=="isi"): ?>
								<th>
									<a href="<?php echo base_url("admin/download_arsip/t1/$resume[id_permohonan]"); ?>" target="_blank">Download</a>
								</th>
							<?php endif ?>
						</tr>
						<tr>
							<th>MK1 = (Surat Keputusan Sampel)</th>
							<th>
								<?php if ($resume['MK1']=="isi"): ?>
									<label class="label label-success">Sudah Dibuat</label>
								<?php endif ?>
							</th>
						<?php if ($resume['MK1']=="isi"): ?>
							<th>
								<a href="<?php echo base_url("admin/download_arsip/mk/$resume[id_permohonan]"); ?>" target="_blank">Download</a>
							</th>
						<?php endif ?>
						</tr>
					</tbody>
				</table>
				<br>
				<a href="<?php echo base_url("admin/data/arsip"); ?>" class="btn btn-primary "><i class="fa fa-chevron-left"></i> Kembali</a>
			</div>
		</div>
	</section>
</div>