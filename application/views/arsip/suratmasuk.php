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
        document.getElementById('images').innerHTML = '<img src="'+imah+'"></img>';
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
			<form class="add-form" data-toggle="validator" role="form" method="post" action="<?php echo base_url('arsip/arsip/tambahsuratmasuk'); ?>" >
                <input type='hidden' name="gambar_surat" value="<?= $file_name; ?>.jpg">
                <div class="form-group">
			   	     <label for="input_nomor_surat" class="control-label">Nomor Surat</label>
			   	     <input type="text" class="form-control" id="input_nomor_surat" name="nomor_surat" required>
			 	</div>
			     <div class="form-group">
			   	     <label for="uraian_perihal" class="control-label">Uraian Perihal</label>
			   	     <input type="text" class="form-control" id="uraian_perihal" name="uraian_perihal" required>
			 	</div>
			    <div class="form-group">
			   	     <label for="asal_surat" class="control-label">Asal Surat</label>
			   	     <input type="text" class="form-control" id="asal_surat" name="asal_surat" required>
			 	</div>
			    <div class="form-group">
			   	     <label for="tanggal_surat" class="control-label">Tanggal Surat</label>
			   	     <input type="date" class="form-control" id="tanggal_surat" name="tanggal_surat" required>
			 	</div>
                <div class="form-group">
                    <label for="gambar_surat" class="control-label">Scan Surat</label>
                    <button type="button" class="btn btn-default btn-block" onclick="scanToLocalDisk();">Scan</button>
                </div>
                    <div id="images"></div>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus fa-fw" aria-hidden="true"></i> Tambah Arsip Surat Masuk</button>
			</form>
	</div>
</div>
