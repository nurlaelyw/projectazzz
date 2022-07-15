
<?php
  if ($this->session->flashdata('pengajuan_surat')) {
    ?>
    <div class="bg-success pesan">
      <?php echo $this->session->flashdata('pengajuan_surat'); ?>
    </div>
    <?php
  }
?>

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

<div class="row">
  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <img src="<?= base_url('asset/image/Surat Keterangan Usaha.png'); ?>" style="height:400px">
      <div class="caption">
        <h4>Surat Keterangan Usaha</h4>
        <p>
          <a href="<?php echo base_url('pengajuan/pengajuansurat/tambah_sku') ?>" class="btn btn-primary"
          data-nik="<?= $penduduk->nik; ?>"
          data-nama="<?= $penduduk->nama; ?>">Ajukan</a>
          <a href="<?= base_url('asset/image/Surat Keterangan Usaha.png'); ?>" class="btn btn-default" role="button">Lihat</a>
        </p>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <img src="<?= base_url('asset/image/Surat Keterangan Tidak Mampu.png'); ?>" style="height:400px">
      <div class="caption">
        <h4>Surat Keterangan Tidak Mampu</h4>
        <p>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pengajuanSktm"
          data-nik="<?= $penduduk->nik; ?>"
          data-nama="<?= $penduduk->nama; ?>">Ajukan</button>
          <a href="<?= base_url('asset/image/Surat Keterangan Tidak Mampu.png'); ?>" class="btn btn-default" role="button">Lihat</a>
        </p>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <img src="<?= base_url('asset/image/Surat Domisili.png'); ?>" style="height:400px">
      <div class="caption">
        <h4>Surat Keterangan Domisili</h4>
        <p>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pengajuanSkd"
          data-nik="<?= $penduduk->nik; ?>"
          data-nama="<?= $penduduk->nama; ?>">Ajukan</button>
          <a href="<?= base_url('asset/image/Surat Domisili.png'); ?>" class="btn btn-default" role="button">Lihat</a>
        </p>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <img src="<?= base_url('asset/image/Surat Belum Pernah Menikah.png'); ?>" style="height:400px">
      <div class="caption">
        <h4>Surat Keterangan Belum Pernah Menikah</h4>
        <p>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pengajuanSkbpm"
          data-nik="<?= $penduduk->nik; ?>"
          data-nama="<?= $penduduk->nama; ?>">Ajukan</button>
          <a href="<?= base_url('asset/image/Surat Belum Pernah Menikah.png'); ?>" class="btn btn-default" role="button">Lihat</a>
        </p>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <img src="<?= base_url('asset/image/Surat Keterangan Belum Memiliki Rumah.png'); ?>" style="height:400px">
      <div class="caption">
        <h4>Surat Keterangan Belum Memiliki Rumah</h4>
        <p>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pengajuanSkbpm"
          data-nik="<?= $penduduk->nik; ?>"
          data-nama="<?= $penduduk->nama; ?>">Ajukan</button>
          <a href="<?= base_url('asset/image/Surat Keterangan Belum Memiliki Rumah.png'); ?>" class="btn btn-default" role="button">Lihat</a>
        </p>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="pengajuanSku" tabindex="-1" role="dialog" aria-labelledby="pengajuanSkuLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="pengajuanSkuLabel">Pengajuan Pembuatan Surat Keterangan Usaha</h4>
      </div>
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
            <div id="image-preview">
                <label for="image-upload" id="image-label">Pilih Foto</label>
                <input type="file" name="gambar_persyaratan" id="image-upload" required>
            </div>
            <span id='helpPersyaratan' class='help-block'>
              Contoh: SIUP (Surat Izin Usaha Perdagangan)
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

<script type="text/javascript">
  $('#pengajuanSku').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var nik = button.data('nik') // Extract info from data-* attributes
    var nama = button.data('nama')
    var modal = $(this)
    modal.find('#nik').val(nik)
    modal.find('#nama').val(nama)
    modal.find('#data_surat').val('')
    modal.find('#perihal').val('')
    modal.find('#tujuan').val('')
    modal.find('#gambar_persyaratan').val('')
    var formsurat = document.getElementById("formsurat")
    var linkaction = "<?= base_url('pengajuan/penduduk/pengajuan_surat_sku'); ?>"
    formsurat.action = linkaction
  })
