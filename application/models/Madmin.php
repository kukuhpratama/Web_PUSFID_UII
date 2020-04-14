
<?php
class Madmin extends CI_Model {

	function tampil_pegawai()
	{
		$ambil = $this->db->get("pegawai");
		$data = $ambil->result_array();
		return $data;

	}
	function tampil_admin()
	{
		$ambil = $this->db->get("admin");
		$data = $ambil->result_array();
		return $data;

	}
	function hapus_akun($id_pegawai)
	{
		$status['status_pegawai']="hapus";
		$this->db->where('id_pegawai',$id_pegawai);
		$this->db->update('pegawai',$status);

	}

	function ambil_pegawai($id_pegawai)
	{
		$this->db->where('id_pegawai',$id_pegawai);
		$ambil = $this->db->get('pegawai');
		$data = $ambil->row_array();
		return $data;
	}

	function ambil_admin($id_admin)
	{
		$this->db->where('id_admin',$id_admin);
		$ambil = $this->db->get('admin');
		$data = $ambil->row_array();
		return $data;
	}

	function ubah_pegawai($id_pegawai, $inputan) 
	{
		$config['upload_path'] = './asset/img/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';

		$this->load->library('upload', $config);

		if(!empty($inputan['password_pegawai']))
		{
					//adegan upload
			$upload = $this->upload->do_upload("foto_tanda_pegawai");
			if ($upload) 
			{
				//hapus foto lama
				$ambil = $this->ambil_pegawai($id_pegawai);
				//ambil nama foto
				$hapus = $ambil['foto_tanda_pegawai'];
				if (file_exists("./asset/img/$hapus")) 
				{
					//hapus foto
					unlink("./asset/img/$hapus");
				}

				//upload foto yang baru

				$inputan['foto_tanda_pegawai'] = $this->upload->data("file_name");
			}
			$inputan['password_pegawai'] = sha1($inputan['password_pegawai']);
			

			//ubah data di database
			$this->db->where('id_pegawai', $id_pegawai);
			$this->db->update('pegawai', $inputan);
		}
		else
		{



			//adegan upload
			$upload = $this->upload->do_upload("foto_tanda_pegawai");
			if ($upload) 
			{
				//hapus foto lama
				$ambil = $this->ambil_pegawai($id_pegawai);
				//ambil nama foto
				$hapus = $ambil['foto_tanda_pegawai'];
				if (file_exists("./asset/img/$hapus")) 
				{
					//hapus foto
					unlink("./asset/img/$hapus");
				}

				//upload foto yang baru

				$hasil['foto_tanda_pegawai'] = $this->upload->data("file_name");

			}
			$hasil['nama_pegawai']=$inputan['nama_pegawai'];
			$hasil['email_pegawai']=$inputan['email_pegawai'];
			$hasil['jabatan_pegawai']=$inputan['jabatan_pegawai'];
			$hasil['alamat_pegawai']=$inputan['alamat_pegawai'];
			$hasil['jenis_kelamin']=$inputan['jenis_kelamin'];
			$hasil['telepone_pegawai']=$inputan['telepone_pegawai'];
			// $inputan['password_pegawai'] = sha1($inputan['password_pegawai']);

			//ubah data di database
			$this->db->where('id_pegawai', $id_pegawai);
			$this->db->update('pegawai', $hasil);
		}
	}

	function ubah_admin($id_admin, $input)
	{
		if (empty($input['password_admin'])) 
		{
			$admin['nama_admin'] = $input['nama_admin'];
			$admin['email_admin'] = $input['email_admin'];

			$this->db->where('id_admin',$id_admin);
			$this->db->update('admin',$admin);

		}
		else
		{
			$input['password_admin'] = sha1($input['password_admin']);
			$this->db->where('id_admin',$id_admin);
			$this->db->update('admin',$input);
		}
	}

	function hapus_history($id_pegawai)
	{
		$this->db->where('id_pegawai', $id_pegawai);
		$this->db->delete('histori');
	}

	function tambah_pegawai($inputan)
	{

		$inputan['password_pegawai'] = sha1($inputan['password_pegawai']);

		$config['upload_path'] = './asset/img/';
		$config['allowed_types'] = 'gif|jpg|png';
		
		$this->load->library('upload', $config);
		
		if($this->upload->do_upload('foto_pegawai'))
		{
			$inputan['foto_tanda_pegawai'] = $this->upload->data("file_name");
		}

		$this->db->insert('pegawai', $inputan);
	}

	function ubah_status_pegawai($data, $kondisi)
		{
			$this->db->where($kondisi);
			$this->db->update('pegawai', $data);
		}

}

