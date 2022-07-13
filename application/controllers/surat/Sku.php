<?php
class Sku extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('phpWord');
		$this->load->model('penduduk_model');
		$this->load->model('pengajuan_model');
	}

	public function index()
	{
		if ($this->session->userdata('hak') != 'admin') {
			redirect('auth');
		}

		$this->form_validation->set_rules('keyword', 'Nama / NIK', 'required');

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Cari Data Penduduk';
			$data['jumlah_pengajuan'] = $this->pengajuan_model->get_jumlah_pengajuan();
			$this->load->view('template/header', $data);
			$this->load->view('template/menu', $data);
			$this->load->view('surat/sku/cari_data_penduduk');
			$this->load->view('template/footer');
		} else {
			$data['title'] = 'Buat Surat Keterangan Usaha';
			$data['jumlah_pengajuan'] = $this->pengajuan_model->get_jumlah_pengajuan();
			$data['penduduk'] = $this->penduduk_model->get_penduduk($this->input->post('keyword'));
			$this->load->view('template/header', $data);
			$this->load->view('template/menu', $data);
			$this->load->view('surat/sku/cari_data_penduduk');
			$this->load->view('surat/sku/tampil_data_penduduk', $data);
			$this->load->view('template/footer');
		}
	}

	public function download_id($id)
	{
		$nama_bulan = array(
			'01' => 'Januari',
			'02' => 'Februari',
			'03' => 'Maret',
			'04' => 'April',
			'05' => 'Mei',
			'06' => 'Juni',
			'07' => 'Juli',
			'08' => 'Agustus',
			'09' => 'September',
			'10' => 'Oktober',
			'11' => 'November',
			'12' => 'Desember'
		);

		$this->pengajuan_model->baca_notif_pengajuan($id);
		$this->pengajuan_model->add_notif_penduduk($id);
		$data = $this->pengajuan_model->get_penduduk($id);

		$tanggal_lahir = explode('-', $data->tanggal_lahir);
		$tanggal_surat = explode('-', $data->tanggal_surat);

		$no_surat = str_pad($data->nomor_surat,3,'0',STR_PAD_LEFT);
		$tahun = $data->tahun;
		$nama = $data->nama;
		$nik = $data->nik;
		$ttl = $data->nama_tempat_lahir.", ".$tanggal_lahir[2].' '.$nama_bulan[$tanggal_lahir[1]].' '.$tanggal_lahir[0];
		$dsn = $data->nama_dusun;
		$rt = $data->no_rt;
		$rw = $data->no_rw;
		$usaha = $data->data_surat;
		$usaha_array = explode(' ', $usaha);
		$usaha = null;
		foreach ($usaha_array as $usaha_array) {
			$usaha = $usaha.' '.ucfirst($usaha_array);
		}
		$tgl_surat = $tanggal_surat[2].' '.$nama_bulan[$tanggal_surat[1]].' '.$tanggal_surat[0];
		$hal = strtolower($data->uraian_perihal);
		$hal_array = explode(' ', $hal);
		$hal = null;
		foreach ($hal_array as $hal_array) {
			$hal =  $hal.' '.ucfirst($hal_array);	
		}

		$surat = new \PhpOffice\PhpWord\TemplateProcessor('asset/surat/'.$data->file_surat);
		$surat->setValue('no_surat', $no_surat);
		$surat->setValue('tahun', $tahun);
		$surat->setValue('nama', $nama);
		$surat->setValue('nik', $nik);
		$surat->setValue('ttl', $ttl);
		$surat->setValue('dsn', $dsn);
		$surat->setValue('rt', $rt);
		$surat->setValue('rw', $rw);
		$surat->setValue('usaha', $usaha);
		$surat->setValue('tgl_surat', $tgl_surat);
		$surat->setValue('hal', $hal);

		$filename = $data->nama_surat.' Update.docx';
		$surat->saveAs('asset/surat/'.$filename);
		$this->session->set_flashdata('filename', $filename);
		redirect('pengajuan/admin/notif');
		//header('location:'.base_url().'asset/surat/'.$filename);
	}

	public function download($nik)
	{
		$this->pengajuan_model->add_pengajuan_admin($nik);
		$id_pengajuan = $this->pengajuan_model->get_last_id_nik($nik)->id_pengajuan_surat;
		$nama_bulan = array(
			'01' => 'Januari',
			'02' => 'Februari',
			'03' => 'Maret',
			'04' => 'April',
			'05' => 'Mei',
			'06' => 'Juni',
			'07' => 'Juli',
			'08' => 'Agustus',
			'09' => 'September',
			'10' => 'Oktober',
			'11' => 'November',
			'12' => 'Desember'
		);

		$data = $this->pengajuan_model->get_penduduk($id_pengajuan);

		$tanggal_lahir = explode('-', $data->tanggal_lahir);
		$tanggal_surat = explode('-', $data->tanggal_surat);

		$no_surat = str_pad($data->nomor_surat,3,'0',STR_PAD_LEFT);
		$tahun = $data->tahun;
		$nama = $data->nama;
		$nik = $data->nik;
		$ttl = $data->nama_tempat_lahir.", ".$tanggal_lahir[2].' '.$nama_bulan[$tanggal_lahir[1]].' '.$tanggal_lahir[0];
		$dsn = $data->nama_dusun;
		$rt = $data->no_rt;
		$rw = $data->no_rw;
		$usaha = $data->data_surat;
		$usaha_array = explode(' ', $usaha);
		$usaha = null;
		foreach ($usaha_array as $usaha_array) {
			$usaha = $usaha.' '.ucfirst($usaha_array);
		}
		$tgl_surat = $tanggal_surat[2].' '.$nama_bulan[$tanggal_surat[1]].' '.$tanggal_surat[0];
		$hal = strtolower($data->uraian_perihal);
		$hal_array = explode(' ', $hal);
		$hal = null;
		foreach ($hal_array as $hal_array) {
			$hal =  $hal.' '.ucfirst($hal_array);	
		}

		$surat = new \PhpOffice\PhpWord\TemplateProcessor('asset/surat/'.$data->file_surat);
		$surat->setValue('no_surat', $no_surat);
		$surat->setValue('tahun', $tahun);
		$surat->setValue('nama', $nama);
		$surat->setValue('nik', $nik);
		$surat->setValue('ttl', $ttl);
		$surat->setValue('dsn', $dsn);
		$surat->setValue('rt', $rt);
		$surat->setValue('rw', $rw);
		$surat->setValue('usaha', $usaha);
		$surat->setValue('tgl_surat', $tgl_surat);
		$surat->setValue('hal', $hal);

		$filename = $data->nama_surat.' Update.docx';
		$surat->saveAs('asset/surat/'.$filename);
		header('location:'.base_url().'asset/surat/'.$filename);
	}

}