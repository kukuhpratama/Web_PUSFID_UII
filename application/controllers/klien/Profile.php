<?php

class Profile extends CI_Controller {

	function __construct()
	{


		parent::__construct();

		if (!$this->session->userdata('klien')) 
		{
			redirect('login');
		}

		$this->load->model('Mklien');
		$this->load->model('Mdata');
	}

	public function index()
	{
		$login = $this->session->userdata('klien');

		//memanggil data klien berdasarkan klien yang login
		$data['login'] = $this->Mklien->ambil_klien($login['id_klien']);


		$data['notif'] = $this->Mdata->notif_klien();


		$this->load->view('klien/header',$data);
		$this->load->view('klien/sidebar',$data);
		$this->load->view('klien/klien/profile',$data);
		$this->load->view('klien/footer');
	}

	function ubah($id)
	{
		$login = $this->session->userdata('klien');

		//memanggil data klien berdasarkan klien yang login
		$data['login'] = $this->Mklien->ambil_klien($login['id_klien']);

		$data['notif'] = $this->Mdata->notif_klien();

		$this->load->view('klien/header',$data);
		$this->load->view('klien/sidebar',$data);
		$this->load->view('klien/klien/ubah_profile',$data);
		$this->load->view('klien/footer');

		//jika ada input post maka
		if ($this->input->post()) 
		{
			$input = $this->input->post();
			$this->Mklien->ubah_klien($input,$id);
			redirect('klien/profile','refresh');
		}
	}

}
