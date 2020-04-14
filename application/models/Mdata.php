<?php

class Mdata extends CI_Model 
{

	function cari_jumlah_pengajuan($bulan,$tahun)
	{
		$this->db->group_by('status_permohonan');
		if (!empty($bulan)) {
			$this->db->where('MONTH(tgl_permohonan)',$bulan);
		}
		
		$this->db->where('YEAR(tgl_permohonan)',$tahun);
		$ambil = $this->db->get('permohonan')->result_array();
		$semua=array();
		foreach ($ambil as $key => $value) 
		{
			$this->db->where('status_permohonan',$value['status_permohonan']);
			$this->db->select('COUNT(id_permohonan)');
			$hasil = $this->db->get('permohonan')->row_array();
			$value['jumlah_pengajuan']=$hasil['COUNT(id_permohonan)'];
			$semua[$value['status_permohonan']] =$value;

		}
		return $semua;
	}

	function cari_pengajuan_jumlah($status,$bulan,$tahun)
	{
		if (!empty($bulan)) {
			$this->db->where('MONTH(tgl_permohonan)',$bulan);
		}
		
		$this->db->where('YEAR(tgl_permohonan)',$tahun);
		$this->db->where('status_permohonan',$status);
		$this->db->select('COUNT(id_permohonan)');
		return $this->db->get('permohonan')->row_array();
	}

	function pengajuan_jumlah($status)
	{
		$this->db->where('status_permohonan',$status);
		$this->db->select('COUNT(id_permohonan)');
		return $this->db->get('permohonan')->row_array();
	}

	function Jumlah_pengajuan()
	{
		$this->db->group_by('status_permohonan');
		$ambil = $this->db->get('permohonan')->result_array();
		$semua=array();
		foreach ($ambil as $key => $value) 
		{
			$this->db->where('status_permohonan',$value['status_permohonan']);
			$this->db->select('COUNT(id_permohonan)');
			$hasil = $this->db->get('permohonan')->row_array();
			$hasil_data['jumlah_pengajuan']=$hasil['COUNT(id_permohonan)'];
			if ($value['status_permohonan']=="Diterima")
			{
				$semua[$key] =$value;
			}
			else
			{
				$semua[$key] =$value;
			}
		}
		return $semua;
	}


	function cari_permohonan($cari)
	{
		$ambil=$this->db->query("SELECT * FROM permohonan JOIN klien ON permohonan.id_klien=klien.id_klien WHERE judul_permohonan LIKE '%$cari%' OR nama_klien LIKE  '%$cari%' ");
		$data = $ambil->result_array();
		return $data;
	}

	function permohonan_terbaru()
	{
		$this->db->order_by('id_permohonan', 'desc');
		$this->db->join('klien', 'permohonan.id_klien = klien.id_klien', 'left');
		$ambil = $this->db->get('permohonan', 5);
		$data = $ambil->result_array();
		return $data;
	}

	function pengajuan_klien($id_klien)
	{
		$this->db->where('id_klien', $id_klien);
		$this->db->where('status_permohonan','pending');
		$ambil = $this->db->get('permohonan');
		$data = $ambil->result_array();
		return $data;
	}

	function tampil_pengajuan_status($status)
	{
		$semua=array();
		if ($status!="Tidak Diterima") {
			$this->db->join('hasil_pengujian', 'hasil_pengujian.id_permohonan = permohonan.id_permohonan', 'left');
		}
		$this->db->where('status_permohonan', $status);
		$this->db->join('klien','permohonan.id_klien=klien.id_klien','LEFT');
		
		$ambil = $this->db->get("permohonan");
		$data = $ambil->result_array();
		foreach ($data as $key =>$value) 
		{
			//mengambil verifikasi
			$hasil = $this->ambil_penerima_permohonan($value['id_permohonan']);
			
			if (empty($hasil)) 
			{
				$value['s1']="kosong";
				$value['t1']="kosong";
				$value['mk']="kosong";
				$value['tampil']="tampil";		
			}
			else 
			{
				$cek_S = $this->ambil_sampel_penerima($hasil['id_penerima']);
				if (empty($cek_S)) 
				{
					$value['s1'] = "kosong";$value['tampil']="kosong";

				}
				else
				{

					$value['s1']="isi";$value['tampil']="tampil";

				}

				$t1 = $this->ambil_penugasan_penerima($hasil['id_penerima']);
				if (empty($t1)) 
				{
					$value['t1'] = "kosong";$value['tampil']="kosong";		
				}
				else 
				{
					$cek_t = $this->tampil_detail_penugasan($t1['id_penugasan']);
					if (empty($cek_t)) 
					{
						
						$value['t1']= "kosong";$value['tampil']="kosong";	
					}
					else
					{
						$value['t1']="isi";$value['tampil']="tampil";
					}
				}

				$mk = $this->ambil_keputusan($hasil['id_penerima']);
				if (empty($mk)) 
				{
					$value['mk'] = "kosong";$value['tampil']="kosong";
				}
				else 
				{
					$value['mk'] = "isi";$value['tampil']="tampil";
				}
			}
			$foto = $this->tampil_foto_permohonan($value['id_permohonan']);
			$value['foto']=$foto;
			$semua[] = $value;	
		}
		return $semua;	
	}