</script>

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

<script type="text/javascript">
  $('#pengajuanSktm').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var nik = button.data('nik') // Extract info from data-* attributes
    var nama = button.data('nama')
    var modal = $(this)
    modal.find('#nik').val(nik)
    modal.find('#nama').val(nama)
    modal.find('#data_surat').val('')
    modal.find('#perihal').val('')
    modal.find('#tujuan').val('')
    var formsurat = document.getElementById("formsurat")
    var linkaction = "<?= base_url('pengajuan/penduduk/pengajuan_surat'); ?>"
    formsurat.action = linkaction
  })
</script>

<div class="modal fade" id="pengajuanSkd" tabindex="-1" role="dialog" aria-labelledby="pengajuanSkdLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="pengajuanSkdLabel">Pengajuan Pembuatan Surat Keterangan Domisili</h4>
      </div>
      <form id="formsurat" method="post" action="<?php echo base_url('pengajuan/penduduk/pengajuan_surat'); ?>">
        <input type="hidden" value="474" name="id_surat" />
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
            <label for="data_surat" class="control-label">Berdomisili Di Alamat Sekarang Sejak Tahun</label>
            <input type="text" class="form-control" id="data_surat" name="data_surat" required>
            <span id='helpPerihal' class='help-block'>
              Contoh: 2014
            </span>
          </div>
          <div class="form-group">
            <label for="perihal" class="control-label">Perihal</label>
            <input type="text" class="form-control" id="perihal" name="perihal" required>
            <span id='helpPerihal' class='help-block'>
              Contoh: Lamaran pekerjaan
            </span>
          </div>
          <div class="form-group">
            <label for="tujuan" class="control-label">Tujuan</label>
            <input type="text" class="form-control" id="tujuan" name="tujuan" required>
            <span id='helpTujuan' class='help-block'>
              Contoh: BukaLapak, Inc.
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

<script type="text/javascript">
  $('#pengajuanSkd').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var nik = button.data('nik') // Extract info from data-* attributes
    var nama = button.data('nama')
    var modal = $(this)
    modal.find('#nik').val(nik)
    modal.find('#nama').val(nama)
    modal.find('#data_surat').val('')
    modal.find('#perihal').val('')
    modal.find('#tujuan').val('')
    var formsurat = document.getElementById("formsurat")
    var linkaction = "<?= base_url('pengajuan/penduduk/pengajuan_surat'); ?>"
    formsurat.action = linkaction
  })
</script>

<div class="modal fade" id="pengajuanSkbpm" tabindex="-1" role="dialog" aria-labelledby="pengajuanSkbpmLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="pengajuanSkbpmLabel">Pengajuan Pembuatan Surat Keterangan Belum Pernah Menikah</h4>
      </div>
      <form id="formsurat" method="post" action="<?php echo base_url('pengajuan/penduduk/pengajuan_surat'); ?>">
        <input type="hidden" value="400" name="id_surat" />
        <input type="hidden" value="0" name="data_surat" />
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
            <label for="perihal" class="control-label">Perihal</label>
            <input type="text" class="form-control" id="perihal" name="perihal" required>
            <span id='helpPerihal' class='help-block'>
              Contoh: Syarat pendaftaran nikah
            </span>
          </div>
          <div class="form-group">
            <label for="tujuan" class="control-label">Tujuan</label>
            <input type="text" class="form-control" id="tujuan" name="tujuan" required>
            <span id='helpTujuan' class='help-block'>
              Contoh: Kantor Urusan Agama Kabupaten Kuningan
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

<script type="text/javascript">
  $('#pengajuanSkbpm').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var nik = button.data('nik') // Extract info from data-* attributes
    var nama = button.data('nama')
    var modal = $(this)
    modal.find('#nik').val(nik)
    modal.find('#nama').val(nama)
    modal.find('#data_surat').val('0')
    modal.find('#perihal').val('')
    modal.find('#tujuan').val('')
    var formsurat = document.getElementById("formsurat")
    var linkaction = "<?= base_url('pengajuan/penduduk/pengajuan_surat'); ?>"
    formsurat.action = linkaction
  })
</script>