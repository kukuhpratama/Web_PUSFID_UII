<?php
class Klien extends CI_Controller {

	function __construct()
	{


		parent::__construct();

		$this->load->model('Mklien');
		$this->load->model('Mdata');
		$this->load->model('Madmin');

		if (!$this->session->userdata('klien')) 
		{
			redirect('login');
		}
	}

	function index() 
	{


		$login = $this->session->userdata('klien');
		//mengambil data login berdasarkan klien
		$data['login']=$this->Mklien->ambil_klien($login['id_klien']);	


		$data['notif'] = $this->Mdata->notif_klien();


		$this->load->view('klien/header',$data);
		$this->load->view('klien/sidebar', $data);
		$this->load->view('klien/klien/home');
		$this->load->view('klien/footer');
	}

	function pengajuan()
	{

		$login = $this->session->userdata('klien');
		//mengambil data login berdasarkan klien
		$data['login']=$this->Mklien->ambil_klien($login['id_klien']);


		//cek pengajuan klien yang pending 
		$data['permohonan'] = $this->Mdata->pengajuan_klien($login['id_klien']);

		$data['notif'] = $this->Mdata->notif_klien();


		$this->load->view('klien/header',$data);
		$this->load->view('klien/sidebar',$data);

		if (!empty($data['permohonan'])) 
		{
			$this->load->view('klien/klien/detail_pengajuan');
		}
		else
		{
			$this->load->view('klien/klien/pengajuan');
		}

		$this->load->view('klien/footer');

		if ($this->input->post()) 
		{
			$input = $this->input->post();
			$input['tgl_permohonan'] = date("Y-m-d H:i:s");
			$input['status_permohonan'] = "Pending";
			$input['id_klien'] = $data['login']['id_klien'];
			//mengambil surat paling akhir
			$data = $this->Mdata->ambil_nomer_permohonan();

		
			// jika tidak ada permohonan dia buat  penomoran p001
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


			$this->Mdata->simpan_permohonan($input);

			echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css" />';
			echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>';
			echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js"></script>';

			echo "<script>";
			echo 'setTimeout(function(){
				swal({
					title: "Data Berhasil Disimpan!",
					text: "Terimakasih!",
					type: "success"
					}, function() {
						window.location = "'.base_url("klien/klien/pengajuan").'";
						});
					}, 1000);';
					echo "</script>";
			
			// echo "<script>alert('Pengajuan Berhasil Dilakukan, Cek Halaman History!!');location='".base_url('klien/klien/pengajuan')."'</script>";
		}
	}

	function tambah_pengajuan()
	{
		$login = $this->session->userdata('klien');
		//mengambil data login berdasarkan klien
		$data['login']=$this->Mklien->ambil_klien($login['id_klien']);	

		$data['notif'] = $this->Mdata->notif_klien();


		$this->load->view('klien/header',$data);
		$this->load->view('klien/sidebar', $data);
		$this->load->view('klien/klien/pengajuan');
		$this->load->view('klien/footer');

		if ($this->input->post()) 
		{
			$input = $this->input->post();
			$input['tgl_permohonan'] = date("Y-m-d H:i:s");
			$input['status_permohonan'] = "Pending";
			$input['id_klien'] = $data['login']['id_klien'];
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

			$this->Mdata->simpan_permohonan($input);
			
			// echo "<script>alert('Pengajuan Berhasil Dilakukan, Cek Halaman Riwayat Permohonan!!');location='".base_url('klien/klien/pengajuan')."'</script>";
			
			echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css" />';
			echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>';
			echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js"></script>';

			echo "<script>";
			echo 'setTimeout(function(){
				swal({
					title: "Data Berhasil Di Simpan!",
					text: "Terimakasih!",
					type: "success"
					}, function() {
						window.location = "'.base_url("klien/klien/pengajuan").'";
						});
					}, 1000);';
					echo "</script>";
		

	}
}

	function logout()
	{
		//menghapus session admin
		$this->session->unset_userdata('klien');
		redirect('login');
	}

	function surat_klien($id_permohonan) 
	{
		//memanggil session admin
		$login = $this->session->userdata('klien');

		//memanggil data admin berdasarkan yang login
		$data['login']=$this->Mklien->ambil_klien($login['id_klien']);	

		$data['detail']=$this->Mdata->ambil_pengajuan($id_permohonan);

		
		$data['notif'] = $this->Mdata->notif_klien();


		$this->load->view('klien/header',$data);
		$this->load->view('klien/sidebar',$data);
		$this->load->view('klien/klien/surat_klien');
		$this->load->view('klien/footer');
	}


}
