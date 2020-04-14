<?php


class Mhistory extends CI_Model 
{

	function ambil_history_pegawai($id_pegawai,$aktivitas) 
	{
		$this->db->where('id_pegawai',$id_pegawai);
		$this->db->where('aktivitas',$aktivitas);
		$ambil = $this->db->get('histori');
		$data = $ambil->row_array();
		return $data;
	}


	function simpan_history($history)
	{
		$this->db->insert('histori', $history);
	}

	function ubah_history($history)
	{
		$this->db->where('id_pegawai',$history['id_pegawai']);
		$this->db->where('aktivitas',$history['aktivitas']);
		$this->db->update('histori',$history);
	}

	function tampil_history()
	{
		$ambil = $this->db->get('pegawai');
		$data_pegawai = $ambil->result_array();

		$semua=array();

		foreach ($data_pegawai as $key => $value) 
		{
			$tgl = date("Y-m-d");
			$this->db->where('DATE(waktu_history)',$tgl);
			$this->db->where('histori.id_pegawai',$value['id_pegawai']);
			$this->db->join('pegawai','histori.id_pegawai=pegawai.id_pegawai','left');
			$ambil = $this->db->get('histori');
			$data = $ambil->result_array();
			$value['aktivitas_pegawai']=$data;
		
			$semua[] = $value;
		}

		return $semua;
	}

}

