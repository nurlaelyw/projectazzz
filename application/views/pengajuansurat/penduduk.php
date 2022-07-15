
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
<div class="container">
  <div class="row">
    <div class="col-sm-6 col-md-4">
      <div class="thumbnail">
        <img src="<?= base_url('asset/image/Surat Keterangan Usaha.png'); ?>" style="height:400px">
        <div class="caption">
          <h4>Surat Keterangan Usaha</h4>
          <p>
            <a href="<?php echo base_url('pengajuan/pengajuansurat/tambah_sku') ?>" class="btn btn-primary">Ajukan</a>
            <a href="<?= base_url('asset/image/Surat Keterangan Usaha.png'); ?>" class="btn btn-default" role="button">Lihat</a>
          </p>
        </div>
      </div>
    </div>
    <!-- <div class="col-sm-6 col-md-4">
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
    </div>-->
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
