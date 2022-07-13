<?php
class Auth extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
		$this->load->model('penduduk_model');
	}

	public function index()
	{
		switch ($this->session->userdata('hak')) {
			case 'admin':
				redirect('surat/daftar');
				break;
			
			case 'penduduk':
				redirect('pengajuan/penduduk');
				break;

			default:
				$this->load->view('auth');
				break;
		}
	}

	public function login()
	{
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() === FALSE) {
			redirect('auth');
		} 
		else {
			$auth = $this->auth_model->auth();
			$auth_penduduk = $this->auth_model->auth_penduduk();

			if ($auth) {
				$get_admin = $this->auth_model->get_admin();
				$row_admin = $get_admin->row();

				$session_admin = array(
					'hak' => 'admin',
					'user' => $row_admin->user
				);

				$this->session->set_userdata($session_admin);
				redirect('surat/daftar');
			}

			if ($auth_penduduk) {
				$penduduk = $this->penduduk_model->get_penduduk_nik($this->input->post('username'));
				
				$session_penduduk = array(
					'hak' => 'penduduk',
					'nik' => $penduduk->nik
				);

				$this->session->set_userdata($session_penduduk);
				redirect('pengajuan/penduduk');
			}


			if (!$auth || !$auth_penduduk) {
				$this->session->set_flashdata('failed_login', 'Username atau password salah.');
				redirect('auth');
			}
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('auth');
	}
}