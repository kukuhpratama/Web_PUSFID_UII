<!DOCTYPE html>
<html>
<head>
    <title>Pusfid - Web</title>
    <link rel="stylesheet"  href=" <?php echo base_url("pengunjung/css/bootstrap.css"); ?>">
    <link href="https://fonts.googleapis.com/css?family=Nunito|Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href=" <?php echo base_url("pengunjung/font-awesome/css/font-awesome.min.css"); ?> ">
    <link rel="stylesheet"  href="<?php echo base_url("pengunjung/css/csspusfid.css"); ?> ">

</head>
<body>
    <!-- navbar area -->
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#naff" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">PUSFID Universitas Islam Indonesia</a>
            </div>
            <div class="navbar-collapse collapse" id="naff">
                <ul class="navbar-nav nav navbar-right" >
                    <li><a href="">HOME</a></li>
                    <li><a href="#sejarah">SEJARAH</a></li>
                    <li><a href="#fasilitas">FASILITAS</a></li>
                    <li><a href="https://forensics.uii.ac.id/">BLOG</a></li>
                    <li><a href="#kontak">HUBUNGI</a></li>
                    <li><a href=" <?php echo base_url('daftar') ?>" >DAFTAR</a></li>
                    <li><a>|</a></li>
                    <li><a href=" <?php echo base_url('login') ?>"><span style="border:1px solid red; padding: 5px; border-radius: 4px;">LOGIN</span></a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="slider">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="1" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src=" <?php echo base_url("pengunjung/img/slider/1.jpg"); ?> ">
                    <div class="carousel-caption">
                        <img src=" <?php echo base_url("pengunjung/img/slider/logo1.png"); ?> " alt="">
                    </div>
                    <div class="carousel-caption" id="isi">
                        <div class="col-md-12 text-justify">
                            <p><b>Untuk memfasilitasi pengembangan bidang ilmu forensika digital, maka dibentuk sebuah unit pusat studi dengan nama Pusat Studi Forensika Digital (PUSFID).Terdapat tiga misi utama dari PUSFID, yaitu</b></p>  
                            <ol><b>
                                <li>mengembangkan kajian keilmuan pada tema : digital forensics, cybercrime, digital evidence, steganography and watermarking, serta computer security secara umum.</li>
                                <li>memberikan edukasi, training dan penyiapan SDM pada kompetensi forensika digital baik untuk kalangan umum ataupun untuk kalangan terbatas (penegak hukum, pendidikan.</li>
                                <li>memberikan layanan masyarakat untuk investigasi kasus kasus yang melibatkan aktivitas dan barang bukti digital serta penyediaan tenaga saksi ahli untuk memberikan klarifikasi temuan dan uji barang bukti digital.</li>
                            </b>
                        </ol> 
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="<?php echo base_url("pengunjung/img/slider/1.jpg"); ?>">
                <div class="carousel-caption">
                    <img src="<?php echo base_url("pengunjung/img/slider/logoB.png"); ?> " alt="">
                </div>
            </div>
<!-- div class="carousel-caption">
    <img src="img/slider/logo1.png" alt="">  -->
<!--   <h1>Pusat Studi Forensika Digital UII</h1>
</div> -->
</div>

<!-- Controls -->
<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
</a>
<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
</a>
</div>
</section>

<section class="profile" style="background-color: ;" >
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1  style="text-shadow:1px 1px;">Syarat dan Ketentuan Permohonan Pengujian di Pusat Studi Forensika Digital Uii</h1>
            </div>
        </div>
        <div  class="row">
            <div class="col-md-12">
                
                <p>
                    <ol style="font-size: 17px;">
                        <li>Registrasi, Menu <b>LOGIN</b> -> <b>DAFTAR</b></li>
                        <li>Surat Permohonan Instansi ataupun Surat Keterangan Kepolisian</li>
                        <li>Foto Barang Bukti yang Ingin Diajukan</li>
                    </ol>
                </p>
            </div>
        </div>
    </div>
</section>

<section class="fasilitas" id="fasilitas">
    <div class="container"> 
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 style="text-shadow:1px 1px;">Fasilitas Pusat Studi Forensika Digital UII</h1>
            </div>
        </div>
        <div class="row ">
            <div class="col-md-3 col-xs-6 text-center">
                <span class="fa-stack fa-5x">
                    <i class="fa fa-circle fa-stack-2x text-primary "></i>
                    <i class="fa fa-comments fa-stack-1x fa-inverse"></i>
                </span>
                <h2>KONSULTASI</h2><br>
            </div>
            <div class="col-md-3 col-xs-6 text-center" >
                <span class="fa-stack fa-5x">
                    <i class="fa fa-circle fa-stack-2x text-primary "></i>
                    <i class="fa fa-book fa-stack-1x fa-inverse"></i>
                </span>
                <h2>PELATIHAN</h2><br>
            </div> 
            <div class="col-md-3 col-xs-6 text-center" >
                <span class="fa-stack fa-5x">
                    <i class="fa fa-circle fa-stack-2x text-primary "></i>
                    <i class="fa fa-wrench fa-stack-1x fa-inverse"></i>
                </span>
                <h2>TOOLS FORENSIK</h2><br>
            </div> 
            <div class="col-md-3 col-xs-6 text-center">
                <span class="fa-stack fa-5x">
                    <i class="fa fa-circle fa-stack-2x text-primary "></i>
                    <i class="fa fa-edit fa-stack-1x fa-inverse"></i>
                </span>
                <h2>PUBLICATION</h2><br>
            </div>
        </div>
    </div> 
</div>
</section>

<section class="profile" id="sejarah">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 style="text-shadow:1px 1px;">Sejarah Pusat Studi Forensika Digital Uii</h1>
            </div>
        </div>
        <div  class="row">
            <div class="col-md-12">
                <img  src="<?php echo base_url("pengunjung/img/profile/fd.png"); ?> ">
                <p style="font-size: 17px;">
                    Menurut data dari PwC dan RSA, saat ini Cybercrime telah menjadi ancaman serius dengan nilai kerugian secara global bisa menyamai pendapatan nasional sebuah negara. Pada aspek lain, Cybercrime juga merupakan salah satu industri yang selalu tumbuh dari tahun ke tahun dengan tingkat return yang sangat besar namun dengan resiko yang kecil. Walaupun hingga saat ini tidak adadefinisi resmi tentang Cybcercrime, namun untuk kepentingan praktis Cybercrime dapat didefinisikan sebagai sebagai perbuatan melanggar hukum yang memanfaatkan teknologi komputer yang berbasis pada kecanggihan perkembangan teknologi Internet. Upaya pengungkapan Cybercrime dilakukan melalui proses investigasi yang dikenal dengan istilah Forensik Digital, yaitu penggunaan ilmu dan metode untuk menemukan, mengumpulkan, mengamankan, menganalisis, menginterpretasi dan mempresentasikan barang bukti digital untuk kepentingan rekontruksi kejadian serta keabsahan proses peradilan.<br>

                    Walaupun aktivitas forensik digital banyak dikaitkan dengan proses penegakan hukum, namun kenyataan dilapangan ternyata hanya sebagian kecil saja kasus-kasus Cybercrime yang ditangani oleh penegak hukum. Sebagian besar justru ditangani oleh pihak swasta atau private investigator. Institusi perbankan, asuransi, perusahaan multinasional adalah institusi yang umumnya sering menjadi target dari aktivitas Cybercrime, dan umumnya secara internal institusi tersebut telah memiliki unit tersendiri untuk penanganan kasus-kasusyang terindikasi mengarah pada Cybercrime. Dalam mencermati fenomena tersebut, maka saat ini diperlukan peran ahli bidang forensic investigator untuk pengungkapan bukti-bukti tindak cybercrime. Sayangnya hingga saat ini tenaga professional sebagai forensic investigator masih sangat terbatas. Dikalangan penegak hukum sendiri, penyidik yang memiliki kemampuan sebagai forensic investigator masih dibawah 10%. Sementara dikalangan umumnya sendiri profesi ini belumlah dipandang sebagai profesi yang menjanjikan. Padahal, sejalan dengan kesadaran para pelaku bisnis akan pentingnya keamanan komputer serta potensi besar Cybercrime yang dihadapinya maka kebutuhan akan profesi forensic investigator akan semakin meningkat. Perbankan,kantor akuntansi, perusahaan multinasional, perusahaan asuransi, perusahaan telekomunikasi adalah sebagian dari institusi non penegak hukum yang banyak membutuhkan tenaga-tenaga forensics investigator.<br>

                    Sementara itu laporan yang dibuat oleh MarketSandMarket ,menyebutkan bahwa pasar digital forensics hingga tahun 2020 akan mencapai US$3,3 Milliar, terbagi untuk berbagai industry pendukung, termasuk diantaranya adalah pelatihan dan jasa konsultasi. Sementara itu informasi yang didapat dari sejumlah situs lowongan pekerjaan dunia seperti indeed.com, jobsdb.com menunjukkan bahwaprofesi sebagai digital investigator/digital forensics analyst adalah termasuk kedalam kelompok hot job. Walaupun hal tersebut tidak nampak dalam situs-situs pencari kerja pada lingkup nasional, namun sejalan dengan berkembangnya trend cybercrime,keamanan computer dan forensics secara global, kebutuhan akan profesi serupa juga akan berdampak pada ketersediaan lowongan tersebut untuk pasar Indonesia.<br>

                    Sebagai upaya untuk menyediakan tenaga profesional bidang forensik digital di Indonesia, maka Prodi Teknik Informatika FTI UII melakukan sejumlah langkah nyata, antara lain:<br>

                    Sejak tahun 2010, Teknik Informatika UII telah mulai memasukkan mata kuliah terkait (digital forensics, ethical hacking, pengamanan sistem  komputer) sebagai mata kuliahpilihan pada kurikulum S1.<br>

                    <li>Sejak tahun 2011, Membuka pelatihan sertifikasi internasional bidang keamanan dan forensik bekerjasama dengan vendor EC-Council (CEH dan CHFI)</li>
                    <li>Sejak tahun 2012, mulai dibuka program Magister Informatika dengan konsentrasi khusus bidang Forensika Digital.li</li>
                    <li>Sejak tahun 2012, menyelenggarakan kegiatan workshop dan seminar tentang digital forensics : H@DFEX (Hacking and Digital Forensics Exposed)</li>
                    <li>Sejak 2014, mendirikan Pusat Studi Forensika Digital (PUSFID) sebagai wadah untuk eksplorasi dan diseminasi keilmuan bidang forensika digital.</li>
                </p>
            </div>
        </div>
    </div>
</section>

<section class="hubungi" id="kontak">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ">
                <h2 style="text-shadow:1px 1px;">KONTAK KAMI</h2>
                <p class="text-center" style="font-size: 20px;"><b>Pusat Studi Forensika Digital (PUSFID) Universitas Islam Indonesia</b></p>
                <ul style="font-size: 17px;">
                    <li><i class="fa fa-address-card"></i> Gedung Mas Mansur Lantai 2 Fakultas Teknologi Industri Jl. Kaliurang Km 14.5</li><br>
                    <li><i class="fa fa-phone"></i> 0274 - 895287</li><br>
                    <li><i class="fa fa-facebook"></i> Pusfid</li>
                </ul>
            </div>
        </div>
    </div>
    
</section>

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <p>Copyright@Pusfid2018</p>
            </div>
        </div>
    </div>
</footer>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src=" <?php echo base_url("pengunjung/js/bootstrap.js") ?> "></script>
</body>
</html>