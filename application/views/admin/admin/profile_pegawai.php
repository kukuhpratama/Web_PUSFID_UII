<div id="page-wrapper">
	<div class="box-header">
		<h3 class="box-title" style="font-size: 20px; opacity: 0.7; margin-left: 4px;"><b>Data Profile</b></h3>
	</div>
	<section id="page-inner">
		<div class="box box-info">
			<div class="box-body">
				<div class="row">
					<div class="col-md-4">
						<div class="thumbnail">
							<img src="<?php echo base_url("asset/img/$login[foto_tanda_pegawai]"); ?>" alt="<?php echo $login['foto_tanda_pegawai']; ?>"  class="img-responsive">
						</div>
					</div>
					<div class="col-md-8">
						<div class="table-responsive">
							<table class="table table-striped">
								<tr>
									<th width="17%">Nama</th>
									<th><b>:</b> <?php echo $login['nama_pegawai'] ?></th>
								</tr>
								<tr>
									<th width="17%">Email</th>
									<th><b>:</b> <?php echo $login['email_pegawai'] ?></th>
								</tr>
								<tr>
									<th width="17%">Jabatan</th>
									<th><b>:</b> <?php echo $login['jabatan_pegawai'] ?></th>
								</tr>
								<tr>
									<th width="17%">Alamat</th>
									<th><b>:</b> <?php echo $login['alamat_pegawai'] ?></th>
								</tr>
								<tr>
									<th width="17%">Jenis Kelamin</th>
									<th><b>:</b> <?php echo $login['jenis_kelamin'] ?></th>
								</tr>
								<tr>
									<th width="17%">Telepone</th>
									<th><b>:</b> <?php echo $login['telepone_pegawai'] ?></th>
								</tr>
							</table>
							
						</div>
					</div>
				</div>
				<a href="<?php echo base_url("admin/admin/ubah_akun/$login[id_pegawai]"); ?>" class="btn btn-primary pull-right"><i class="fa fa-edit"></i> Edit</a>
			</div>
		</div>
	</section>
</div>