<?php

class Klien extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();

		
		if (!$this->session->userdata('admin') && !$this->session->userdata('pegawai')) 
		{
			redirect('login');
		}

		$this->load->model('Mklien');
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

		$data["user"]=$this->Mklien->tampil_klien();

		$data['notif'] = $this->Mdata->notif_pegawai();

		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar');
		$this->load->view('admin/klien/tampil', $data);
		$this->load->view('admin/footer');
	}

	function status($id_klien, $status)
	{
		if ($status=="enable") 
		{
			$data['status_klien'] = "enabled";
			$where['id_klien'] = $id_klien;
			
		}
		else
		{
			$data['status_klien'] = "disabled";
			$where['id_klien'] = $id_klien;
		}
		$this->Mklien->ubah_status_klien($data, $where);

		redirect(base_url("admin/data/klien"),'refresh');
	}
}


