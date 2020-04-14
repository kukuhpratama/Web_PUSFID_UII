<?php

class Welcome extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();

		if (!$this->session->userdata('admin') && !$this->session->userdata('pegawai')) 
		{
			redirect('login');
		}

		
		$this->load->model('Madmin');
		$this->load->model('Mdata');
	}


	function index()
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
		$data['pending'] = $this->Mdata->tampil_permohonan_status("Pending");
		$data['diterima'] = $this->Mdata->tampil_permohonan_status("Diterima");
		$data['tidak_diterima'] = $this->Mdata->tampil_permohonan_status("Tidak Diterima");
		// echo"<pre>";
		// print_r($data['login']);
		// echo"</pre>";
		//memanggil view difolder admin namanya index

		//memanggil 5 permohonan data terbaru
		$data['permohonan'] = $this->Mdata->permohonan_terbaru();

		$data['notif'] = $this->Mdata->notif_pegawai();

		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar',$data);
		$this->load->view('admin/index',$data);
		$this->load->view('admin/footer');
		
	}

	function cari_permohonan()
	{
		$this->load->model('Mklien');		
		$cari = $this->input->post('search');
		$hasil = $this->Mdata->cari_permohonan($cari);
		foreach ($hasil as $key => $value) {
			if($value['status_permohonan']=='Diterima'){
				$hasil=$this->Mklien->aktivitas_permohonan($value['id_permohonan']);
				if($hasil>0){
					echo "<a href ='".base_url("admin/data/surat_permohonan_arsip/$value[id_permohonan]")."'>".$value['judul_permohonan']." - ".$value['nama_klien']."-".$value['nomor_permohonan']."</a>";
				echo  "<br>";
				}else{
					echo "<a href ='".base_url("admin/data/detail/$value[id_permohonan]")."'>".$value['judul_permohonan']." - ".$value['nama_klien']."-".$value['nomor_permohonan']."</a>";
				echo  "<br>";
				}
				
			}elseif($value['status_permohonan']=='Tidak Diterima'){
				echo "<a href ='".base_url("admin/data/surat_permohonan_arsip/$value[id_permohonan]")."'>".$value['judul_permohonan']." - ".$value['nama_klien']."-".$value['nomor_permohonan']."</a>";
				echo  "<br>";
			}else{
				echo "<a href ='".base_url("admin/data/surat_permohonan/$value[id_permohonan]")."'>".$value['judul_permohonan']." - ".$value['nama_klien']."-".$value['nomor_permohonan']."</a>";
				echo  "<br>";
				
			}
		}
	}

}

