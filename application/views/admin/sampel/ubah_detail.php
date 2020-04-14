<div id="page-wrapper">
    <div class="box-header">
        <h3 class="box-title" style="font-size: 20px; opacity: 0.7; margin-left: 4px"><b>Detail Sampel</b></h3>
    </div>
    <section id="page-inner">
        <div class="box box-info">
            <div class="box-body">
                <form method="POST">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>Nomor Permintaan Pengujian : <b><?php echo $detail_sampel['nomor_permohonan'] ?></b> </td>
                                <td>Nomor Bahan Uji : <b> <?php echo $detail_sampel['nomor_penerima'] ?></b></td>
                            </tr>
                            <tr>
                                <td>Nama Penerima. : <b><?php echo $detail_sampel['nama_pegawai'] ?></b></td>
                                <td>Waktu Penerima : <b><?php echo date("d",strtotime($detail_sampel['tgl_penerima']))." ".bulan(date("m",strtotime($detail_sampel['tgl_penerima'])))." ".date("Y",strtotime($detail_sampel['tgl_penerima'])); ?></b></td>
                            </tr>
                        </tbody>
                    </table>
                    <h4>Informasi Perangkat Elektronik</h4>
                    <table class="table-bordered table">
                        <tbody>
                            <tr>
                                <td width="550">Jenis Sampel : <?php echo $detail_sampel['jenis_sampel']; ?></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="form-group">
                        <label>Pabrikan</label>
                        <input type="text" name="pabrik_sampel" class="flat flat-sm form-control" value="<?php echo $detail['pabrik_sampel']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Nomor Seri</label>
                        <input type="text" name="nomor_seri_sampel" class="flat flat-lg form-control" value="<?php echo $detail['nomor_seri_sampel']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Model</label>
                        <input type="text" name="model_sampel" class="flat flat-lg form-control" value="<?php echo $detail['model_sampel']; ?>">
                    </div>
                   <!--  <div class="form-group">
                        <label>Tanda Tim Penguji</label>
                        <input type="text" name="tanda_tim_penguji" class="flat flat-sm form-control" value="<?php //echo $detail['tanda_tim_penguji']; ?>">
                    </div> -->
                <!--     <div class="form-group">
                        <label>Upload IME</label>
                    </div> -->
                    <div class="form-group">
                        <label>Kondisi Sampel</label>
                        <select class="flat flat-sm form-control" name="kondisi_sampel">
                            <option value="Baik" <?php if($detail['kondisi_sampel']=="Baik"){echo "selected";} ?>>Baik</option>
                            <option value="Tidak Baik" <?php if($detail['kondisi_sampel']=="Tidak Baik"){echo "selected";} ?>>Tidak BaiK</option>
                        </select>
                    </div>
                  <!--   <div class="form-group">
                        <label>Jumlah Penyimpanan</label>
                        <input type="text" name="jml_penyimpanan_sampel" class="flat flat-sm form-control" value="<?php //echo $detail['jml_penyimpanan_sampel']; ?>">
                    </div> -->
                    <!-- <a href="<?php //echo base_url("admin/data/sampel/tambah/$detail_sampel[id_penerima]") ?>" class="btn btn-primary"><i class="fa fa-chevron-left"> Kembali</i></a> -->
                    <button class="btn btn-success pull-right"  onclick="return confirm('Apakah anda yakin mengubah data?')"><i class="fa fa-save"></i> Simpan</button>
                </form>
                
            </div>
            
        </div>
        
    </section>
    
</div>