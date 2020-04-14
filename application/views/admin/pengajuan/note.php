<div id="page-wrapper">
	<div class="box-header">
		<h3 class="box-title" style="font-size: 20px; opacity: 0.7; margin-left: 4px;"><b>Note</b></h3>
	</div>
	<section id="page-inner">
		<div class="box box-info">
			<div class="box-body">
				<?php if (!empty($note['note_permohonan'])): ?>
				<p>
					<?php echo $note['note_permohonan']; ?>
				</p>
				<?php endif ?>
				<hr>
				<form method="POST">
					<div class="form-group">
						<label>Note</label>
						<textarea name="note_permohonan" class="form-control"></textarea>
					<span style="color: red;">*Tulisan akan menggantikan tulisan sebelumnya, lebih baik di copy lalu di tambahkan note terbaru</span>
					</div>
					<a href="<?php echo base_url("admin/data/pengajuan") ?>" class="btn btn-primary"><i class="fa fa-chevron-left"></i> Kembali</a>
					<button class="btn btn-success pull-right"><i class="fa fa-save"></i> Simpan</button>
				</form>
			</div>
		</div>
	</section>
</div>