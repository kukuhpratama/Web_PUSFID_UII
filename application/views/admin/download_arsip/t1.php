<div id="page-wrapper">
    <section id="page-inner">
        <div class="box box-info">
            <div class="box-body">
                <table class="table table-bordered tebal">
                    <thead>
                        <tr>
                            <th width="100">
                                <img src="<?php echo base_url("asset/img/Bhantu.png") ?>" width="120" style="padding-bottom: 40px;">
                            </th>
                            <th>
                                <h4 class="text-center"> SURAT PENUGASAN PENGUJIAN <br> SAMPEL</h4>
                                <h5 class="text-center" style="font-weight: 550;">LABORATORIUM FORENSIKA DIGITAL <br> PUSAT STUDI FORENSIKA DIGITAL</h5>
                                <p class="text-center" style="font-weight: 200">
                                    Gedung KH Mas Mansur <br> Kampus terpadu Universitas Islam Indonesia <br> Jalan Kaliurang KM 14,5, Ngemplak, Sleman, <br> Yogyakarta
                                </p>
                            </th>
                            <th>
                                <h6 class="text-center". style="font-weight: 600;">Kode Form :</h6>
                                <h1 class="text-center" style="font-size: 90px;padding-bottom: 30px">T</h1>
                            </th>
                        </tr>
                    </thead>
                </table>
                <!-- <pre>
                    <?php //print_r($verifikasi); ?>
                </pre> -->
                <p class="text-center"><b>No: <?php echo $penugasan['nomor_penugasan']; ?> </b></p>
                <br>
                <?php $permohonan = str_replace("T", "P", $penugasan['nomor_penugasan']); ?>
                <?php $penerimaan = str_replace("T", "S", $penugasan['nomor_penugasan']); ?>
                <br>
                <br>
                <p>
                   Sehubungan permohonan pengujian sampel Nomor <?php echo $permohonan; ?> dan berita acara penerimaan sampel pengujian Nomor <?php echo $penerimaan; ?>, maka kepada nama-nama tertera dibawah ini di berikan tugas sesuai dengan kemampuan dan kompetensinya untuk melakukan pengujian yang di maksud. Nama-nama tersebut adalah :
                   <table class="table-bordered table tebal">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Pekerjaan</th>
                            <th>Deskripsi Tugas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $nomor=1;
                        foreach ($detail as $key => $value): ?>
                            <tr>
                                <td><?php echo $nomor++; ?></td>
                                <td><?php echo $value['nama_pegawai']; ?></td>
                                <td><?php echo $value['jabatan_pegawai']; ?></td>
                                <td><?php echo $value['tugas']; ?></td>

                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <br>
                <p>
                    Penugasan ini diberikan selama durasi waktu 15 hari sejak surat penugasan ini dibuat.
                    <br>
                    Demikian surat ini dibuat untuk dikerjakan dengan penuh tanggung jawab.
                </p>
                <p class="text-center">
                    <?php $pecah=explode("-", $penugasan['tgl_penugasan']); ?>
                    <?php $tanggal = explode(" ", $pecah[2]); ?>
                    <?php
                    $bulan = bulan($pecah[1]);
                    $tgl = $tanggal[0]." ".$bulan." ".$pecah[0];
                    ?>
                    Yogyakarta, <?php echo $tgl; ?>
                </p>
                <p class="text-center">
                    <br>
                    Yang memberikan penugasan,
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <u>Yudi Prayudi</u>
                    <br>
                    Kepala Pusfid UII
                </p>
                <a href="<?php echo base_url("admin/data/resume_arsip/$id_permohonan"); ?>" class="btn btn-primary hidden-print"><i class="fa fa-chevron-left"></i> Kembali</a>

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