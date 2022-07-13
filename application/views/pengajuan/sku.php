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

<h2>Data Penduduk</h2>
<table class="profil">
	<tr>
		<td width="25%">NIK</td>
		<td width="5%">:</td>
		<td width="70%"><?= $penduduk->nik; ?></td>
	</tr>
	<tr>
		<td>Nama</td>
		<td>:</td>
		<td><?= $penduduk->nama; ?></td>
	</tr>
	<tr>
		<td>Dususn</td>
		<td>:</td>
		<td><?= $penduduk->nama_dusun; ?></td>
	</tr>
	<tr>
		<td>RT</td>
		<td>:</td>
		<td><?= $penduduk->no_rt; ?></td>
	</tr>
	<tr>
		<td>RW</td>
		<td>:</td>
		<td><?= $penduduk->no_rw; ?></td>
	</tr>
	<?php
		$jenis_kelamin = 'Perempuan';
		if ($penduduk->jenis_kelamin == 'L') {
			$jenis_kelamin = 'Laki-laki';
		}
	?>
	<tr>
		<td>Jenis Kelamin</td>
		<td>:</td>
		<td><?= $jenis_kelamin; ?></td>
	</tr>
	<tr>
		<td>Tempat Lahir</td>
		<td>:</td>
		<td><?= $penduduk->nama_tempat_lahir; ?></td>
	</tr>
	<?php
		$tanggal_lahir = explode('-', $penduduk->tanggal_lahir);
	?>
	<tr>
		<td>Tanggal Lahir</td>
		<td>:</td>
		<td><?= $tanggal_lahir[2].' '.$nama_bulan[$tanggal_lahir[1]].' '.$tanggal_lahir[0]; ?></td>
	</tr>
	<tr>
		<td>Agama</td>
		<td>:</td>
		<td><?= $penduduk->nama_agama; ?></td>
	</tr>
	<tr>
		<td>Status</td>
		<td>:</td>
		<td><?= $penduduk->status_perkawinan; ?></td>
	</tr>
	<tr>
		<td>Pendidikan</td>
		<td>:</td>
		<td><?= $penduduk->nama_pendidikan; ?></td>
	</tr>
	<tr>
		<td>Pekerjaan</td>
		<td>:</td>
		<td><?= $penduduk->nama_pekerjaan; ?></td>
	</tr>
</table>

<br>
<h2>Data Pengajuan Surat</h2>
<form class="add-form" data-toggle="validator" role="form" method="post" 
	action="<?= base_url('surat/sku/download_id/'.$pengajuan->id_pengajuan_surat) ?>">
	<div class="form-group">
		<label for="inputNik" class="control-label">NIK</label>
		<input type="text" class="form-control" id="inputNik" name="nik" 
			value="<?= $pengajuan->nik; ?>" readonly>
	</div>
	<div class="form-group">
		<label for="inputNama" class="control-label">Nama</label>
		<input type="text" class="form-control" id="inputNama" name="nama" 
			value="<?= $pengajuan->nama; ?>" readonly>
	</div>
	<div class="form-group">
		<label for="inputDataSurat" class="control-label">Usaha</label>
		<input type="text" class="form-control" id="inputDataSurat" name="data_surat" 
			value="<?= $pengajuan->data_surat; ?>" readonly>
	</div>
	<div class="form-group">
		<label for="inputPerihal" class="control-label">Perihal</label>
		<input type="text" class="form-control" id="inputPerihal" name="perihal" 
			value="<?= $pengajuan->uraian_perihal; ?>" readonly>
	</div>
	<div class="form-group">
		<label for="inputTujuan" class="control-label">Tujuan</label>
		<input type="text" class="form-control" id="inputTujuan" name="tujuan" 
			value="<?= $pengajuan->tujuan_surat; ?>" readonly>
	</div>
	<div class="form-group">
		<label for="inputTujuan" class="control-label">Gambar</label>
		<br>
			<a href="<?php echo base_url('images/'.$pengajuan->gambar); ?>"><img src="<?php echo base_url('images/'.$pengajuan->gambar); ?>" width="400" /></a>
        <br>
	</div>	
	<button type="submit" class="btn btn-primary">Terima Pengajuan</button>
	<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#tolakPengajuan"
	data-id="<?= $pengajuan->id_pengajuan_surat; ?>">Tolak Pengajuan</button>
</form>

<div class="modal fade" id="tolakPengajuan" tabindex="-1" role="dialog" aria-labelledby="pengajuanSktmLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="pengajuanSktmLabel">Tolak Pengajuan</h4>
      </div>
      <form id="formsurat" method="post" action="#">
        <input type="hidden" value="<?= $pengajuan->id_pengajuan_surat ?>" name="id_pengajuan_surat" />
        <div class="modal-body">
          <div class="form-group">
            <label for="data_surat" class="control-label">Alasan</label>
            <textarea class="form-control" rows="7" name="pesan" required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-danger">Tolak Pengajuan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
  $('#tolakPengajuan').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id_pengajuan_surat = button.data('id_pengajuan_surat') // Extract info from data-* attributes
    var modal = $(this)
    modal.find('#id_pengajuan_surat').val(id_pengajuan_surat)
    modal.find('#pesan').val('')
    var formsurat = document.getElementById("formsurat")
    var linkaction = "<?= base_url('pengajuan/admin/tolak'); ?>"
    formsurat.action = linkaction
  })
</script>