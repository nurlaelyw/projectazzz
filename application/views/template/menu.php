<nav class="navbar navbar-default navbar-fixed-top">
<div class="container-fluid">
	<a class="navbar-brand" href="<?= base_url(); ?>">Kelurahan 30 Ilir Palembang</a>
	<ul class="nav navbar-nav navbar-right">
		<li class="<?php if($this->uri->segment(1)=="pengajuan"){echo "active";} ?>">
			<a href="<?php echo base_url('pengajuan/admin/notif'); ?>">Notifikasi <?php if ($jumlah_pengajuan > 0) { ?><span class="badge badge-error"><?= $jumlah_pengajuan ?></span><?php } ?></a>
		</li>
		<li class="<?php if($this->uri->segment(1)=="data_penduduk"){echo "active";} ?>">
			<a href="<?php echo base_url('data_penduduk/admin/data_penduduk'); ?>">Data Penduduk <?php if ($jumlah_pengajuan > 0) { ?><span class="badge badge-error"><?= $jumlah_pengajuan ?></span><?php } ?></a>
		</li>
		<li class="<?php if($this->uri->segment(1)=="surat"){echo "active";} ?>">
			<a href="<?php echo base_url('surat/daftar'); ?>">Surat</a>
		</li>
        <li class="dropdown <?php if($this->uri->segment(1)=="arsip"){echo "active";} ?>">
        	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Arsip <span class="caret"></span></a>
        	<ul class="dropdown-menu">
        		<li><a href="<?= base_url('arsip/arsip/tabelsuratmasuk'); ?>">Surat Masuk</a></li>
            	<li><a href="<?= base_url('arsip/arsip/tabelsuratkeluar'); ?>">Surat Keluar</a></li>
        	</ul>
		</li>
        <li><a href="<?php echo base_url('auth/logout'); ?>">Logout</a></li>
	</ul>
</div>
</nav>
<div class="konten">
	<h1><?php echo $title; ?></h1>
	<hr>