	function ambil_surat_permohonan_zip($id_permohonan)
	{
		$ambil = $this->db->get_where("permohonan",array('id_permohonan'=>$id_permohonan));
		return $ambil->row_array();
	}

	

	function tampil_foto_permohonan($id_permohonan)
	{
		$this->db->where('id_permohonan', $id_permohonan);
		$ambil = $this->db->get('foto_permohonan');
		$data = $ambil->result_array();
		return $data;
	}

	function tampil_pengajuan_dan_foto()
	{
		$semua=array();

		$this->db->join('klien','permohonan.id_klien=klien.id_klien','LEFT');
		$ambil = $this->db->get("permohonan");
		$data = $ambil->result_array();
		foreach ($data as $key =>$value) 
		{
			//mengambil verifikasi
			$hasil = $this->ambil_penerima_permohonan($value['id_permohonan']);
			$foto = $this->tampil_foto_permohonan($value['id_permohonan']);
			if (empty($hasil)) 
			{
				$value['s1']="kosong";
				$value['t1']="kosong";
				$value['mk']="kosong";		
			}
			else 
			{
				$cek_S = $this->ambil_sampel_penerima($hasil['id_penerima']);
				if (empty($cek_S)) 
				{
					$value['s1'] = "kosong";

				}
				else
				{

					$value['s1']="isi";

				}

				$t1 = $this->ambil_penugasan_penerima($hasil['id_penerima']);
				if (empty($t1)) 
				{
					$value['t1'] = "kosong";		
				}
				else 
				{
					$cek_t = $this->tampil_detail_penugasan($t1['id_penugasan']);
					if (empty($cek_t)) 
					{
						
						$value['t1']= "kosong";	
					}
					else
					{
						$value['t1']="isi";
					}
				}

				$mk = $this->ambil_keputusan($hasil['id_penerima']);
				if (empty($mk)) 
				{
					$value['mk'] = "kosong";
				}
				else 
				{
					$value['mk'] = "isi";
				}
			}
			$value['foto']=$foto;
			$semua[] = $value;	
		}
		return $semua;	
	}

	function foto_history($id_klien)
	{
		$semua=array();
		$this->db->where('permohonan.id_klien',$id_klien);
		$this->db->join('klien','permohonan.id_klien=klien.id_klien','LEFT');
		$ambil = $this->db->get("permohonan");
		$data = $ambil->result_array();
		foreach ($data as $key =>$value) 
		{
			//mengambil verifikasi
			$hasil = $this->ambil_penerima_permohonan($value['id_permohonan']);
			$foto = $this->tampil_foto_permohonan($value['id_permohonan']);
			if (empty($hasil)) 
			{
				$value['s1']="kosong";
				$value['t1']="kosong";
				$value['mk']="kosong";		
			}
			else 
			{
				$cek_S = $this->ambil_sampel_penerima($hasil['id_penerima']);
				if (empty($cek_S)) 
				{
					$value['s1'] = "kosong";

				}
				else
				{

					$value['s1']="isi";

				}

				$t1 = $this->ambil_penugasan_penerima($hasil['id_penerima']);
				if (empty($t1)) 
				{
					$value['t1'] = "kosong";		
				}
				else 
				{
					$cek_t = $this->tampil_detail_penugasan($t1['id_penugasan']);
					if (empty($cek_t)) 
					{
						
						$value['t1']= "kosong";	
					}
					else
					{
						$value['t1']="isi";
					}
				}

				$mk = $this->ambil_keputusan($hasil['id_penerima']);
				if (empty($mk)) 
				{
					$value['mk'] = "kosong";
				}
				else 
				{
					$value['mk'] = "isi";
				}
			}
			$value['foto']=$foto;
			$semua[] = $value;	
		}
		return $semua;	
	}

	function tampil_pengajuan()
	{
		$semua=array();
		$this->db->join('klien','permohonan.id_klien=klien.id_klien','LEFT');
		// $this->db->join('hasil_pengujian', 'hasil_pengujian.id_permohonan = permohonan.id_permohonan', 'left');
		$ambil = $this->db->get("permohonan");
		$data = $ambil->result_array();
		foreach ($data as $key =>$value) 
		{
			//mengambil verifikasi
			$hasil = $this->ambil_penerima_permohonan($value['id_permohonan']);
			if (empty($hasil)) 
			{
				$value['s1']="kosong";
				$value['t1']="kosong";
				$value['mk']="kosong";		
			}
			else 
			{
				$cek_S = $this->ambil_sampel_penerima($hasil['id_penerima']);
				if (empty($cek_S)) 
				{
					$value['s1'] = "kosong";

				}
				else
				{

					$value['s1']="isi";

				}

				$t1 = $this->ambil_penugasan_penerima($hasil['id_penerima']);
				if (empty($t1)) 
				{
					$value['t1'] = "kosong";		
				}
				else 
				{
					$cek_t = $this->tampil_detail_penugasan($t1['id_penugasan']);
					if (empty($cek_t)) 
					{
						
						$value['t1']= "kosong";	
					}
					else
					{
						$value['t1']="isi";
					}
				}

				$mk = $this->ambil_keputusan($hasil['id_penerima']);
				if (empty($mk)) 
				{
					$value['mk'] = "kosong";
				}
				else 
				{
					$value['mk'] = "isi";
				}
			}
			$semua[] = $value;	
		}
		return $semua;
	}

