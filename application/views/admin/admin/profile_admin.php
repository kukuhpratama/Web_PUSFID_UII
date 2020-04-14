<div id="page-wrapper">
	<div class="box-header">
		<h3 class="box-title" style="font-size: 20px; opacity: 0.7; margin-left: 4px;"><b>Data Profile</b></h3>
	</div>
	<section id="page-inner">
		<div class="box box-info">
			<div class="box-body table-responsive">
			<!-- <pre>
				<?php //print_r($_SESSION['admin']) ?>
			</pre> -->
			<table class="table table-striped">
				<tr>
					<th width="17%">Nama</th>
					<th><b>:</b> <?php echo $login['nama_admin'] ?></th>
				</tr>
				<tr>
					<th width="17%">Email</th>
					<th><b>:</b> <?php echo $login['email_admin'] ?></th>
				</tr>
			</table>
			<a href="<?php echo base_url("admin/admin/ubah_akun/$login[id_admin]"); ?>" class="btn btn-primary pull-right"><i class="fa fa-edit"></i> Edit</a>
		</div>
	</div>
</section>
</div>