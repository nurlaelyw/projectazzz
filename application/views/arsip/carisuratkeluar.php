<form method="post" action="<?= base_url('arsip/arsip/cari_surat_keluar'); ?>">
<div class='form-inline'>
	<div class="input-group">
    	<a class="btn btn-hijau" href="<?php echo base_url('arsip/arsip/tabelsuratkeluar'); ?>">
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
if (count($tabelsuratkeluar) < 1) {
	?>
	<p class="bg-info pesan">Tidak ada data.</p>
	<?php
} else {
	?>
	<table>
		<tr>
			<th>No Surat</th>
			<th>Uraian Perihal</th>
			<th>Tujuan Surat</th>
			<th>Tanggal</th>
			<th>Gambar</th>
			<th>Kelola</th>
		</tr>
		<?php
		foreach ($tabelsuratkeluar as $outbox) {
		$penanggung_jawab;
		switch ($outbox->id_surat) {
			case '500':
				$penanggung_jawab = 'Ekbang';
				break;
			case '463':
				$penanggung_jawab = 'Kesra';
				break;
			case '474':
				$penanggung_jawab = 'Kepend';
			case '400':
				$penanggung_jawab = 'Kesra';
				break;
		}
		?>
		<tr>
			<td>
				<?php echo $outbox->id_surat.'/'.str_pad($outbox->nomor_surat,3,'0',STR_PAD_LEFT).'/'.$penanggung_jawab.'/'.$outbox->tahun; ?>	
			</td>
			<td><?php echo $outbox->uraian_perihal; ?></td>
			<td><?php echo $outbox->tujuan_surat; ?></td>
			<td><?php echo $outbox->tanggal_surat; ?></td>
			<td><a href="<?= base_url('images/'.$outbox->gambar_surat) ?>" class="btn btn-default btn-sm"><i class="fa fa-eye fa-fw" aria-hidden="true"></i> Lihat</a></td>
			<td>
				<a href="<?php echo base_url('arsip/arsip/editsuratkeluar/'.$outbox->id_surat_keluar); ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit fa-fw" aria-hidden="true"></i> Edit</a>
				<!-- <a href="<?php echo base_url('arsip/arsip/hapussuratkeluar/'.$outbox->id_surat_keluar); ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash fa-fw" aria-hidden="true"></i> Hapus</a> -->
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