<div id="page-wrapper">
	<div class="box-header">
		<h3 class="box-title" style="font-size: 20px; opacity: 0.7; margin-left: 4px;"><b>Edit Profile</b></h3>
	</div>
	<div id="page-inner">
		<div class="box box-info">
				<div class="box-body">
					<form method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<label>NAMA</label>
							<input type="text" name="nama_admin" class="form-control" value="<?php echo $login['nama_admin'] ?>">
						</div>
						<div class="form-group">
							<label>EMAIL</label>
							<input type="text" name="email_admin" class="form-control" value="<?php echo $login['email_admin']?>">
						</div>
						<div class="form-group">
							<label>PASSWORD</label>
							<input type="password" name="password_admin" class="form-control" >
							<span style="color:red;">*Apabila password tidak diubah, mohon dikoosngkan!</span>
						</div>
						<a href="<?php echo base_url("admin/admin") ?>" class="btn btn-primary"><i class="fa fa-chevron-left"> Kembali</i></a>
						<button class="btn btn-success pull-right" onclick="return confirm('Apakah anda yakin mengubah data ?');" ><i class="fa fa-save"></i> Simpan</button>
					</form>
				</div>
		</div>
	</div>
	
</div>