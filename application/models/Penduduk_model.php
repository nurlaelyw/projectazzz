<?php
class Penduduk_model extends CI_Model {

	public function delete_surat($id)
	{
		$this->db->delete('pengajuan_surat', array('id_pengajuan_surat' => $id));
	}

	public function edit_surat_id($id)
	{
		$data = array(
			'data_surat' => $this->input->post('data_surat'),
			'uraian_perihal' => $this->input->post('uraian_perihal'),
			'tujuan_surat' => $this->input->post('tujuan_surat')
		);

		$this->db->where('id_pengajuan_surat', $id);
		$this->db->update('pengajuan_surat', $data);
	}

	public function edit_surat_gambar_id($id)
	{
		$file = $this->upload->data();
		$img_syarat = $file['file_name'];
		$data = array(
			'data_surat' => $this->input->post('data_surat'),
			'uraian_perihal' => $this->input->post('uraian_perihal'),
			'tujuan_surat' => $this->input->post('tujuan_surat'),
			'gambar' => $img_syarat
		);

		$this->db->where('id_pengajuan_surat', $id);
		$this->db->update('pengajuan_surat', $data);
	}

	public function get_surat($id)
	{
		$this->db->select('*');
		$this->db->from('pengajuan_surat');
		$this->db->join('surat', 'pengajuan_surat.id_surat = surat.id_surat');
		$this->db->where('id_pengajuan_surat', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function get_penduduk_nik($nik)
	{
		$this->db->select('*');
		$this->db->from('penduduk');
		$this->db->join('tempat_lahir', 'penduduk.id_tempat_lahir = tempat_lahir.id_tempat_lahir');
		$this->db->join('agama', 'penduduk.id_agama = agama.id_agama');
		$this->db->join('pendidikan', 'penduduk.id_pendidikan = pendidikan.id_pendidikan');
		$this->db->join('pekerjaan', 'penduduk.id_pekerjaan = pekerjaan.id_pekerjaan');
		$this->db->join('shdk', 'penduduk.id_shdk = shdk.id_shdk');
		$this->db->join('keluarga', 'penduduk.no_kk = keluarga.no_kk');
		$this->db->join('dusun', 'keluarga.id_dusun = dusun.id_dusun');
		$this->db->join('rt', 'keluarga.id_rt = rt.id_rt');
		$this->db->join('rw', 'keluarga.id_rw = rw.id_rw');
		$this->db->where('nik', $nik);
		$query = $this->db->get();
		return $query->row();
	}

	public function get_penduduk($keyword)
	{
		$this->db->select('*');
		$this->db->from('penduduk');
		$this->db->join('tempat_lahir', 'penduduk.id_tempat_lahir = tempat_lahir.id_tempat_lahir');
		$this->db->join('agama', 'penduduk.id_agama = agama.id_agama');
		$this->db->join('pendidikan', 'penduduk.id_pendidikan = pendidikan.id_pendidikan');
		$this->db->join('pekerjaan', 'penduduk.id_pekerjaan = pekerjaan.id_pekerjaan');
		$this->db->join('shdk', 'penduduk.id_shdk = shdk.id_shdk');
		$this->db->join('keluarga', 'penduduk.no_kk = keluarga.no_kk');
		$this->db->join('dusun', 'keluarga.id_dusun = dusun.id_dusun');
		$this->db->join('rt', 'keluarga.id_rt = rt.id_rt');
		$this->db->join('rw', 'keluarga.id_rw = rw.id_rw');
		$this->db->where('nama', $keyword);
		$this->db->or_where('nik', $keyword);
		$query = $this->db->get();
		return $query->result();
	}

	// public function get_penduduk($keyword)
	// {
	// 	$this->db->select('*');
	// 	$this->db->from('penduduk');
	// 	$this->db->like('NAMA', $keyword);
	// 	$this->db->or_like('NIK', $keyword);
	// 	$query = $this->db->get();
	// 	return $query->result();
	// }
}