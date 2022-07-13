<div class="konten">
<div class='pengajuan'>
<?php
if (count($pengajuan) < 1) {
	?>
	<p class="bg-info pesan">Tidak ada pemberitahuan.</p>
	<?php
} else {
	foreach ($pengajuan as $pengajuan) {
		echo "<b>".$pengajuan->nama."</b> mengajukan <b>".$pengajuan->nama_surat."</b> ";
		?>
		<a href="
			<?php
				switch ($pengajuan->id_surat) {
					case 500:
						echo base_url("pengajuan/admin/sku/".$pengajuan->id_pengajuan_surat);
						break;
					case 463:
						echo base_url("pengajuan/admin/sktm/".$pengajuan->id_pengajuan_surat);
						break;
					case 474:
						echo base_url("pengajuan/admin/skd/".$pengajuan->id_pengajuan_surat);
						break;
					case 400:
						echo base_url("pengajuan/admin/skbpm/".$pengajuan->id_pengajuan_surat);
						break;
				}
			?>">lihat</a>.
		<hr>
		<?php
	}
}
?>
</div>
</div>

<?php
if ($this->session->flashdata('filename')) {
	?>
	<script type="text/javascript">
		window.location.href = "<?= base_url().'asset/surat/'.$this->session->flashdata('filename'); ?>";
	</script>
	<?php
}
?>