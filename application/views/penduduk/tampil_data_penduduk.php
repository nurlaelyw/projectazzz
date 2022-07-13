<?php
foreach ($penduduk as $penduduk) {
	?>
	<table class="profil">
		<tr>
			<td width="25%">NIK</td>
			<td width="5%">:</td>
			<td width="70%"><?= $penduduk->NIK; ?></td>
		</tr>
		<tr>
			<td>Nama</td>
			<td>:</td>
			<td><?= $penduduk->NAMA; ?></td>
		</tr>
		<tr>
			<td>Jenis Kelamin</td>
			<td>:</td>
			<td><?= $penduduk->JENISKELAMIN; ?></td>
		</tr>
		<tr>
			<td>Tempat Lahir</td>
			<td>:</td>
			<td><?= $penduduk->TEMPATLAHIR; ?></td>
		</tr>
		<tr>
			<td>Tanggal Lahir</td>
			<td>:</td>
			<td><?= $penduduk->TANGGALLAHIR; ?></td>
		</tr>
		<tr>
			<td>Umur</td>
			<td>:</td>
			<td><?= $penduduk->UMUR; ?></td>
		</tr>
		<tr>
			<td>Agama</td>
			<td>:</td>
			<td><?= $penduduk->AGAMA; ?></td>
		</tr>
		<tr>
			<td>Status</td>
			<td>:</td>
			<td><?= $penduduk->STATUS; ?></td>
		</tr>
		<tr>
			<td>Pendidikan</td>
			<td>:</td>
			<td><?= $penduduk->PENDIDIKAN; ?></td>
		</tr>
		<tr>
			<td>Pekerjaan</td>
			<td>:</td>
			<td><?= $penduduk->PEKERJAAN; ?></td>
		</tr>
		<tr>
			<td>Nama Ibu</td>
			<td>:</td>
			<td><?= $penduduk->NAMAIBU; ?></td>
		</tr>
		<tr>
			<td>Nama Ayah</td>
			<td>:</td>
			<td><?= $penduduk->NAMAAYAH; ?></td>
		</tr>
		<tr>
			<td colspan="3">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#downloadSurat"
						data-nik="<?= $penduduk->NIK; ?>" 
						data-nama="<?= $penduduk->NAMA; ?>"
						data-ibu="<?= $penduduk->NAMAIBU; ?>"
						data-ayah="<?= $penduduk->NAMAAYAH; ?>">Pilih
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
        <h4 class="modal-title" id="downloadSuratLabel">Buat Surat Keterangan Kematian</h4>
      </div>
      <form id="formsurat" method="post" action="<?php echo base_url('surat/skkm/download/'.$penduduk->NIK); ?>">
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
		        <label for="ibu" class="control-label">Nama Ibu</label>
		        <input type="text" class="form-control" id="ibu" readonly>
		      </div>
		      <div class="form-group">
		        <label for="ayah" class="control-label">Nama Ayah</label>
		        <input type="text" class="form-control" id="ayah" readonly>
		      </div>
		      <div class="form-group">
				<label for="anak">Anak Ke:</label>	
					<select class="form-control" for="anake" name="anake" id="anake">
						<option name="ke" value="1">1</option>
						<option name="ke" value="2">2</option>
						<option name="ke" value="3">3</option>
						<option name="ke" value="4">4</option>
					</select>
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
	  var ibu = button.data('ibu')
	  var ayah = button.data('ayah')
	  var modal = $(this)
	  modal.find('#nik').val(nik)
	  modal.find('#nama').val(nama)
	  modal.find('#ibu').val(ibu)
	  modal.find('#ayah').val(ayah)
	  modal.find('#anake').val('')
	  var formsurat = document.getElementById("formsurat")
	  var linkaction = "<?= base_url('surat/skkm/download'); ?>" + "/" + nik
	  formsurat.action = linkaction
	})
</script>