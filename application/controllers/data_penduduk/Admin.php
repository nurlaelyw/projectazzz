<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->model('data_penduduk');
		$this->load->model('pengajuan_model');
		$this->load->helper(array('form', 'url'));
		$this->load->library('pagination');
		$this->load->database();
	}

    public function data_penduduk()
	{
        if ($this->session->userdata('hak') != 'admin') {
			redirect('auth');
		}

		$config['base_url']=base_url()."data_penduduk/admin/data_penduduk";
		$config['total_rows']= $this->db->query("SELECT * FROM data_penduduk")->num_rows();
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

		$data['title'] = 'Data Penduduk';
		$data['tabelsuratmasuk'] = $this->data_penduduk->get_pag_surat_masuk($config);
		$data['jumlah_pengajuan'] = $this->pengajuan_model->get_jumlah_pengajuan();
		$this->load->view('template/header', $data);
		$this->load->view('template/menu3', $data);
		$this->load->view('data_penduduk', $data);
		$this->load->view('template/footer');
	}

}
    ?>