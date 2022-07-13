<?php
class Daftar extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('pengajuan_model');
	}
	public function index()
	{
		if ($this->session->userdata('hak') != 'admin') {
			redirect('auth');
		}
		$data['title'] = 'Surat';
		$data['jumlah_pengajuan'] = $this->pengajuan_model->get_jumlah_pengajuan();
		$this->load->view('template/header', $data);
		$this->load->view('template/menu', $data);
		$this->load->view('surat/daftar');
		$this->load->view('template/footer');
	}
}