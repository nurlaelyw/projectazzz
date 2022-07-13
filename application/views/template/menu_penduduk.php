<nav class="navbar navbar-default navbar-fixed-top">
<div class="container-fluid">
	<a class="navbar-brand" href="<?= base_url(); ?>">Kelurahan 30 Ilir Palembang</a>
	<ul class="nav navbar-nav navbar-right">
		<li class="<?php if($this->uri->segment(3)==""){echo "active";} ?>">
			<a href="<?= base_url(); ?>">Beranda</a>
		</li>
		<li class="<?php if($this->uri->segment(3)=="pemberitahuan"){echo "active";} ?>">
			<a href="<?php echo base_url('pengajuan/penduduk/pemberitahuan'); ?>">Notifikasi <?php if ($jumlah_konfirmasi > 0) { ?><span class='badge badge-error'><?= $jumlah_konfirmasi ?></span><?php } ?></a>
		</li>
		<li><a href="<?php echo base_url('auth/logout'); ?>">Logout</a></li>
	</ul>
</div>
</nav>
<div class="konten">
	<h1><?php echo $title; ?></h1>
	<h4>
		<?php
			if ($penduduk->jenis_kelamin == 'L') {
				echo "Anda saat ini login sebagai Saudara ".$penduduk->nama;
			} else {
				echo "Anda saat ini login sebagai Saudari ".$penduduk->nama;
			}

			if ($jml_blm_proses > 0) {
				echo ". Dan memiliki <a href='".base_url('pengajuan/penduduk/belum_di_proses/'.$this->session->userdata('nik'))."'>".$jml_blm_proses." pengajuan surat yang belum diproses</a> oleh Desa.";
			}
		?>
	</h4>
	<hr>