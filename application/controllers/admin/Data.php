<?php
class Data extends CI_Controller 
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
	
	function klien() // halaman klien di admin
	{
		if ($this->session->userdata('admin')) 
		{
			$login = $this->session->userdata('admin');
		}elseif ($this->session->userdata('pegawai')) {
			$login = $this->session->userdata('pegawai');
		}

		if ($login['level']=="pegawai") 
		{
			
			$data['login'] = $this->Madmin->ambil_pegawai($login['id_pegawai']);
		}
		else
		{
			$data['login'] = $this->Madmin->ambil_admin($login['id_admin']);

		}
		

		//memberikan level
		$data['login']['level'] = $login['level'];
		//memanggil session admin
		$login = $this->session->userdata('pegawai');

		// //memanggil data admin berdasarkan yang login
		// $data['login'] = $this->Madmin->ambil_admin($login['id_admin']);

		//model Mklien menjalakan function tampil_klien
		$data["klien"] = $this->Mklien->tampil_klien();


		$data['notif'] = $this->Mdata->notif_pegawai();

		$this->load->view('admin/header',$data);
		$this->load->view("admin/sidebar",$data);
		$this->load->view("admin/klien/tampil",$data);
		$this->load->view("admin/footer");
	}

	function permohonan() //merujuk ke halaman awal pengajuan di admin
	{
		//memanggil session admin
		$login = $this->session->userdata('pegawai');

		//memanggil data admin berdasarkan yang login
		$data['login'] = $this->Madmin->ambil_pegawai($login['id_pegawai']);

		//memberikan level
		$data['login']['level'] = $login['level'];


		$data["pengajuan"] = $this->Mdata->tampil_pengajuan();

		$data["permohonan"] = $this->Mdata->tampil_pengajuan_dan_foto();

		$data['cek_laporan'] = $this->Mdata->cek_laporan($data['pengajuan']);


		$data['notif'] = $this->Mdata->notif_pegawai();

		$this->load->view('admin/header',$data);
		$this->load->view("admin/sidebar",$data);
		$this->load->view("admin/permohonan/tampil", $data);
		$this->load->view("admin/footer");
	}

	function pengajuan()
	{
		//memanggil session admin
		$login = $this->session->userdata('pegawai');

		//memanggil data admin berdasarkan yang login
		$data['login'] = $this->Madmin->ambil_pegawai($login['id_pegawai']);

		//memberikan level
		$data['login']['level'] = $login['level'];


		$data["pengajuan"] = $this->Mdata->tampil_pengajuan_dan_foto();

		$data['cek_laporan'] = $this->Mdata->cek_laporan($data['pengajuan']);

		$data['notif'] = $this->Mdata->notif_pegawai();

		$this->load->view('admin/header',$data);
		$this->load->view("admin/sidebar",$data);
		$this->load->view("admin/pengajuan/tampil", $data);
		$this->load->view("admin/footer");
	}

	

	function sampel($id_permohonan) // menampilkan halaman sampel
	{
		//model Mdata menjalankan ambil_penerima
		$data['penerima'] = $this->Mdata->ambil_penerima_permohonan($id_permohonan);
		$data['permohonan'] = $this->Mdata->ambil_permohonan($id_permohonan);

		//jika table penerima masih kosong maka
		if (empty($data['penerima'])) 
		{
			$this->Mdata->simpan_penerima($id_permohonan);
			redirect("admin/data/sampel/$id_permohonan");
		}

		$data["sampel"] = $this->Msampel->tampil_sampel($data['penerima']['id_penerima']);

		//memanggil session admin
		$login = $this->session->userdata('pegawai');

		//memanggil data admin berdasarkan yang login
		$data['login'] = $this->Madmin->ambil_pegawai($login['id_pegawai']);

		//memberikan level
		$data['login']['level'] = $login['level'];

		$data['notif'] = $this->Mdata->notif_pegawai();

		$this->load->view('admin/header',$data);
		$this->load->view("admin/sidebar",$data);
		$this->load->view("admin/sampel/tampil",$data);
		$this->load->view("admin/footer");
	}

	function sampel_arsip( $id_permohonan)
	{
		//model Mdata menjalankan ambil_penerima
		$data['penerima'] = $this->Mdata->ambil_penerima_permohonan($id_permohonan);

		//jika table penerima masih kosong maka
		if (empty($data['penerima'])) 
		{
			$this->Mdata->simpan_penerima($id_permohonan);
			redirect("admin/data/sampel/$id_permohonan");
		}

		$data["sampel"] = $this->Msampel->tampil_sampel($data['penerima']['id_penerima']);

		if ($this->session->userdata('admin')) 
		{
			$login = $this->session->userdata('admin');
		}elseif ($this->session->userdata('pegawai')) {
			$login = $this->session->userdata('pegawai');
		}

		if ($login['level']=="pegawai") 
		{
			
			$data['login'] = $this->Madmin->ambil_pegawai($login['id_pegawai']);
		}
		else
		{
			$data['login'] = $this->Madmin->ambil_admin($login['id_admin']);

		}
		

		//memberikan level
		$data['login']['level'] = $login['level'];
		//memberikan level
		$data['login']['level'] = $login['level'];

		$data['notif'] = $this->Mdata->notif_pegawai();

		$this->load->view('admin/header',$data);
		$this->load->view("admin/sidebar",$data);
		$this->load->view("admin/arsip/sampel_arsip",$data);
		$this->load->view("admin/footer");
	}

	function tambah_sampel($id_penerima) 
	{
		//memanggil session admin
		$login = $this->session->userdata('pegawai');

		//memanggil data admin berdasarkan yang login
		$data['login'] = $this->Madmin->ambil_pegawai($login['id_pegawai']);

		//memberikan level
		$data['login']['level'] = $login['level'];

		$data['notif'] = $this->Mdata->notif_pegawai();

		// mengambil data permohonan di table penerima
		$data['permohonan'] = $this->Mdata->ambil_penerima($id_penerima);

		$this->load->view('admin/header',$data);
		$this->load->view("admin/sidebar",$data);
		$this->load->view("admin/sampel/tambah",$data);
		$this->load->view("admin/footer");

		// mengambil id_permohonan 
		$id_permohonan = $data['permohonan']['id_permohonan'];

		//jika ada input post
		if ($this->input->post()) 
		{
			$input = $this->input->post();
			$input['id_penerima'] = $id_penerima;

			$id_sampel = $this->Msampel->simpan_sampel($input);

			
			redirect("admin/data/detail_sampel/$id_sampel");

			// $lokasi = base_url("admin/data/detail_sampel/$id_sampel");
			// echo "<script>";
			// echo "alert('Apakah data sudah benar ?');";
			// echo "location='".$lokasi."';";
			// echo "</script>";

		}
	}

	function tambah_sampel_arsip($id_penerima) 
	{
		//memanggil session admin
		if ($this->session->userdata('admin')) 
		{
			$login = $this->session->userdata('admin');
		}elseif ($this->session->userdata('pegawai')) {
			$login = $this->session->userdata('pegawai');
		}

		if ($login['level']=="pegawai") 
		{
			
			$data['login'] = $this->Madmin->ambil_pegawai($login['id_pegawai']);
		}
		else
		{
			$data['login'] = $this->Madmin->ambil_admin($login['id_admin']);

		}

		//memberikan level
		$data['login']['level'] = $login['level'];

		$data['notif'] = $this->Mdata->notif_pegawai();

		// mengambil data permohonan di table penerima
		$data['permohonan'] = $this->Mdata->ambil_penerima($id_penerima);

		$this->load->view('admin/header',$data);
		$this->load->view("admin/sidebar",$data);
		$this->load->view("admin/arsip/tambah_sampel_arsip",$data);
		$this->load->view("admin/footer");

		// mengambil id_permohonan 
		$id_permohonan = $data['permohonan']['id_permohonan'];

		//jika ada input post
		if ($this->input->post()) 
		{
			$input = $this->input->post();
			$input['id_penerima'] = $id_penerima;

			$id_sampel = $this->Msampel->simpan_sampel($input);

			redirect("admin/data/tambah_detail_sampel_arsip/$id_sampel");
		}
	}


	function dokumen()
	{
		//memanggil session admin
		$login = $this->session->userdata('pegawai');

		//memanggil data admin berdasarkan yang login
		$data['login'] = $this->Madmin->ambil_pegawai($login['id_pegawai']);

		//memberikan level
		$data['login']['level'] = $login['level'];

		$data['notif'] = $this->Mdata->notif_pegawai();

		$this->load->view('admin/header',$data);
		$this->load->view("admin/sidebar",$data);
		$this->load->view("admin/dokumen/tampil");
		$this->load->view("admin/footer");
	}

	function detail($id_permohonan) 
	{
		//memanggil session admin
		$login = $this->session->userdata('pegawai');

		//memanggil data admin berdasarkan yang login
		$data['login'] = $this->Madmin->ambil_pegawai($login['id_pegawai']);

		//memberikan level
		$data['login']['level'] = $login['level'];

		$data['detail']=$this->Mdata->ambil_pengajuan($id_permohonan);

		// echo"<pre>";
		// print_r($data);
		// echo"<pre>";
		

		$data['notif'] = $this->Mdata->notif_pegawai();

		$this->load->view('admin/header',$data);
		$this->load->view("admin/sidebar",$data);
		$this->load->view("admin/pengajuan/detail",$data);
		$this->load->view("admin/footer");
	}

	function surat_permohonan($id_permohonan) 
	{
		//memanggil session admin
		$login = $this->session->userdata('pegawai');

		//memanggil data admin berdasarkan yang login
		$data['login'] = $this->Madmin->ambil_pegawai($login['id_pegawai']);

		//memberikan level
		$data['login']['level'] = $login['level'];

		$data['detail']=$this->Mdata->ambil_pengajuan($id_permohonan);

		
		

		$data['notif'] = $this->Mdata->notif_pegawai();

		$this->load->view('admin/header',$data);
		$this->load->view("admin/sidebar",$data);
		$this->load->view("admin/permohonan/surat_permohonan",$data);
		$this->load->view("admin/footer");
	}
	function surat_permohonan_arsip($id_permohonan) 
	{
		if ($this->session->userdata('admin')) 
		{
			$login = $this->session->userdata('admin');
		}elseif ($this->session->userdata('pegawai')) {
			$login = $this->session->userdata('pegawai');
		}

		if ($login['level']=="pegawai") 
		{
			
			$data['login'] = $this->Madmin->ambil_pegawai($login['id_pegawai']);
		}
		else
		{
			$data['login'] = $this->Madmin->ambil_admin($login['id_admin']);

		}
		

		//memberikan level
		$data['login']['level'] = $login['level'];

		//memberikan level
		$data['login']['level'] = $login['level'];

		$data['detail']=$this->Mdata->ambil_pengajuan($id_permohonan);

		// echo"<pre>";
		// print_r($data);
		// echo"<pre>";
		

		$data['notif'] = $this->Mdata->notif_pegawai();

		$this->load->view('admin/header',$data);
		$this->load->view("admin/sidebar",$data);
		$this->load->view("admin/arsip/surat_permohonan_arsip",$data);
		$this->load->view("admin/footer");
	}


	function verifikasi($id_permohonan) 
	{
		//model  Mdata menjalankan function ambil_pengajuan berdasarkan id_pengajuan

		$data['detail']=$this->Mdata->ambil_pengajuan($id_permohonan);

		//mengambil data verifikasi berdasarkan id_permohonan
		//model Mdata menjalankan function ambil verifikasi
		$data['verifikasi'] = $this->Mdata->ambil_verifikasi($id_permohonan);

		//model Madmin menjalankan function tampil_admin()

		$data['user']=$this->Madmin->tampil_pegawai();

		//memanggil session admin
		$login = $this->session->userdata('pegawai');

		//memanggil data admin berdasarkan yang login
		$data['login'] = $this->Madmin->ambil_pegawai($login['id_pegawai']);

		//memberikan level
		$data['login']['level'] = $login['level'];

		//membuat view
		//
		
		$data['notif'] = $this->Mdata->notif_pegawai();

		$this->load->view('admin/header',$data);
		$this->load->view("admin/sidebar",$data);

		//jika isi dari status permohonan samadengan diterima atau tidak diterima mak
		if ($data['detail']['status_permohonan']=="Diterima" OR $data['detail']['status_permohonan']=="Tidak Diterima") 
		{
			$this->load->view("admin/pengajuan/hasil",$data);
			
		}
		else
		{
			$this->load->view("admin/pengajuan/verifikasi",$data);

		}
		$this->load->view("admin/footer");

		//jika ada input post maka

		if ($this->input->post()) 
		{
			$input = $this->input->post();
			if ( $input['id_pegawai1']!= $input['id_pegawai2']) {
				# code...


			//mengambil id_admin1
				$detail['id_pegawai'][] = $input['id_pegawai1'];
				$detail['id_pegawai'][] = $input['id_pegawai2'];
				$verifikasi['status_verifikasi'] = $input['status_verifikasi'];

				$verifikasi['nomor_verifikasi']=$data['detail']['nomor_permohonan'];
				$verifikasi['id_permohonan']=$id_permohonan;
				$verifikasi['tgl_verifikasi']=date("Y-m-d H:i:s");
				$this->Mdata->simpan_verifikasi($verifikasi,$detail);

			//tambah skripsi email
				$this->Mdata->kirim_email_verifikasi($id_permohonan,$data['detail']);

			//mengambil status verifikasi beserta tanggal
				$inputan['status_permohonan']=$input['status_verifikasi'];
				$inputan['tgl_verifikasi_permohonan']=date("Y-m-d H:i:s");

				$this->Mdata->ubah_status_permohonan($inputan,$id_permohonan);

				$history['id_pegawai'] = $data['login']['id_pegawai'];
				$history['waktu_history'] = date('Y-m-d H:i:s');
				$history['aktivitas'] = "verifikasi permohonan";
				$this->Mhistory->simpan_history($history);

				redirect("admin/data/verifikasi/$id_permohonan");
			}
		}
	}

	function surat_verifikasi_arsip($id_permohonan) 
	{
		//model  Mdata menjalankan function ambil_pengajuan berdasarkan id_pengajuan

		$data['detail']=$this->Mdata->ambil_pengajuan($id_permohonan);

		//mengambil data verifikasi berdasarkan id_permohonan
		//model Mdata menjalankan function ambil verifikasi
		$data['verifikasi'] = $this->Mdata->ambil_verifikasi($id_permohonan);

		//model Madmin menjalankan function tampil_admin()

		$data['user']=$this->Madmin->tampil_pegawai();

		//memanggil session admin
		if ($this->session->userdata('admin')) 
		{
			$login = $this->session->userdata('admin');
		}elseif ($this->session->userdata('pegawai')) {
			$login = $this->session->userdata('pegawai');
		}

		if ($login['level']=="pegawai") 
		{
			
			$data['login'] = $this->Madmin->ambil_pegawai($login['id_pegawai']);
		}
		else
		{
			$data['login'] = $this->Madmin->ambil_admin($login['id_admin']);

		}
		

		//memberikan level
		$data['login']['level'] = $login['level'];

		//memberikan level
		$data['login']['level'] = $login['level'];

		//membuat view
		//
		
		$data['notif'] = $this->Mdata->notif_pegawai();

		$this->load->view('admin/header',$data);
		$this->load->view("admin/sidebar",$data);

		//jika isi dari status permohonan samadengan diterima atau tidak diterima maka
		$this->load->view("admin/arsip/surat_verifikasi_arsip",$data);

		

		$this->load->view("admin/footer");

		//jika ada input post maka

		if ($this->input->post()) 
		{
			$input = $this->input->post();
			//mengambil id_admin1
			$detail['id_pegawai'][] = $input['id_pegawai1'];
			$detail['id_pegawai'][] = $input['id_pegawai2'];
			$verifikasi['status_verifikasi'] = $input['status_verifikasi'];

			$verifikasi['nomor_verifikasi']=$data['detail']['nomor_permohonan'];
			$verifikasi['id_permohonan']=$id_permohonan;
			$verifikasi['tgl_verifikasi']=date("Y-m-d H:i:s");
			$this->Mdata->simpan_verifikasi($verifikasi,$detail);

			//tambah skripsi email
			$this->Mdata->kirim_email_verifikasi($id_permohonan,$data['detail']);

			//mengambil status verifikasi beserta tanggal
			$inputan['status_permohonan']=$input['status_verifikasi'];
			$inputan['tgl_verifikasi_permohonan']=date("Y-m-d H:i:s");

			$this->Mdata->ubah_status_permohonan($inputan,$id_permohonan);

			$history['id_pegawai'] = $data['login']['id_pegawai'];
			$history['waktu_history'] = date('Y-m-d H:i:s');
			$history['aktivitas'] = "verifikasi permohonan";
			$this->Mhistory->simpan_history($history);

			redirect("admin/data/verifikasi/$id_permohonan");
		}
	}


	function surat ($id_penerima) 
	{

		//model Mdata menjalankan ambil_penerima
		$data['penerima'] = $this->Mdata->ambil_penerima($id_penerima);

		$data["sampel"] = $this->Msampel->tampil_sampel($id_penerima);


		//penyebutan

		$data['tanggal'] = penyebut(date("d",strtotime($data['penerima']['tgl_penerima'])))." ".bulan(date("m",strtotime($data['penerima']['tgl_penerima'])))." ".penyebut(date("Y",strtotime($data['penerima']['tgl_penerima'])));

		//memanggil session admin
		$login = $this->session->userdata('pegawai');

		//memanggil data admin berdasarkan yang login
		$data['login'] = $this->Madmin->ambil_pegawai($login['id_pegawai']);

		//memberikan level
		$data['login']['level'] = $login['level'];

		$data['notif'] = $this->Mdata->notif_pegawai();

		$this->load->view('admin/header',$data);
		$this->load->view("admin/sidebar",$data);
		$this->load->view("admin/sampel/surat",$data);
		$this->load->view("admin/footer");

	}

	function surat_sampel_arsip ($id_penerima) 
	{

		//model Mdata menjalankan ambil_penerima
		$data['penerima'] = $this->Mdata->ambil_penerima($id_penerima);

		$data["sampel"] = $this->Msampel->tampil_sampel($id_penerima);


		//penyebutan

		$data['tanggal'] = penyebut(date("d",strtotime($data['penerima']['tgl_penerima'])))." ".bulan(date("m",strtotime($data['penerima']['tgl_penerima'])))." ".penyebut(date("Y",strtotime($data['penerima']['tgl_penerima'])));

		//memanggil session admin
		if ($this->session->userdata('admin')) 
		{
			$login = $this->session->userdata('admin');
		}elseif ($this->session->userdata('pegawai')) {
			$login = $this->session->userdata('pegawai');
		}

		if ($login['level']=="pegawai") 
		{
			
			$data['login'] = $this->Madmin->ambil_pegawai($login['id_pegawai']);
		}
		else
		{
			$data['login'] = $this->Madmin->ambil_admin($login['id_admin']);

		}
		

		//memberikan level
		$data['login']['level'] = $login['level'];

		$data['notif'] = $this->Mdata->notif_pegawai();

		$this->load->view('admin/header',$data);
		$this->load->view("admin/sidebar",$data);
		$this->load->view("admin/arsip/surat_sampel_arsip",$data);
		$this->load->view("admin/footer");

	}

	function hapus_sampel($id_sampel,$id_permohonan)
	{
		$lokasi = base_url("admin/data/sampel/$id_permohonan");
		$this->Msampel->hapus_sampel($id_sampel);

		
		//untuk hapus
		//memanggil session admin
		$login = $this->session->userdata('pegawai');

		//memanggil data admin berdasarkan yang login
		$data['login'] = $this->Madmin->ambil_pegawai($login['id_pegawai']);

		//memberikan level
		$data['login']['level'] = $login['level'];
		//akhir hapus

		$history['id_pegawai'] = $data['login']['id_pegawai'];
		$history['waktu_history'] = date('Y-m-d H:i:s');
		$history['aktivitas'] = "Menghapus sampel";
		$this->Mhistory->simpan_history($history);

		echo "<script>";
		echo "alert('Data berhasil dihapus');";
		echo "location='".$lokasi."';";
		echo "</script>";
	}

	function hapus_foto_pengujian($id_foto_permohonan,$id_permohonan)
	{
		$lokasi = base_url("admin/data/pengajuan");
		$this->Msampel->hapus_foto_permohonan($id_foto_permohonan,$id_permohonan);

		//untuk hapus
		//memanggil session admin
		$login = $this->session->userdata('pegawai');

		//memanggil data admin berdasarkan yang login
		$data['login'] = $this->Madmin->ambil_pegawai($login['id_pegawai']);

		//memberikan level
		$data['login']['level'] = $login['level'];
		//akhir hapus

		$history['id_pegawai'] = $data['login']['id_pegawai'];
		$history['waktu_history'] = date('Y-m-d H:i:s');
		$history['aktivitas'] = "hapus foto sampel";
		$this->Mhistory->simpan_history($history);

		echo "<script>";
		echo "alert('Data berhasil dihapus');";
		echo "location='".$lokasi."';";
		echo "</script>";
	}


	function ubah_sampel($id_sampel,$id_permohonan) 
	{
		// mengambil data sampel
		$data['sampel'] = $this->Msampel->ambil_sampel($id_sampel);
		//memanggil session admin
		$login = $this->session->userdata('pegawai');

		//memanggil data admin berdasarkan yang login
		$data['login'] = $this->Madmin->ambil_pegawai($login['id_pegawai']);

		//memberikan level
		$data['login']['level'] = $login['level'];


		//membuat view
		
		$data['notif'] = $this->Mdata->notif_pegawai();

		$this->load->view('admin/header',$data);
		$this->load->view("admin/sidebar",$data);
		$this->load->view("admin/sampel/ubah",$data);
		$this->load->view("admin/footer");


		if ($this->input->post()) 
		{
			$inputan = $this->input->post();
			$this->Msampel->ubah_sampel($inputan,$id_sampel);

			$history['id_pegawai'] = $data['login']['id_pegawai'];
			$history['waktu_history'] = date('Y-m-d H:i:s');
			$history['aktivitas'] = "ubah sampel";
			$this->Mhistory->simpan_history($history);

			$lokasi = base_url("admin/data/ubah_detail/$id_sampel");
			echo "<script>";
			echo "alert('Data berhasil ubah');";
			echo "location='".$lokasi."';";
			echo "</script>";
		}

	}



	function ubah_sampel_arsip($id_sampel,$id_permohonan) 
	{
		// mengambil data sampel
		$data['sampel'] = $this->Msampel->ambil_sampel($id_sampel);
		
		//memanggil session admin
		
		if ($this->session->userdata('admin')) 
		{
			$login = $this->session->userdata('admin');
		}elseif ($this->session->userdata('pegawai')) {
			$login = $this->session->userdata('pegawai');
		}
		if ($login['level']=="pegawai") 
		{
			
			$data['login'] = $this->Madmin->ambil_pegawai($login['id_pegawai']);
		}
		else
		{
			$data['login'] = $this->Madmin->ambil_admin($login['id_admin']);

		}

		//memberikan level
		$data['login']['level'] = $login['level'];

		//membuat view
		
		$data['notif'] = $this->Mdata->notif_pegawai();

		$this->load->view('admin/header',$data);
		$this->load->view("admin/sidebar",$data);
		$this->load->view("admin/arsip/ubah_sampel_arsip",$data);
		$this->load->view("admin/footer");


		if ($this->input->post()) 
		{
			$inputan = $this->input->post();
			$this->Msampel->ubah_sampel($inputan,$id_sampel);

			$history['id_pegawai'] = $data['login']['id_pegawai'];
			$history['waktu_history'] = date('Y-m-d H:i:s');
			$history['aktivitas'] = "ubah sampel";
			$this->Mhistory->simpan_history($history);

			$lokasi = base_url("admin/data/ubah_detail_sampel_arsip/$id_sampel");
			echo "<script>";
			echo "alert('Data berhasil ubah');";
			echo "location='".$lokasi."';";
			echo "</script>";
		}

	}

	function detail_sampel($id_sampel) //tambah
	{
		//model Msampel menjalankan function ambil_sampel berdasarkan id_sampel
		$data['detail_sampel'] = $this->Msampel->ambil_sampel($id_sampel);


		//memanggil session admin
		$login = $this->session->userdata('pegawai');

		//memanggil data admin berdasarkan yang login
		$data['login'] = $this->Madmin->ambil_pegawai($login['id_pegawai']);

		//memberikan level
		$data['login']['level'] = $login['level'];

		$data['notif'] = $this->Mdata->notif_pegawai();

		$this->load->view('admin/header',$data);
		$this->load->view("admin/sidebar",$data);
		$this->load->view("admin/sampel/detail",$data);
		$this->load->view("admin/footer");

		$permohonan = $this->Mdata->ambil_permohonan($data['detail_sampel']['id_permohonan']);
		$folder = $permohonan['judul_permohonan']." - ".date("d-m-Y H-i-s",strtotime($permohonan['tgl_permohonan']));


		//jika ada input post maka
		if ($this->input->post()) 
		{
			$input = $this->input->post();
			$input['id_sampel'] = $id_sampel;
			$config['upload_path'] = "./asset/Kumpulan Kasus/".$folder."/";
			$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('foto_ime')) 
			{
				$fileData = $this->upload->data();
				$input['foto_ime'] = $fileData['file_name'];

			}
			//model Msampel menjalankan function simpan_detail_sampel
			$this->Msampel->simpan_detail_sampel($input);

			//mengambil id_permohonan
			$id = $data['detail_sampel']['id_permohonan'];

			$history['id_pegawai'] = $data['login']['id_pegawai'];
			$history['waktu_history'] = date('Y-m-d H:i:s');
			$history['aktivitas'] = "Tambah Detail Sampel";
			$this->Mhistory->simpan_history($history);

			$lokasi = base_url("admin/data/sampel/$id");

			echo "<script>";
			echo "alert('Data berhasil disimmpan');";
			echo "location='".$lokasi."';";
			echo "</script>";
		}

	}

	function tambah_detail_sampel_arsip($id_sampel) //tambah
	{
		//model Msampel menjalankan function ambil_sampel berdasarkan id_sampel
		$data['detail_sampel'] = $this->Msampel->ambil_sampel($id_sampel);

		//memanggil session admin
		$login = $this->session->userdata('pegawai');

		if ($login['level']=="pegawai") 
		{
			
			$data['login'] = $this->Madmin->ambil_pegawai($login['id_pegawai']);
		}
		else
		{
			$data['login'] = $this->Madmin->ambil_admin($login['id_admin']);

		}
		//memberikan level
		$data['login']['level'] = $login['level'];

		$data['notif'] = $this->Mdata->notif_pegawai();

		$this->load->view('admin/header',$data);
		$this->load->view("admin/sidebar",$data);
		$this->load->view("admin/arsip/tambah_detail_sampel_arsip",$data);
		$this->load->view("admin/footer");


		//jika ada input post maka
		if ($this->input->post()) 
		{
			$input = $this->input->post();
			$input['id_sampel'] = $id_sampel;

			//model Msampel menjalankan function simpan_detail_sampel
			$this->Msampel->simpan_detail_sampel($input);

			//mengambil id_permohonan
			$id = $data['detail_sampel']['id_permohonan'];

			if ($login['level']=="pegawai") {
				$history['id_pegawai'] = $data['login']['id_pegawai'];
				$history['waktu_history'] = date('Y-m-d H:i:s');
				$history['aktivitas'] = "Tambah Detail Sampel";
				$this->Mhistory->simpan_history($history);
			}

			$lokasi = base_url("admin/data/sampel_arsip/$id");

			echo "<script>";
			echo "alert('Data berhasil disimmpan');";
			echo "location='".$lokasi."';";
			echo "</script>";
		}

	}

	function ubah_detail($id_sampel) 
	{
		//model Msampel menjalankan function ambil sampel berdasarkan id_sampel
		$data['detail_sampel']=$this->Msampel->ambil_sampel($id_sampel);

		//mengambil detail_sampel
		$data['detail'] = $this->Msampel->ambil_detail_sampel($id_sampel);

		// echo "<pre>";
		// print_r($data['detail']);
		// echo "</pre>";
		
		//memanggil session admin
		$login = $this->session->userdata('pegawai');

		//memanggil data admin berdasarkan yang login
		$data['login'] = $this->Madmin->ambil_pegawai($login['id_pegawai']);

		//memberikan level
		$data['login']['level'] = $login['level'];


		$data['notif'] = $this->Mdata->notif_pegawai();

		$this->load->view('admin/header',$data);
		$this->load->view("admin/sidebar",$data);
		$this->load->view("admin/sampel/ubah_detail",$data);
		$this->load->view("admin/footer");


		//jika ada input post maka
		if ($this->input->post()) 
		{
			$input = $this->input->post();

			//model Msampel menjalankan function ubah detail_Sampel
			$this->Msampel->ubah_detail_sampel($input,$id_sampel);

			//mengambil id_permohonan
			$id = $data['detail_sampel']['id_permohonan'];

			$history['id_pegawai'] = $data['login']['id_pegawai'];
			$history['waktu_history'] = date('Y-m-d H:i:s');
			$history['aktivitas'] = "Ubah detail sampel";
			$this->Mhistory->simpan_history($history);

			redirect("admin/data/sampel/$id");

			// echo "<script>";
			// echo "alert('Data berhasil disimmpan');";
			// echo "location='".$lokasi."';";
			// echo "</script>";
		}
	}

	function ubah_detail_sampel_arsip($id_sampel) 
	{
		//model Msampel menjalankan function ambil sampel berdasarkan id_sampel
		$data['detail_sampel']=$this->Msampel->ambil_sampel($id_sampel);

		//mengambil detail_sampel
		$data['detail'] = $this->Msampel->ambil_detail_sampel($id_sampel);

		// echo "<pre>";
		// print_r($data['detail']);
		// echo "</pre>";
		
		//memanggil session admin
		$login = $this->session->userdata('pegawai');

		//memanggil data admin berdasarkan yang login
		$data['login'] = $this->Madmin->ambil_pegawai($login['id_pegawai']);

		//memberikan level
		$data['login']['level'] = $login['level'];


		$data['notif'] = $this->Mdata->notif_pegawai();

		$this->load->view('admin/header',$data);
		$this->load->view("admin/sidebar",$data);
		$this->load->view("admin/arsip/ubah_detail_sampel_arsip",$data);
		$this->load->view("admin/footer");


		//jika ada input post maka
		if ($this->input->post()) 
		{
			$input = $this->input->post();

			//model Msampel menjalankan function ubah detail_Sampel
			$this->Msampel->ubah_detail_sampel($input,$id_sampel);

			//mengambil id_permohonan
			$id = $data['detail_sampel']['id_permohonan'];

			$history['id_pegawai'] = $data['login']['id_pegawai'];
			$history['waktu_history'] = date('Y-m-d H:i:s');
			$history['aktivitas'] = "Ubah detail sampel";
			$this->Mhistory->simpan_history($history);

			$lokasi = base_url("admin/data/sampel/$id");

			echo "<script>";
			echo "alert('Data berhasil disimmpan');";
			echo "location='".$lokasi."';";
			echo "</script>";
		}
	}

	function detail_surat($id_sampel)
	{
		$data['detail']=$this->Msampel->ambil_detail_sampel($id_sampel);

		$data['detail_sampel']=$this->Msampel->ambil_sampel($id_sampel);

		//memanggil session admin
		$login = $this->session->userdata('pegawai');

		//memanggil data admin berdasarkan yang login
		$data['login'] = $this->Madmin->ambil_pegawai($login['id_pegawai']);

		//memberikan level
		$data['login']['level'] = $login['level'];

		$data['notif'] = $this->Mdata->notif_pegawai();

		$this->load->view('admin/header',$data);
		$this->load->view("admin/sidebar",$data);
		$this->load->view("admin/sampel/detail_surat",$data);
		$this->load->view("admin/footer");
	}

	function surat_detail_sampel_arsip($id_sampel)
	{
		$data['detail']=$this->Msampel->ambil_detail_sampel($id_sampel);

		$data['detail_sampel']=$this->Msampel->ambil_sampel($id_sampel);

		//memanggil session admin
		if ($this->session->userdata('admin')) 
		{
			$login = $this->session->userdata('admin');
		}elseif ($this->session->userdata('pegawai')) {
			$login = $this->session->userdata('pegawai');
		}

		if ($login['level']=="pegawai") 
		{
			
			$data['login'] = $this->Madmin->ambil_pegawai($login['id_pegawai']);
		}
		else
		{
			$data['login'] = $this->Madmin->ambil_admin($login['id_admin']);

		}
		

		//memberikan level
		$data['login']['level'] = $login['level'];

		$data['notif'] = $this->Mdata->notif_pegawai();

		$this->load->view('admin/header',$data);
		$this->load->view("admin/sidebar",$data);
		$this->load->view("admin/arsip/surat_detail_sampel_arsip",$data);
		$this->load->view("admin/footer");
	}

	function penugasan($id_permohonan)
	{
		//memanggil session admin
		$login = $this->session->userdata('pegawai');

		//memanggil data admin berdasarkan yang login
		$data['login'] = $this->Madmin->ambil_pegawai($login['id_pegawai']);

		//memberikan level
		$data['login']['level'] = $login['level'];

		//mengambil data penerima berdasarkan id_permohonan
		$data['penerima']=$this->Mdata->ambil_penerima_permohonan($id_permohonan);

		//mengambil data penugasan berdasarkan penerima
		$cek =$this->Mdata->ambil_penugasan_penerima($data['penerima']['id_penerima']);

		//jika isi dari $cek kosong maka
		if (empty($cek)) 
		{
			$id_penugasan=$this->Mdata->simpan_penugasan($data['penerima']);
			$data['id_penugasan'] = $id_penugasan;

			$history['id_pegawai'] = $data['login']['id_pegawai'];
			$history['waktu_history'] = date('Y-m-d H:i:s');
			$history['aktivitas'] = "Penugasan";
			$this->Mhistory->simpan_history($history);
		}
		else
		{
			//mengambil id_penugasan yang sudah ada
			$id_penugasan = $cek['id_penugasan'];
			$data['id_penugasan'] = $cek['id_penugasan'];
		}

		 //mengambil data setail_penugasan berdasarkan id_penugasan
		$data['penugasan'] = $this->Mdata->detail_penugasan($id_penugasan);

		//membuat view
		
		$data['notif'] = $this->Mdata->notif_pegawai();

		$this->load->view('admin/header',$data);
		$this->load->view("admin/sidebar",$data);
		$this->load->view("admin/penugasan/tampil",$data);
		$this->load->view("admin/footer");

	}

	function surat_penugasan($id_penugasan)
	{
		//memanggil session admin
		$login = $this->session->userdata('pegawai');

		//memanggil data admin berdasarkan yang login
		$data['login'] = $this->Madmin->ambil_pegawai($login['id_pegawai']);

		//memberikan level
		$data['login']['level'] = $login['level'];

		//mengambil data penugasan berdasarkan id_penugasan
		$data['penugasan'] = $this->Mdata->ambil_penugasan($id_penugasan);

		$data['pengajuan'] = $this->Mdata->ambil_penerima($data['penugasan']['id_penerima']);

		//mengambil data detail_penugasan berdasarkan "Id_penugasan"

		$data['detail'] = $this->Mdata->detail_penugasan($id_penugasan);


		//membuat view
		
		$data['notif'] = $this->Mdata->notif_pegawai();

		$this->load->view('admin/header',$data);
		$this->load->view("admin/sidebar",$data);
		$this->load->view("admin/penugasan/surat",$data);
		$this->load->view("admin/footer");

	}
	function surat_penugasan_arsip($id_penugasan)
	{
		//memanggil session admin
		if ($this->session->userdata('admin')) 
		{
			$login = $this->session->userdata('admin');
		}elseif ($this->session->userdata('pegawai')) {
			$login = $this->session->userdata('pegawai');
		}

		if ($login['level']=="pegawai") 
		{
			
			$data['login'] = $this->Madmin->ambil_pegawai($login['id_pegawai']);
		}
		else
		{
			$data['login'] = $this->Madmin->ambil_admin($login['id_admin']);

		}
		

		//memberikan level
		$data['login']['level'] = $login['level'];

		//memberikan level
		$data['login']['level'] = $login['level'];

		//mengambil data penugasan berdasarkan id_penugasan
		$data['penugasan'] = $this->Mdata->ambil_penugasan($id_penugasan);

		$data['pengajuan'] = $this->Mdata->ambil_penerima($data['penugasan']['id_penerima']);

		//mengambil data detail_penugasan berdasarkan "Id_penugasan"

		$data['detail'] = $this->Mdata->detail_penugasan($id_penugasan);


		//membuat view
		
		$data['notif'] = $this->Mdata->notif_pegawai();

		$this->load->view('admin/header',$data);
		$this->load->view("admin/sidebar",$data);
		$this->load->view("admin/arsip/surat_penugasan_arsip",$data);
		$this->load->view("admin/footer");

	}

	function tambah_penugasan($id_penugasan,$id_permohonan)
	{
		//memanggil session admin
		$login = $this->session->userdata('pegawai');

		//memanggil data admin berdasarkan yang login
		$data['login'] = $this->Madmin->ambil_pegawai($login['id_pegawai']);

		//memberikan level
		$data['login']['level'] = $login['level'];

		$data['admin']=$this->Madmin->tampil_pegawai();

		//mengambil data penugasan berdasarkan id_penugasan
		$data['penugasan'] = $this->Mdata->ambil_penugasan($id_penugasan);

		$data['pengajuan'] = $this->Mdata->ambil_penerima($data['penugasan']['id_penerima']);

		//mengambil data detail_penugasan berdasarkan "Id_penugasan"

		$data['detail'] = $this->Mdata->detail_penugasan($id_penugasan);

		//membuat view
		
		$data['notif'] = $this->Mdata->notif_pegawai();

		$this->load->view('admin/header',$data);
		$this->load->view("admin/sidebar",$data);
		$this->load->view("admin/penugasan/tambah",$data);
		$this->load->view("admin/footer");

		if ($this->input->post()) 
		{
			$input = $this->input->post();	
			$input['id_penugasan'] = $id_penugasan;
			$hasil=$this->Mdata->simpan_detail_penugasan($input);
			if($hasil==1){
				$history['id_pegawai'] = $data['login']['id_pegawai'];
				$history['waktu_history'] = date('Y-m-d H:i:s');
				$history['aktivitas'] = "Tambagh Penugasan";
				$this->Mhistory->simpan_history($history);

				$lokasi = base_url("admin/data/penugasan/$id_permohonan");

				echo "<script>";
				echo "alert('Data berhasil disimmpan');";
				echo "location='".$lokasi."';";
				echo "</script>";
			}
		}
	}


	function hapus_penugasan($id_detail_penugasan,$id_permohonan)
	{


		$lokasi = base_url("admin/data/penugasan/$id_permohonan");
		$this->Mdata->hapus_penugasan($id_detail_penugasan);


		//untuk hapus
		//memanggil session admin
		$login = $this->session->userdata('pegawai');

		//memanggil data admin berdasarkan yang login
		$data['login'] = $this->Madmin->ambil_pegawai($login['id_pegawai']);

		//memberikan level
		$data['login']['level'] = $login['level'];
		//akhir hapus

		$history['id_pegawai'] = $data['login']['id_pegawai'];
		$history['waktu_history'] = date('Y-m-d H:i:s');
		$history['aktivitas'] = "hapus penugasan";
		$this->Mhistory->simpan_history($history);

		echo "<script>";
		echo "alert('Data berhasil dihapus');";
		echo "location='".$lokasi."';";
		echo "</script>";
	}

	function edit_penugasan($id_detail_penugasan,$id_permohonan) 
	{
		// mengambil data penugasan
		$data['detail'] = $this->Mdata->ambil_detail_penugasan($id_detail_penugasan);

		//tampil admin

		$data['admin'] = $this->Madmin->tampil_pegawai();

		//untuk hapus
		//memanggil session admin
		$login = $this->session->userdata('pegawai');

		//memanggil data admin berdasarkan yang login
		$data['login'] = $this->Madmin->ambil_pegawai($login['id_pegawai']);

		//memberikan level
		$data['login']['level'] = $login['level'];
		



		//membuat view

		$data['notif'] = $this->Mdata->notif_pegawai();

		$this->load->view('admin/header',$data);
		$this->load->view("admin/sidebar",$data);
		$this->load->view("admin/penugasan/edit",$data);
		$this->load->view("admin/footer");


		if ($this->input->post()) 
		{
			$inputan = $this->input->post();
			$this->Mdata->edit_detail_penugasan($inputan,$id_detail_penugasan);
			// $lokasi = base_url("admin/data/penugasan/$id_permohonan");
			redirect("admin/data/penugasan/$id_permohonan");

			$history['id_pegawai'] = $data['login']['id_pegawai'];
			$history['waktu_history'] = date('Y-m-d H:i:s');
			$history['aktivitas'] = "Edit Penugasan";
			$this->Mhistory->simpan_history($history);

			// echo "<script>";
			// echo "alert('Data berhasil ubah');";
			// echo "location='".$lokasi."';";
			// echo "</script>";
		}

	}

	function keputusan($id_permohonan) // surat keputusan
	{
		//memanggil session admin
		$login = $this->session->userdata('pegawai');

		//memanggil data admin berdasarkan yang login
		$data['login'] = $this->Madmin->ambil_pegawai($login['id_pegawai']);

		//memberikan level
		$data['login']['level'] = $login['level'];

		$data['penerima'] = $this->Mdata->ambil_penerima_permohonan($id_permohonan);

		$data['sampel']=$this->Msampel->tampil_sampel($data['penerima']['id_penerima']);

		$data['keputusan']=$this->Mdata->ambil_keputusan($data['penerima']['id_penerima']);

		//jika keputusan kosong
		if (empty($data['keputusan'])) 
		{
			$view = "admin/keputusan/tambah";
		}
		else
		{
			$data['tanggal'] = penyebut(date("d",strtotime($data['keputusan']['tgl_keputusan'])))." ".bulan(date("m",strtotime($data['keputusan']['tgl_keputusan'])))." ".penyebut(date("Y",strtotime($data['keputusan']['tgl_keputusan'])));
			$view = "admin/keputusan/surat";


		}

		if ($this->input->post()) 
		{
			$input = $this->input->post();
			$input['nomor_keputusan'] = str_replace("P", "MK", $data['penerima']['nomor_permohonan']);
			$input['id_pegawai'] =$data['login']['id_pegawai'];
			$input['tgl_keputusan']=date("Y-m-d H:i:s");
			$input['id_penerima']=$data['penerima']['id_penerima'];
			$this->Mdata->simpan_keputusan($input);


			$history['id_pegawai'] = $data['login']['id_pegawai'];
			$history['waktu_history'] = date('Y-m-d H:i:s');
			$history['aktivitas'] = "Tambah Keputusan";
			$this->Mhistory->simpan_history($history);

			redirect("admin/data/keputusan/$id_permohonan",'refresh');
		}


		$data['notif'] = $this->Mdata->notif_pegawai();

		$this->load->view('admin/header',$data);
		$this->load->view("admin/sidebar",$data);
		$this->load->view($view,$data);
		$this->load->view("admin/footer",$data);
	}

	function keputusan_sampel_arsip($id_permohonan) // surat keputusan
	{
		//memanggil session admin
		if ($this->session->userdata('admin')) 
		{
			$login = $this->session->userdata('admin');
		}elseif ($this->session->userdata('pegawai')) {
			$login = $this->session->userdata('pegawai');
		}

		if ($login['level']=="pegawai") 
		{
			
			$data['login'] = $this->Madmin->ambil_pegawai($login['id_pegawai']);
		}
		else
		{
			$data['login'] = $this->Madmin->ambil_admin($login['id_admin']);

		}
		

		//memberikan level
		$data['login']['level'] = $login['level'];
		//memberikan level
		$data['login']['level'] = $login['level'];

		$data['penerima'] = $this->Mdata->ambil_penerima_permohonan($id_permohonan);

		$data['sampel']=$this->Msampel->tampil_sampel($data['penerima']['id_penerima']);

		$data['keputusan']=$this->Mdata->ambil_keputusan($data['penerima']['id_penerima']);

		//jika keputusan kosong
		if (empty($data['keputusan'])) 
		{
			$view = "admin/keputusan/tambah";
		}
		else
		{
			$data['tanggal'] = penyebut(date("d",strtotime($data['keputusan']['tgl_keputusan'])))." ".bulan(date("m",strtotime($data['keputusan']['tgl_keputusan'])))." ".penyebut(date("Y",strtotime($data['keputusan']['tgl_keputusan'])));
			$view = "admin/keputusan/surat";

		}

		if ($this->input->post()) 
		{
			$input = $this->input->post();
			$input['nomor_keputusan'] = str_replace("P", "MK", $data['penerima']['nomor_permohonan']);
			$input['id_pegawai'] =$data['login']['id_pegawai'];
			$input['tgl_keputusan']=date("Y-m-d H:i:s");
			$input['id_penerima']=$data['penerima']['id_penerima'];
			$this->Mdata->simpan_keputusan($input);


			$history['id_pegawai'] = $data['login']['id_pegawai'];
			$history['waktu_history'] = date('Y-m-d H:i:s');
			$history['aktivitas'] = "Tambah Keputusan";
			$this->Mhistory->simpan_history($history);

			redirect("admin/data/keputusan/$id_permohonan",'refresh');
		}


		$data['notif'] = $this->Mdata->notif_pegawai();

		$this->load->view('admin/header',$data);
		$this->load->view("admin/sidebar",$data);
		$this->load->view("admin/arsip/keputusan_sampel_arsip",$data);
		$this->load->view("admin/footer",$data);
	}

	function laporan($id_permohonan)
	{
		$data['laporan'] = $this->Mdata->ambil_laporan($id_permohonan);
		//memanggil session admin
		$login = $this->session->userdata('pegawai');

		//memanggil data admin berdasarkan yang login
		$data['login'] = $this->Madmin->ambil_pegawai($login['id_pegawai']);

		//memberikan level
		$data['login']['level'] = $login['level'];

		$data['penerima'] = $this->Mdata->ambil_penerima_permohonan($id_permohonan);

		$data['sampel'] = $this->Msampel->tampil_sampel($data['penerima']['id_penerima']);

		$data['keputusan'] = $this->Mdata->ambil_keputusan($data['penerima']['id_penerima']);


		$data['notif'] = $this->Mdata->notif_pegawai();

		$data['riwayat'] = $this->Mdata->riwayat_pengujian($data['laporan']['id_pengujian']);

		$this->load->view('admin/header',$data);
		$this->load->view("admin/sidebar",$data);
		$this->load->view("admin/laporan",$data);
		$this->load->view("admin/footer",$data);

		if ($this->input->post('simpan')) 
		{
			$email_tujuan = $this->Mklien->ambil_email($id_permohonan);
			$input =$this->input->post('keterangan_admin');
			$this->Mdata->upload_laporan($id_permohonan,$input);
			$message = "Assalammualaikum Bapak/Ibu, Mohon check website PUSFID, laporan akhir analisis telah dikirim. Terimakasih";
			email_laporan($message,$email_tujuan->email_klien,$email_tujuan->nama_klien);
			redirect("admin/data/detail_laporan/$id_permohonan");
		}

	}

	function detail_laporan($id_permohonan)
	{
		$data['laporan'] = $this->Mdata->ambil_laporan($id_permohonan);
		//memanggil session admin
		$login = $this->session->userdata('pegawai');
		// echo '<pre>';
		// print_r($login);
		// echo '</pre>';

		//memanggil data admin berdasarkan yang login
		$data['login'] = $this->Madmin->ambil_pegawai($login['id_pegawai']);
		$data['permohonan'] = $this->Mdata->ambil_pengajuan($id_permohonan);

		//memberikan level
		$data['login']['level'] = $login['level'];
		$data['penerima'] = $this->Mdata->ambil_penerima_permohonan($id_permohonan);

		$data['notif'] = $this->Mdata->notif_pegawai();

		if($data['laporan']['status_pesan_pegawai']==0)
		{
			$this->Mdata->kurangi_notif($id_permohonan);
			redirect("admin/data/detail_laporan/$id_permohonan",'refresh');
		}

		$data['riwayat'] = $this->Mdata->riwayat_pengujian($data['laporan']['id_pengujian']);

		$this->load->view('admin/header',$data);
		$this->load->view("admin/sidebar",$data);
		$this->load->view("admin/detail_laporan",$data);
		$this->load->view("admin/footer",$data);
	}

	function laporan_arsip($id_permohonan)
	{
		$data['laporan'] = $this->Mdata->ambil_laporan($id_permohonan);

		//memanggil session admin
		if ($this->session->userdata('admin')) 
		{
			$login = $this->session->userdata('admin');
		}elseif ($this->session->userdata('pegawai')) {
			$login = $this->session->userdata('pegawai');
		}

		if ($login['level']=="pegawai") 
		{
			
			$data['login'] = $this->Madmin->ambil_pegawai($login['id_pegawai']);
		}
		else
		{
			$data['login'] = $this->Madmin->ambil_admin($login['id_admin']);

		}
		

		//memanggil data admin berdasarkan yang login
		$data['login'] = $this->Madmin->ambil_pegawai($login['id_pegawai']);
		$data['permohonan'] = $this->Mdata->ambil_pengajuan($id_permohonan);

		//memberikan level
		$data['login']['level'] = $login['level'];
		$data['penerima'] = $this->Mdata->ambil_penerima_permohonan($id_permohonan);

		$data['notif'] = $this->Mdata->notif_pegawai();

		if($data['laporan']['status_pesan_pegawai']==0)
		{
			$this->Mdata->kurangi_notif($id_permohonan);
			redirect("admin/data/detail_laporan/$id_permohonan",'refresh');
		}

		$data['riwayat'] = $this->Mdata->riwayat_pengujian($data['laporan']['id_pengujian']);

		$this->load->view('admin/header',$data);
		$this->load->view("admin/sidebar",$data);
		$this->load->view("admin/arsip/laporan_arsip",$data);
		$this->load->view("admin/footer",$data);
	}

	function note($id_permohonan)
	{
		//memanggil session admin
		$login = $this->session->userdata('pegawai');

		//memanggil data admin berdasarkan yang login
		$data['login'] = $this->Madmin->ambil_pegawai($login['id_pegawai']);

		//memberikan level
		$data['login']['level'] = $login['level'];
		$data['laporan'] = $this->Mdata->ambil_laporan($id_permohonan);

		//ambil note

		$data['note'] = $this->Mdata->ambil_note($id_permohonan);

		$data['notif'] = $this->Mdata->notif_pegawai();

		$this->load->view('admin/header',$data);
		$this->load->view("admin/sidebar",$data);
		$this->load->view("admin/pengajuan/note",$data);
		$this->load->view("admin/footer",$data);

		if ($this->input->post()) 
		{
			$input = $this->input->post();
			$this->Mdata->simpan_note($input,$id_permohonan);
			echo "<script>alert('Note berhasil ditambah');location='".base_url("admin/data/pengajuan")."'</script>";
		}
	}

	function note_arsip($id_permohonan)
	{
		//memanggil session admin
		if ($this->session->userdata('admin')) 
		{
			$login = $this->session->userdata('admin');
		}elseif ($this->session->userdata('pegawai')) {
			$login = $this->session->userdata('pegawai');
		}

		if ($login['level']=="pegawai") 
		{
			
			$data['login'] = $this->Madmin->ambil_pegawai($login['id_pegawai']);
		}
		else
		{
			$data['login'] = $this->Madmin->ambil_admin($login['id_admin']);

		}

		//memberikan level
		$data['login']['level'] = $login['level'];
		$data['laporan'] = $this->Mdata->ambil_laporan($id_permohonan);

		//ambil note

		$data['note'] = $this->Mdata->ambil_note($id_permohonan);

		$data['notif'] = $this->Mdata->notif_pegawai();

		$this->load->view('admin/header',$data);
		$this->load->view("admin/sidebar",$data);
		$this->load->view("admin/arsip/note_arsip",$data);
		$this->load->view("admin/footer",$data);

		if ($this->input->post()) 
		{
			$input = $this->input->post();
			$this->Mdata->simpan_note($input,$id_permohonan);
			echo "<script>alert('Note berhasil ditambah');location='".base_url("admin/data/note_arsip/".$id_permohonan)."'</script>";
		}
	}

	function hapus_klien($id_klien)
	{
		$login = $this->session->userdata('pegawai');

		if ($login['level']=="pegawai") 
		{
			
			$data['login'] = $this->Madmin->ambil_pegawai($login['id_pegawai']);
		}
		else
		{
			$data['login'] = $this->Madmin->ambil_admin($login['id_admin']);

		}

		//memberikan level
		$data['login']['level'] = $login['level'];


		$this->Mklien->hapus_klien($id_klien);

		if ($login['level']=="pegawai")
		{
			$history['id_admin'] = $data['login']['id_admin'];
			$history['waktu_history'] = date('Y-m-d H:i:s');
			$history['aktivitas'] = "Hapus Klien";
			$this->Mhistory->simpan_history($history);
		}

		redirect('admin/data/klien','refresh');


	}

	function resume($id_permohonan)
	{
		$data['resume'] = $this->Mdata->ambil_permohonan($id_permohonan);

		$data['penerima']=$this->Mdata->ambil_penerima_permohonan($id_permohonan);

		//memanggil session admin
		if ($this->session->userdata('admin')) 
		{
			$login = $this->session->userdata('admin');
		}elseif ($this->session->userdata('pegawai')) {
			$login = $this->session->userdata('pegawai');
		}

		if ($login['level']=="pegawai") 
		{
			
			$data['login'] = $this->Madmin->ambil_pegawai($login['id_pegawai']);
		}
		else
		{
			$data['login'] = $this->Madmin->ambil_admin($login['id_admin']);

		}


		//memberikan level
		$data['login']['level'] = $login['level'];

		$data["sampel"] = $this->Msampel->tampil_sampel($data['penerima']['id_penerima']);

		$data['notif'] = $this->Mdata->notif_pegawai();

		$this->load->view('admin/header',$data);
		$this->load->view("admin/sidebar",$data);
		$this->load->view("admin/pengajuan/resume",$data);
		$this->load->view("admin/footer",$data);
	}

	function resume_arsip($id_permohonan)
	{
		$data['resume'] = $this->Mdata->ambil_permohonan($id_permohonan);

		$data['penerima']=$this->Mdata->ambil_penerima_permohonan($id_permohonan);

		//memanggil session admin
		if ($this->session->userdata('admin')) 
		{
			$login = $this->session->userdata('admin');
		}elseif ($this->session->userdata('pegawai')) {
			$login = $this->session->userdata('pegawai');
		}
		if ($login['level']=="pegawai") 
		{
			
			$data['login'] = $this->Madmin->ambil_pegawai($login['id_pegawai']);
		}
		else
		{
			$data['login'] = $this->Madmin->ambil_admin($login['id_admin']);

		}



		//memberikan level
		$data['login']['level'] = $login['level'];

		$data["sampel"] = $this->Msampel->tampil_sampel($data['penerima']['id_penerima']);

		$data['notif'] = $this->Mdata->notif_pegawai();

		$this->load->view('admin/header',$data);
		$this->load->view("admin/sidebar",$data);
		$this->load->view("admin/arsip/resume_arsip",$data);
		$this->load->view("admin/footer",$data);
	}

	function arsip($status=null)
	{

		if ($this->session->userdata('admin')) 
		{
			$login = $this->session->userdata('admin');
		}elseif ($this->session->userdata('pegawai')) {
			$login = $this->session->userdata('pegawai');
		}

		if ($login['level']=="pegawai") 
		{
			
			$data['login'] = $this->Madmin->ambil_pegawai($login['id_pegawai']);
		}
		else
		{
			$data['login'] = $this->Madmin->ambil_admin($login['id_admin']);

		}

		//memberikan level
		$data['login']['level'] = $login['level'];
		// if($this->input->post('status'))
		// {
		// 	$data['status'] = $this->input->post('status');
		// 	$data["pengajuan"] = $this->Mdata->tampil_pengajuan_status($data['status']);
		// 	$data['tahun']= $this->input->post("tahun");
		// }
		if ($this->input->post("tahun") || $this->input->post("bulan")) {
			$tahun = $this->input->post("tahun");
			$bulan = $this->input->post("bulan");
			$data['tahun']=$tahun;
			$data['bulann']=$bulan;
			$data['status'] = $this->input->post('status');
			$data["pengajuan"] = $this->Mdata->tampil_pengajuan_arsip_tahun($tahun,$bulan,$data["status"]);

		}elseif($this->input->post('status')){
			$data['status'] = $this->input->post('status');
			$data["pengajuan"] = $this->Mdata->tampil_pengajuan_status($data['status']);
			$data['tahun']= "";
			$data['bulann']= "";
		}
		else
		{	
			if($status){
				if($status=='diterima'){
					$data['status'] = 'Diterima';
					$data["pengajuan"] = $this->Mdata->tampil_pengajuan_status($data['status']);
				}else{
					$data['status'] = 'Tidak Diterima';
					$data["pengajuan"] = $this->Mdata->tampil_pengajuan_status($data['status']);
				}
			}else{
				$data['status']='';
				$data["pengajuan"] = $this->Mdata->tampil_pengajuan_arsip();
				$data['tahun']= "";
				$data['bulann']= "";
			}
			
		}


		if($this->input->post('P1'))
		{
			$data['P1'] = $this->input->post('P1');
		}
		else
		{
			$data['P1']="";
		}

		if($this->input->post('P2'))
		{
			$data['P2'] = $this->input->post('P2');
		}
		else
		{
			$data['P2']="";
		}

		if($this->input->post('S1'))
		{
			$data['S1'] = $this->input->post('S1');
		}
		else
		{
			$data['S1']="";
		}

		if($this->input->post('T1'))
		{
			$data['T1'] = $this->input->post('T1');
		}
		else
		{
			$data['T1']="";
		}

		if($this->input->post('Laporan'))
		{
			$data['Laporan'] = $this->input->post('Laporan');
		}
		else
		{
			$data['Laporan']="";
		}

		if($this->input->post('MK'))
		{
			$data['MK'] = $this->input->post('MK');
		}
		else
		{
			$data['MK']="";
		}

		$data["arsip"] = $this->Mdata->tampil_pengajuan_dan_foto();
		$data['cek_laporan'] = $this->Mdata->cek_laporan($data['pengajuan']);
		$data['bulan'] = namabulan();



		$data['notif'] = $this->Mdata->notif_pegawai();

		$this->load->view('admin/header',$data);
		$this->load->view("admin/sidebar",$data);
		$this->load->view("admin/arsip/tampil", $data);
		$this->load->view("admin/footer");
	}

	function report()
	{


		if ($this->session->userdata('admin')) 
		{
			$login = $this->session->userdata('admin');
		}elseif ($this->session->userdata('pegawai')) {
			$login = $this->session->userdata('pegawai');
		}

		if ($login['level']=="pegawai") 
		{
			
			$data['login'] = $this->Madmin->ambil_pegawai($login['id_pegawai']);
		}
		else
		{
			$data['login'] = $this->Madmin->ambil_admin($login['id_admin']);

		}

		//memberikan level
		$data['login']['level'] = $login['level'];

		$data['bulan'] = namabulan();

		if ($this->input->post()) 
		{
			$bulan = $this->input->post('bulan');
			$tahun = $this->input->post('tahun');
			$data["bulan_tahun"]=date("M",strtotime($bulan))." ".$tahun;
			$data["tahun"]=$tahun;
			$data["pengajuan"] = $this->Mdata->cari_jumlah_pengajuan($bulan,$tahun);
			$data["diterima"]= $this->Mdata->cari_pengajuan_jumlah("Diterima",$bulan,$tahun);
			$data["tidak"]= $this->Mdata->cari_pengajuan_jumlah("Tidak Diterima",$bulan,$tahun);
		}
		else
		{
			$data['bulan_tahun']=date("M Y");
			$data['tahun']=date("Y");
			$data["pengajuan"]= $this->Mdata->jumlah_pengajuan();
			$data["diterima"]= $this->Mdata->pengajuan_jumlah("Diterima");
			$data["tidak"]= $this->Mdata->pengajuan_jumlah("Tidak Diterima");
		}


		$data['cek_laporan'] = $this->Mdata->cek_laporan($data['pengajuan']);

		$data['notif'] = $this->Mdata->notif_pegawai();

		$this->load->view('admin/header',$data);
		$this->load->view("admin/sidebar",$data);
		$this->load->view("admin/report/tampil", $data);
		$this->load->view("admin/footer");

	}


	function tambah_klien()
	{
		// memanggil helper provinsi
		$data['provinsi'] = provinsi();

		if ($this->session->userdata('admin')) 
		{
			$login = $this->session->userdata('admin');
		}elseif ($this->session->userdata('pegawai')) {
			$login = $this->session->userdata('pegawai');
		}

		if ($login['level']=="pegawai") 
		{
			
			$data['login'] = $this->Madmin->ambil_pegawai($login['id_pegawai']);
		}
		else
		{
			$data['login'] = $this->Madmin->ambil_admin($login['id_admin']);

		}


		//$data['login'] = $this->Madmin->ambil_admin($login['id_admin']);

		$data['login']['level'] = $login['level'];

		$data['notif'] = $this->Mdata->notif_pegawai();

		$this->load->view('admin/header',$data);
		$this->load->view("admin/sidebar",$data);
		$this->load->view("admin/klien/tambah", $data);
		$this->load->view("admin/footer");	

		if($this->input->post())	
		{
			$input = $this->input->post();
			$this->Mklien->tambah_klien($input);

			echo "<script>alert('Klien Berhasil Ditambahkan');location='".base_url('admin/data/klien')."'</script>";
		}
	}
	

	function ubah_klien($id)
	{
		if ($this->session->userdata('admin')) 
		{
			$login = $this->session->userdata('admin');
		}elseif ($this->session->userdata('pegawai')) {
			$login = $this->session->userdata('pegawai');
		}

		if ($login['level']=="pegawai") 
		{
			
			$data['login'] = $this->Madmin->ambil_pegawai($login['id_pegawai']);
		}
		else
		{
			$data['login'] = $this->Madmin->ambil_admin($login['id_admin']);

		}

		$data['login']['level'] = $login['level'];

		$data['ambil'] = $this->Mklien->ambil_klien($id);

		$data['notif'] = $this->Mdata->notif_pegawai();

		$this->load->view('admin/header',$data);
		$this->load->view("admin/sidebar",$data);
		$this->load->view("admin/klien/ubah", $data);
		$this->load->view("admin/footer");	

		if($this->input->post())	
		{
			$input = $this->input->post();
			$this->Mklien->ubah_klien($input,$id);
			echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css" />';
			echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>';
			echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js"></script>';

			echo "<script>";
			echo 'setTimeout(function(){
				swal({
					title: "Data Berhasil Diubah",
					type: "success"
					}, function() {
						window.location = "'.base_url("admin/data/klien").'";
						});
					}, 1000);';
					echo "</script>";

				}
			}

			function tambah_permohonan()
			{
				$login = $this->session->userdata('pegawai');

				$data['login'] = $this->Madmin->ambil_pegawai($login['id_pegawai']);

				$data['login']['level'] = $login['level'];

				$data['klien'] = $this->Mklien->tampil_klien();

				$data['notif'] = $this->Mdata->notif_pegawai();

				$this->load->view('admin/header',$data);
				$this->load->view("admin/sidebar",$data);
				$this->load->view("admin/pengajuan/tambah", $data);
				$this->load->view("admin/footer");	

				if ($this->input->post()) 
				{
					$input = $this->input->post();
					$input['tgl_permohonan'] = date("Y-m-d H:i:s");
					$input['status_permohonan'] = "Pending";
			// $input['status_sample']= "-";
			//mengambil surat paling akhir
					$data = $this->Mdata->ambil_nomer_permohonan();



					if (empty($data['nomor_permohonan'])) 
					{
						$input['nomor_permohonan'] = "P-001/".date("m/Y");	
					}
					else 
					{
				//membuat bulan dan tahun sekarang
						$date = date("m/Y");
				//memecah data string (nomor_permohonan) menjadi array

						$nomor = explode("/", $data['nomor_permohonan']);
						$last = substr($nomor[0], 2,5);
						$last++;
						$nomor_permohonan = sprintf('%03d', $last);
						$input['nomor_permohonan'] = "P-".$nomor_permohonan."/".$date;
					}

					$id_permohonan = $this->Mdata->simpan_permohonan($input);

					echo "<script>alert('Pengajuan Berhasil Dilakukan, Cek Halaman History!!');location='".base_url("admin/data/verifikasi/$id_permohonan")."'</script>";
				}
			}

			function hapus_arsip($id_permohonan)
			{
				$this->Mdata->hapus_arsip($id_permohonan);

				echo "<script>alert('Arsip berhasil dihapus!!');location='".base_url("admin/data/arsip")."'</script>";
			}

			function edit_surat($id_permohonan)
			{
				if ($this->session->userdata('admin')) 
				{
					$login = $this->session->userdata('admin');
				}elseif ($this->session->userdata('pegawai')) {
					$login = $this->session->userdata('pegawai');
				}

				if ($login['level']=="pegawai") 
				{

					$data['login'] = $this->Madmin->ambil_pegawai($login['id_pegawai']);
				}
				else
				{
					$data['login'] = $this->Madmin->ambil_admin($login['id_admin']);

				}


				$data['detail']=$this->Mdata->ambil_pengajuan($id_permohonan);


		//memberikan level
				$data['login']['level'] = $login['level'];
		//memanggil session admin
				$login = $this->session->userdata('pegawai');


				$data['notif'] = $this->Mdata->notif_pegawai();

				$this->load->view('admin/header',$data);
				$this->load->view("admin/sidebar",$data);
				$this->load->view("admin/pengajuan/edit_surat",$data);
				$this->load->view("admin/footer");

				if($this->input->post())
				{
					$input =  $this->input->post();
					$history['id_pegawai'] = $login['id_pegawai'];
					$history['waktu_history'] = date('Y-m-d H:i:s');
					$history['aktivitas'] = "edit permohonan";

					$hasilnya = $this->Mhistory->ambil_history_pegawai($login['id_pegawai'],$history['aktivitas']);

					if (!empty($hasilnya)) 
					{
						$this->Mhistory->ubah_history($history);	
					}
					else
					{
						$this->Mhistory->simpan_history($history);
					}

					$this->Mdata->ubah_surat($input,$id_permohonan);

					redirect("admin/data/detail/$id_permohonan","refresh");
					
				}
			}

		}
