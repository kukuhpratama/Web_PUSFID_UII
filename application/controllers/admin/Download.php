<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Download extends CI_Controller
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

	public function P1($id_permohonan)
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

		$data['detail']=$this->Mdata->ambil_pengajuan($id_permohonan);

		$data['notif'] = $this->Mdata->notif_pegawai();

		$this->load->view('admin/header',$data);
		$this->load->view("admin/sidebar",$data);
		$this->load->view("admin/download/p1",$data);
		$this->load->view("admin/footer");
	}


	public function P2($id_permohonan)
	{
		//model  Mdata menjalankan function ambil_pengajuan berdasarkan id_pengajuan

		$data['detail']=$this->Mdata->ambil_pengajuan($id_permohonan);

		//mengambil data verifikasi berdasarkan id_permohonan
		//model Mdata menjalankan function ambil verifikasi
		$data['verifikasi'] = $this->Mdata->ambil_verifikasi($id_permohonan);

		//model Madmin menjalankan function tampil_admin()

		$data['user']=$this->Madmin->tampil_admin();

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
		$this->load->view("admin/download/p2",$data);
		$this->load->view("admin/footer");
	}

	public function S1($id_permohonan)
	{
		$hasil = $this->Mdata->ambil_penerima_permohonan($id_permohonan);
		$id_penerima = $hasil['id_penerima'];
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
		$this->load->view("admin/download/s1",$data);
		$this->load->view("admin/footer");

	}

	public function S2($id_sampel)
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
		$this->load->view("admin/download/s2",$data);
		$this->load->view("admin/footer");
	}

	public function T1($id_permohonan)
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

		$hasil = $this->Mdata->ambil_penerima_permohonan($id_permohonan);
		$id_penerima = $hasil['id_penerima'];

		$ambil = $this->Mdata->ambil_penugasan_penerima($id_penerima);
		$id_penugasan=$ambil['id_penugasan'];


		//mengambil data penugasan berdasarkan id_penugasan
		$data['penugasan'] = $this->Mdata->ambil_penugasan($id_penugasan);

		//mengambil data detail_penugasan berdasarkan "Id_penugasan"

		$data['detail'] = $this->Mdata->detail_penugasan($id_penugasan);

		$data['id_permohonan'] = $id_permohonan;
		//membuat view
		
		
		$data['notif'] = $this->Mdata->notif_pegawai();

		$this->load->view('admin/header',$data);
		$this->load->view("admin/sidebar",$data);
		$this->load->view("admin/download/t1",$data);
		$this->load->view("admin/footer");

	}

	public function MK($id_permohonan)
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
			$view = "admin/download/mk1";


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
		$this->load->view("admin/download/mk",$view,$data);
		$this->load->view("admin/footer",$data);
	}

}

/* End of file Download.php */
/* Location: ./application/controllers/admin/Download.php */