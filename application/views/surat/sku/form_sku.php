<?php echo form_open_multipart('pengajuan/penduduk/sku');?>
        <input type="hidden" value="500" name="id_surat" />
          <div class="form-group">
            <label for="nik" class="control-label">NIK</label>
            <input type="text" class="form-control" id="nik" >
          </div>
          <div class="form-group">
            <label for="nama" class="control-label">Nama</label>
            <input type="text" class="form-control" id="nama" >
          </div>
          <div class="form-group">
            <label for="data_surat" class="control-label">Usaha</label>
            <input type="text" class="form-control" id="data_surat" name="data_surat" required>
            <span id='helpPerihal' class='help-block'>
              Contoh: Ternak ikan lele
            </span>
          </div>
          <div class="form-group">
            <label for="perihal" class="control-label">Perihal</label>
            <input type="text" class="form-control" id="perihal" name="perihal" required>
            <span id='helpPerihal' class='help-block'>
              Contoh: Permohonan peminjaman modal usaha
            </span>
          </div>
          <div class="form-group">
            <label for="tujuan" class="control-label">Tujuan</label>
            <input type="text" class="form-control" id="tujuan" name="tujuan" required>
            <span id='helpTujuan' class='help-block'>
              Contoh: Bank BRI Cabang Ciawigebang Kuningan
            </span>
          </div>
           <div class="form-group">
            <label for="tujuan" class="control-label">Foto Persyaratan</label>
            <input type="file" name="gambar_persyaratan" required>
            <span id='helpPersyaratan' class='help-block'>
              Contoh: SIUP (Surat Izin Usaha Perdagangan)
            </span>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button type="submit" value="upload" class="btn btn-primary">Ajukan</button>
        </div>
      </form>

