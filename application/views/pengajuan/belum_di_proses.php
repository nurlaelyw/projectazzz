<div class="konten">
<?php 
if ($this->session->flashdata('edit_surat')) {
	?>
	<div class="bg-success pesan">
		<?php echo $this->session->flashdata('edit_surat'); ?>
	</div>
	<?php
}

if ($this->session->flashdata('delete_surat')) {
	?>
	<div class="bg-success pesan">
		<?php echo $this->session->flashdata('delete_surat'); ?>
	</div>
	<?php
}

if (count($surat) < 1) {
	?>
	<p class="bg-info pesan">Tidak ada data.</p>
	<?php
} else {
	?>
	<table>
		<tr>
			<th>No</th>
			<th>Jenis Surat</th>
			<th>Uraian Perihal</th>
			<th>Tujuan Surat</th>
			<th>Data Surat*</th>
			<th>Kelola</th>
		</tr>
		<?php
		$no = 1;
		foreach ($surat as $surat) {
			?>
			<tr>
				<td><?= $no; ?></td>
				<td><?= $surat->nama_surat; ?></td>
				<td><?php echo $surat->uraian_perihal; ?></td>
				<td><?php echo $surat->tujuan_surat; ?></td>
				<td><?php if ($surat->data_surat == '0') { echo '-'; } else { echo $surat->data_surat; } ?></td>
				<td>
					<a href="<?php echo base_url('pengajuan/penduduk/edit_surat/'.$surat->id_pengajuan_surat); ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit fa-fw" aria-hidden="true"></i> Edit</a>
					<a href="#" class="btn btn-danger btn-sm" onclick="conDelSurat('<?= $surat->id_pengajuan_surat; ?>', '<?= $no; ?>')"><i class="fa fa-trash fa-fw" aria-hidden="true"></i> Hapus</a>
				</td>
			</tr>
			<?php
			$no++;
		}
		?>
	</table>
	<br><br>
	<p style="color: #aaa">
		*Data Surat:
		<ul style="color: #aaa">
			<li>Surat Keterangan Usaha: Usaha</li>
			<li>Surat Keterangan Tidak Mampu: Untuk</li>
			<li>Surat Keterangan Domisili: Tahun</li>
			<li>Surat Keterangan Belum Pernah Menikah: -</li>
		</ul>
	</p>
	<?php
}
?>
</div>