<?php
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
?>
<?php if ($this->session->flashdata('addsuratmasuk')) {
	?> <div class="bg-success pesan">
		<?php echo $this->session->flashdata('addsuratmasuk'); ?>
	</div>
	<?php
	} 
?>

<?php if ($this->session->flashdata('editsuratmasuk')) {
	?> <div class="bg-success pesan">
		<?php echo $this->session->flashdata('editsuratmasuk'); ?>
	</div>
	<?php
	} 
?>

<?php if ($this->session->flashdata('hapussuratmasuk')) {
	?> <div class="bg-success pesan">
		<?php echo $this->session->flashdata('hapussuratmasuk'); ?>
	</div>
	<?php
	} 
?>

<form method="post" action="<?= base_url('arsip/arsip/cari_surat_masuk'); ?>">
<div class='form-inline'>
<div class="input-group">
    	<a class="btn btn-hijau" href="<?php echo base_url('arsip/arsip/suratmasuk'); ?>">
			<i class="fa fa-plus fa-fw" aria-hidden="true"></i> Upload Data Penduduk
		</a>
 	</div>
	<div class="input-group">
    	<a class="btn btn-hijau" href="<?php echo base_url('arsip/arsip/suratmasuk'); ?>">
			<i class="fa fa-plus fa-fw" aria-hidden="true"></i> Tambah Data Penduduk
		</a>
 	</div>
</div>
<br>
<div class="form-inline">
<div class="input-group">
    	<input type="text" class="form-control" placeholder="Masukkan Nama/NIK" name="keyword" required>
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
			<th>NIK</th>
			<th>NO KK </th>
			<th>NAMA</th>
			<th>TEMPAT LAHIR</th>
			<th>TANGGAL LAHIR</th>
            <th>JENIS KELAMIN</th>
            <th>PEKERJAAN</th>
            <th>STATUS</th>
            <th></th>
		</tr>
		<?php
		foreach ($tabelsuratmasuk as $inbox) {
		?>
		<tr>
			<td><?php echo $inbox->nik; ?></td>
			<td><?php echo $inbox->no_kk; ?></td>
			<td><?php echo $inbox->nama; ?></td>
			<td><?php echo $inbox->tempat_lahir; ?></td>
            <?php
		    $tanggal_lahir = explode('-', $inbox->tanggal_lahir);
	        ?>
            <td><?= $tanggal_lahir[2].' '.$nama_bulan[$tanggal_lahir[1]].' '.$tanggal_lahir[0]; ?></td>
			<td>
                <?php 
                    if($inbox->jenis_kelamin == "L"){
                        echo "Laki-Laki";
                    }else{
                        echo "Perempuan";
                    }
                ?>
            </td>
            <td><?php echo $inbox->pekerjaan; ?></td>
            <td><?php echo $inbox->status; ?></td>
			<td>
                <div class="modal fade" id="pengajuanSktm" tabindex="-1" role="dialog" aria-labelledby="pengajuanSktmLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Tutup"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="pengajuanSktmLabel">Pengajuan Pembuatan Surat Keterangan Tidak Mampu</h4>
                        </div>
                        <form id="formsurat" method="post" action="<?php echo base_url('pengajuan/penduduk/pengajuan_surat'); ?>">
                            <input type="hidden" value="463" name="id_surat" />
                            <div class="modal-body">
                            <div class="form-group">
                                <label for="nik" class="control-label">NIK</label>
                                <input type="text" class="form-control" id="nik" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nama" class="control-label">Nama</label>
                                <input type="text" class="form-control" id="nama" readonly>
                            </div>
                            <div class="form-group">
                                <label for="data_surat" class="control-label">Untuk Mendapatkan</label>
                                <input type="text" class="form-control" id="data_surat" name="data_surat" required>
                                <span id='helpPerihal' class='help-block'>
                                Contoh: Beasiswa
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="perihal" class="control-label">Perihal</label>
                                <input type="text" class="form-control" id="perihal" name="perihal" required>
                                <span id='helpPerihal' class='help-block'>
                                Contoh: Permohonan beasiswa
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="tujuan" class="control-label">Tujuan</label>
                                <input type="text" class="form-control" id="tujuan" name="tujuan" required>
                                <span id='helpTujuan' class='help-block'>
                                Contoh: Universitas Kuningan
                                </span>
                            </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Ajukan</button>
                            </div>
                        </form>
                        </div>
                    </div>
                    </div>  	
            <a href="<?php echo base_url('arsip/arsip/editsuratmasuk/'.$inbox->nik); ?>" class="btn btn-warning btn-sm"><i class="fa fa-eye fa-fw" aria-hidden="true"></i> Detail</a>
				<!-- <a href="#" class="btn btn-danger btn-sm" onclick="conDelMasuk('<?= $inbox->nik; ?>', '<?= $inbox->nomor_surat; ?>')"><i class="fa fa-trash fa-fw" aria-hidden="true"></i> Hapus</a> -->
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