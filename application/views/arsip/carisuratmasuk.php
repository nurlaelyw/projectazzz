<form method="post" action="<?= base_url('arsip/arsip/cari_surat_masuk'); ?>">
<div class='form-inline'>
	<div class="input-group">
    	<a class="btn btn-hijau" href="<?php echo base_url('arsip/arsip/tabelsuratmasuk'); ?>">
			<i class="fa fa-arrow-left fa-fw" aria-hidden="true"></i> Awal
		</a>
 	</div>
	<div class="input-group">
    	<input type="text" class="form-control" placeholder="Nomor / Perihal / Asal" name="keyword" required>
    	<span class="input-group-btn">
	        <button class="btn btn-default" type="submit"><i class="fa fa-search fa-fw" aria-hidden="true"></i> Cari</button>
	    </span>
  	</div>
</div>
</form>

<?php
if (count($tabelsuratmasuk) < 1) {
	?>
	<p class="bg-info pesan">Tidak ada data.</p>
	<?php
} else {
	?>
	<table>
		<tr>
			<th>No Surat</th>
			<th>Uraian Perihal</th>
			<th>Asal Surat</th>
			<th>Tanggal</th>
			<th>Gambar</th>
			<th>Kelola</th>
		</tr>
		<?php
		foreach ($tabelsuratmasuk as $inbox) {
		?>
		<tr>
			<td><?php echo $inbox->nomor_surat; ?></td>
			<td><?php echo $inbox->uraian_perihal; ?></td>
			<td><?php echo $inbox->asal_surat; ?></td>
			<td><?php echo $inbox->tanggal_surat; ?></td>
			<td><a href="<?= base_url('images/'.$inbox->gambar_surat) ?>" class="btn btn-default btn-sm"><i class="fa fa-eye fa-fw" aria-hidden="true"></i> Lihat</a></td>
			<td>
				<a href="<?php echo base_url('arsip/arsip/editsuratmasuk/'.$inbox->id_surat_masuk); ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit fa-fw" aria-hidden="true"></i> Edit</a>
				<!-- <a href="<?php echo base_url('arsip/arsip/hapussuratmasuk/'.$inbox->id_surat_masuk); ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash fa-fw" aria-hidden="true"></i> Hapus</a> -->
			</td>
		</tr>
		<?php
		}
		?>
	</table>
	<?php
	echo $this->pagination->create_links();
}
?>