	function tampil_pengajuan_arsip()
	{
		$semua=array();
		$this->db->where('status_permohonan', 'Diterima');
		$this->db->join('klien','permohonan.id_klien=klien.id_klien','LEFT');
		$this->db->join('hasil_pengujian', 'hasil_pengujian.id_permohonan = permohonan.id_permohonan', 'left');
		$ambil = $this->db->get("permohonan");
		$data = $ambil->result_array();
		foreach ($data as $key =>$value) 
		{
			//mengambil verifikasi
			$hasil = $this->ambil_penerima_permohonan($value['id_permohonan']);
			$foto = $this->tampil_foto_permohonan($value['id_permohonan']);
			if (empty($hasil)) 
			{
				$value['s1']="kosong";
				$value['t1']="kosong";
				$value['mk']="kosong";		
			}
			else 
			{
				$cek_S = $this->ambil_sampel_penerima($hasil['id_penerima']);
				if (empty($cek_S)) 
				{
					$value['s1'] = "kosong";

				}
				else
				{

					$value['s1']="isi";

				}

				$t1 = $this->ambil_penugasan_penerima($hasil['id_penerima']);
				if (empty($t1)) 
				{
					$value['t1'] = "kosong";		
				}
				else 
				{
					$cek_t = $this->tampil_detail_penugasan($t1['id_penugasan']);
					if (empty($cek_t)) 
					{
						
						$value['t1']= "kosong";	
					}
					else
					{
						$value['t1']="isi";
					}
				}

				$mk = $this->ambil_keputusan($hasil['id_penerima']);
				if (empty($mk)) 
				{
					$value['mk'] = "kosong";
				}
				else 
				{
					$value['mk'] = "isi";
				}
			}
			$value['foto']=$foto;
			$semua[] = $value;	
		}

		$this->db->where('status_permohonan', 'Tidak Diterima');
		$this->db->join('klien','permohonan.id_klien=klien.id_klien','LEFT');
		
		$ambil = $this->db->get("permohonan");
		$data = $ambil->result_array();
		foreach ($data as $key =>$value) 
		{
			//mengambil verifikasi
			$hasil = $this->ambil_penerima_permohonan($value['id_permohonan']);
			$foto = $this->tampil_foto_permohonan($value['id_permohonan']);
			if (empty($hasil)) 
			{
				$value['s1']="kosong";
				$value['t1']="kosong";
				$value['mk']="kosong";		
			}
			else 
			{
				$cek_S = $this->ambil_sampel_penerima($hasil['id_penerima']);
				if (empty($cek_S)) 
				{
					$value['s1'] = "kosong";

				}
				else
				{

					$value['s1']="isi";

				}

				$t1 = $this->ambil_penugasan_penerima($hasil['id_penerima']);
				if (empty($t1)) 
				{
					$value['t1'] = "kosong";		
				}
				else 
				{
					$cek_t = $this->tampil_detail_penugasan($t1['id_penugasan']);
					if (empty($cek_t)) 
					{
						
						$value['t1']= "kosong";	
					}
					else
					{
						$value['t1']="isi";
					}
				}

				$mk = $this->ambil_keputusan($hasil['id_penerima']);
				if (empty($mk)) 
				{
					$value['mk'] = "kosong";
				}
				else 
				{
					$value['mk'] = "isi";
				}
			}
			$value['foto']=$foto;
			$semua[] = $value;	
		}
		return $semua;
	}

	function tampil_pengajuan_arsip_bulantahun($tahun,$bulan)
	{
		$semua=array();
		$this->db->where('YEAR(tgl_permohonan)', $tahun);
		$this->db->where('MONTH(tgl_permohonan)', $bulan);
		$this->db->where('status_permohonan', 'Diterima');
		$this->db->join('klien','permohonan.id_klien=klien.id_klien','LEFT');
		$this->db->join('hasil_pengujian', 'hasil_pengujian.id_permohonan = permohonan.id_permohonan', 'left');
		$ambil = $this->db->get("permohonan");
		$data = $ambil->result_array();
		foreach ($data as $key =>$value) 
		{
			//mengambil verifikasi
			$hasil = $this->ambil_penerima_permohonan($value['id_permohonan']);
			$foto = $this->tampil_foto_permohonan($value['id_permohonan']);
			if (empty($hasil)) 
			{
				$value['s1']="kosong";
				$value['t1']="kosong";
				$value['mk']="kosong";		
			}
			else 
			{
				$cek_S = $this->ambil_sampel_penerima($hasil['id_penerima']);
				if (empty($cek_S)) 
				{
					$value['s1'] = "kosong";

				}
				else
				{

					$value['s1']="isi";

				}

				$t1 = $this->ambil_penugasan_penerima($hasil['id_penerima']);
				if (empty($t1)) 
				{
					$value['t1'] = "kosong";		
				}
				else 
				{
					$cek_t = $this->tampil_detail_penugasan($t1['id_penugasan']);
					if (empty($cek_t)) 
					{
						
						$value['t1']= "kosong";	
					}
					else
					{
						$value['t1']="isi";
					}
				}

				$mk = $this->ambil_keputusan($hasil['id_penerima']);
				if (empty($mk)) 
				{
					$value['mk'] = "kosong";
				}
				else 
				{
					$value['mk'] = "isi";
				}
			}
			$value['foto']=$foto;
			$semua[] = $value;	
		}
		$this->db->where('YEAR(tgl_permohonan)', $tahun);
		$this->db->where('MONTH(tgl_permohonan)', $bulan);
		$this->db->where('status_permohonan', 'Tidak Diterima');
		$this->db->join('klien','permohonan.id_klien=klien.id_klien','LEFT');
		
		$ambil = $this->db->get("permohonan");
		$data = $ambil->result_array();
		foreach ($data as $key =>$value) 
		{
			//mengambil verifikasi
			$hasil = $this->ambil_penerima_permohonan($value['id_permohonan']);
			$foto = $this->tampil_foto_permohonan($value['id_permohonan']);
			if (empty($hasil)) 
			{
				$value['s1']="kosong";
				$value['t1']="kosong";
				$value['mk']="kosong";		
			}
			else 
			{
				$cek_S = $this->ambil_sampel_penerima($hasil['id_penerima']);
				if (empty($cek_S)) 
				{
					$value['s1'] = "kosong";

				}
				else
				{

					$value['s1']="isi";

				}

				$t1 = $this->ambil_penugasan_penerima($hasil['id_penerima']);
				if (empty($t1)) 
				{
					$value['t1'] = "kosong";		
				}
				else 
				{
					$cek_t = $this->tampil_detail_penugasan($t1['id_penugasan']);
					if (empty($cek_t)) 
					{
						
						$value['t1']= "kosong";	
					}
					else
					{
						$value['t1']="isi";
					}
				}

				$mk = $this->ambil_keputusan($hasil['id_penerima']);
				if (empty($mk)) 
				{
					$value['mk'] = "kosong";
				}
				else 
				{
					$value['mk'] = "isi";
				}
			}
			$value['foto']=$foto;
			$semua[] = $value;	
		}
		return $semua;

	}

