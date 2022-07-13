<?php
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
        document.getElementById('response').innerHTML = '<br><img src="'+imah+'"></img><br>';
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
    img.scanned {
        height: 200px;
        margin-right: 12px;
    }

    div#images {
        margin-top: 20px;
    }
</style>


<div class="container">
	<div class="col-sm-4 col-sm-offset-4">
		<form class="add-form" data-toggle="validator" role="form" method="post" action="<?php echo base_url('arsip/arsip/editsuratkeluar/'.$tabelsuratkeluar->id_surat_keluar); ?>" >
            <input type='hidden' name='id_pengajuan_surat' value='<?= $tabelsuratkeluar->id_pengajuan_surat; ?>'>
			<input type='hidden' name="gambar_surat" value="<?= $file_name; ?>.jpg">
            <?php
            $penanggung_jawab;
            switch ($tabelsuratkeluar->id_surat) {
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
            <div class="form-group">
		   	     <label for="no_surat">Nomor Surat</label>
		   	     <input type="text" class="form-control" value="<?php echo $tabelsuratkeluar->id_surat.'/'.str_pad($tabelsuratkeluar->nomor_surat,3,'0',STR_PAD_LEFT).'/'.$penanggung_jawab.'/'.$tabelsuratkeluar->tahun; ?>" name="nomor_surat" readonly>
		 	</div>
		     <div class="form-group">
		   	     <label for="uraian_perihal" class="control-label">Uraian Perihal</label>
		   	     <input type="text" class="form-control" id="uraian_perihal" value="<?php echo $tabelsuratkeluar->uraian_perihal; ?>"" name="uraian_perihal" required>
		 	</div>
		    <div class="form-group">
		   	     <label for="tujuan_surat" class="control-label">Tujuan Surat</label>
		   	     <input type="text" class="form-control" id="tujuan_surat" value="<?php echo $tabelsuratkeluar->tujuan_surat; ?>"" name="tujuan_surat" required>
		 	</div>
		    <div class="form-group">
		   	     <label for="tanggal_surat" class="control-label">Tanggal Surat</label>
		   	     <input type="date" class="form-control" id="tanggal_surat" value="<?php echo $tabelsuratkeluar->tanggal_surat; ?>"" name="tanggal_surat" required>
		 	</div>
            <div class="form-group">
                <label for="gambar_surat" class="control-label">Scan Surat</label>
                <button type="button" class="btn btn-default btn-block" onclick="scanToLocalDisk();">Scan</button>
            </div>
                <div id="response"></div>
                <button type="submit" class="btn btn-warning"><i class="fa fa-edit fa-fw" aria-hidden="true"></i> Edit Arsip Surat Keluar</button>
		</form>
	</div>
</div>
