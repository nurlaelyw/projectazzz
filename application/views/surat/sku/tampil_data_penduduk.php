<?php
if (count($penduduk) < 1) {
	?>
	<p class="bg-info pesan">Tidak ada data.</p>
	<?php
} else {
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
	foreach ($penduduk as $penduduk) {
		?>
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
				<td>Dusun</td>
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
			<tr>
				<td colspan="3">
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#downloadSurat"
							data-nik="<?= $penduduk->nik; ?>" 
							data-nama="<?= $penduduk->nama; ?>">Pilih
					</button>
				</td>	
			</tr>
		</table>
		<?php
	}
	?>

	<div class="modal fade" id="downloadSurat" tabindex="-1" role="dialog" aria-labelledby="downloadSuratLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="downloadSuratLabel">Buat Surat Keterangan Usaha</h4>
	      </div>
	      <form id="formsurat" method="post" action="<?php echo base_url('surat/sku/download/'.$penduduk->nik); ?>">
	      	<input type="hidden" value="500" name="id_surat" />
		      <div class="modal-body">
			      <div class="form-group">
			        <label for="nik" class="control-label">NIK</label>
			        <input type="text" class="form-control" id="nik" name="nik" value="<?= $penduduk->nik; ?>" readonly>
			      </div>
			      <div class="form-group">
			        <label for="nama" class="control-label">Nama</label>
			        <input type="text" class="form-control" id="nama" name="nama" value="<?= $penduduk->nama; ?>" readonly>
			      </div>
			      <div class="form-group">
		            <label for="data_surat" class="control-label">Usaha</label>
		            <input type="text" class="form-control" id="data_surat" name="data_surat" required>
		            <span id='helpPerihal' class='help-block'>
		            </span>
		          </div>
		          <div class="form-group">
		            <label for="perihal" class="control-label">Perihal</label>
		            <input type="text" class="form-control" id="perihal" name="perihal" required>
		            <span id='helpPerihal' class='help-block'>
		            </span>
		          </div>
		          <div class="form-group">
		            <label for="tujuan" class="control-label">Alamat Usaha</label>
		            <input type="text" class="form-control" id="tujuan" name="tujuan" required>
		            <span id='helpTujuan' class='help-block'>
		            </span>
		          </div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
		        <button type="submit" class="btn btn-primary">Unduh Surat</button>
		      </div>
	      </form>
	    </div>
	  </div>
	</div>

	<script type="text/javascript">
		$('#downloadSurat').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var nik = button.data('nik') // Extract info from data-* attributes
		  var nama = button.data('nama')
		  var tgllahir = button.data('tgllahir')
		  var modal = $(this)
		  modal.find('#nik').val(nik)
		  modal.find('#nama').val(nama)
		  modal.find('#data_surat').val('')
		  modal.find('#perihal').val('')
		  modal.find('#tujuan').val('')
		  var formsurat = document.getElementById("formsurat")
		  var linkaction = "<?= base_url('surat/sku/download'); ?>" + "/" + nik
		  formsurat.action = linkaction
		})
	</script>
	<?php
}
?>