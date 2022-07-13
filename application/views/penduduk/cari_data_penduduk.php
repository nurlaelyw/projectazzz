<form class="add-form" data-toggle="validator" role="form" method="post" 
	action="<?php echo base_url('penduduk/penduduk/tampil_data_penduduk'); ?>">
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahPenduduk">Tambah Penduduk</button>
	<br>	
	<br>
	<div class="form-group">
		<label for="input_nik" class="control-label">Nama / NIK</label>
		<input type="text" class="form-control" id="input_keyword" name="keyword" required>
	</div>
	<button type="submit" class="btn btn-hijau">
		Cari
	</button>
</form>
<div class="modal fade" id="tambahPenduduk" tabindex="-1" role="dialog" aria-labelledby="tambahPendudukLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="tambahPendudukLabel">Tambah Data Penduduk</h4>
      </div>
      <form id="formsurat" method="post" action="<?php echo base_url('penduduk/penduduk/tambahdata'); ?>">
	      <div class="modal-body">
		      <div class="form-group">
		        <label for="nkk" class="control-label">No KK</label>
		        <input type="text" class="form-control" name="nkk">
		      </div>
		      <div class="form-group">
		        <label for="namakk" class="control-label">Nama KK</label>
		        <input type="text" class="form-control" name="namakk">
		      </div>
		      <div class="form-group">
		        <label for="kdshdk" class="control-label">Kode SHDK</label>
		        <input type="text" class="form-control" name="kdshdk">
		      </div>
		      <div class="form-group">
		        <label for="nik" class="control-label">NIK</label>
		        <input type="text" class="form-control" name="nik">
		      </div>
		      <div class="form-group">
		        <label for="nama" class="control-label">Nama</label>
		        <input type="text" class="form-control" name="nama">
		      </div>
		       <div class="form-group">
		        <label for="rt" class="control-label">RT</label>
		        <input type="text" class="form-control" name="rt">
		      </div>
		      <div class="form-group">
		        <label for="rw" class="control-label">RW</label>
		        <input type="text" class="form-control" name="rw">
		      </div>
		      <div class="form-group">
		        <label for="dusun" class="control-label">Dusun</label>
		        <input type="text" class="form-control" name="dusun">
		      </div>
		      <div class="form-group">
		        <label for="jk" class="control-label">Jenis Kelamin</label>
		        <input type="text" class="form-control" name="jk">
		      </div>
		      <div class="form-group">
		        <label for="tempatlahir" class="control-label">Tempat Lahir</label>
		        <input type="text" class="form-control" name="tempatlahir">
		      </div>
		      <div class="form-group">
		        <label for="tgllahir" class="control-label">Tanggal Lahir</label>
		        <input type="tgllahir" class="form-control" name="tgllahir">
		      </div>
		      <div class="form-group">
		        <label for="gdr" class="control-label">Golongan Darah</label>
		        <input type="text" class="form-control" name="gdr">
		      </div>
		      <div class="form-group">
		        <label for="agama" class="control-label">Agama</label>
		        <input type="text" class="form-control" name="agama">
		      </div>
		      <div class="form-group">
		        <label for="status" class="control-label">Status</label>
		        <input type="text" class="form-control" name="status">
		      </div>
		      <div class="form-group">
		        <label for="pend" class="control-label">Pendidikan</label>
		        <input type="text" class="form-control" name="pend">
		      </div>
		      <div class="form-group">
		        <label for="pekerjaan" class="control-label">Pekerjaan</label>
		        <input type="text" class="form-control" name="pekerjaan">
		      </div>
		      <div class="form-group">
		        <label for="namaayah" class="control-label">Nama Ayah</label>
		        <input type="text" class="form-control" name="namaayah">
		      </div>
		      <div class="form-group">
		        <label for="namaibu" class="control-label">Nama Ibu</label>
		        <input type="text" class="form-control" name="namaibu">
		      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
	        <button type="submit" class="btn btn-primary">Tambah Data Penduduk</button>
	      </div>
      </form>
    </div>
  </div>
</div>
<!-- <script type="text/javascript">
	$('#tambahPenduduk').on('show.bs.modal', function (event) {
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
	  var linkaction = "<?= base_url('penduduk/skkm/download'); ?>" + "/" + nik
	  formsurat.action = linkaction
	})
</script> -->