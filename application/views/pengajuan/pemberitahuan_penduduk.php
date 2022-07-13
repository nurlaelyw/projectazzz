<div class="konten">
<div class='pengajuan'>
<?php
if (count($pemberitahuan) < 1) {
	?>
	<p class="bg-info pesan">Tidak ada pemberitahuan.</p>
	<?php
} else {
	foreach ($pemberitahuan as $pemberitahuan) {
		if ($pemberitahuan->status == '0') {
			echo 'Pengajuan <b>'.$pemberitahuan->nama_surat.'</b> Anda <b> ditolak</b> dikarenakan <b>'.$pemberitahuan->pesan.'</b>.<hr>';
		} else {
			echo '<b>'.$pemberitahuan->nama_surat.'</b> Anda telah selesai diproses dan dapat diambil di kantor Desa.<hr>';
		}
	}
}
?>
</div>
</div>