	function tampil_pengajuan_arsip_tahun($tahun=null,$bulan=null,$status=null)
	{
		$semua=array();
		if($tahun){
			$this->db->where('YEAR(tgl_permohonan)', $tahun);
		}
		if($bulan){
			$this->db->where('MONTH(tgl_permohonan)', $bulan);
		}
		if($status){
			$this->db->where('status_permohonan', $status);
		}		

		$this->db->join('klien','permohonan.id_klien=klien.id_klien','LEFT');
		$this->db->join('hasil_pengujian', 'hasil_pengujian.id_permohonan = permohonan.id_permohonan', 'left');
		$ambil = $this->db->get("permohonan");
		$data = $ambil->result_array();
		foreach ($data as $key =>$value) 
		{
			//mengambil verifikasi
			$hasil = $this->ambil_penerima_permohonan($value['id_permohonan']);
			$foto = $this->tampil_foto_permohonan($value['id_permohonan']);
			if (empty($hasil)) 
			{
				$value['s1']="kosong";
				$value['t1']="kosong";
				$value['mk']="kosong";		
			}
			else 
			{
				$cek_S = $this->ambil_sampel_penerima($hasil['id_penerima']);
				if (empty($cek_S)) 
				{
					$value['s1'] = "kosong";

				}
				else
				{

					$value['s1']="isi";

				}

				$t1 = $this->ambil_penugasan_penerima($hasil['id_penerima']);
				if (empty($t1)) 
				{
					$value['t1'] = "kosong";		
				}
				else 
				{
					$cek_t = $this->tampil_detail_penugasan($t1['id_penugasan']);
					if (empty($cek_t)) 
					{
						
						$value['t1']= "kosong";	
					}
					else
					{
						$value['t1']="isi";
					}
				}

				$mk = $this->ambil_keputusan($hasil['id_penerima']);
				if (empty($mk)) 
				{
					$value['mk'] = "kosong";
				}
				else 
				{
					$value['mk'] = "isi";
				}
			}
			$value['foto']=$foto;
			$semua[] = $value;	
		}
		// $this->db->where('YEAR(tgl_permohonan)', $tahun);
		// $this->db->where('status_permohonan', $status);
		// $this->db->join('klien','permohonan.id_klien=klien.id_klien','LEFT');
		
		// $ambil = $this->db->get("permohonan");
		// $data = $ambil->result_array();
		// foreach ($data as $key =>$value) 
		// {
		// 	//mengambil verifikasi
		// 	$hasil = $this->ambil_penerima_permohonan($value['id_permohonan']);
		// 	$foto = $this->tampil_foto_permohonan($value['id_permohonan']);
		// 	if (empty($hasil)) 
		// 	{
		// 		$value['s1']="kosong";
		// 		$value['t1']="kosong";
		// 		$value['mk']="kosong";		
		// 	}
		// 	else 
		// 	{
		// 		$cek_S = $this->ambil_sampel_penerima($hasil['id_penerima']);
		// 		if (empty($cek_S)) 
		// 		{
		// 			$value['s1'] = "kosong";

		// 		}
		// 		else
		// 		{

		// 			$value['s1']="isi";

		// 		}

		// 		$t1 = $this->ambil_penugasan_penerima($hasil['id_penerima']);
		// 		if (empty($t1)) 
		// 		{
		// 			$value['t1'] = "kosong";		
		// 		}
		// 		else 
		// 		{
		// 			$cek_t = $this->tampil_detail_penugasan($t1['id_penugasan']);
		// 			if (empty($cek_t)) 
		// 			{
						
		// 				$value['t1']= "kosong";	
		// 			}
		// 			else
		// 			{
		// 				$value['t1']="isi";
		// 			}
		// 		}

		// 		$mk = $this->ambil_keputusan($hasil['id_penerima']);
		// 		if (empty($mk)) 
		// 		{
		// 			$value['mk'] = "kosong";
		// 		}
		// 		else 
		// 		{
		// 			$value['mk'] = "isi";
		// 		}
		// 	}
		// 	$value['foto']=$foto;
		// 	$semua[] = $value;	
		// }
		return $semua;

	}



