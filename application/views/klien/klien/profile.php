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
							<img src="<?php echo base_url("asset/img/klien/$login[foto_klien]"); ?>" alt="<?php echo $login['foto_klien']; ?>"  class="img-responsive">
						</div>
					</div>
					<div class="col-md-8">
						<div class="table-responsive">
							<table class="table table-striped">
								<tr>
									<th width="11%">Nama</th>
									<th><b>: </b><?php echo $login['nama_klien'] ?></th>
								</tr>
								<tr>
									<th width="11%">NIK</th>
									<th><b>: </b><?php echo $login['nik_klien'] ?></th>
								</tr>
								<tr>
									<th width="11%">Email</th>
									<th><b>: </b><?php echo $login['email_klien'] ?></th>
								</tr>
								<tr>
									<th width="11%">Username</th>
									<th><b>: </b><?php echo $login['username_klien'] ?></th>
								</tr>
								<tr>
									<th width="11%">Alamat</th>
									<th><b>: </b><?php echo $login['alamat_klien'] ?></th>
								</tr>
								<tr>
									<th width="11%">Telepone</th>
									<th><b>: </b><?php echo $login['telpon_klien'] ?></th>
								</tr>
							</table>
						</div>
					</div>
				</div>

				<a href="<?php echo base_url("klien/profile/ubah/$login[id_klien]"); ?>" class="btn btn-primary pull-right"><i class="fa fa-edit"></i> Edit</a>
			</div>
		</div>
	</section>
</div>