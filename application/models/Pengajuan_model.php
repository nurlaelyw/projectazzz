<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengajuan_model extends CI_Model {

	public function get_surat_belum_di_proses($nik)
	{
		$this->db->select('*');
		$this->db->from('pengajuan_surat');
		$this->db->join('surat', 'pengajuan_surat.id_surat = surat.id_surat');
		$this->db->where('nik', $nik);
		$this->db->where('baca', '0');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_jml_blm_proses($nik)
	{
		$this->db->select('*');
		$this->db->from('pengajuan_surat');
		$this->db->where('nik', $nik);
		$this->db->where('baca', '0');
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function notif_penduduk_tolak()
	{
		$id = $this->input->post("id_pengajuan_surat");
		$data = array(
			'id_notif_penduduk' => NULL,
			'id_pengajuan_surat' => $id,
			'baca' => '0',
			'status' => '0',
			'pesan' => $this->input->post("pesan")
		);

		$this->db->insert('notif_penduduk', $data);
	}

	public function tolak()
	{
		$id = $this->input->post("id_pengajuan_surat");
		$data = array(
			'baca' => '1',
			'arsip' => '2'
		);

		$this->db->where('id_pengajuan_surat', $id);
		$this->db->update('pengajuan_surat', $data);
	}

	public function baca_notif_pengajuan($id)
	{
		$data = array(
			'baca' => '1'
		);

		$this->db->where('id_pengajuan_surat', $id);
		$this->db->update('pengajuan_surat', $data);
	}

	public function baca_pemberitahuan_penduduk($nik)
	{
		$this->db->select('*');
		$this->db->from('notif_penduduk');
		$this->db->join('pengajuan_surat', 'notif_penduduk.id_pengajuan_surat = pengajuan_surat.id_pengajuan_surat');
		$this->db->where('notif_penduduk.baca', '0');
		$this->db->where('nik', $nik);
		$query = $this->db->get();
		$surat = $query->result();

		foreach ($surat as $surat) {
			$data = array(
				'baca' => '1'
			);

			$this->db->where('id_notif_penduduk', $surat->id_notif_penduduk);		
			$this->db->update('notif_penduduk', $data);
		}
	}

	public function add_notif_penduduk($id)
	{
		$data = array(
			'id_notif_penduduk' => NULL,
			'id_pengajuan_surat' => $id,
			'baca' => '0'
		);

		$this->db->insert('notif_penduduk', $data);
	}

	public function get_last_id_nik($nik)
	{
		$this->db->select('*');
		$this->db->from('pengajuan_surat');
		$this->db->where('nik', $nik);
		$this->db->order_by('id_pengajuan_surat', 'desc');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->row();
	}

	public function get_penduduk($id)
	{
		$this->db->select('*');
		$this->db->from('pengajuan_surat');
		$this->db->join('surat', 'pengajuan_surat.id_surat = surat.id_surat');
		$this->db->join('penduduk', 'pengajuan_surat.nik = penduduk.nik');
		$this->db->join('tempat_lahir', 'penduduk.id_tempat_lahir = tempat_lahir.id_tempat_lahir');
		$this->db->join('agama', 'penduduk.id_agama = agama.id_agama');
		$this->db->join('pendidikan', 'penduduk.id_pendidikan = pendidikan.id_pendidikan');
		$this->db->join('pekerjaan', 'penduduk.id_pekerjaan = pekerjaan.id_pekerjaan');
		$this->db->join('shdk', 'penduduk.id_shdk = shdk.id_shdk');
		$this->db->join('keluarga', 'penduduk.no_kk = keluarga.no_kk');	
		$this->db->join('dusun', 'keluarga.id_dusun = dusun.id_dusun', 'left');
		$this->db->join('rt', 'keluarga.id_rt = rt.id_rt');
		$this->db->join('rw', 'keluarga.id_rw = rw.id_rw');
		$this->db->where('id_pengajuan_surat', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function get_pengajuan_id($id)
	{
		$this->db->select('*');
		$this->db->from('pengajuan_surat');
		$this->db->join('surat', 'pengajuan_surat.id_surat = surat.id_surat');
		$this->db->join('penduduk', 'pengajuan_surat.nik = penduduk.nik');		
		$this->db->where('id_pengajuan_surat', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function get_pengajuan()
	{
		$this->db->select('*');
		$this->db->from('pengajuan_surat');
		$this->db->join('surat', 'pengajuan_surat.id_surat = surat.id_surat');
		$this->db->join('penduduk', 'pengajuan_surat.nik = penduduk.nik');		
		$this->db->where('baca', 0);
		$this->db->order_by('id_pengajuan_surat', 'asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_jumlah_pengajuan()
	{
		$data = $this->db->get_where('pengajuan_surat', array('baca' => 0));
		return $data->num_rows();
	}

	public function get_jumlah_pemberitahuan_penduduk($nik)
	{
		$this->db->select('*');
		$this->db->from('notif_penduduk');
		$this->db->join('pengajuan_surat', 'notif_penduduk.id_pengajuan_surat = pengajuan_surat.id_pengajuan_surat');
		$this->db->join('surat', 'pengajuan_surat.id_surat = surat.id_surat');
		$this->db->where('notif_penduduk.baca', '0');
		$this->db->where('nik', $nik);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get_pemberitahuan_penduduk($nik)
	{
		$this->db->select('*');
		$this->db->from('notif_penduduk');
		$this->db->join('pengajuan_surat', 'notif_penduduk.id_pengajuan_surat = pengajuan_surat.id_pengajuan_surat');
		$this->db->join('surat', 'pengajuan_surat.id_surat = surat.id_surat');
		$this->db->where('notif_penduduk.baca', '0');
		$this->db->where('nik', $nik);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_nomor_surat($id_surat)
	{
		$tahun = date('Y');
		$this->db->select('*');
		$this->db->from('pengajuan_surat');
		$this->db->where('id_surat', $id_surat);
		$this->db->where('tahun', $tahun);
		$this->db->order_by('id_pengajuan_surat', 'desc');
		$this->db->limit(1);
		$query = $this->db->get();
		$data = $query->row();
		if ($data) {
			return $data->nomor_surat+1;
		} else {
			return 1;
		}
	}

	public function add_pengajuan_admin($nik)
	{
		$nik = $nik;
		$id_surat = $this->input->post('id_surat');
		$nomor_surat = $this->get_nomor_surat($id_surat);
		$tahun = date('Y');
		$tanggal_surat = date('Y-m-d');
		$perihal = $this->input->post('perihal');
		$tujuan = $this->input->post('tujuan');
		$data_surat = $this->input->post('data_surat');

		$data = array(
			'id_pengajuan_surat' => NULL,
			'nik' => $nik,
			'id_surat' => $id_surat,
			'nomor_surat' => $nomor_surat,
			'tahun' => $tahun,
			'tanggal_surat' => $tanggal_surat,
			'data_surat' => $data_surat,
			'uraian_perihal' => $perihal,
			'tujuan_surat' => $tujuan,
			'data_surat' => $data_surat,
			'baca' => '1',
			'arsip' => '0'
		);

		$status = $this->db->insert('pengajuan_surat', $data);
	}

	public function add_pengajuan()
	{
		$nik = $this->session->userdata('nik');
		$id_surat = $this->input->post('id_surat');
		$nomor_surat = $this->get_nomor_surat($id_surat);
		$tahun = date('Y');
		$tanggal_surat = date('Y-m-d');
		$perihal = $this->input->post('perihal');
		$tujuan = $this->input->post('tujuan');
		$data_surat = $this->input->post('data_surat');

		$data = array(
			'id_pengajuan_surat' => NULL,
			'nik' => $nik,
			'id_surat' => $id_surat,
			'nomor_surat' => $nomor_surat,
			'tahun' => $tahun,
			'tanggal_surat' => $tanggal_surat,
			'data_surat' => $data_surat,
			'uraian_perihal' => $perihal,
			'tujuan_surat' => $tujuan,
			'data_surat' => $data_surat,
			'baca' => '0',
			'arsip' => '0'
		);

		$status = $this->db->insert('pengajuan_surat', $data);

		if ($status) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function pengajuan_surat_sku()
	{
		$file = $this->upload->data();
		$nik = $this->session->userdata('nik');
		$id_surat = $this->input->post('id_surat');
		$nomor_surat = $this->get_nomor_surat($id_surat);
		$tahun = date('Y');
		$tanggal_surat = date('Y-m-d');
		$perihal = $this->input->post('perihal');
		$tujuan = $this->input->post('tujuan');
		$data_surat = $this->input->post('data_surat');
		$img_syarat = $file['file_name'];

		$data = array(
			'id_pengajuan_surat' => NULL,
			'nik' => $nik,
			'id_surat' => $id_surat,
			'nomor_surat' => $nomor_surat,
			'tahun' => $tahun,
			'tanggal_surat' => $tanggal_surat,
			'data_surat' => $data_surat,
			'uraian_perihal' => $perihal,
			'tujuan_surat' => $tujuan,
			'data_surat' => $data_surat,
			'gambar' => $img_syarat,
			'baca' => '0',
			'arsip' => '0'
		);

		$status = $this->db->insert('pengajuan_surat', $data);

		if ($status) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

}

/* End of file Pengajuan_model.php */
/* Location: ./application/models/Pengajuan_model.php */