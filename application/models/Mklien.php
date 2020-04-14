	<?php
	class Mklien extends CI_Model 
	{

		function tampil_klien() 
		{
			$ambil = $this->db->get("klien");
			$data = $ambil->result_array();
			return  $data;

		}

		function ambil_klien($id_klien)
		{
			$this->db->where('id_klien',$id_klien);
			$ambil = $this->db->get('klien');
			$data = $ambil->row_array();
			return $data;
		}

		function ambil_email($id_permohonan){
			$this->db->select("klien.email_klien");
			$this->db->from("klien");
			$this->db->join("permohonan","permohonan.id_klien=klien.id_klien");
			$this->db->where("permohonan.id_permohonan",$id_permohonan);
			$query=$this->db->get();
			return $query->row();
		}

		function cek_klien($username,$nik)
		{
			$ambil = $this->db->query("SELECT * FROM klien WHERE username_klien='$username' OR nik_klien='$nik'");

			//mengjitung data yang terambil
			$nilai = $ambil->num_rows();

			//jika nilai samadengan 1 maka
			if ($nilai==1) 
			{
				return 'Ada';	
			}
			else
			{
				return 'Tidak Ada';
			}
		}

		function simpan_klien($inputan)
		{
			//mengambil data klien berdasarkan username atau nik
			$cek = $this->cek_klien($inputan['username_klien'],$inputan['nik_klien']);

			if ($cek=="Tidak Ada") 
			{
				//mengenkripsi password
				$inputan['password_klien'] = sha1($inputan['password_klien']);

				$config['upload_path'] = './asset/img/klien/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';

				$this->load->library('upload',$config);


				$this->upload->do_upload('foto_klien');
				//jika ada upload foto yang di upload
				$inputan['foto_klien'] = $this->upload->data('file_name');

				$this->db->insert('klien',$inputan);

				return 'Berhasil';
			}

			//menyimpan data yang diisi kedalam table klien
			else
			{
				return 'Gagal';
			}
		}

		function ubah_klien($input,$id)
		{
			$config['upload_path'] = './asset/img/klien/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';

			$this->load->library('upload',$config);
			if ($this->upload->do_upload('foto_klien')) 
			{

				$data['foto_klien'] = $this->upload->data('file_name');
					
				
				if (empty($input['password_klien'])) 
				{
					$data['nik_klien'] = $input['nik_klien'];
					$data['email_klien'] = $input['email_klien'];
					$data['nama_klien'] = $input['nama_klien'];
					$data['alamat_klien'] = $input['alamat_klien'];
					$data['telpon_klien'] = $input['telpon_klien'];
					$this->db->where('id_klien',$id);
					$this->db->update('klien',$data);
				}
				else
				{
					$input['foto_klien']=$data['foto_klien'];
					$input['password_klien']=sha1($input['password_klien']);
					$this->db->where('id_klien',$id);
					$this->db->update('klien',$input);	
				}

			}
			else
			{
				if (empty($input['password_klien'])) 
				{
					$data['nik_klien'] = $input['nik_klien'];
					$data['email_klien'] = $input['email_klien'];
					$data['nama_klien'] = $input['nama_klien'];
					$data['alamat_klien'] = $input['alamat_klien'];
					$data['telpon_klien'] = $input['telpon_klien'];
					$this->db->where('id_klien',$id);
					$this->db->update('klien',$data);
				}
				else
				{
					$input['password_klien']=sha1($input['password_klien']);
					$this->db->where('id_klien',$id);
					$this->db->update('klien',$input);	
				}
			}
		}

		function hapus_klien($id_klien)
		{
			$status['status_klien']='hapus';
			$this->db->where('id_klien', $id_klien);
			$this->db->update('klien', $status);
		}


		function tambah_klien($input)
		{
			$config['upload_path'] = './asset/img/klien/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			
			$this->load->library('upload', $config);
			
			if ($this->upload->do_upload('foto_klien'))
			{
				$input['foto_klien'] = $this->upload->data("file_name");
			}

			$this->db->insert('klien', $input);
		}

		function edit_klien($input,$id)
		{
			$config['upload_path'] = './asset/img/klien/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			
			$this->load->library('upload', $config);
			
			if ($this->upload->do_upload('foto_klien'))
			{
				$input['foto_klien'] = $this->upload->data("file_name");
			}

			$this->db->where('id_klien', $id);
			$this->db->update('klien', $input);
		}

		function ubah_status_klien($data, $kondisi)
		{
			$this->db->where($kondisi);
			$this->db->update('klien', $data);
		}

		function aktivitas_permohonan($id_permohonan){
			$this->db->select('*');
			$this->db->from('keputusan_sampel');
			$this->db->join('penerima','penerima.id_penerima=keputusan_sampel.id_penerima');
			$this->db->join('permohonan','permohonan.id_permohonan=penerima.id_permohonan');
			$this->db->where('permohonan.id_permohonan',$id_permohonan);
			$query = $this->db->get();
			return $query->num_rows();
		}
	}

