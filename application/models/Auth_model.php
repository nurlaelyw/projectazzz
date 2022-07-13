<?php
class Auth_model extends CI_Model {
	public function auth()
	{
		$data = array(
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('password'))
		);

		$query = $this->db->get_where('admin', $data);

		if ($query->num_rows() == 1) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function auth_penduduk()
	{
		$password = $this->input->post('password');
		$tanggal_lahir = 0;
		if (strlen($password) == 8) {
			$password = str_split($this->input->post('password'));
			$tgl = $password[0].$password[1];
			$bln = $password[2].$password[3];
			$thn = $password[4].$password[5].$password[6].$password[7];
			$tanggal_lahir = $thn."-".$bln."-".$tgl;
		}

		$data = array(
			'nik' => $this->input->post('username'),
			'tanggal_lahir' => $tanggal_lahir
		);

		$query = $this->db->get_where('penduduk', $data);

		if ($query->num_rows() == 1) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function get_admin()
	{
		$data = array(
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('password'))
		);

		$query = $this->db->get_where('admin', $data);
		return $query;
	}
}