<?php

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model("Mlogin");
		$this->load->model('Mhistory');
		if ($this->session->userdata('admin') OR $this->session->userdata('pegawai')) 
		{
			redirect('admin');
		}elseif ($this->session->userdata('klien')) {
			redirect('klien/klien','refresh');
		}
		// if (isset($_SESSION['klien'])) {
		// 		echo "sudah login";

				
		// }

	}

	function index()
	{
		//membuat view 
		$this->load->view("login");

		//jika ada inputan post maka
		if ($this->input->post()) 
		{
			$username = $this->input->post('username');
			$password = sha1($this->input->post('password'));

			//model Mlogin menjalankan function login_admin
			$cek = $this->Mlogin->login_pegawai($username,$password);

			if ($cek=="berhasil") 
			{
				$login = $this->session->userdata('pegawai');
				$history['id_pegawai'] = $login['id_pegawai'];
				$history['waktu_history'] = date('Y-m-d H:i:s');
				$history['aktivitas'] = "login";

				$hasilnya = $this->Mhistory->ambil_history_pegawai($login['id_pegawai'],$history['aktivitas']);

				if (!empty($hasilnya)) 
				{
					$this->Mhistory->ubah_history($history);	
				}
				else
				{
					$this->Mhistory->simpan_history($history);
				}

				redirect('admin');
			}
			else
			{
				$cek_login_admin = $this->Mlogin->login_admin($username,$password);
				if ($cek_login_admin=="benar") 
				{
					redirect('admin');
					
				}
				else
				{
					$cek_login_klien = $this->Mlogin->login_klien($username,$password);
					if ($cek_login_klien == "sukses") 
					{
					 redirect('klien/klien','refresh');
					// echo $cek_login_klien;


					// echo "sudah login";
					}
					else
					{
						// echo $cek_login_klien;
						redirect('Login','refresh');
					}
				}
			}

		}
	}

}

