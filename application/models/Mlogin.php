<?php

class Mlogin extends CI_Model 
{
	function login_pegawai($username,$passowrd)
	{
		//mengambil data dari table admin berdasarkan username dan passowrd
		$this->db->where('email_pegawai',$username);
		$this->db->where('password_pegawai', $passowrd);
		$this->db->where('status_pegawai', "enabled");
		// $this->db->where('status_pegawai', "");
		$ambil = $this->db->get('pegawai');

		//menghitung data yang cocok
		$hitung = $ambil->num_rows();

		//jika isi dari $hitung samadengan 1 maka
		if ($hitung==1) 
		{
			//data yang login di pecah  kebentuk array
			$akun = $ambil->row_array();
			$akun['level']="pegawai";
			//membuat session admin
			$this->session->set_userdata('pegawai',$akun);
			return 'berhasil';
		}
		else
		{
			return 'gagal';
		}
	}

	function login_admin($username,$passowrd)
	{
		$this->db->where('email_admin',$username);
		$this->db->where('password_admin',$passowrd);
		$ambil = $this->db->get('admin');
		$hitung = $ambil->num_rows();

		if ($hitung==1) 
		{
			$akun = $ambil->row_array();
			$admin['id_admin'] = $akun['id_admin'];
			$admin['nama_admin'] = $akun['nama_admin'];
			$admin['jabatan_admin'] = "Admin";
			$admin['level']="admin";
			$this->session->set_userdata('admin',$admin);

			return 'benar';

		}
		else
		{
			return 'gagal';
		}
	}

	function login_klien($username,$password)
	{
		$this->db->where('username_klien', $username);
		$this->db->where('password_klien', $password);
		$this->db->where('status_klien', "enabled");
		// $this->db->where('status_klien', "");

		$data = $this->db->get('klien');

		$cek_banyaknya_data = $data->num_rows();
		if ($cek_banyaknya_data == 1) 
		{
			$akun_login = $data->row_array();
			$this->session->set_userdata('klien', $akun_login);
			return 'sukses';
		}
		else 
		{
			return "gagal";
		}
	}

}


