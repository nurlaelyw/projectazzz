<?php
class Arsip extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('arsip_model');
		$this->load->model('pengajuan_model');
		$this->load->helper(array('form', 'url'));
		$this->load->library('pagination');
		$this->load->database();
	}

	public function index()
	{
		if ($this->session->userdata('hak') != 'admin') {
			redirect('auth');
		}
		$data['title'] = 'Arsip';
		$data['jumlah_pengajuan'] = $this->pengajuan_model->get_jumlah_pengajuan();
		$this->load->view('template/header', $data);
		$this->load->view('template/menu', $data);
		$this->load->view('arsip/arsip');
		$this->load->view('template/footer');
	}

	public function cari_surat_keluar()
	{
		if ($this->session->userdata('hak') != 'admin') {
			redirect('auth');
		}
		$data['tabelsuratkeluar'] = $this->arsip_model->cari_surat_keluar();
		$data['jumlah_pengajuan'] = $this->pengajuan_model->get_jumlah_pengajuan();
		$data['title'] = 'Arsip Surat Keluar';
		$this->load->view('template/header', $data);
		$this->load->view('template/menu', $data);
		$this->load->view('arsip/carisuratkeluar', $data);
		$this->load->view('template/footer');
	}

	public function cari_surat_masuk()
	{
		if ($this->session->userdata('hak') != 'admin') {
			redirect('auth');
		}

		$data['tabelsuratmasuk'] = $this->arsip_model->cari_surat_masuk();
		$data['title'] = 'Arsip Surat Masuk';
		$data['jumlah_pengajuan'] = $this->pengajuan_model->get_jumlah_pengajuan();
		$this->load->view('template/header', $data);
		$this->load->view('template/menu', $data);
		$this->load->view('arsip/carisuratmasuk', $data);
		$this->load->view('template/footer');
	}

	public function suratmasuk()
	{
		if ($this->session->userdata('hak') != 'admin') {
			redirect('auth');
		}
		$data['title'] = 'Tambah Arsip Surat Masuk';
		$data['jumlah_pengajuan'] = $this->pengajuan_model->get_jumlah_pengajuan();
		$this->load->view('template/header', $data);
		$this->load->view('template/menu', $data);
		$this->load->view('arsip/suratmasuk');
		$this->load->view('template/footer');
	}

	public function tabelsuratmasuk()
	{
		if ($this->session->userdata('hak') != 'admin') {
			redirect('auth');
		}

		$config['base_url']=base_url()."arsip/arsip/tabelsuratmasuk";
		$config['total_rows']= $this->db->query("SELECT * FROM surat_masuk")->num_rows();
		$config['per_page']=2;
		$config['num_links'] = 2;
		$config['uri_segment']=4;

	   	$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] ="</ul>";
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] = "<li>";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>";
	    $config['first_link']='<< ';
	    $config['last_link']='>> ';
	    $config['next_link']='> ';
	    $config['prev_link']='< ';
	    $this->pagination->initialize($config);

		$data['tabelsuratmasuk'] = $this->arsip_model->get_pag_surat_masuk($config);
		$data['title'] = 'Arsip Surat Masuk';
		$data['jumlah_pengajuan'] = $this->pengajuan_model->get_jumlah_pengajuan();
		$this->load->view('template/header', $data);
		$this->load->view('template/menu', $data);
		$this->load->view('arsip/tabelsuratmasuk', $data);
		$this->load->view('template/footer');
	}

	public function tambahsuratmasuk()
	{
		if ($this->session->userdata('hak') != 'admin') {
			redirect('auth');
		}
		$this->form_validation->set_rules('nomor_surat', 'No Surat', 'required');
		$this->form_validation->set_rules('uraian_perihal', 'Uraian', 'required');
		$this->form_validation->set_rules('asal_surat', 'Asal Surat', 'required');
		$this->form_validation->set_rules('tanggal_surat', 'Tanggal', 'required');
		$this->form_validation->set_rules('gambar_surat', 'File Foto', 'required');

		if ($this->form_validation->run() === FALSE)
		{
			$data['jumlah_pengajuan'] = $this->pengajuan_model->get_jumlah_pengajuan();
			$data['title'] = 'Arsip Surat Masuk';
			$this->load->view('template/header');
			$this->load->view('template/menu', $data);
			$this->session->set_flashdata('failaddsuratmasuk', 'Isi lengkap form yang tersedia');
			redirect('arsip/arsip/suratmasuk');
			$this->load->view('template/footer');
		} else {
			$data['tambahsuratmasuk'] = $this->arsip_model->tambahsuratmasuk();
			$this->session->set_flashdata('addsuratmasuk', 'Berhasil mengarsipkan surat.');
			redirect('arsip/arsip/tabelsuratmasuk');
		}
	}

	public function editsuratmasuk($id_surat_masuk)
	{
		if ($this->session->userdata('hak') != 'admin') {
			redirect('login');
		}
		$this->form_validation->set_rules('nomor_surat', 'No Surat', 'required');
		$this->form_validation->set_rules('uraian_perihal', 'Uraian', 'required');
		$this->form_validation->set_rules('asal_surat', 'Asal Surat', 'required');
		$this->form_validation->set_rules('tanggal_surat', 'Tanggal', 'required');

		if ($this->form_validation->run() === FALSE) {
			$data['tabelsuratmasuk'] = $this->arsip_model->ambildatasuratmasukid($id_surat_masuk);
			$data['jumlah_pengajuan'] = $this->pengajuan_model->get_jumlah_pengajuan();
			$data['title'] = 'Edit Arsip Surat Masuk';
			$this->load->view('template/header', $data);
			$this->load->view('template/menu', $data);
			$this->load->view('arsip/formeditsuratmasuk');
			$this->load->view('template/footer');
		} else {
			$editsuratmasuk = $this->arsip_model->editsuratmasuk($id_surat_masuk);
			$this->session->set_flashdata('editsuratmasuk', 'Arsip surat berhasil diedit.');
			redirect('arsip/arsip/tabelsuratmasuk');
		}
	}

	public function hapussuratmasuk($id_surat_masuk)
	{
		if ($this->session->userdata('hak') != 'admin') {
			redirect('auth');
		}
		$this->arsip_model->hapussuratmasuk($id_surat_masuk);
		$this->session->set_flashdata('hapussuratmasuk', 'Arsip surat berhasil dihapus.');
		redirect('arsip/arsip/tabelsuratmasuk');
	}


	public function suratkeluar()
	{
		if ($this->session->userdata('hak') != 'admin') {
			redirect('auth');
		}
		$data['title'] = 'Tambah Arsip Surat Keluar';
		$data['jumlah_pengajuan'] = $this->pengajuan_model->get_jumlah_pengajuan();
		$data['surat_keluar'] = $this->arsip_model->get_surat_keluar();
		$this->load->view('template/header', $data);
		$this->load->view('template/menu', $data);
		$this->load->view('arsip/suratkeluar', $data);
		$this->load->view('template/footer');
	}

	public function tabelsuratkeluar()
	{
		if ($this->session->userdata('hak') != 'admin') {
			redirect('auth');
		}

		$config['base_url']=base_url()."arsip/arsip/tabelsuratkeluar";
		$config['total_rows']= $this->db->query("SELECT * FROM surat_keluar;")->num_rows();
		$config['per_page']=2;
		$config['num_links'] = 2;
		$config['uri_segment']=4;

	   	$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] ="</ul>";
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] = "<li>";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>";
	    $config['first_link']='<< ';
	    $config['last_link']='>> ';
	    $config['next_link']='> ';
	    $config['prev_link']='< ';
	    $this->pagination->initialize($config);

		$data['tabelsuratkeluar'] = $this->arsip_model->get_pag_surat_keluar($config);
		$data['jumlah_pengajuan'] = $this->pengajuan_model->get_jumlah_pengajuan();
		$data['title'] = 'Arsip Surat Keluar';
		$this->load->view('template/header', $data);
		$this->load->view('template/menu', $data);
		$this->load->view('arsip/tabelsuratkeluar', $data);
		$this->load->view('template/footer');
	}

	public function tambahsuratkeluar()
	{
		if ($this->session->userdata('hak') != 'admin') {
			redirect('auth');
		}

			$this->arsip_model->surat_diarsipkan($this->input->post('id_pengajuan_surat'));
			$this->arsip_model->tambahsuratkeluar();
			$this->session->set_flashdata('addsuratkeluar', 'Berhasil mengarsipkan surat.');
			redirect('arsip/arsip/tabelsuratkeluar');
		
	}

	public function editsuratkeluar($idsuratkeluar)
	{
		if ($this->session->userdata('hak') != 'admin') {
			redirect('login');
		}
		$this->form_validation->set_rules('nomor_surat', 'No Surat', 'required');
		$this->form_validation->set_rules('uraian_perihal', 'Uraian', 'required');
		$this->form_validation->set_rules('tujuan_surat', 'Tujuan Surat', 'required');
		$this->form_validation->set_rules('tanggal_surat', 'Tanggal', 'required');

		if ($this->form_validation->run() === FALSE) {
			$data['tabelsuratkeluar'] = $this->arsip_model->ambildatasuratkeluarid($idsuratkeluar);
			$data['title'] = 'Edit Arsip Surat Keluar';
			$data['jumlah_pengajuan'] = $this->pengajuan_model->get_jumlah_pengajuan();
			$this->load->view('template/header', $data);
			$this->load->view('template/menu', $data);
			$this->load->view('arsip/formeditsuratkeluar', $data);
			$this->load->view('template/footer');
		} else {
			$editsuratkeluar = $this->arsip_model->editsuratkeluar($idsuratkeluar);
			$this->session->set_flashdata('editsuratkeluar', 'Arsip surat berhasil diedit.');
			redirect('arsip/arsip/tabelsuratkeluar');
		}
	}

	public function hapussuratkeluar($idsuratkeluar)
	{
		if ($this->session->userdata('hak') != 'admin') {
			redirect('auth');
		}
		$this->arsip_model->hapussuratkeluar($idsuratkeluar);
		$this->session->set_flashdata('hapussuratkeluar', 'Arsip surat berhasil dihapus.');
		redirect('arsip/arsip/tabelsuratkeluar');
	}


}
