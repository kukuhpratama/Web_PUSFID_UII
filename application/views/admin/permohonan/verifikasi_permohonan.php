<div id="page-wrapper">
    <div class="box-header">
        <h3 class="box-title" style="font-size: 20px; opacity: 0.7"><b>Verifikasi Permohonan</b></h3>
    </div>
    <section id="page-inner">
        <div class="box box-info">
            <div class="box-body">
        
                <span>No. <b><?php echo $detail['nomor_permohonan']; ?></b></span>
                <span class="pull-right">
                    Tgl. <b><?php echo date("d/M/Y", strtotime($detail['tgl_permohonan'])); ?></b>
                </span>
                <div class="clearfix"></div>
                <hr>
                <table class="table table-bordered">
                    
                    <tbody>
                        <tr>
                            <th>Nama</th>
                            <td><?php echo $detail['nama_klien'] ?></td>
                        </tr>
                        <tr>
                            <th>Isi Permohonan</th>
                            <td><?php echo $detail['isi_permohonan'] ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                               <?php if ($detail['status_permohonan']=="Pending"): ?>
                                    <span class="label label-warning"><?php echo $detail['status_permohonan']; ?></span>
                                <?php elseif($detail['status_permohonan']=="Tidak Diterima"): ?>
                                    <span class="label label-danger">
                                        <?php echo $detail['status_permohonan']; ?>
                                    </span>
                                <?php else: ?>
                                    <span class="label label-success"> <?php echo $detail['status_permohonan']; ?></span>

                                <?php endif ?>

                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <h3>Verifikasi</h3>
                <form method="POST">
                    <div class="form-group">
                        <label>Penanggung Jawab 1</label>
                        <select  class="form-control" name="id_pegawai1" required="">
                            <option value="" >- Pilih Penanggung Jawab 1</option>
                            <?php foreach ($user as $key => $value): ?>
                                <option value="<?php echo $value['id_pegawai']; ?>"><?php echo $value['nama_pegawai']." - ".$value['jabatan_pegawai']; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Penanggung Jawab 2</label>
                        <select class="form-control" name="id_pegawai2" required="">
                            <option value="" >- Pilih Penaggung Jawab 2</option>
                            <?php foreach ($user as $key => $value): ?>
                                <option value="<?php echo $value['id_pegawai']; ?>"><?php echo $value['nama_pegawai']." - ".$value['jabatan_pegawai']; ?></option>
                            <?php endforeach ?>
                        </select>   
                    </div>
                    <div class="form-group">
                        <label>Verifikasi</label>
                        <select class="form-control" name="status_verifikasi" required="">
                            <option value="" >- Pilih Status</option>
                            <option value="Diterima">Diterima</option>
                            <option value='Tidak Diterima'>Tidak Diterima</option>
                        </select>
                    </div>
                    <a href="<?php echo base_url("admin/data/permohonan") ?>" class="btn btn-primary"><i class="fa fa-chevron-left"></i> Kembali</a>
                    <button class="btn btn-success pull-right"><i class="fa fa-save"></i> Simpan</button>
                </form>
            
            </div>
        </div>
    </section>
</div>