	function tampil_permohonan_status($status)
	{
		$this->db->where('status_permohonan',$status);
		$this->db->join('klien','permohonan.id_klien=klien.id_klien','LEFT');
		$ambil = $this->db->get("permohonan");
		$data = $ambil->result_array();
		return $data;
	}

	function ambil_pengajuan($id_permohonan)
	{
		$this->db->where('id_permohonan', $id_permohonan);
		$this->db->join('klien','permohonan.id_klien=klien.id_klien','LEFT');
		$ambil = $this->db->get('permohonan');
		$data = $ambil->row_array();
		return $data;
	}

	function simpan_verifikasi($input,$detail)
	{
		if ($input['status_verifikasi']=='Tidak Diterima') {
			$input2['status_akhir']='true';
			$this->db->update('permohonan',$input2);
		}
		$this->db->insert('verifikasi',$input);

		$data['id_verifikasi'] = $this->db->insert_id('verifikasi');

		foreach ($detail['id_pegawai'] as $key => $id_pegawai) 
		{
			$data['id_pegawai'] = $id_pegawai;
			$this->db->insert('detail_verifikasi',$data);
		}

	}

	function ubah_status_permohonan($inputan,$id_permohonan)
	{
		$this->db->where('id_permohonan', $id_permohonan);
		$this->db->update('permohonan',$inputan);
	}

	function ambil_verifikasi($id_permohonan)
	{
		$this->db->where('id_permohonan', $id_permohonan);
		$ambil = $this->db->get('verifikasi');
		$data = $ambil->row_array();

		//mengambil detail verifikasi berdasarkan id_verifikasi

		$id_verifikasi = $data['id_verifikasi'];

		$this->db->where('id_verifikasi', $id_verifikasi);
		$this->db->join('pegawai','detail_verifikasi.id_pegawai=pegawai.id_pegawai','left');
		$ambil_detail = $this->db->get('detail_verifikasi');
		$data_detail = $ambil_detail->result_array();
		$data['detail'] = $data_detail;
		return $data;
	}

	function ambil_penerima_permohonan($id_permohonan)
	{
		$this->db->where('penerima.id_permohonan', $id_permohonan);
		$this->db->join('permohonan','penerima.id_permohonan=permohonan.id_permohonan','LEFT');
		$this->db->join('klien','permohonan.id_klien=klien.id_klien','LEFT');
		$ambil = $this->db->get('penerima');
		$data = $ambil->row_array();
		return  $data;
	}

	function ambil_penerima($id_penerima)
	{

		$this->db->where('id_penerima',$id_penerima);
		$this->db->join('pegawai','penerima.id_pegawai=pegawai.id_pegawai','left');
		$this->db->join('permohonan','penerima.id_permohonan=permohonan.id_permohonan','left');
		$this->db->join('klien','permohonan.id_klien=klien.id_klien','left');
		$ambil = $this->db->get('penerima');
		$data = $ambil->row_array();
		return $data;
	}

	function simpan_penerima($id_permohonan) 
	{
		// mengambil data permohonan berdasarkan id_permohonan
		$data = $this->ambil_pengajuan($id_permohonan);
		$login = $this->session->userdata('pegawai');
		// mengambil nomor permohonan
		$nomor_penerima = str_replace("P", "S", $data['nomor_permohonan']);

		$inputan['nomor_penerima'] = $nomor_penerima;
		$inputan['id_permohonan'] = $id_permohonan;
		$inputan['tgl_penerima'] = date("Y-m-d H:i:s");
		$inputan['id_pegawai'] = $login['id_pegawai'];

		$this->db->insert('penerima', $inputan);

	}

	function ambil_penugasan_penerima($id_penerima)
	{
		$this->db->where('id_penerima',$id_penerima);
		$ambil = $this->db->get('penugasan');
		$data = $ambil->row_array();
		return $data;
	}

	function simpan_penugasan($penerima)
	{
		$input['nomor_penugasan'] = str_replace("S","T", $penerima['nomor_penerima']);
		$input['tgl_penugasan']=date("Y-m-d H:i:s");
		$input['id_penerima']= $penerima['id_penerima'];

		//menyimpan data ke table penugasan
		$this->db->insert('penugasan',$input);

		//mengambil id_penugasan yang baru saja di tambahkan
		$id_penugasan = $this->db->insert_id('penugasan');
		return $id_penugasan;


	}

	function detail_penugasan ($id_penugasan)
	{
		$this->db->where('id_penugasan',$id_penugasan);
		$this->db->join('pegawai','detail_penugasan.id_pegawai=pegawai.id_pegawai','left');

		$ambil = $this->db->get('detail_penugasan');
		$data = $ambil->result_array();

		return $data;
	}

