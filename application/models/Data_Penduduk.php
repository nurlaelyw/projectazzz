<?php
class data_penduduk extends CI_Model {

    function get_pag_surat_masuk($config)
	{
		$this->db->select('*');
		$this->db->from('data_penduduk');
		$this->db->order_by('nik', 'desc');
		$this->db->limit($config['per_page'], $this->uri->segment(4));
		$s_masuk = $this->db->get();

		if ($s_masuk->num_rows() > 0) {
			foreach ($s_masuk->result() as $value) {
				$data[] = $value;
			}
			return $data;
		}
	}
}