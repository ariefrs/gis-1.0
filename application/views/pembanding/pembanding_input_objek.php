<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $title; ?></title>
		<script type="text/javascript">
			jQuery(document).ready(function($){
				$('#banyak_objek').focus();
			});
		</script>
	</head>
	<body>
		<form action="" method="post">
		<div class="container">
			<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="form-group">
					<div class="input-group">
					<span class="input-group-addon"><label>No Laporan : </label></span>
					<input readonly type="text" class="form-control" name="lap" id="lap" value="<?php echo $laporan; ?>">
					<input type="hidden" name="laporan" value="<?php echo $laporan;?>">
					</div>
					<div class="input-group">
						<span class="input-group-addon">
							<label>Jumlah Data Pembanding</label></span>			
					    <input required="required" name="banyak_objek" id="banyak_objek" class="form-control" size="1" oninvalid="this.setCustomValidity('Jumlah Data Banding harus diisi')" oninput="setCustomValidity('')"/>
					    <span class="input-group-btn">
					    	<button type="submit" class="btn btn-success" title="Submit"/><i class="fa fa-check"></i> Submit </button></span>
				    </div>
		    	</div>
		    <div class="col-md-2"></div>
	    	</div><!-- End of Row -->
    	</div><!-- End of Container -->
		</form>
	</body>
</html>
