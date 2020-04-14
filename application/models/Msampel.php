<?php


class Msampel extends CI_Model {

	function  tampil_sampel($id)
	{

		$this->db->where('id_penerima',$id);
		$this->db->join('detail_sampel','detail_sampel.id_sampel=sampel.id_sampel','LEFT');
		$ambil = $this->db->get("sampel");
		$data = $ambil->result_array();
		return  $data;

	}

	function simpan_sampel($inputan)
	{
		$this->db->insert('sampel',$inputan);

		//mengambil id_sampel yang baru saja di tambah
		$id_sampel = $this->db->insert_id('sampel');

		return $id_sampel;
	}

	function ambil_sampel($id_sampel)
	{
		$this->db->where('id_sampel',$id_sampel);
		$this->db->join('penerima','sampel.id_penerima=penerima.id_penerima','LEFT');
		$this->db->join('pegawai', 'penerima.id_pegawai=pegawai.id_pegawai', 'LEFT');
		$this->db->join('permohonan','penerima.id_permohonan=permohonan.id_permohonan','LEFT');


		$ambil = $this->db->get('sampel');
		$data = $ambil->row_array();

		return $data;
	}

	function simpan_detail_sampel($input)
	{
		$this->db->insert('detail_sampel',$input);
	}

	function hapus_sampel($id_sampel)
	{
		$this->db->where('id_sampel',$id_sampel);
		$this->db->delete('sampel');

		$this->db->where('id_sampel',$id_sampel);
		$this->db->delete('detail_sampel');
	}

	function ubah_sampel($inputan,$id_sampel)
	{
		$this->db->where('id_sampel',$id_sampel);
		$this->db->update('sampel',$inputan);
	}

	function ambil_detail_sampel($id_sampel)
	{
		$this->db->select('*');
		$this->db->where('id_sampel',$id_sampel);
		$ambil = $this->db->get('detail_sampel');
		$data = $ambil->row_array();
		return $data;
	}

	function ubah_detail_sampel($inputan, $id_sampel)
	{
		$this->db->where('id_sampel',$id_sampel);
		$this->db->update('detail_sampel',$inputan);
	}

	function hapus_foto_permohonan($id_foto_permohonan,$id_permohonan)
	{
		$this->db->where('id_foto_permohonan',$id_foto_permohonan);
		$this->db->delete('foto_permohonan');
		$tmp = $this->db->get_where('permohonan',array('id_permohonan'=>$id_permohonan));
		$tmp2 = $tmp->row();
		$jumlah_sampel = $tmp2->jumlah_sampel-1;
		$this->db->where('id_permohonan',$id_permohonan);
		$this->db->update('permohonan', array('jumlah_sampel'=>$jumlah_sampel));
	}

}

