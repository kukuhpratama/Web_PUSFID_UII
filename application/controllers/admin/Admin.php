<?php

class admin extends CI_Controller 
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

		$data["pegawai"] = $this->Madmin->tampil_pegawai();

		$data['notif'] = $this->Mdata->notif_pegawai();

		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar',$data);
		$this->load->view('admin/admin/tampil',$data);
		$this->load->view('admin/footer');
	}


	function logout()
	{
		if ($this->session->userdata('admin')) 
		{
			$this->session->unset_userdata('admin');
		}elseif ($this->session->userdata('pegawai')) {
			$this->session->unset_userdata('pegawai');
		}
		

		redirect('welcome');

	}

	function hapus_akun($id_pegawai)
	{
		$this->Madmin->hapus_akun($id_pegawai);

		redirect('admin/admin');
	}

	function ubah_akun($id_pegawai) // pegawai
	{

		//mengambil data dari inputan
		$input = $this->input->post();
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

		if ($input) 
		{
			if ($login['level']=="admin") 
			{
				$this->Madmin->ubah_admin($id_pegawai,$input);
				
			}
			else
			{

				$this->Madmin->ubah_pegawai($id_pegawai,$input);
			}
			echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css" />';
			echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>';
			echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js"></script>';

			echo "<script>";
			echo 'setTimeout(function(){
				swal({
					title: "Data Berhasil Diubah",
					type: "success"
					}, function() {
						window.location = "'.base_url("admin/admin/profile").'";
						});
					}, 1000);';
					echo "</script>";
		}

		//load view
		
		$data['notif'] = $this->Mdata->notif_pegawai();

		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar',$data);
		if ($login['level']=="admin") 
		{
			$this->load->view('admin/admin/ubah_admin');
		}
		else
		{
			$this->load->view('admin/admin/ubah_pegawai');
		}
		$this->load->view('admin/footer');

		
	}


	function tambah() 
	{
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

		//load view
		$data['notif'] = $this->Mdata->notif_pegawai();

		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar',$data);
		$this->load->view('admin/admin/tambah_pegawai');
		$this->load->view('admin/footer');


		if($this->input->post())
		{
			$input = $this->input->post();

			$this->Madmin->tambah_pegawai($input);
			redirect('admin/admin','refresh');
		}
	}

	function profile()
	{
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

		//load view
		
		
		$data['notif'] = $this->Mdata->notif_pegawai();

		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar',$data);
		if ($login['level']=="admin") 
		{
			
			$this->load->view('admin/admin/profile_admin');

		}
		else
		{
			$this->load->view('admin/admin/profile_pegawai');
		}
		$this->load->view('admin/footer');
	}


	function ubah_admin($id)
	{

		if ($this->session->userdata('admin')) 
		{
			$login = $this->session->userdata('admin');
		}elseif ($this->session->userdata('pegawai')) {
			$login = $this->session->userdata('pegawai');
		}

		//memberikan level

		if ($login['level']=="pegawai") 
		{
			$menu['login'] =  $this->Madmin->ambil_pegawai($login['id_pegawai']);

		}
		else
		{

			$menu['login'] =  $this->Madmin->ambil_admin($login['id_admin']);
		}
		$menu['login']['level'] = $login['level'];

		$data['notif'] = $this->Mdata->notif_pegawai();

		$data['login'] = $this->Madmin->ambil_pegawai($id);

		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar',$menu);
		$this->load->view('admin/admin/ubah_pegawai',$data);
		$this->load->view('admin/footer');		
		$input = $this->input->post();
		if ($input) 
		{
			$this->Madmin->ubah_pegawai($id,$input);
			redirect('admin/admin','refresh');	
		}
	}

	function status($id_pegawai, $status)
	{
		if ($status=="enable") 
		{
			$data['status_pegawai'] = "enabled";
			$where['id_pegawai'] = $id_pegawai;
			
		}
		else
		{
			$data['status_pegawai'] = "disabled";
			$where['id_pegawai'] = $id_pegawai;
		}
		$this->Madmin->ubah_status_pegawai($data, $where);

		redirect(base_url("admin/admin"),'refresh');
	}

}

