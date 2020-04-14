<?php 
function penyebut($nilai)
{
	$nilai = abs($nilai);
	$huruf = array("","Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
	$Temp = "";
	if ($nilai < 12) 
	{
		$Temp = " ". $huruf[$nilai];
	}
	elseif ($nilai < 20) 
	{
		$Temp = penyebut($nilai - 10). " belas";
	}
	elseif ($nilai < 100) 
	{
		$Temp = penyebut($nilai/10). " puluh". penyebut($nilai % 10);
	}
	elseif ($nilai < 200)
	{
		$Temp = " seratus" . penyebut($nilai - 100);
	}
	elseif ($nilai < 1000) 
	{
		$Temp = penyebut($nilai/100) . "  ratus" . penyebut($nilai % 100);
	}
	elseif ($nilai < 2000) 
	{
		$Temp = " seribu" . penyebut($nilai - 1000);
	}
	elseif ($nilai < 1000000) 
	{
		$Temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
	}
	return $Temp;
}

function bulan($nilai)
{
	if ($nilai=="01") 
	{
		$bulan = "Januari";
	}
	elseif ($nilai=="02") 
	{
		$bulan = "Februari";
	}
	elseif ($nilai=="03") 
	{
		$bulan = "Maret";
	}
	elseif ($nilai=="04") 
	{
		$bulan = "April";
	}
	elseif ($nilai=="05") 
	{
		$bulan = "Mei";
	}
	elseif ($nilai=="06") 
	{
		$bulan = "Juni";
	}
	elseif ($nilai=="07") 
	{
		$bulan = "Juli";
	}
	elseif ($nilai=="08") 
	{
		$bulan = "Agustus";
	}
	elseif ($nilai=="09") 
	{
		$bulan = "September";
	}
	elseif ($nilai=="10") 
	{
		$bulan = "Oktober";
	}
	elseif ($nilai=="11") 
	{
		$bulan = "November";
	}
	elseif ($nilai=="12") 
	{
		$bulan = "Desember";
	}

	return $bulan;

} 


function ambil_pengaturan($nama_kolom)
{
	$CI =& get_instance();

	$CI->db->where('kolom_pengaturan', $nama_kolom);
	return $CI->db->get('pengaturan')->row_array();
}

function kirim_email($isi,$tujuan)	
{
	include_once APPPATH.'libraries/dompdf/autoload.inc.php';

	// use ;

	$file_name =  'surat verifikasi -'.$tujuan['nama_klien'].'.pdf';
	$html_code = $isi;
	$options = new \Dompdf\Options();
	$options->set('isRemoteEnabled', true);
	$pdf = new Dompdf\Dompdf($options);
	$pdf->load_html($html_code);
	$pdf->render();
	$file = $pdf->output();
	file_put_contents($file_name, $file);

	include_once APPPATH.'libraries/phpmailer/PHPMailerAutoload.php';

	$mail = new PHPMailer();

	$body="Assalammualaikum Bapak/Ibu, Kami dari pihak pusfid memberikan tanggap permohonan yang diajukan ke PUSFID UII. Terimakasih";

	$mail->IsSMTP(); // telling the class to use SMTP

	$mail->SMTPOptions = array(
		'ssl' => array(
			'verify_peer' => false,
			'verify_peer_name' => false,
			'allow_self_signed' => true
		)
	);

	$mail->Host = "smtp.gmail.com"; // SMTP server 
	$mail->SMTPDebug = 0; // enables SMTP debug information (for testing) // 1 = errors and messages // 2 = messages only 
	$mail->SMTPAuth = true; // enable SMTP authentication 
	$mail->SMTPSecure = "tls"; // sets the prefix to the servier 
	$mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server 
	$mail->Port = 587; // set the SMTP port for the GMAIL server 
	$mail->Username = "tugasakhirkukuh@gmail.com"; // GMAIL username 
	$mail->Password = "Prihandoko123"; // GMAIL password

	$mail->SetFrom('tugasakhirkukuh@gmail.com', 'PUSFID UII');

	$mail->AddReplyTo('tugasakhirkukuh@gmail.com', 'PUSFID UII');

	$mail->Subject = "Surat Verifikasi Permohonan PUSFID UII";

	$mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

	$mail->MsgHTML($body);

	$address = $tujuan['email_klien']; 
	$mail->AddAddress($address, $tujuan['nama_klien']);

	// $mail->AddEmbeddedImage('asset/img/Bhantu.jpg','hantu');

	$mail->AddAttachment($file_name); // attachment 
	// $mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

	// $mail->Send();

	if ($mail->send()) 
	{
		echo "<pre>";
		echo "mailer Error" . $mail->ErrorInfo;
		echo "</pre>";
	}	else
	{
		echo "Message sent!";
	}

}

function namabulan()
{
	$namaBulan = array("Januari","Febuari","Maret","April","Mei","Juni","Juli","Agustus","September","Okotober","November","Desember");
	return $namaBulan;
}


function provinsi()
{
	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
			"key: 958e6b2127744f8372443a1f1b2dc66f"
		),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
		echo "cURL Error #:" . $err;
	} else {
		$hasil = json_decode($response,TRUE);
		return $hasil['rajaongkir']['results'];
	}
}

