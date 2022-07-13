<style>
    #image-preview {
        height: 400px;
        position: relative;
        overflow: hidden;
        background-color: #ffffff;
        color: #ecf0f1;
        background-image: url("<?php echo base_url('images/'.$surat->gambar); ?>");
        background-size: cover;
        background-position: center center;
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
<div class="konten">
<h1>Edit Pengajuan <?= $surat->nama_surat ?></h1>
<hr>
<div class="container">
	<div class="col-sm-4 col-sm-offset-4">
		<!-- <form class="add-form" data-toggle="validator" role="form" method="post" action="<?php echo base_url('pengajuan/penduduk/edit_surat_id/'.$surat->id_pengajuan_surat); ?>" > -->
      <?php echo form_open_multipart('pengajuan/penduduk/edit_surat_id/'.$surat->id_pengajuan_surat); ?>
            <input type='hidden' name='id_pengajuan_surat' value='<?= $surat->id_pengajuan_surat; ?>'>
            <?php
            switch ($surat->id_surat) {
                case '500':
                    ?>
                    <div class="form-group">
                         <label for="data_surat" class="control-label">Usaha</label>
                         <input type="text" class="form-control" id="data_surat" value="<?php echo $surat->data_surat; ?>" name="data_surat" required>
                         <span id='helpPerihal' class='help-block'>
                            Contoh: Ternak ikan lele
                         </span>
                    </div>
                    <div class="form-group">
                        <label for="perihal" class="control-label">Perihal</label>
                        <input type="text" class="form-control" id="perihal" value="<?php echo $surat->uraian_perihal; ?>" name="uraian_perihal" required>
                        <span id='helpPerihal' class='help-block'>
                          Contoh: Permohonan peminjaman modal usaha
                        </span>
                      </div>
                      <div class="form-group">
                        <label for="tujuan" class="control-label">Tujuan</label>
                        <input type="text" class="form-control" id="tujuan" value="<?php echo $surat->tujuan_surat; ?>" name="tujuan_surat" required>
                        <span id='helpTujuan' class='help-block'>
                          Contoh: Bank BRI Cabang Ciawigebang Kuningan
                        </span>
                      </div>
                      <div class="form-group" style="">
                        <label for="tujuan" class="control-label">Foto Persyaratan</label>
                        <div id="image-preview">
                            <label for="image-upload" id="image-label">Ganti Foto</label>
                            <input type="file" name="gambar_persyaratan" id="image-upload">
                        </div>
                        <span id='helpPersyaratan' class='help-block'>
                          Contoh: SIUP (Surat Izin Usaha Perdagangan)
                        </span>
                      </div>
                      <button type="submit" class="btn btn-warning"><i class="fa fa-edit fa-fw" aria-hidden="true"></i> Edit Pengajuan Surat</button>
                    </div>
                    <?php
                    break;
                case '463':
                    ?>
                    <div class="form-group">
                         <label for="data_surat" class="control-label">Untuk Mendapatkan</label>
                         <input type="text" class="form-control" id="data_surat" value="<?php echo $surat->data_surat; ?>" name="data_surat" required>
                         <span id='helpPerihal' class='help-block'>
                            Contoh: Beasiswa
                         </span>
                    </div>
                    <div class="form-group">
                        <label for="perihal" class="control-label">Perihal</label>
                        <input type="text" class="form-control" id="perihal" value="<?php echo $surat->uraian_perihal; ?>" name="uraian_perihal" required>
                        <span id='helpPerihal' class='help-block'>
                          Contoh: Permohonan beasiswa
                        </span>
                      </div>
                      <div class="form-group">
                        <label for="tujuan" class="control-label">Tujuan</label>
                        <input type="text" class="form-control" id="tujuan" value="<?php echo $surat->tujuan_surat; ?>" name="tujuan_surat" required>
                        <span id='helpTujuan' class='help-block'>
                          Contoh: Universitas Kuningan
                        </span>
                      </div>
                      <button type="submit" class="btn btn-warning"><i class="fa fa-edit fa-fw" aria-hidden="true"></i> Edit Pengajuan Surat</button>
                    </div>
                    <?php
                    break;
                case '474':
                    ?>
                    <div class="form-group">
                         <label for="data_surat" class="control-label">Berdomisili Di Alamat Sekarang Sejak Tahun</label>
                         <input type="text" class="form-control" id="data_surat" value="<?php echo $surat->data_surat; ?>" name="data_surat" required>
                         <span id='helpPerihal' class='help-block'>
                            Contoh: 2014
                         </span>
                    </div>
                    <div class="form-group">
                        <label for="perihal" class="control-label">Perihal</label>
                        <input type="text" class="form-control" id="perihal" value="<?php echo $surat->uraian_perihal; ?>" name="uraian_perihal" required>
                        <span id='helpPerihal' class='help-block'>
                          Contoh: Lamaran pekerjaan
                        </span>
                      </div>
                      <div class="form-group">
                        <label for="tujuan" class="control-label">Tujuan</label>
                        <input type="text" class="form-control" id="tujuan" value="<?php echo $surat->tujuan_surat; ?>" name="tujuan_surat" required>
                        <span id='helpTujuan' class='help-block'>
                          Contoh: BukaLapak, Inc.
                        </span>
                      </div>
                      <button type="submit" class="btn btn-warning"><i class="fa fa-edit fa-fw" aria-hidden="true"></i> Edit Pengajuan Surat</button>
                    </div>
                    <?php
                    break;
                case '400':
                    ?>
                    <input type="hidden" value="0" name="data_surat" />
                    <div class="form-group">
                        <label for="perihal" class="control-label">Perihal</label>
                        <input type="text" class="form-control" id="perihal" value="<?php echo $surat->uraian_perihal; ?>" name="uraian_perihal" required>
                        <span id='helpPerihal' class='help-block'>
                          Contoh: Syarat pendaftaran nikah
                        </span>
                      </div>
                      <div class="form-group">
                        <label for="tujuan" class="control-label">Tujuan</label>
                        <input type="text" class="form-control" id="tujuan" value="<?php echo $surat->tujuan_surat; ?>" name="tujuan_surat" required>
                        <span id='helpTujuan' class='help-block'>
                          Contoh: Kantor Urusan Agama Kabupaten Kuningan
                        </span>
                      </div>
                      <button type="submit" class="btn btn-warning"><i class="fa fa-edit fa-fw" aria-hidden="true"></i> Edit Pengajuan Surat</button>
                    </div>
                    <?php
                    break;
            }
            ?>
		</form>
	</div>
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