<div id="page-wrapper">
    <section id="page-inner">
        <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title hidden-print">Detail Sampel</h3>
            </div>
            <div class="box-body">

                <table class="table table-bordered tebal">
                    <thead>
                        <tr>
                            <th width="100">
                                    <img src="<?php echo base_url("asset/img/Bhantu.png") ?>" width="120" style="padding-bottom: 40px;">
                            </th>
                            <th>
                                <h4 class="text-center">FORMULIR IDENTITAS SAMPEL ELEKTRONIK</h4>
                                <h5 class="text-center" style="font-weight: 550;">LABORATORIUM FORENSIKA DIGITAL <br> PUSAT STUDI FORENSIKA DIGITAL</h5>
                                <p class="text-center" style="font-weight: 200">
                                    Gedung KH Mas Mansur <br> Kampus terpadu Universitas Islam Indonesia <br> Jalan Kaliurang KM 14,5, Ngemplak, Sleman, <br> Yogyakarta
                                </p>
                            </th>
                            <th>
                                <h6 class="text-center". style="font-weight: 600;">Kode Form :</h6>
                                <h1 class="text-center" style="font-size: 90px;padding-bottom: 30px">S</h1>
                            </th>
                        </tr>
                    </thead>
                </table>
                <h4 class="text-center"><b>No: <?php echo $detail_sampel['nomor_penerima']; ?></b></h4>
                <table class="table table-bordered tebal">
                    <tbody>
                        <tr>
                            <td>Nomor Permintaan Pengujian : <?php echo $detail_sampel['nomor_permohonan'] ?></td>
                            <td>Nomor Bahan Uji : <?php echo $detail_sampel['nomor_penerima'] ?></td>
                        </tr>
                        <tr>
                            <td>Nama Penerima. : <?php echo $detail_sampel['nama_pegawai'] ?></td>
                            <td>Waktu Penerima : <?php echo date("d",strtotime($detail_sampel['tgl_penerima']))." ".bulan(date("m",strtotime($detail_sampel['tgl_penerima'])))." ".date("Y",strtotime($detail_sampel['tgl_penerima'])); ?></td>
                        </tr>
                    </tbody>
                </table>
                <h4><b>Informasi Perangkat Elektronik</b></h4>
                <table class="table-bordered table tebal">
                    <tbody>
                        <tr>
                            <td width="550">Jenis Sampel : <?php echo $detail_sampel['jenis_sampel']; ?></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Pabrikan : <?php echo $detail['pabrik_sampel']; ?></td>
                            <td width="660">Model : <?php echo $detail['model_sampel']; ?> </td>
                        </tr>
                        <tr>
                            <td colspan="2">Nomor Seri : <?php echo $detail['nomor_seri_sampel']; ?></td>
                        </tr>
                       
                            <td colspan="2">Tanda Tim Penguji : PUSFID UII </td>
                    
                        <tr>
                            <td colspan="2">Kondisi Sampel : <?php echo $detail['kondisi_sampel']; ?></td>
                        </tr>
                      <!--   <tr>
                            <td colspan="2">Jumlah Penyimpanan : <?php //echo $detail['jml_penyimpanan_sampel']; ?></td>
                        </tr> -->
                    </tbody>
                </table>
                <h4 class="hidden"><b>Informasi CMOS</b></h4>
                <table class="table-bordered table hidden">
                    <tbody>
                        <tr>
                            <td width="550">Logon Password : <?php echo $detail['logon_password']; ?></td>
                            <td>Password : <?php echo $detail['password']; ?></td>
                        </tr>
                        <tr>
                            <td>Waktu Sekarang : <?php echo $detail['waktu_sekarang']; ?></td>
                            <td>Tanggal: </td>
                        </tr>
                        <tr>
                            <td>Waktu CMOS : <?php echo $detail['waktu_cmos']; ?></td>
                            <td>Tanggal : </td>
                        </tr>
                    </tbody>
                </table>
                <br>

                   <a href="<?php echo base_url("admin/data/resume/$detail_sampel[id_permohonan]"); ?>" class="btn btn-primary hidden-print"><i class="fa fa-chevron-left"></i> Kembali</a>
                <a href="#" onclick="window.print();" class="btn  btn-success hidden-print pull-right"><i class="fa fa-print"></i> Print</a>
            </div>
            
        </div>
        
    </section>
    
</div>
<script>
    $(window).load(function(){
        window.print();
    })
</script>