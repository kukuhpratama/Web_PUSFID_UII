<?php

class History extends CI_Controller 


{

	function __construct()
	{
		parent::__construct();

		
		if (!$this->session->userdata('klien')) 
		{
			redirect('login');
		}

		$this->load->model('Mdata');
		$this->load->model('Mklien');
	}


	 function index()
	{
		$login = $this->session->userdata('klien');
		//mengambil data login berdasarkan klien
		$data['login']=$this->Mklien->ambil_klien($login['id_klien']);

		//mengambil data permohonan berdasarkan id_klien yang login
		$data['permohonan']=$this->Mdata->riwayat_pengajuan_klien($login['id_klien']);
		$data["permohonan"] = $this->Mdata->foto_history($login['id_klien']);

		$data['cek_laporan'] = $this->Mdata->cek_laporan($data['permohonan']);

		$data['notif'] = $this->Mdata->notif_klien();


		$this->load->view('klien/header',$data);
		$this->load->view('klien/sidebar',$data);
		$this->load->view('klien/klien/history',$data);
		$this->load->view('klien/footer');
	}

	function balasan($id_permohonan) 
	{
		$data['detail']=$this->Mdata->ambil_pengajuan($id_permohonan);

		//mengambil data verifikasi berdasarkan id_permohonan
		//model Mdata menjalankan function ambil verifikasi
		$data['verifikasi']=$this->Mdata->ambil_verifikasi($id_permohonan);

		$login = $this->session->userdata('klien');

		//mengambil data klienya login berdasarkan session
		$data['login']=$this->Mklien->ambil_klien($login['id_klien']);


		$data['notif'] = $this->Mdata->notif_klien();


		$this->load->view('klien/header',$data);
		$this->load->view('klien/sidebar',$data);
		$this->load->view('klien/klien/surat_balasan',$data);
		$this->load->view('klien/footer');
	}

	function laporan ($id_permohonan)
	{
		$login = $this->session->userdata('klien');

		//mengambil data klienya login berdasarkan session
		$data['laporan'] = $this->Mdata->ambil_laporan($id_permohonan);

		//mengambil data klienya login berdasarkan session
		$data['login']=$this->Mklien->ambil_klien($login['id_klien']);

		$data['permohonan'] = $this->Mdata->ambil_pengajuan($id_permohonan);
		$data['notif'] = $this->Mdata->notif_klien();

		if($data['laporan']['status_pesan_klien']==0)
		{
			$this->Mdata->kurangi_notif_klien($id_permohonan);
			redirect("klien/history/laporan/$id_permohonan",'refresh');
		}

		$data['riwayat'] = $this->Mdata->riwayat_pengujian($data['laporan']['id_pengujian']);

		$this->load->view('klien/header',$data);
		$this->load->view('klien/sidebar',$data);
		$this->load->view('klien/klien/laporan',$data);
		$this->load->view('klien/footer');

		if ($this->input->post()) 
		{
			$this->Mdata->status_laporan($this->input->post(),$id_permohonan);
			redirect("klien/history/laporan/$id_permohonan",'refresh');
		}


	}

	function edit_permohonan($id_permohonan)
	{
		$login = $this->session->userdata('klien');

		//mengambil data klienya login berdasarkan session
		$data['laporan'] = $this->Mdata->ambil_laporan($id_permohonan);

		//mengambil data klienya login berdasarkan session
		$data['login']=$this->Mklien->ambil_klien($login['id_klien']);


		$data['notif'] = $this->Mdata->notif_klien();

		$data['permohonan'] = $this->Mdata->ambil_pengajuan($id_permohonan);


		$this->load->view('klien/header',$data);
		$this->load->view('klien/sidebar',$data);
		$this->load->view('klien/klien/edit_permohonan',$data);
		$this->load->view('klien/footer');
		if ($this->input->post()) 
		{
			$input = $this->input->post();
		$this->Mdata->simpan_sampel($input,$id_permohonan);

			echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css" />';
			echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>';
			echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js"></script>';

			echo "<script>";
			echo 'setTimeout(function(){
				swal({
					title: "Data Berhasil Disimpan!",
					text: "Terimakasi!",
					type: "success"
					}, function() {
						window.location = "'.base_url("klien/history").'";
						});
					}, 1000);';
					echo "</script>";
		}
		

	}

	function hapus($id_permohonan)
	{
		$this->Mdata->hapus_permohonan_klien($id_permohonan);
		redirect('klien/history','refresh');
	}

}

