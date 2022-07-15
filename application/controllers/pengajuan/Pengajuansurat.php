<?php

class Pengajuansurat extends CI_Controller {

    public function __construct(){

        parent::__construct();
        $this->load->model('data_penduduk');
        $this->load->model('penduduk_model');
		$this->load->model('pengajuan_model');

    }

    public function tambah_sku(){
        $data['title'] = 'Pengajuan Surat Keterangan Usaha';
        $data['jumlah_konfirmasi'] =  $this->pengajuan_model->get_jumlah_pemberitahuan_penduduk($this->session->userdata('nik'));
		// $data['surat'] = $this->penduduk_model->get_surat($id);
		$this->load->view('template/header', $data);
		$this->load->view('template/menu_penduduk2', $data);
		$this->load->view('pengajuansurat/sku', $data);
		$this->load->view('template/footer');
    }

    public function penduduk()
	{
		if ($this->session->userdata('hak') != 'penduduk') {
			redirect('auth');
		}

		$data['jumlah_konfirmasi'] = $this->pengajuan_model->get_jumlah_pemberitahuan_penduduk($this->session->userdata('nik'));
		$data['title'] = 'Pengajuan Pembuatan Surat';
		$data['penduduk'] = $this->penduduk_model->get_penduduk_nik($this->session->userdata('nik'));
		$data['jml_blm_proses'] = $this->pengajuan_model->get_jml_blm_proses($this->session->userdata('nik'));
		$this->load->view('template/header', $data);
		$this->load->view('template/menu_penduduk2', $data);
		$this->load->view('pengajuansurat/penduduk', $data);
		$this->load->view('template/footer');
	}
}