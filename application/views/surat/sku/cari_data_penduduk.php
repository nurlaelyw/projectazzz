<form class="add-form" data-toggle="validator" role="form" method="post" 
	action="<?php echo base_url('surat/sku'); ?>">
	<div class="form-group">
		<label for="input_keyword" class="control-label">Nama / NIK</label>
		<input type="text" class="form-control" id="input_keyword" name="keyword" required>
	</div>
	<button type="submit" class="btn btn-hijau">
		Cari
	</button>
</form>