	function ambil_penugasan($id_penugasan)
	{
		$this->db->where("id_penugasan",$id_penugasan);
		$ambil = $this->db->get('penugasan');
		$data = $ambil->row_array();

		return $data;
	}

	function ambil_nomer_permohonan() 
	{
		$ambil = $this->db->query("SELECT MAX(nomor_permohonan) as nomor_permohonan FROM permohonan");
		$data = $ambil->row_array();
		return $data;
	}

	function simpan_permohonan($inputan)
	{
		
		$folder = $inputan['judul_permohonan']." - ".date("d-m-Y H-i-s",strtotime($inputan['tgl_permohonan']));

		mkdir('./asset/Kumpulan Kasus/'. $folder,0777, TRUE);
		
		$config['upload_path'] = './asset/Kumpulan Kasus/'.$folder.'/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|mp4|3gp|flv|avi|mp3';
		$config['max_size'] = '100000';
		$this->load->library('upload', $config);

		if ($this->upload->do_upload('file_surat')) 
		{
			$fileData = $this->upload->data();
			$inputan['surat_permohonan'] = $fileData['file_name'];

		}
		$this->db->insert("permohonan",$inputan);
		$id_permohonan = $this->db->insert_id("permohonan");
		$no=0;
		foreach ($_FILES['foto']['name'] as $key => $value)
		{
			$foto = $_FILES['foto']['name'][$key];
			$lokasi = $_FILES['foto']['tmp_name'][$key];

			$nomer = $no+=1;
			$tmp = explode(".", $foto);
			$kasus_foto = $inputan['judul_permohonan']."-".$nomer;

			$hasil['foto'] = $kasus_foto. '.' . end($tmp);

			move_uploaded_file($lokasi, "./asset/Kumpulan Kasus/$folder/".$hasil['foto']);


			$hasil['id_permohonan']=$id_permohonan;

			$this->db->insert('foto_permohonan', $hasil);
		}

		return $id_permohonan;
	}

	function simpan_sampel($inputan, $id_permohonan)
	{
		
		$ambil = $this->ambil_permohonan($id_permohonan);

		$folder = $ambil['judul_permohonan']." - ".date("d-m-Y H-i-s", strtotime($ambil['tgl_permohonan']));

		$tmp = $this->db->get_where('permohonan',array('id_permohonan'=>$id_permohonan));
		$tmp2 = $tmp->row();
		$inputan['jumlah_sampel'] =  $inputan['jumlah_sampel'] + $tmp2->jumlah_sampel;
		$this->db->where('id_permohonan',$id_permohonan);
		$this->db->update('permohonan', array('jumlah_sampel'=>$inputan['jumlah_sampel']));

		$config['upload_path'] = './asset/img/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|mp4|3gp|flv|avi|mp3';
		$config['max_size'] = '100000';
		$this->load->library('upload', $config);
		
		$cek = $this->db->get_where('foto_permohonan',array('id_permohonan'=>$id_permohonan));
		if($cek->num_rows()==0){
			$no=$cek->num_rows();
		}else{
			$no=$cek->num_rows()+1;
		}
		foreach ($_FILES['foto']['name'] as $key => $value)
		{
			$nomer = $no++;
			$kasus_foto = $ambil['judul_permohonan']."-".$nomer."Sampel_Tambah";

			$foto = $_FILES['foto']['name'][$key];
			$lokasi = $_FILES['foto']['tmp_name'][$key];

			$tmp = explode(".", $foto);
			$hasil['foto'] = $kasus_foto. '.' . end($tmp);

			move_uploaded_file($lokasi, "./asset/Kumpulan Kasus/$folder/".$hasil['foto']);

			$hasil['id_permohonan']=$id_permohonan;

			$this->db->insert('foto_permohonan', $hasil);


		}

	}

	function riwayat_pengajuan($id_klien)
	{
		$this->db->order_by('id_permohonan','desc');
		$this->db->where('permohonan.id_klien',$id_klien);
		$this->db->join('klien','permohonan.id_klien=klien.id_klien');
		$ambil = $this->db->get('permohonan');
		$data = $ambil->result_array();
		return $data;
	}

	function riwayat_pengajuan_klien($id_klien)
	{
		$this->db->order_by('id_permohonan','desc');
		$this->db->where('permohonan.id_klien',$id_klien);
		$this->db->join('klien','permohonan.id_klien=klien.id_klien');
		$ambil = $this->db->get('permohonan');
		$data = $ambil->result_array();
		return $data;
	}

	function simpan_detail_penugasan($input)
	{
		$cek = $this->db->get_where('detail_penugasan',array('id_pegawai'=>$input['id_pegawai'],'id_penugasan'=>$input['id_penugasan']));
		if($cek->num_rows()>0){
			return 0;
		}else{
			$this->db->insert('detail_penugasan',$input);
			return 1;
		}
		
	}


	function hapus_penugasan($id_detail_penugasan)
	{
		$this->db->where('id_detail_penugasan',$id_detail_penugasan);
		$this->db->delete('detail_penugasan');

	}

	function ambil_detail_penugasan($id_detail_penugasan)
	{
		$this->db->where('id_detail_penugasan',$id_detail_penugasan);

		$ambil = $this->db->get('detail_penugasan');
		$data = $ambil->row_array();
		return $data;
	}


	function edit_detail_penugasan($inputan, $id_detail_penugasan)
	{
		$this->db->where('id_detail_penugasan',$id_detail_penugasan);
		$this->db->update('detail_penugasan',$inputan);
	}

