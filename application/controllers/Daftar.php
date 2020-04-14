<?php

class Daftar extends CI_Controller {


	function __construct()
	{
		parent::__construct();
		$this->load->model('Mklien');
	}

	public function index()
	{	

		// memanggil helper provinsi
		$data['provinsi'] = provinsi();

		$this->load->view('daftar',$data);

		//jika ada inout post maka
		if ($this->input->post()) 
		{
			
			$input = $this->input->post();

				//model mklien menjalankan function simpan_klien
			$cek = $this->Mklien->simpan_klien($input);

			if ($cek=="Berhasil") 
			{
				echo "<script>alert('Pendaftaran berhasil');location='".base_url("login")."'</script>";	
			}
			else
			{
				echo "<script>alert('NIK atau Username sudah terdaftar');location='".base_url("daftar")."'</script>";
			}
			
		}
	}

}

