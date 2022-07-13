<?php
if (count($surat_keluar) < 1) {
    ?>
    <p class="bg-info pesan">Tidak ada surat keluar yang harus diarsipkan.</p>
    <?php
} else {
    $date = new DateTime();
    $file_name = $date->getTimestamp();
    ?>
    <script>
        var file_name = '<?= $file_name; ?>';
        function scanToLocalDisk() {
            scanner.scan(displayResponseOnPage,
                {
                    "output_settings": [
                        {
                            "type": "save",
                            "format": "jpg",
                            "save_path": "C:\\Xampp\\htdocs\\ciawigebang\\images\\"+file_name+".jpg"
                        }
                    ]
                }
            );
        }

        function displayResponseOnPage(successful, mesg, response) {
            if(!successful) {
                document.getElementById('response').innerHTML = 'Failed: ' + mesg;
                return;
            }

            if(successful && mesg != null && mesg.toLowerCase().indexOf('user cancel') >= 0) {
                document.getElementById('response').innerHTML = 'User cancelled';
                return;
            }

            var imah = '<?= base_url("images"); ?>'+'/'+file_name+'.jpg';
            document.getElementById('images').innerHTML = '<br><img src="'+imah+'"></img></br>';
        }

        var imagesScanned = [];

        function processScannedImage(scannedImage) {
            imagesScanned.push(scannedImage);
            var elementImg = scanner.createDomElementFromModel( {
                'name': 'img',
                'attributes': {
                    'class': 'scanned',
                    'src': scannedImage.src
                }
            });
            document.getElementById('images').appendChild(elementImg);
        }
    </script>

    <style>
        img {
            height: 550px; 
            margin-top: 10px;
            margin-bottom: 25px;
        }
    </style>

    <div class="container">
        <div class="col-sm-4 col-sm-offset-4">
            <form class="add-form" data-toggle="validator" role="form" method="post" action="<?php echo base_url('arsip/arsip/tambahsuratkeluar'); ?>">
                <input type='hidden' name="gambar_surat" value="<?= $file_name; ?>.jpg">
                <div class="form-group">
                    <label for="nosurat">Pilih Surat</label>
                    <select class="form-control" name="id_pengajuan_surat">
                        <?php
                            foreach ($surat_keluar as $surat_keluar) {
                                $penanggung_jawab;
                                switch ($surat_keluar->id_surat) {
                                    case '500':
                                        $penanggung_jawab = 'Ekbang';
                                        break;
                                    case '463':
                                        $penanggung_jawab = 'Kesra';
                                        break;
                                    case '474':
                                        $penanggung_jawab = 'Kepend';
                                    case '400':
                                        $penanggung_jawab = 'Kesra';
                                        break;
                                }
                                ?>
                                <option value="<?= $surat_keluar->id_pengajuan_surat; ?>"><?= $surat_keluar->id_surat."/".str_pad($surat_keluar->nomor_surat,3,'0',STR_PAD_LEFT)."/".$penanggung_jawab.'/'.$surat_keluar->tahun; ?></option>
                                <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="gambar_surat" class="control-label">Scan Surat</label>
                    <button type="button" class="btn btn-default btn-block" onclick="scanToLocalDisk();">Scan</button>
                </div>
                <div id="images"></div>
                <button type="submit" class="btn btn-primary"><i class="fa fa-plus fa-fw" aria-hidden="true"></i> Tambah Arsip Surat Keluar</button>
            </form>
        </div>
    </div>
    <?php
}
?>