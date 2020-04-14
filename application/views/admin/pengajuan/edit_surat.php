<div id="page-wrapper">
<div class="box-header">
        <h3 class="box-title" style="font-size: 20px; opacity: 0.7; margin-left: 4px;"><b>Edit Isi Permohonan</b></h3>
    </div>
    <section id="page-inner">
        <div class="box box-info">
            <div class="box-body">
                 <form method="post">
                        <textarea class="form-control" name="isi_permohonan" id="theeditor"><?php echo $detail['isi_permohonan']; ?></textarea>
                      <br>
                    <a href="<?php echo base_url("admin/data/pengajuan"); ?>" class="btn btn-primary btn-sm hidden-print"><i class="fa fa-chevron-left"></i> Kembali</a>
                    <button class="btn btn-sm btn-success pull-right" onclick="return confirm('Apakah anda yakin mengubah data?')"><i class="fa fa-save"></i> Simpan</button>
                </form>
                
            </div>
        </div>
    </section>
</div>