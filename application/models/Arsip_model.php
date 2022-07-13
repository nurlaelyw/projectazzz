<?php
class arsip_model extends CI_Model {

	function get_pag_surat_masuk($config)
	{
		$this->db->select('*');
		$this->db->from('surat_masuk');
		$this->db->order_by('id_surat_masuk', 'desc');
		$this->db->limit($config['per_page'], $this->uri->segment(4));
		$s_masuk = $this->db->get();

		if ($s_masuk->num_rows() > 0) {
			foreach ($s_masuk->result() as $value) {
				$data[] = $value;
			}
			return $data;
		}
	}

	function get_pag_surat_keluar($config)
	{
		$this->db->select('*');
		$this->db->from('surat_keluar');
		$this->db->join('pengajuan_surat', 'surat_keluar.id_pengajuan_surat=pengajuan_surat.id_pengajuan_surat');
		$this->db->order_by('id_surat_keluar', 'desc');
		$this->db->limit($config['per_page'], $this->uri->segment(4));
		$s_keluar = $this->db->get();

		if ($s_keluar->num_rows() > 0) {
			foreach ($s_keluar->result() as $value) {
				$data[] = $value;
			}
			return $data;
		}
	}

	public function cari_surat_keluar()
	{
		$keyword = explode('/', $this->input->post('keyword'));

		if (count($keyword) == 4) {
			$id_surat = $keyword[0];
			$nomor_surat = ltrim($keyword[1], '0');
			$tahun = $keyword[3];

			return
			$this->db
				->select('*')
				->from('surat_keluar')
				->join('pengajuan_surat', 'surat_keluar.id_pengajuan_surat=pengajuan_surat.id_pengajuan_surat')
				->join('surat', 'pengajuan_surat.id_surat=surat.id_surat')
				->where('pengajuan_surat.id_surat', $id_surat)
				->where('nomor_surat', $nomor_surat)
				->where('tahun', $tahun)
				->order_by('id_surat_keluar', 'desc')
				->get()
				->result();
		} else {
			return
			$this->db
				->select('*')
				->from('surat_keluar')
				->join('pengajuan_surat', 'surat_keluar.id_pengajuan_surat=pengajuan_surat.id_pengajuan_surat')
				->join('surat', 'pengajuan_surat.id_surat=surat.id_surat')
				->where('uraian_perihal', $keyword[0])
				->or_where('tujuan_surat', $keyword[0])
				->order_by('id_surat_keluar', 'desc')
				->get()
				->result();
		}
	}

	public function cari_surat_masuk()
	{
		$keyword = $this->input->post('keyword');
		$this->db->select('*');
		$this->db->from('surat_masuk');
		$this->db->where('nomor_surat', $keyword);
		$this->db->or_where('uraian_perihal', $keyword);
		$this->db->or_where('asal_surat', $keyword);
		$this->db->order_by('id_surat_masuk', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function surat_diarsipkan($id)
	{
		$data = array(
			'arsip' => '1'
		);
		$this->db->where('id_pengajuan_surat', $id);
		$this->db->update('pengajuan_surat', $data);
	}

	public function get_surat_keluar()
	{
		$this->db->select('*');
		$this->db->from('pengajuan_surat');
		$this->db->where('arsip', '0');
		$query = $this->db->get();
		return $query->result();
	}

	public function ambildatasuratmasuk()
	{
		$this->db->select('*');
		$this->db->from('surat_masuk');
		$query = $this->db->get();
		return $query->result();
	}

	public function ambildatasuratmasukid($id_surat_masuk)
	{
		$query = $this->db->get_where('surat_masuk', array('id_surat_masuk' => $id_surat_masuk));
		return $query->row();
	}

	public function editsuratmasuk($id_surat_masuk)
	{
		$data = array(
			'nomor_surat' => $this->input->post('nomor_surat'),
			'uraian_perihal' => $this->input->post('uraian_perihal'),
			'asal_surat' =>$this->input->post('asal_surat'),
			'tanggal_surat' =>$this->input->post('tanggal_surat'),
			'gambar_surat' => $this->input->post('gambar_surat'),
		);

		$this->db->where('id_surat_masuk', $id_surat_masuk);
		$this->db->update('surat_masuk', $data);
	}

	public function tambahsuratmasuk()
	{
		$data = array 	('nomor_surat' => $this->input->post('nomor_surat'),
						'uraian_perihal' => $this->input->post('uraian_perihal'),
						'asal_surat' => $this->input->post('asal_surat'),
						'tanggal_surat' => $this->input->post('tanggal_surat'),
						'gambar_surat' => $this->input->post('gambar_surat'),
					);

		$this->db->insert('surat_masuk', $data);
	}

	public function hapussuratmasuk($id_surat_masuk)
	{
		$this->db->delete('surat_masuk', array('id_surat_masuk' => $id_surat_masuk));
	}

	public function tambahsuratkeluar()
	{
		$data = array 	('id_pengajuan_surat' => $this->input->post('id_pengajuan_surat'),
						'gambar_surat' => $this->input->post('gambar_surat'),
									);
		$this->db->insert('surat_keluar', $data);
	}

	public function ambildatasuratkeluar()
	{
		$this->db->select('*');
		$this->db->from('surat_keluar');
		$this->db->join('pengajuan_surat', 'surat_keluar.id_pengajuan_surat=pengajuan_surat.id_pengajuan_surat');
		$query = $this->db->get();
		return $query->result();
	}

	public function ambildatasuratkeluarid($idsuratkeluar)
	{
		$this->db->select('*');
		$this->db->from('surat_keluar');
		$this->db->join('pengajuan_surat', 'surat_keluar.id_pengajuan_surat=pengajuan_surat.id_pengajuan_surat');
		$this->db->where('id_surat_keluar', $idsuratkeluar);
		$query = $this->db->get();
		return $query->row();
	}

	public function editsuratkeluar($idsuratkeluar)
	{
		$id_pengajuan_surat = $this->input->post('id_pengajuan_surat');

		$data1 = array(
			'gambar_surat' => $this->input->post('gambar_surat')
		);

		$data2 = array(
			'uraian_perihal' => $this->input->post('uraian_perihal'),
			'tujuan_surat' => $this->input->post('tujuan_surat'),
			'tanggal_surat' => $this->input->post('tanggal_surat')
		);

		$this->db->where('id_surat_keluar', $idsuratkeluar);
		$this->db->update('surat_keluar', $data1);

		$this->db->where('id_pengajuan_surat', $id_pengajuan_surat);
		$this->db->update('pengajuan_surat', $data2);
	}

	public function hapussuratkeluar($idsuratkeluar)
	{
		$this->db->delete('surat_keluar', array('id_surat_keluar' => $idsuratkeluar));
	}



public function insert($data)
  {
    $this->db->insert('surat_masuk', $data);
  }
}