	function ambil_keputusan($id_penerima)
	{
		$this->db->where('id_penerima',$id_penerima);
		$this->db->join('pegawai','keputusan_sampel.id_pegawai=pegawai.id_pegawai','left');
		$ambil = $this->db->get('keputusan_sampel');
		$data = $ambil->row_array();
		return $data;
	}

	function simpan_keputusan($inputan)
	{
		$input['status_akhir']='true';
		$this->db->insert("keputusan_sampel",$inputan);
		$this->db->update('permohonan', $input);
	}

	function upload_laporan($id_permohonan,$keterangan)
	{
		$detail = $this->Mdata->ambil_pengajuan($id_permohonan);
		$folder = $detail['judul_permohonan']." - ".date("d-m-Y H-i-s",strtotime($detail['tgl_permohonan'])).'/';
		$config['upload_path'] = './asset/Kumpulan Kasus/'.$folder;
		$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';

		$this->load->library('upload', $config);

		$hasil = $this->ambil_laporan($id_permohonan);

		if (empty($hasil))
		{
			if ($this->upload->do_upload('file_pengujian')) 
			{
				$input['file_pengujian'] = $this->upload->data('file_name');
				$input['keterangan_pegawai'] = $keterangan;
				$input['id_permohonan'] = $id_permohonan;
				$input['status_pesan_pegawai'] = "1";
				$input['status_pesan_klien'] = "0";

			// print_r($input);

				$this->db->insert('hasil_pengujian',$input);

				$hasil1['id_pengujian'] = $this->db->insert_id('hasil_pengujian');
			}

		}
		else
		{
			if ($this->upload->do_upload('file_pengujian')) 
			{
				$input['file_pengujian'] = $this->upload->data('file_name');
				$input['id_permohonan'] = $id_permohonan;
				$input['keterangan_pegawai'] = $keterangan;
				$input['status_pesan_pegawai'] = "1";
				$input['status_pesan_klien'] = "0";
			// print_r($input);

				$this->db->where('id_permohonan', $id_permohonan);
				$this->db->update('hasil_pengujian',$input);
			}

			$hasil1['id_pengujian']=$hasil['id_pengujian'];

		}

		$hasil1['waktu'] = date("Y-m-d H:i:s");
		$hasil1['keterangan'] = "Upload";

		$this->db->insert("riwayat_pengujian",$hasil1);

	}

	function riwayat_pengujian($id_pengujian)
	{
		$this->db->where('id_pengujian', $id_pengujian);
		$ambil = $this->db->get('riwayat_pengujian');
		$data = $ambil->result_array();
		return $data;
	}

	function cek_laporan($pengajuan)
	{
		$semua=array();
		foreach ($pengajuan as $key => $value) 
		{
			//mengambil data laporan berdasarkan id_permohonan
			$this->db->where('id_permohonan',$value['id_permohonan']);
			$ambil = $this->db->get('hasil_pengujian');
			$data = $ambil->num_rows();
			$hasil = $ambil->row_array();
			if ($data==1) 
			{
				$value['status_laporan']="Ada";
				$value['hasil_laporan'] = $hasil['status_pengujian'];
			}
			else
			{
				$value['status_laporan']="Belum Ada";
			}
			$semua[] = $value;
		}
		return $semua;
	}

	function ambil_laporan($id_permohonan)
	{
		$this->db->where('id_permohonan',$id_permohonan);
		$ambil = $this->db->get('hasil_pengujian');
		$data = $ambil->row_array();
		return $data;
	}

	function status_laporan($input,$id_permohonan)
	{
		$input['status_pesan_pegawai'] = "0";
		$input['status_pesan_klien'] = "1";
		$this->db->where('id_permohonan',$id_permohonan);
		$this->db->update('hasil_pengujian',$input);

		$data = $this->ambil_laporan($id_permohonan);
		$hasil1['id_pengujian'] = $data['id_pengujian'];

		$hasil1['waktu'] = date("Y-m-d H:i:s");
		$hasil1['keterangan'] = "Download (".$input['status_pengujian'].")";

		$this->db->insert("riwayat_pengujian",$hasil1);
	}

	function simpan_note($input,$id_permohonan)
	{
		$this->db->where('id_permohonan',$id_permohonan);
		$this->db->update('permohonan',$input);
	}

	function ambil_note($id_permohonan)
	{
		$this->db->where('id_permohonan',$id_permohonan);
		$ambil = $this->db->get('permohonan');
		$data = $ambil->row_array();
		return $data;
	}

	function ambil_permohonan($id_permohonan)
	{
		$this->db->where('id_permohonan',$id_permohonan);
		$ambil = $this->db->get('permohonan');
		$data = $ambil->row_array();

		//ambil penerima
		$penerima = $this->ambil_penerima_permohonan($id_permohonan);
		if (empty($penerima)) 
		{
			$data['S1'] = "kosong";
		}
		else
		{
			$cek_s = $this->ambil_sampel_penerima($penerima['id_penerima']);
			if (empty($cek_s)) 
			{
				$data['S1'] = "kosong";
			}
			else
			{

				$data['S1'] = "isi";
			}
		}

		//mengambil penugasan
		$penugasan = $this->ambil_penugasan_penerima($penerima['id_penerima']);
		if (empty($penugasan)) 
		{
			$data['T1'] = "kosong";
		}
		else
		{
			$cek_t = $this->tampil_detail_penugasan($penugasan['id_penugasan']);
			if (empty($cek_t)) 
			{
				
				$data['T1'] = "kosong";
			}
			else
			{
				$data['T1'] = "isi";
			}
		}

		$mk = $this->ambil_keputusan($penerima['id_penerima']);
		if (!empty($mk)) 
		{
			$data['MK1'] = "isi";

		}
		else
		{
			$data['MK1'] = "kosong";
		}

		return $data;
	}

