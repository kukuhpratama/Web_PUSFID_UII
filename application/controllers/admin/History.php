<?php

class History extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		
		if (!$this->session->userdata('admin') && !$this->session->userdata('pegawai')) 
		{
			redirect('login');
		}

		//memanggil atau membuat model
		$this->load->model('Mhistory');
		$this->load->model('Madmin');
		$this->load->model('Mdata');

		
	}

	public function index()
	{
		// echo date("H:i:s");
		//memanggil session admin
		//memanggil session admin
			if ($this->session->userdata('admin')) 
		{
			$login = $this->session->userdata('admin');
		}elseif ($this->session->userdata('pegawai')) {
			$login = $this->session->userdata('pegawai');
		}

		//memberikan level

		if ($login['level']=="pegawai") 
		{
			$data['login'] =  $this->Madmin->ambil_pegawai($login['id_pegawai']);
				
		}
		else
		{

			$data['login'] =  $this->Madmin->ambil_admin($login['id_admin']);
		}
		
		//memanggil session admin
		$data['login']['level'] = $login['level'];

		$data['history']=$this->Mhistory->tampil_history();


		$data['notif'] = $this->Mdata->notif_pegawai();

		$this->load->view('admin/header',$data);
		$this->load->view("admin/sidebar",$data);
		$this->load->view("admin/history/tampil",$data);
		$this->load->view("admin/footer");
	}
	function hapus($id_pegawai)
	{
		$this->Madmin->hapus_history($id_pegawai);
		redirect('admin/history','refresh');
	}

}
