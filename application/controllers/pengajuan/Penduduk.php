<?php
class Penduduk extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('penduduk_model');
		$this->load->model('pengajuan_model');
	}

	public function index()
	{
		if ($this->session->userdata('hak') != 'penduduk') {
			redirect('auth');
		}

		$data['jumlah_konfirmasi'] = $this->pengajuan_model->get_jumlah_pemberitahuan_penduduk($this->session->userdata('nik'));
		$data['title'] = 'Pengajuan Pembuatan Surat';
		$data['penduduk'] = $this->penduduk_model->get_penduduk_nik($this->session->userdata('nik'));
		$data['jml_blm_proses'] = $this->pengajuan_model->get_jml_blm_proses($this->session->userdata('nik'));
		$this->load->view('template/header', $data);
		$this->load->view('template/menu_penduduk', $data);
		$this->load->view('pengajuan/penduduk', $data);
		$this->load->view('template/footer');
	}

	public function delete_surat($id)
	{
		$this->penduduk_model->delete_surat($id);
		$this->session->set_flashdata('delete_surat', 'Pengajuan surat berhasil dihapus.');
		redirect(base_url('pengajuan/penduduk/belum_di_proses/'.$this->session->userdata('nik')));
	}

	public function edit_surat_id($id)
	{
		$config['upload_path']          = './images/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 4096;
        $config['max_width']            = 5000;
        $config['max_height']           = 5000;

        $this->load->library('upload', $config);

        $upload = $this->upload->do_upload('gambar_persyaratan');
        if (!$upload)
		{
			$this->penduduk_model->edit_surat_id($id);
			$this->session->set_flashdata('edit_surat', 'Pengajuan surat berhasil diedit.');
			redirect(base_url('pengajuan/penduduk/belum_di_proses/'.$this->session->userdata('nik')));
		} else {
			$this->penduduk_model->edit_surat_gambar_id($id);
			$this->session->set_flashdata('edit_surat', 'Pengajuan surat berhasil diedit.');
			redirect(base_url('pengajuan/penduduk/belum_di_proses/'.$this->session->userdata('nik')));
		}
		// $this->penduduk_model->edit_surat_id($id);
		// $this->session->set_flashdata('edit_surat', 'Pengajuan surat berhasil diedit.');
		// redirect(base_url('pengajuan/penduduk/belum_di_proses/'.$this->session->userdata('nik')));
	}

	public function edit_surat($id)
	{
		$data['title'] = 'Pengajuan Surat Keterangan Usaha';
		$data['jumlah_konfirmasi'] =  $this->pengajuan_model->get_jumlah_pemberitahuan_penduduk($this->session->userdata('nik'));
		$data['surat'] = $this->penduduk_model->get_surat($id);
		$this->load->view('template/header', $data);
		$this->load->view('template/menu_penduduk2', $data);
		$this->load->view('penduduk/edit_surat', $data);
		$this->load->view('template/footer');
	}

	public function belum_di_proses($nik)
	{
		$data['jumlah_konfirmasi'] = $this->pengajuan_model->get_jumlah_pemberitahuan_penduduk($this->session->userdata('nik'));
		$data['title'] = 'Pengajuan Surat yang Belum Diproses';
		$data['surat'] = $this->pengajuan_model->get_surat_belum_di_proses($nik);
		$this->load->view('template/header', $data);
		$this->load->view('template/menu_penduduk2', $data);
		$this->load->view('pengajuan/belum_di_proses', $data);
		$this->load->view('template/footer');
	}

	public function pemberitahuan()
	{
		$data['jumlah_konfirmasi'] = $this->pengajuan_model->get_jumlah_pemberitahuan_penduduk($this->session->userdata('nik'));
		$data['title'] = ' Surat';
		$data['penduduk'] = $this->penduduk_model->get_penduduk_nik($this->session->userdata('nik'));
		$data['pemberitahuan'] = $this->pengajuan_model->get_pemberitahuan_penduduk($this->session->userdata('nik'));
		$this->load->view('template/header', $data);
		$this->load->view('template/menu_penduduk2', $data);
		$this->load->view('pengajuan/pemberitahuan_penduduk', $data);
		$this->load->view('template/footer');
		$this->pengajuan_model->baca_pemberitahuan_penduduk($this->session->userdata('nik'));
	}

	public function pengajuan_surat()
	{
		$pengajuan = $this->pengajuan_model->add_pengajuan();
		if ($pengajuan) {
			$this->session->set_flashdata('pengajuan_surat', 'Pengajuan surat Anda berhasil, tunggu proses dari Desa, jika sudah selesai akan tampil di menu pemberitahuan.');
		}
		redirect('pengajuan/penduduk');
	}

	public function sku()
	{
		$config['upload_path']          = './images/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 4096;
        $config['max_width']            = 5000;
        $config['max_height']           = 5000;

        $this->load->library('upload', $config);

        $upload = $this->upload->do_upload('gambar_persyaratan');
        if (!$upload)
		{
			$this->session->set_flashdata('pengajuan_surat', 'Pengajuan surat Anda Gagal, cek kembali Form Surat yang harus diisi');
		} else {
			$this->pengajuan_model->pengajuan_surat_sku();
			$this->session->set_flashdata('pengajuan_surat', 'Pengajuan surat Anda berhasil, tunggu proses dari Desa, jika sudah selesai akan tampil di menu pemberitahuan.');
			redirect('pengajuan/penduduk');
		}	
		// if ($this->session->userdata('hak') != 'penduduk') {
		// 	redirect('auth');
		// }

		// $data['jumlah_konfirmasi'] = $this->pengajuan_model->get_jumlah_pemberitahuan_penduduk($this->session->userdata('nik'));
		// $data['title'] = 'Form Surat Keterangan Usaha';
		// $data['penduduk'] = $this->penduduk_model->get_penduduk_nik($this->session->userdata('nik'));
		// $data['data_penduduk'] = $this->penduduk_model->get_penduduk_nik($this->session->userdata('nik'));
		// $data['jml_blm_proses'] = $this->pengajuan_model->get_jml_blm_proses($this->session->userdata('nik'));
		// $this->load->view('template/header', $data);
		// $this->load->view('template/menu_penduduk', $data);
		// $this->load->view('surat/sku/form_sku', $data);
		// $this->load->view('template/footer');
	}

	// public function pengajuan_surat_sku()
	// {
	// 	$config['upload_path']          = './images/';
 //        $config['allowed_types']        = 'gif|jpg|png';
 //        $config['max_size']             = 4096;
 //        $config['max_width']            = 5000;
 //        $config['max_height']           = 5000;

 //        $this->load->library('upload', $config);

 //        $upload = $this->upload->do_upload('gambar_persyaratan');
 //        if (!$upload)
	// 	{
	// 		$this->session->set_flashdata('pengajuan_surat', 'Pengajuan surat Anda Gagal, cek kembali Form Surat yang harus diisi');
	// 	} else {
	// 		$this->pengajuan_model->pengajuan_surat_sku();
	// 		$this->session->set_flashdata('pengajuan_surat', 'Pengajuan surat Anda berhasil, tunggu proses dari Desa, jika sudah selesai akan tampil di menu pemberitahuan.');
	// 		redirect('pengajuan/penduduk');
	// 	}
		// if ($upload) {
		// 	$pengajuan_sku = $this->pengajuan_model_sku->add_pengajuan_sku();
		// 	$this->session->set_flashdata('pengajuan_surat', 'Pengajuan surat Anda berhasil, tunggu proses dari Desa, jika sudah selesai akan tampil di menu pemberitahuan.');
		// }
		// redirect('pengajuan/penduduk');

}