	function ambil_sampel_penerima($id_penerima)
	{
		$this->db->where('id_penerima',$id_penerima);
		$ambil = $this->db->get('sampel');
		$data = $ambil->result_array();
		return $data;
	}

	function tampil_detail_penugasan($id_penugasan)
	{
		$this->db->where('id_penugasan',$id_penugasan);
		$ambil = $this->db->get('detail_penugasan');
		$data = $ambil->result_array();
		return $data;
	}

	function kirim_email_verifikasi($id_permohonan,$tujuan)
	{

		include_once APPPATH.'libraries/dompdf/autoload.inc.php';

		$verifikasi = $this->ambil_verifikasi($id_permohonan);
		$email = tamplate();
		

		$nilai="";

		if($verifikasi['status_verifikasi']=="Diterima")
		{
			$nilai .= "<li>";
			$nilai .= '<i class="fa fa-check-square-o" aria-hidden="true"></i>Diterima untuk diuji lebih lanjut';
			$nilai .= "</li>";
			$nilai .= "<li>";
			$nilai .= '<i class="fa fa-square-o" aria-hidden="true"></i> Tidak Diterima</li>';
		}
		else
		{
			$nilai .= "<li>";
			$nilai .= '<i class="fa fa-square-o" aria-hidden="true"></i>Diterima untuk diuji lebih lanjut';
			$nilai .= "</li>";
			$nilai .= "<li>";
			$nilai .= '<i class="fa fa-check-square-o" aria-hidden="true"></i> Tidak Diterima</li>';
		}

		$pecah=explode("-", $verifikasi['tgl_verifikasi']);
			$tanggal = explode(" ", $pecah[2]);
			$bulan = bulan($pecah[1]);
			$tgl = $tanggal[0]." ".$bulan." ".$pecah[0];

		$email = str_replace("{nomer}", $verifikasi["nomor_verifikasi"], $email);
		$email = str_replace("{tgl}", $tgl, $email);
		$email = str_replace("{keputusan}", $nilai, $email);

		$a="";
		foreach ($verifikasi['detail'] as $key => $value) 
		{
			$a.="<tr>";
			$a.="<td style='border:1px solid #f4f4f4;padding:8px 16px;'>".$value['nama_pegawai']."</td>";
			$a.="<td style='border:1px solid #f4f4f4;padding:8px 16px;'>".$value['jabatan_pegawai']."</td>";
			$a.="</tr>";
		}

		$email = str_replace("{admin}", $a, $email);

		kirim_email($email,$tujuan);
}

function hapus_permohonan_klien($id_permohonan)
{
	$this->db->where('id_permohonan', $id_permohonan);
	$this->db->delete('permohonan');
}


function notif_klien()
{
	$login  = $this->session->userdata('klien');
	$this->db->where('status_pesan_klien', 0);
	$this->db->where('id_klien', $login['id_klien']);
	$this->db->join('permohonan', 'hasil_pengujian.id_permohonan = permohonan.id_permohonan', 'left');
	return $this->db->get('hasil_pengujian')->result_array();
}

function notif_pegawai()
{
	$this->db->where('status_pesan_pegawai', 0);
	$this->db->join('permohonan', 'hasil_pengujian.id_permohonan = permohonan.id_permohonan', 'left');
	return $this->db->get('hasil_pengujian')->result_array();
}

function kurangi_notif($id_permohonan)
{
	$hasil['status_pesan_pegawai']=1;

	$this->db->where('id_permohonan',$id_permohonan);
	$this->db->update('hasil_pengujian', $hasil);
}

function kurangi_notif_klien($id_permohonan)
{
	$hasil['status_pesan_klien']=1;

	$this->db->where('id_permohonan',$id_permohonan);
	$this->db->update('hasil_pengujian', $hasil);
}

function hapus_arsip($id_permohonan)
{
	$this->db->where('id_permohonan', $id_permohonan);
	$this->db->delete('permohonan');
}

function ambil_ime($id_permohonan)
{

	$this->db->join('penerima','sampel.id_penerima=penerima.id_penerima','LEFT');
	$this->db->join('pegawai', 'penerima.id_pegawai=pegawai.id_pegawai', 'LEFT');
	$this->db->join('permohonan','penerima.id_permohonan=permohonan.id_permohonan','LEFT');
	$this->db->where('permohonan.id_permohonan', $id_permohonan);
	$data = $this->db->get('sampel')->row_array();

	$this->db->where('id_sampel', $data['id_sampel']);
	$data_sampel = $this->db->get('detail_sampel')->row_array();
	return $data_sampel;
}

function ubah_surat($input,$id_permohonan)
{
	$this->db->where('id_permohonan',$id_permohonan);
	$this->db->update('permohonan',$input);

}

}


