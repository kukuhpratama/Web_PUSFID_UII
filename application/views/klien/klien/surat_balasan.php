<div id="page-wrapper">
    <section id="page-inner">
        <div class="box box-info">
            <div class="box-body">
                <table class="table table-bordered tebal  ">
                    <thead>
                        <tr>
                            <th width="100">
                                    <img src="<?php echo base_url("asset/img/Bhantu.png") ?>" width="120" style="padding-bottom: 40px;">
                            </th>
                            <th>
                                <h4 class="text-center"> FORMULIR VERIFIKASI <br> PERMOHONAN PENGUJIAN</h4>
                                <h5 class="text-center" style="font-weight: 550;">LABORATORIUM FORENSIKA DIGITAL <br> PUSAT STUDI FORENSIKA DIGITAL</h5>
                                <p class="text-center" style="font-weight: 200">
                                    Gedung KH Mas Mansur <br> Kampus terpadu Universitas Islam Indonesia <br> Jalan Kaliurang KM 14,5, Ngemplak, Sleman, <br> Yogyakarta
                                </p>
                            </th>
                            <th>
                                <h6 class="text-center". style="font-weight: 600;">Kode Form</h6>
                                <h1 class="text-center" style="font-size: 90px;padding-bottom: 30px">P</h1>
                            </th>
                        </tr>
                    </thead>
                </table>
                <!-- <pre>
                    <?php //print_r($verifikasi); ?>
                </pre> -->
                 <p class="text-center"><b>No. <?php echo $verifikasi['nomor_verifikasi']; ?></b></p>
                <br>
                <span>
                    <?php $pecah=explode("-", $detail['tgl_permohonan']); ?>
                <?php $tanggal = explode(" ", $pecah[2]); ?>
                <?php
                $bulan = bulan($pecah[1]);
                $tgl = $tanggal[0]." ".$bulan." ".$pecah[0];
                ?>
                    Tanggal :<b> <?php echo $tgl; ?></b>
                </span>
                <br>
                <br>
                <p>
                    Menimbang kompetensi SDM, ketersedian alat, waktu, dan kelengkapan administrasi lainya maka bersama ini diputuskan pemohonan tersebut :
                    <?php if ($verifikasi['status_verifikasi']=="Diterima"): ?>
                        <ul style="list-style: none;">
                            <li>
                                <i class="fa fa-check-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Diterima untuk diuji lebih lanjut
                            </li>
                            <li>
                                <i class="fa fa-square-o" aria-hidden="true"></i> Tidak Diterima</li>
                            </ul>
                        <?php else: ?>
                            <ul style="list-style: none;">
                                <li>
                                    <i class="fa fa-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Diterima untuk diuji lebih lanjut
                                </li>
                                <li>
                                    <i class="fa fa-check-square-o" aria-hidden="true"></i> Tidak Diterima</li>
                                </ul>
                            <?php endif ?>
                        </p>
                        <p>Yang menverifikasi permohonan :</p>
                        <table class="table-bordered table tebal  ">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Tanda Tangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($verifikasi['detail'] as $key => $value): ?>
                                    <tr>
                                        <td><?php echo $value['nama_pegawai']; ?></td>
                                        <td><?php echo $value['jabatan_pegawai']; ?></td>
                                        <td>
                                           
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                         <br>
                            <a href="<?php echo base_url("klien/history") ?>" class="btn  btn-primary hidden-print "><i class=" fa fa-chevron-left"></i> Kembali</a>
                            <a href="" onclick="window.print();" class="btn  btn-success hidden-print pull-right"><i class=" fa fa-print"></i> Print</a>
                        <div class="clearfix"></div>
                        

                    </div>    
                </div>
                
                <?php if ($verifikasi['status_verifikasi']="Diterima"): ?>
                    <p style="color: red; font-size: 20px;" hidden="print"><b>*Mohon Segera Hubungi CP Admin: <span style="color: black">081222234316</span> </b></p>
                <?php endif ?>
                </di>
            </section>
        </div>