<div class="konten">
<h1>Tambah Pengajuan Surat Keterangan Usaha</h1>
<hr>
<style>
    #image-preview {
        height: 400px;
        position: relative;
        overflow: hidden;
        background-color: #ffffff;
        color: #ecf0f1;
    }
    #image-preview input {
        line-height: 200px;
        font-size: 200px;
        position: absolute;
        opacity: 0;
        z-index: 10;
    }
    #image-preview label {
        position: absolute;
        z-index: 5;
        opacity: 0.8;
        cursor: pointer;
        background-color: #bdc3c7;
        width: 200px;
        height: 50px;
        font-size: 20px;
        line-height: 50px;
        text-transform: uppercase;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        margin: auto;
        text-align: center;
    }
</style>
<div class="container">
	<div class="col-sm-4 col-sm-offset-4">
    <?php echo form_open_multipart('pengajuan/penduduk/sku');?>
        <input type="hidden" value="500" name="id_surat" />
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
          <div class="form-group">
            <label for="tujuan" class="control-label">Foto Persyaratan</label>
            <div id="image-preview">
                <label for="image-upload" id="image-label">Pilih Foto</label>
                <input type="file" name="gambar_persyaratan" id="image-upload" required>
            </div>
            <span id='helpPersyaratan' class='help-block'>
              Contoh: Surat Pengantar dari RT/RW
            </span>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Ajukan</button>
        </div>
      </form>
    </div>
</div>

<script src="<?php echo base_url('asset/js/jquery.uploadPreview.min.js'); ?>" charset="utf-8"></script>
<script type="text/javascript">
  $(document).ready(function() {
      $.uploadPreview({
          input_field: "#image-upload",
          preview_box: "#image-preview",
          label_field: "#image-label"
      });
  });
</script>