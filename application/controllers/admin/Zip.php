<?php
class Zip extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();

		
		if (!$this->session->userdata('admin') && !$this->session->userdata('pegawai')) 
		{
			redirect('login');
		}

		//memanggil atau membuat model Mklien
		$this->load->model('Madmin');
		$this->load->model('Mklien');
		$this->load->model('Mdata');
		$this->load->model('Msampel');
		$this->load->model('Mhistory');
	}


	function all_surat($id_permohonan)
	{
		set_time_limit(500);
		$this->load->library('zip');
		$detail = $this->Mdata->ambil_pengajuan($id_permohonan);
		if($detail['status_permohonan']=="Diterima")
		{
			include_once APPPATH.'libraries/dompdf/autoload.inc.php';
			$options = new \Dompdf\Options();
			$options->set('isRemoteEnabled', true);
			$pdf = new Dompdf\Dompdf($options);

			$pecah=explode("-", $detail['tgl_permohonan']);
			$tanggal = explode(" ", $pecah[2]);
			$bulan = bulan($pecah[1]);
			$tgl = $tanggal[0]." ".$bulan." ".$pecah[0];

			$folder = $detail['judul_permohonan']." - ".date("d-m-Y H-i-s",strtotime($detail['tgl_permohonan'])).'/';

			$p1 = '<!DOCTYPE html>
			<html lang="en">
			<head>
			<meta charset="UTF-8">
			<title>Permohonan</title>
			<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
			<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
			<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
			</head>
			<style type="text/css">
			table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>tbody>tr>td, .table-bordered>thead>tr>th, .table-bordered>tr>td {
				border: 1px solid #0f0f0f !important;
			}
			.table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
				border-bottom-width: 1px !important;
			}
			</style>
			<body>
			<table class="table table-bordered">
			<thead>
			<tr>
			<th width="100">
			<img src='.base_url ("asset/img/Bhantu.jpg").' width="120" style="padding-bottom: 40px;">
			</th>
			<th width="300">
			<h4 class="text-center"> FORMULIR PERMOHONAN <br> PENGUJIAN SAMPEL</h4>
			<h5 class="text-center" style="font-weight: 550;">LABORATORIUM FORENSIKA DIGITAL <br> PUSAT STUDI FORENSIKA DIGITAL</h5>
			<p class="text-center" style="font-weight: 200">
			Gedung KH Mas Mansur <br> Kampus terpadu Universitas ISlam Indonesia <br> Jalan Kaliurang KM 14,5, Ngemplak, Sleman, <br> Yogyakarta
			</p>
			</th>
			<th>
			<h6 class="text-center". style="font-weight: 600;">Kode Form :</h6>
			<h1 class="text-center" style="font-size: 90px;padding-bottom: 30px">P</h1>
			</th>
			</tr>
			</thead>
			</table>
			<h4 class="text-center"><b>No: '.$detail['nomor_permohonan'].'</b></h4>
			<br>
			<br>
			<br>
			<br>
			<p>
			Bersama ini kami mengajukan kepada Laboratorium Forensika Digital Pusat Studi Forensika Digital, Universitas Islam Indonesia, Yogyakarta, untuk melakukan pengujian dengan lingkup sebagai berikut:
			'.$detail['isi_permohonan'].'
			<br>
			Demikian permohonan pengujian sampel yang diajukan.
			</p>

			<p class="text-right">


			Yogyakarta,  '.$tgl.'
			<br>
			Yang Mengajukan Permohonan, 
			<br>
			<br>
			<br>
			<br>
			<br><b>'. $detail['nama_klien'].'</b>
			</p>
			</body>
			</html>';
			$file_name =  FCPATH.'asset/Kumpulan Kasus/'.$folder.'Surat_Permohonan.pdf';		
			$pdf->load_html($p1);
			$pdf->render();
			$file = $pdf->output();
			file_put_contents($file_name, $file);
			$this->zip->read_file($file_name);



			$options = new \Dompdf\Options();
			$options->set('isRemoteEnabled', true);
			$pdf = new Dompdf\Dompdf($options);
			$verifikasi = $this->Mdata->ambil_verifikasi($id_permohonan);
			$pecah=explode("-", $verifikasi['tgl_verifikasi']);
			$tanggal = explode(" ", $pecah[2]);
			$bulan = bulan($pecah[1]);
			$tgl = $tanggal[0]." ".$bulan." ".$pecah[0];

			$tmp_verifikasi='';
			foreach ($verifikasi['detail'] as $key => $value):
				$tmp_verifikasi='<tr>
				<td>'.$value['nama_pegawai'].'</td>
				<td>'.$value['jabatan_pegawai'].'</td>
				<td></td>
				</tr>';
			endforeach;
			$td='fa-square-o';
			$d='fa-square-o';
			if ($verifikasi['status_verifikasi']=="Diterima")
			{
				$d='fa-check-square-o';
			}
			else
			{
				$td='fa-check-square-o';

			}

			$p2 = '<!DOCTYPE html>
			<html lang="en">
			<head>
			<meta charset="UTF-8">
			<title>Verifikasi</title>
			<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
			<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
			<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
			</head>
			<style type="text/css">
			table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>tbody>tr>td, .table-bordered>thead>tr>th, .table-bordered>tr>td {
				border: 1px solid #0f0f0f !important;
			}
			.table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
				border-bottom-width: 1px !important;
			}
			</style>
			<body>
			<table class="table table-bordered">
			<thead>
			<tr>
			<th width="100">
			<img src='.base_url("asset/img/Bhantu.jpg").' width="120" style="padding-bottom: 40px;">
			</th>
			<th width="300">
			<h4 class="text-center"> FORMULIR PERMOHONAN <br> PENGUJIAN SAMPEL</h4>
			<h5 class="text-center" style="font-weight: 550;">LABORATORIUM FORENSIKA DIGITAL <br> PUSAT STUDI FORENSIKA DIGITAL</h5>
			<p class="text-center" style="font-weight: 200">
			Gedung KH Mas Mansur <br> Kampus terpadu Universitas ISlam Indonesia <br> Jalan Kaliurang KM 14,5, Ngemplak, Sleman, <br> Yogyakarta
			</p>
			</th>
			<th>
			<h6 class="text-center". style="font-weight: 600;">Kode Form :</h6>
			<h1 class="text-center" style="font-size: 90px;padding-bottom: 30px">P</h1>
			</th>
			</tr>
			</thead>
			</table>
			<p class="text-center"><b>No: '.$verifikasi['nomor_verifikasi'].'</b></p>
			<br>
			<span>
			Tanggal : <b>'.$tgl.'</b>
			</span>
			<br>
			<br>
			<p>
			Menimbang kompetensi SDM, ketersedian alat, waktu, dan kelengkapan administrasi lainya maka bersama ini diputuskan pemohonan tersebut :
			<ul style="list-style: none;">
			<li>
			<i class="fa '.$d.'" aria-hidden="true"></i>Diterima untuk diuji lebih lanjut
			</li>
			<li>
			<i class="fa '.$td.'" aria-hidden="true"></i> Tidak Diterima</li>
			</ul>
			</p>
			<p>Yang menverifikasi permohonan :</p>
			<table class="table-bordered table">
			<thead>
			<tr>
			<th>Nama</th>
			<th>Jabatan</th>
			<th>Tanda tangan</th>
			</tr>
			</thead>
			<tbody>
			'.$tmp_verifikasi.'
			</tbody>
			</table>
			</body>
			</html>';
			$file_name =  FCPATH.'asset/Kumpulan Kasus/'.$folder.'Surat_Verifikasi.pdf';		
			$pdf->load_html($p2);
			$pdf->render();
			$file = $pdf->output();
			file_put_contents($file_name, $file);
			$this->zip->read_file($file_name);


			$options = new \Dompdf\Options();
			$options->set('isRemoteEnabled', true);
			$pdf = new Dompdf\Dompdf($options);
			$id_penerima = $this->Mdata->ambil_penerima_permohonan($id_permohonan);
			$penerima = $this->Mdata->ambil_penerima($id_penerima['id_penerima']);
			$sampel = $this->Msampel->tampil_sampel($id_penerima['id_penerima']);
			$tanggal= penyebut(date("d",strtotime($id_penerima['tgl_penerima'])))." ".bulan(date("m",strtotime($id_penerima['tgl_penerima'])))." ".penyebut(date("Y",strtotime($id_penerima['tgl_penerima'])));
		//memanggil session admin

			$pecah=explode("-", $penerima['tgl_permohonan']);
			$tanggal1 = explode(" ", $pecah[2]);
			$bulan = bulan($pecah[1]);
			$tgl = $tanggal1[0]." ".$bulan." ".$pecah[0];
		//model Mdata menjalankan ambil_penerima
			$tmp_sampel='';
			$nomor=1;
			foreach ($sampel as $key => $value):
				$tmp_sampel='<tr>
				<td>'.$nomor++.'</td>
				<td>'.$value['jenis_sampel'].'</td>
				<td>'.$value['spesifikasi_sampel'].'</td>
				<td>'.$value['jumlah_sampel'].'</td>
				<td>'.$value['ket_sampel'].'</td>
				<td>'.$value['identitas_sampel'].'</td>
				</tr>';	
			endforeach ;
			$s1 = '<!DOCTYPE html>
			<html lang="en">
			<head>
			<meta charset="UTF-8">
			<title>Sampel</title>
			<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
			<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
			<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
			</head>
			<style type="text/css">
			table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>tbody>tr>td, .table-bordered>thead>tr>th, .table-bordered>tr>td {
				border: 1px solid #0f0f0f !important;
			}
			.table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
				border-bottom-width: 1px !important;
			}
			</style>
			<body>
			<table class="table table-bordered">
			<thead>
			<tr>
			<th width="100">
			<img src='.base_url("asset/img/Bhantu.png").' width="120" style="padding-bottom: 40px;">
			</th>
			<th width="300">
			<h4 class="text-center"> 	BERITA ACARA <br> PENERIMAAN SAMPEL PENGUJIAN</h4>
			<h5 class="text-center" style="font-weight: 550;">LABORATORIUM FORENSIKA DIGITAL <br> PUSAT STUDI FORENSIKA DIGITAL</h5>
			<p class="text-center" style="font-weight: 200">
			Gedung KH Mas Mansur <br> Kampus terpadu Universitas ISlam Indonesia <br> Jalan Kaliurang KM 14,5, Ngemplak, Sleman, <br> Yogyakarta
			</p>
			</th>
			<th>
			<h6 class="text-center". style="font-weight: 600;">Kode Form :</h6>
			<h1 class="text-center" style="font-size: 90px;padding-bottom: 30px">S</h1>
			</th>
			</tr>
			</thead>
			</table>
			<h4 class="text-center"><b>No: '.$penerima['nomor_penerima'].'</b></h4>
			<br>
			<br>
			<br>
			<br>
			<p>
			Pada hari ini: '.$tanggal.' ('.date("d-m-Y",strtotime($penerima['tgl_penerima'])).'), telah diserahkan '. count($sampel).' jenis sampel pengujian yaitu:
			</p>
			<table class="table table-bordered">
			<thead>
			<tr>
			<th>No</th>
			<th>Jenis sampel</th>
			<th>Spesifikasi</th>
			<th>Jumlah</th>
			<th>Keterangan</th>
			<th>Identitas sampel</th>
			</tr>
			</thead>
			<tbody>
			'.$tmp_sampel.'
			</tbody>
			</table>
			<p>
			Sampel tersebut selanjutkan diserahkan untuk diuji/dianalisis lebih lanjut oleh Pusat Studi Forensika Digital, Universitas Islam Indonesia, Yogyakarta. Sampel yang diterima telah diperiksa sesuai dengan spesifikasi dan keterangan yang tercantum pada tabel di atas.
			</p>
			<p class="text-center">
			Yogyakarta, '.$tgl.'

			</p>
			<div class="row" style="padding: 0 20px;">
			<div class="pull-left col-md-6">
			<p class="text-left">
			<br>
			Yang Menyerahkan Sampel 
			<br>
			<br>
			<br>
			<br>
			<br>
			<br><b>'.$penerima['nama_klien'].'</b>
			</p>
			</div>
			<div class="col-md-6">
			<p class="text-right">
			<br>
			Yang Menerima Sampel 
			<br>
			<br>
			<br>
			<br>
			<br>
			<br><b>'.$penerima['nama_pegawai'].'</b>
			</p>
			</div>
			</div>
			</body>
			</html>';
			$file_name =  FCPATH.'asset/Kumpulan Kasus/'.$folder.'Surat_Sampel.pdf';		
			$pdf->load_html($s1);
			$pdf->render();
			$file = $pdf->output();
			file_put_contents($file_name, $file);
			$this->zip->read_file($file_name);


			$sampel = $this->Msampel->tampil_sampel($id_penerima['id_penerima']);
			foreach($sampel as $key => $sp):
				$options = new \Dompdf\Options();
				$options->set('isRemoteEnabled', true);
				$pdf = new Dompdf\Dompdf($options);
				$detail_sampel = $this->Msampel->ambil_sampel($sp['id_sampel']);
				$ambil_sampel = $this->Msampel->ambil_detail_sampel($sp['id_sampel']);
				$s2 = '<!DOCTYPE html>
				<html lang="en">
				<head>
				<meta charset="UTF-8">
				<title>Sampel</title>
				<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
				<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
				<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
				</head>
				<style type="text/css">
				table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>tbody>tr>td, .table-bordered>thead>tr>th, .table-bordered>tr>td {
					border: 1px solid #0f0f0f !important;
				}
				.table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
					border-bottom-width: 1px !important;
				}
				</style>
				<body>
				<table class="table table-bordered">
				<thead>
				<tr>
				<th width="100">
				<img src='.base_url("asset/img/Bhantu.png").' width="120" style="padding-bottom: 40px;">
				</th>
				<th width="300">
				<h4 class="text-center">FORMULIR IDENTITAS SAMPEL ELEKTRONIK</h4>
				<h5 class="text-center" style="font-weight: 550;">LABORATORIUM FORENSIKA DIGITAL <br> PUSAT STUDI FORENSIKA DIGITAL</h5>
				<p class="text-center" style="font-weight: 200">
				Gedung KH Mas Mansur <br> Kampus terpadu Universitas ISlam Indonesia <br> Jalan Kaliurang KM 14,5, Ngemplak, Sleman, <br> Yogyakarta
				</p>
				</th>
				<th>
				<h6 class="text-center". style="font-weight: 600;">Kode Form :</h6>
				<h1 class="text-center" style="font-size: 90px;padding-bottom: 30px">S</h1>
				</th>
				</tr>
				</thead>
				</table>
				<h4 class="text-center">No. <b>'.$detail_sampel['nomor_penerima'].'</b></h4>
				<table class="table table-bordered">
				<tbody>
				<tr>
				<td>Nomor Permintaan Pengujian : '.$detail_sampel['nomor_permohonan'].'</td>
				<td>Nomor Bahan Uji : '.$detail_sampel['nomor_penerima'].'</td>
				</tr>
				<tr>
				<td>Nama Penerima. : '.$detail_sampel['nama_pegawai'].'</td>
				<td>Waktu Penerima : '.date("d",strtotime($detail_sampel['tgl_penerima']))." ".bulan(date("m",strtotime($detail_sampel['tgl_penerima'])))." ".date("Y",strtotime($detail_sampel['tgl_penerima'])).'</td>
				</tr>
				</tbody>
				</table>
				<h4><b>Informasi Perangkat Elektronik</b></h4>
				<table class="table-bordered table">
				<tbody>
				<tr>
				<td colspan="2">Jenis Sampel : '.$detail_sampel['jenis_sampel'].'</td>
				</tr>
				<tr>
				<td>Pabrikan : '.$ambil_sampel['pabrik_sampel'].'</td>
				<td>Model : '.$ambil_sampel['model_sampel'].'</td>
				</tr>
				<tr>
				<td colspan="2">Nomor Seri : '.$ambil_sampel['nomor_seri_sampel'].'</td>
				</tr>
				<tr>
				<td colspan="2">Tanda Tim Penguji : PUSFID UII </td>
				</tr>
				<tr>
				<td colspan="2">Kondisi Sampel : '.$ambil_sampel['kondisi_sampel'].'</td>
				</tr>
				</tbody>
				</table>
				</tbody>
				</table>
				</body>
				</html>';
				$file_name =  FCPATH.'asset/Kumpulan Kasus/'.$folder.'Surat_Detail_Sampel'.++$key.'.pdf';		
				$pdf->load_html($s2);
				$pdf->render();
				$file = $pdf->output();
				file_put_contents($file_name, $file);
				$this->zip->read_file($file_name);
			endforeach;

			$options = new \Dompdf\Options();
			$options->set('isRemoteEnabled', true);
			$pdf = new Dompdf\Dompdf($options);
			$data['penerima']=$this->Mdata->ambil_penerima_permohonan($id_permohonan);
			$penugasan=$this->Mdata->ambil_penugasan_penerima($data['penerima']['id_penerima']);
			$permohonan = str_replace("T", "P", $penugasan['nomor_penugasan']); 
            $penerimaan = str_replace("T", "S", $penugasan['nomor_penugasan']);
			$detail_penugasan = $this->Mdata->detail_penugasan($penugasan['id_penugasan']);
			$pecah=explode("-", $penugasan['tgl_penugasan']);
			$tanggal = explode(" ", $pecah[2]);
			$bulan = bulan($pecah[1]);
			$tgl = $tanggal[0]." ".$bulan." ".$pecah[0];

			$tmp_penugasan='';
			$nomor=0;
			foreach ($detail_penugasan as $key => $value):
				$tmp_penugasan='<tr>
				<td>'.$nomor++.'</td>
				<td>'.$value['nama_pegawai'].'</td>
				<td>'.$value['jabatan_pegawai'].'</td>
				<td>'.$value['tugas'].'</td>
				</tr>';
			endforeach;
			$t1 = '<!DOCTYPE html>
			<html lang="en">
			<head>
			<meta charset="UTF-8">
			<title>Penugasan</title>
			<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
			<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
			<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
			</head>
			<style type="text/css">
			table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>tbody>tr>td, .table-bordered>thead>tr>th, .table-bordered>tr>td {
				border: 1px solid #0f0f0f !important;
			}
			.table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
				border-bottom-width: 1px !important;
			}
			</style>
			<body>
			<table class="table table-bordered">
			<thead>
			<tr>
			<th width="100">
			<img src='.base_url("asset/img/Bhantu.png").' width="120" style="padding-bottom: 40px;">
			</th>
			<th width="300">
			<h4 class="text-center"> SURAT PENUGASAN PENGUJIAN <br> SAMPEL</h4>
			<h5 class="text-center" style="font-weight: 550;">LABORATORIUM FORENSIKA DIGITAL <br> PUSAT STUDI FORENSIKA DIGITAL</h5>
			<p class="text-center" style="font-weight: 200">
			Gedung KH Mas Mansur <br> Kampus terpadu Universitas ISlam Indonesia <br> Jalan Kaliurang KM 14,5, Ngemplak, Sleman, <br> Yogyakarta
			</p>
			</th>
			<th>
			<h6 class="text-center". style="font-weight: 600;">Kode Form :</h6>
			<h1 class="text-center" style="font-size: 90px;padding-bottom: 30px">T</h1>
			</th>
			</tr>
			</thead>
			</table>
			<p class="text-center"><b>No: '. $penugasan['nomor_penugasan'].' </b></p>
			<br>
			<br>
			<br>
			<p>
			Sehubungan permohonan pengujian sampel Nomor  '.$permohonan.' dan berita acara penerimaan sampel pengujian Nomor  '.$penerimaan.', maka kepada nama-nama tertera dibawah ini di berikan tugas sesuai dengan kemampuan dan kompetensinya untuk melakukan pengujian yang di maksud. Nama-nama tersebut adalah :
			<table class="table-bordered table">
			<thead>
			<tr>
			<th>No</th>
			<th>Nama</th>
			<th>Pekerjaan</th>
			<th>Deskripsi Tugas</th>
			</tr>
			</thead>
			<tbody>
			'.$tmp_penugasan.'
			</tbody>
			</table>
			<br>
			<p>
			Penugasan ini diberikan selama durasi waktu 15 hari sejak surat penugasan ini dibuat.
			<br>
			Demikian surat ini dibuat untuk dikerjakan dengan penuh tanggung jawab.
			</p>
			<p class="text-center">
			Yogyakarta, '.$tgl.'
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
			</body>
			</html>';
			$file_name =  FCPATH.'asset/Kumpulan Kasus/'.$folder.'Surat_Penugasan.pdf';		
			$pdf->load_html($t1);
			$pdf->render();
			$file = $pdf->output();
			file_put_contents($file_name, $file);
			$this->zip->read_file($file_name);



			$options = new \Dompdf\Options();
			$options->set('isRemoteEnabled', true);
			$pdf = new Dompdf\Dompdf($options);
			$penerima = $this->Mdata->ambil_penerima_permohonan($id_permohonan);
			$sampel = $this->Msampel->tampil_sampel($penerima['id_penerima']);
			$keputusan = $this->Mdata->ambil_keputusan($penerima['id_penerima']);
			$tanggal = penyebut(date("d",strtotime($keputusan['tgl_keputusan'])))." ".bulan(date("m",strtotime($keputusan['tgl_keputusan'])))." ".penyebut(date("Y",strtotime($keputusan['tgl_keputusan'])));
			$pecah=explode("-", $keputusan['tgl_keputusan']);
			$tanggal1 = explode(" ", $pecah[2]);
			$bulan = bulan($pecah[1]);
			$tgl = $tanggal1[0]." ".$bulan." ".$pecah[0];

			if ($keputusan['status_keputusan']=="Di kembalikan")
			{
				$tds ='dikembalikan / <strike>dimusnakan</strike>';
			}
			else
			{
				$sd = 'dimusnahkan / <strike>dikembalikan</strike>
				';
			}
			$tmp_keputusan = '';
			$nomor=1;
			foreach ($sampel as $key => $value):
				$tmp_keputusan='<tr>
				<td>'.$nomor++.'</td>
				<td>'.$value['jenis_sampel'].'</td>
				<td>'.$value['spesifikasi_sampel'].'</td>
				<td>'.$value['jumlah_sampel'].'</td>
				<td>'.$value['ket_sampel'].'</td>
				<td>'.$value['identitas_sampel'].'</td>
				</tr>';	
			endforeach; 

			if ($keputusan['status_keputusan']=="Di Kembalikan"): 
				$dk ='<li>
				diserahkan kembali pada
				<ol type="a">
				<li>
				Nama : '.$penerima['nama_klien'].'
				</li>
				<li>
				Alamat : '.$penerima['alamat_klien'].'
				</li>
				</ol>
				</li>
				<li>
				<strike>Dimusnahkan oleh pusat studi Forensika Digital, Universitas Islam Indonesia, Yogyakarta</strike>
				</li>';
			else:
				$dk ='<strike>
				<li>
				diserahkan kembali kepada
				<ol type="a">
				<li>
				Nama : '.$penerima['nama_klien'].'
				</li>
				<li>
				Alamat :'.$penerima['alamat_klien'].'
				</li>
				</ol>
				</li>
				</strike>
				<li>
				Dimusnahkan oleh Pusat Studi Forensika Digital, Universitas Islam Indonesia, Yogyakarta
				</li>';
			endif; 
			if ($keputusan['status_keputusan']=="Di Kembalikan"):
				$kk='Yang menyerahkan/<strike>memusnahkan sampel</strike>';
			else:
				$kk='Yang menyerahkan/<strike>memusnahkan sampel</strike>';
			endif;

			if ($keputusan['status_keputusan']=="Di Kembalikan"): 
				$hh='Yang menerima sampel/<strike>menyaksikan</strike>';
			else: 
				$hh='<strike>Yang menerima sampel/</strike>menyaksikan';
			endif;
			$mk1 = '<!DOCTYPE html>
			<html lang="en">
			<head>
			<meta charset="UTF-8">
			<title>Keputusan</title>
			<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
			<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
			<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
			</head>
			<style type="text/css">
			table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>tbody>tr>td, .table-bordered>thead>tr>th, .table-bordered>tr>td {
				border: 1px solid #0f0f0f !important;
			}
			.table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
				border-bottom-width: 1px !important;
			}
			</style>
			<body>
			<table class="table table-bordered">
			<thead>
			<tr>
			<th width="100">
			<img src='.base_url("asset/img/Bhantu.png").' width="120" style="padding-bottom: 40px;">
			</th>
			<th width="300">
			<h4 class="text-center"> 	BERITA ACARA <br> PENGEMBALIAN / PEMUSNAHAN <br> SAMPEL PENGUJIAN</h4>
			<h5 class="text-center" style="font-weight: 550;">LABORATORIUM FORENSIKA DIGITAL <br> PUSAT STUDI FORENSIKA DIGITAL</h5>
			<p class="text-center" style="font-weight: 200">
			Gedung KH Mas Mansur <br> Kampus terpadu Universitas ISlam Indonesia <br> Jalan Kaliurang KM 14,5, Ngemplak, Sleman, <br> Yogyakarta
			</p>
			</th>
			<th>
			<h6 class="text-center". style="font-weight: 600;">Kode Form :</h6>
			<h1 class="text-center" style="font-size: 90px;padding-bottom: 30px">MK</h1>
			</th>
			</tr>
			</thead>
			</table>
			<h4 class="text-center"><b>No: '.$keputusan['nomor_keputusan'].'</b></h4>
			<br>
			<br>
			<p>
			Pada hari ini: '. $tanggal.' ('.date("d-m-Y",strtotime($keputusan['tgl_keputusan'])).'), telah 
			'.$tds.'
			'.$sd.'
			'.count($sampel).' jenis pengujian yaitu:
			</p>
			<table class="table table-bordered">
			<thead>
			<tr>
			<th>NO</th>
			<th>JENIS</th>
			<th>SPESIFIKASI</th>
			<th>JUMLAH</th>
			<th>KETERANGAN</th>
			<th>IDENTITAS</th>
			</tr>
			</thead>
			<tbody>
			'.$tmp_keputusan.'
			</tbody>
			</table>
			<p>
			sampel tersebut selanjutnya :
			<ol>
			'.$dk.'
			</ol>
			</p>
			<p class="text-center">
			Yogyakarta, '.$tgl.'
			</p>
			<div class="row" style="padding: 0 20px;">
			<div class="pull-left col-md-6">
			<p class="text-left">
			<br>
			'.$kk.'
			<br>
			<br>
			<br>
			<br>
			<br>
			<br><b>'.$keputusan['nama_pegawai'].'</b>
			</p>
			</div>
			<div class="col-md-6">
			<p class="text-right">
			<br>
			'.$hh.'
			<br>
			<br>
			<br>
			<br>
			<br>
			<br><b>'.$penerima['nama_klien'].'</b>
			</p>
			</div>
			</div>
			</body>
			</html>';
			$file_name =  FCPATH.'asset/Kumpulan Kasus/'.$folder.'Surat_Keputusan.pdf';		
			$pdf->load_html($mk1);
			$pdf->render();
			$file = $pdf->output();
			file_put_contents($file_name, $file);
			$pdf->setPaper('A4', 'portrait');
			$this->zip->read_file($file_name);

			$surat_instansi = $this->Mdata->ambil_surat_permohonan_zip($id_permohonan);
			$this->zip->read_file(FCPATH.'asset/Kumpulan Kasus/'.$folder.$surat_instansi['surat_permohonan']);
			$foto = $this->Mdata->tampil_foto_permohonan($id_permohonan);

			foreach ($foto as $value) {
				$this->zip->read_file(FCPATH.'asset/Kumpulan Kasus/'.$folder.$value['foto']);
			}
			$laporan = $this->Mdata->ambil_laporan($id_permohonan);
			$this->zip->read_file(FCPATH.'asset/Kumpulan Kasus/'.$folder.$laporan['file_pengujian']);

			$foto_ime = $this->Mdata->ambil_ime($id_permohonan);
			$this->zip->read_file(FCPATH.'asset/Kumpulan Kasus/'.$folder.$foto_ime['foto_ime']);
		}
		elseif($detail['status_permohonan']=="Tidak Diterima")
		{
			include_once APPPATH.'libraries/dompdf/autoload.inc.php';
			$options = new \Dompdf\Options();
			$options->set('isRemoteEnabled', true);
			$pdf = new Dompdf\Dompdf($options);

			$pecah=explode("-", $detail['tgl_permohonan']);
			$tanggal = explode(" ", $pecah[2]);
			$bulan = bulan($pecah[1]);
			$tgl = $tanggal[0]." ".$bulan." ".$pecah[0];

			$folder = $detail['judul_permohonan']." - ".date("d-m-Y H-i-s",strtotime($detail['tgl_permohonan'])).'/';

			$p1 = '<!DOCTYPE html>
			<html lang="en">
			<head>
			<meta charset="UTF-8">
			<title>Permohonan</title>
			<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
			<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
			<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
			</head>
			<style type="text/css">
			table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>tbody>tr>td, .table-bordered>thead>tr>th, .table-bordered>tr>td {
				border: 1px solid #0f0f0f !important;
			}
			.table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
				border-bottom-width: 1px !important;
			}
			</style>
			<body>
			<table class="table table-bordered">
			<thead>
			<tr>
			<th width="100">
			<img src='.base_url ("asset/img/Bhantu.jpg").' width="120" style="padding-bottom: 40px;">
			</th>
			<th width="300">
			<h4 class="text-center"> FORMULIR PERMOHONAN <br> PENGUJIAN SAMPEL</h4>
			<h5 class="text-center" style="font-weight: 550;">LABORATORIUM FORENSIKA DIGITAL <br> PUSAT STUDI FORENSIKA DIGITAL</h5>
			<p class="text-center" style="font-weight: 200">
			Gedung KH Mas Mansur <br> Kampus terpadu Universitas ISlam Indonesia <br> Jalan Kaliurang KM 14,5, Ngemplak, Sleman, <br> Yogyakarta
			</p>
			</th>
			<th>
			<h6 class="text-center". style="font-weight: 600;">Kode Form :</h6>
			<h1 class="text-center" style="font-size: 90px;padding-bottom: 30px">P</h1>
			</th>
			</tr>
			</thead>
			</table>
			<h4 class="text-center"><b>No: '.$detail['nomor_permohonan'].'</b></h4>
			<br>
			<br>
			<br>
			<br>
			<p>
			Bersama ini kami mengajukan kepada Laboratorium Forensika Digital Pusat Studi Forensika Digital, Universitas Islam Indonesia, Yogyakarta, untuk melakukan pengujian dengan lingkup sebagai berikut:
			'.$detail['isi_permohonan'].'
			<br>
			Demikian permohonan pengujian sampel yang diajukan.
			</p>

			<p class="text-right">


			Yogyakarta,  '.$tgl.'
			<br>
			Yang Mengajukan Permohonan, 
			<br>
			<br>
			<br>
			<br>
			<br><b>'. $detail['nama_klien'].'</b>
			</p>
			</body>
			</html>';
			$file_name =  FCPATH.'asset/Kumpulan Kasus/'.$folder.'Surat_Permohonan.pdf';		
			$pdf->load_html($p1);
			$pdf->render();
			$file = $pdf->output();
			file_put_contents($file_name, $file);
			$this->zip->read_file($file_name);



			$options = new \Dompdf\Options();
			$options->set('isRemoteEnabled', true);
			$pdf = new Dompdf\Dompdf($options);
			$verifikasi = $this->Mdata->ambil_verifikasi($id_permohonan);
			$pecah=explode("-", $verifikasi['tgl_verifikasi']);
			$tanggal = explode(" ", $pecah[2]);
			$bulan = bulan($pecah[1]);
			$tgl = $tanggal[0]." ".$bulan." ".$pecah[0];

			$tmp_verifikasi='';
			foreach ($verifikasi['detail'] as $key => $value):
				$tmp_verifikasi='<tr>
				<td>'.$value['nama_pegawai'].'</td>
				<td>'.$value['jabatan_pegawai'].'</td>
				<td></td>
				</tr>';
			endforeach;
			$td='fa-square-o';
			$d='fa-square-o';
			if ($verifikasi['status_verifikasi']=="Diterima")
			{
				$d='fa-check-square-o';
			}
			else
			{
				$td='fa-check-square-o';

			}

			$p2 = '<!DOCTYPE html>
			<html lang="en">
			<head>
			<meta charset="UTF-8">
			<title>Verifikasi</title>
			<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
			<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
			<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
			</head>
			<style type="text/css">
			table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>tbody>tr>td, .table-bordered>thead>tr>th, .table-bordered>tr>td {
				border: 1px solid #0f0f0f !important;
			}
			.table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
				border-bottom-width: 1px !important;
			}
			</style>
			<body>
			<table class="table table-bordered">
			<thead>
			<tr>
			<th width="100">
			<img src='.base_url("asset/img/Bhantu.jpg").' width="120" style="padding-bottom: 40px;">
			</th>
			<th width="300">
			<h4 class="text-center"> FORMULIR PERMOHONAN <br> PENGUJIAN SAMPEL</h4>
			<h5 class="text-center" style="font-weight: 550;">LABORATORIUM FORENSIKA DIGITAL <br> PUSAT STUDI FORENSIKA DIGITAL</h5>
			<p class="text-center" style="font-weight: 200">
			Gedung KH Mas Mansur <br> Kampus terpadu Universitas ISlam Indonesia <br> Jalan Kaliurang KM 14,5, Ngemplak, Sleman, <br> Yogyakarta
			</p>
			</th>
			<th>
			<h6 class="text-center". style="font-weight: 600;">Kode Form :</h6>
			<h1 class="text-center" style="font-size: 90px;padding-bottom: 30px">P</h1>
			</th>
			</tr>
			</thead>
			</table>
			<p class="text-center"><b>No: '.$verifikasi['nomor_verifikasi'].'</b></p>
			<br>
			<span>
			Tanggal : <b>'.$tgl.'</b>
			</span>
			<br>
			<br>
			<p>
			Menimbang kompetensi SDM, ketersedian alat, waktu, dan kelengkapan administrasi lainya maka bersama ini diputuskan pemohonan tersebut :
			<ul style="list-style: none;">
			<li>
			<i class="fa '.$d.'" aria-hidden="true"></i>Diterima untuk diuji lebih lanjut
			</li>
			<li>
			<i class="fa '.$td.'" aria-hidden="true"></i> Tidak Diterima</li>
			</ul>
			</p>
			<p>Yang menverifikasi permohonan :</p>
			<table class="table-bordered table">
			<thead>
			<tr>
			<th>Nama</th>
			<th>Jabatan</th>
			<th>Tanda tangan</th>
			</tr>
			</thead>
			<tbody>
			'.$tmp_verifikasi.'
			</tbody>
			</table>
			</body>
			</html>';
			$file_name =  FCPATH.'asset/Kumpulan Kasus/'.$folder.'Surat_Verifikasi.pdf';		
			$pdf->load_html($p2);
			$pdf->render();
			$file = $pdf->output();
			file_put_contents($file_name, $file);
			$this->zip->read_file($file_name);
			$surat_instansi = $this->Mdata->ambil_surat_permohonan_zip($id_permohonan);
			$this->zip->read_file(FCPATH.'asset/Kumpulan Kasus/'.$folder.$surat_instansi['surat_permohonan']);
			$foto = $this->Mdata->tampil_foto_permohonan($id_permohonan);

			foreach ($foto as $value) {
				$this->zip->read_file(FCPATH.'asset/Kumpulan Kasus/'.$folder.$value['foto']);
			}
		}

		
		$this->zip->download("All_Arsip_Permohonan-".$detail['judul_permohonan'].".zip");

	}
}