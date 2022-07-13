<?php
class Penduduk extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('penduduk_model');
	}

	public function index()
	{
		if ($this->session->userdata('hak') != 'admin') {
			redirect('auth');
		}

		$this->form_validation->set_rules('keyword','Nama / NIK','required');

		if ($this->form_validation->run() === FALSE) {
			$data['title'] = 'Penduduk';
			$this->load->view('template/header', $data);
			$this->load->view('template/menu', $data);
			$this->load->view('penduduk/cari_data_penduduk');
			$this->load->view('template/footer');
		} else {
			$data['title'] = 
		}
	}

	public function tambahdata()
	{
		if ($this->session->userdata('hak') != 'admin'){
			redirect('auth');
		}

		$this->form_validation->set_rules('nkk','No KK','required');
		$this->form_validation->set_rules('namakk','Nama KK','required');
		$this->form_validation->set_rules('kdshdk','Kode SHDK','required');
		$this->form_validation->set_rules('nik','NIK','required');
		$this->form_validation->set_rules('nama','Nama','required');
		$this->form_validation->set_rules('rt','RT','required');
		$this->form_validation->set_rules('rw','RW','required');
		$this->form_validation->set_rules('dusun','Dusun','required');
		$this->form_validation->set_rules('jk','Jenis Kelamin','required');
		$this->form_validation->set_rules('tempatlahir','Tempat Lahir','required');
		$this->form_validation->set_rules('tgllahir','Tanggal Lahir','required');
		$this->form_validation->set_rules('gdr','Golongan Darah','required');
		$this->form_validation->set_rules('agama','Agama','required');
		$this->form_validation->set_rules('status','Status','required');
		$this->form_validation->set_rules('pend','Pendidikan','required');
		$this->form_validation->set_rules('pekerjaan','Pekerjaan','required');
		$this->form_validation->set_rules('namaayah','Nama Ayah','required');
		$this->form_validation->set_rules('namaibu','Nama Ibu','required');

		if ($this->form_validation->run() === FALSE) {
			$data['title'] = 'Penduduk';
			$this->load->view('template/header', $data);
			$this->load->view('template/menu', $data);
			$this->load->view('penduduk/cari_data_penduduk');
			$this->load->view('template/footer');
		} else {
			$this->penduduk_model->tambahdata();
			$this->session->set_flashdata();
		}

	}
	
}