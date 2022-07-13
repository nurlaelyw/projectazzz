<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('pengajuan_model');
		$this->load->model('penduduk_model');
	}

	public function tolak()
	{
		//echo $this->input->post("id_pengajuan_surat");
		//echo $this->input->post("pesan");
		//die;
		$this->pengajuan_model->tolak();
		$this->pengajuan_model->notif_penduduk_tolak();
		redirect('pengajuan/admin/notif');
	}

	public function notif()
	{
		$data['title'] = 'Pengajuan Surat dari Penduduk';
		$data['jumlah_pengajuan'] = $this->pengajuan_model->get_jumlah_pengajuan();
		$data['pengajuan'] = $this->pengajuan_model->get_pengajuan();
		$this->load->view('template/header', $data);
		$this->load->view('template/menu2', $data);
		$this->load->view('notif_admin', $data);
		$this->load->view('template/footer');
	}

	public function sku($id)
	{
		$data['jumlah_pengajuan'] = $this->pengajuan_model->get_jumlah_pengajuan();
		$data['pengajuan'] = $this->pengajuan_model->get_pengajuan_id($id);
		$data['penduduk'] = $this->penduduk_model->get_penduduk_nik($data['pengajuan']->nik);
		$data['title'] = 'Pengajuan Surat Keterangan Usaha';
		$this->load->view('template/header', $data);
		$this->load->view('template/menu', $data);
		$this->load->view('pengajuan/sku', $data);
		$this->load->view('template/footer');
	}

	public function sktm($id)
	{
		$data['jumlah_pengajuan'] = $this->pengajuan_model->get_jumlah_pengajuan();
		$data['pengajuan'] = $this->pengajuan_model->get_pengajuan_id($id);
		$data['penduduk'] = $this->penduduk_model->get_penduduk_nik($data['pengajuan']->nik);
		$data['title'] = 'Pengajuan Surat Keterangan Tidak Mampu';
		$this->load->view('template/header', $data);
		$this->load->view('template/menu', $data);
		$this->load->view('pengajuan/sktm', $data);
		$this->load->view('template/footer');
	}

	public function skd($id)
	{
		$data['jumlah_pengajuan'] = $this->pengajuan_model->get_jumlah_pengajuan();
		$data['pengajuan'] = $this->pengajuan_model->get_pengajuan_id($id);
		$data['penduduk'] = $this->penduduk_model->get_penduduk_nik($data['pengajuan']->nik);
		$data['title'] = 'Pengajuan Surat Keterangan Domisili';
		$this->load->view('template/header', $data);
		$this->load->view('template/menu', $data);
		$this->load->view('pengajuan/skd', $data);
		$this->load->view('template/footer');
	}

	public function skbpm($id)
	{
		$data['jumlah_pengajuan'] = $this->pengajuan_model->get_jumlah_pengajuan();
		$data['pengajuan'] = $this->pengajuan_model->get_pengajuan_id($id);
		$data['penduduk'] = $this->penduduk_model->get_penduduk_nik($data['pengajuan']->nik);
		$data['title'] = 'Pengajuan Surat Keterangan Belum Pernah Menikah';
		$this->load->view('template/header', $data);
		$this->load->view('template/menu', $data);
		$this->load->view('pengajuan/skbpm', $data);
		$this->load->view('template/footer');
	}

}

/* End of file Admin.php */
/* Location: ./application/controllers/pengajuan/Admin.php */