function kode_provinsi()
{
	$provinsi['id-ac']="Naggroe Aceh Darussalam (NAD)";
	$provinsi['id-ki']="Kalimantan Timur";
	$provinsi['id-jt']="Jawa Tengah";
	$provinsi['id-be']="Bengkulu";
	$provinsi['id-bt']="Banten";
	$provinsi['id-kb']="Kalimantan Barat";
	$provinsi['id-bb']="Bangka Belitung";
	$provinsi['id-ba']="Bali";
	$provinsi['id-ji']="Jawa Timur";
	$provinsi['id-ks']="Kalimantan Selatan";
	$provinsi['id-nt']="Nusa Tenggara Timur (NTT)";
	$provinsi['id-se']="Sulawesi Selatan";
	$provinsi['id-kr']="Kepulauan Riau";
	$provinsi['id-ib']="Papua Barat";
	$provinsi['id-su']="Sumatera Utara";
	$provinsi['id-ri']="Riau";
	$provinsi['id-sw']="Sulawesi Utara";
	$provinsi['id-la']="Maluku Utara";
	$provinsi['id-sb']="Sumatera Barat";
	$provinsi['id-ma']="Maluku";
	$provinsi['id-nb']="Nusa Tenggara Barat (NTB)";
	$provinsi['id-sg']="Sulawesi Tenggara";
	$provinsi['id-st']="Sulawesi Tengah";
	$provinsi['id-pa']="Papua";
	$provinsi['id-jr']="Jawa Barat";
	$provinsi['id-1024']="Lampung";
	$provinsi['id-jk']="DKI Jakarta";
	$provinsi['id-go']="Gorontalo";
	$provinsi['id-yo']="DI Yogykarta";
	$provinsi['id-kt']="Kalimantan Tengah";
	$provinsi['id-sl']="Sulawesi Selatan";
	$provinsi['id-sr']="Sulawesi Barat";
	$provinsi['id-ja']="Jambi";

	return $provinsi;
}

function jumlah_permohonan()
{
	$CI =& get_instance();
	$kode = kode_provinsi();

	$semua=array();
	foreach ($kode as $key => $value)
	{
		$ambil = $CI->db->query("SELECT COUNT(*) as jumlah FROM permohonan JOIN klien ON permohonan.id_klien=klien.id_klien WHERE provinsi='$value'");
		$hasil = $ambil->row_array();
		if(!empty($hasil))
		{
			$semua[$key]=$hasil;
		}
		else
		{
			$semua[$key]=0;
		}
	}

	return $semua;

}

function tamplate()
{
	$template='<!DOCTYPE html>
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
	<div class="box box-info">
	<div class="box-body">
	<table class="table table-bordered">
	<thead>
	<tr>
	<th width="100" >
	<img src='.base_url ("asset/img/Bhantu.jpg").' width="120" style="padding-bottom: 40px;">
	</th>
	<th width="300" >
	<h4 class="text-center"> FORMULIR PERMOHONAN <br> PENGUJIAN SAMPEL</h4>
	<h5 class="text-center" style="font-weight: 550;">LABORATORIUM FORENSIKA DIGITAL <br> PUSAT STUDI FORENSIKA DIGITAL</h5>
	<p class="text-center" style="font-weight: 200">
	Gedung KH Mas Mansur <br> Kampus terpadu Universitas Islam Indonesia <br> Jalan Kaliurang KM 14,5, Ngemplak, Sleman, <br> Yogyakarta
	</p>
	</th>
	<th >
	<h6 class="text-center" style="font-weight: 600;">Kode Form :</h6>
	<h1 class="text-center" style="font-size: 90px;padding-bottom: 30px">P</h1>
	</th>
	</tr>
	</thead>
	</table>
	<!-- <pre>
	</pre> -->
	<p class="text-center"><b>No. {nomer} </b></p>
	<br>
	<span>
	Tanggal :<b> {tgl} </b>
	</span>
	<br>
	<br>
	<p>
	Menimbang kompetensi SDM, ketersedian alat, waktu, dan kelengkapan administrasi lainya maka bersama ini diputuskan pemohonan tersebut :
	</p>
	<ul style="list-style: none;">
	{keputusan}</ul>
	<p></p>
	<p>Yang menverifikasi permohonan :</p>
	<table class="table-bordered table">
	<thead>
	<tr>
	<th>Nama</th>
	<th>Jabatan</th>
	</tr>
	</thead>
	<tbody>
	{admin}
	</tbody>
	</table>
	</div>
	</div>
	</body>
	</html>';

	return $template;
}

function email_laporan($pesan,$email_tujuan,$nama_klien)
{
	echo $email_tujuan;
	include_once APPPATH.'libraries/phpmailer/PHPMailerAutoload.php';

	$mail = new PHPMailer();


	$mail->IsSMTP(); // telling the class to use SMTP

	$mail->SMTPOptions = array(
		'ssl' => array(
			'verify_peer' => false,
			'verify_peer_name' => false,
			'allow_self_signed' => true
		)
	);

	$mail->Host = "smtp.gmail.com"; // SMTP server 
	$mail->SMTPDebug = 0; // enables SMTP debug information (for testing) // 1 = errors and messages // 2 = messages only 
	$mail->SMTPAuth = true; // enable SMTP authentication 
	$mail->SMTPSecure = "tls"; // sets the prefix to the servier 
	$mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server 
	$mail->Port = 587; // set the SMTP port for the GMAIL server 
	$mail->Username = "tugasakhirkukuh@gmail.com"; // GMAIL username 
	$mail->Password = "Prihandoko123"; // GMAIL password

	$mail->SetFrom('tugasakhirkukuh@gmail.com', 'PUSFID UII');

	$mail->AddReplyTo('tugasakhirkukuh@gmail.com', 'PUSFID UII');

	$mail->Subject = "Pemberitahuan PUSFID UII";

	$mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

	$mail->MsgHTML($pesan);

	$address = $email_tujuan; 
	$mail->AddAddress($address, $nama_klien);

	// $mail->AddAttachment($file_name); // attachment 
	// $mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

	// $mail->Send();

	if ($mail->send()) 
	{
		// echo "<pre>";
		// echo "mailer Error" . $mail->ErrorInfo;
		// echo "</pre>";
	}
	else
	{
		echo "Message sent!";
	}
}

?>
