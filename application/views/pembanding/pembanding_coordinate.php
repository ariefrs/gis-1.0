<!doctype html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <script type="text/javascript">
            function updateKoordinat(newLat,newLng)
            {
                var a = newLat;
                var b = newLng;
                $('#lat').val(a+','+b);
            }
        </script>
        <?php echo $map['js']; ?>
    </head>
    <body>
        <h2 style="margin-top:50px"><?php echo $title; ?></h2>
        <p>Drag posisi pin untuk mendapatkan titik koordinat (lihat perubahan pada kolom <a href="#lat"><strong>Koordinat</strong></a>)
        </p>
        <form action="<?php echo $action; ?>" method="post">
		<table class="table table-striped">
        <tr>
        <td colspan="4"><?php echo $map['html']; ?></td>
        </tr>
		<tr>
			<td>Jenis Data :</td>
            <td><?php echo $jenisdata;?></td>
            <td>Luas Tanah :</td>
            <td><?php echo number_format($lt);?></td>
		</tr>
		<tr>
			<td>Alamat :</td>
			<td><?php echo $alamat; ?> 
            <td>Luas Bangunan :</td>
            <td><?php echo number_format($lb);?></td>
			</td>			
		</tr>
		<tr>
			<td>Nilai :</td>
            <td><?php echo number_format($harga); ?> 
            <td>Tahun Data :</td>
            <td><?php echo $tahundata;?></td>

		</tr>
		<tr>	
            <td>Kategori Harga :</td>
            <td><?php echo $kategoriharga; ?> </td>
            <td><label for="lat">Koordinat :<?php echo form_error('lat') ?></label></td>
            <td><input type="text" class="form-control" name="lat" id="lat"/><?php echo $lat; ?>
            </td>
        </tr>
        </table>    
<input type="hidden" name="modified_user_id" id="modified_user_id" value="<?php echo $this->session->userdata('id'); ?>" />      
<input type="hidden" name="modified_by" id="modified_by" value="<?php echo $this->session->userdata('name'); ?>" />
<input type="hidden" name="modified" id="modified" value="<?php echo date('Y-m-d H:i:s'); ?>" />	    
<input type="hidden" name="id" value="<?php echo $id; ?>" />

	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('pembanding') ?>" class="btn btn-danger">Cancel</a>
	</form>
    </body>
</html>