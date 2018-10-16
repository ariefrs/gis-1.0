<!doctype html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        
		<?php echo $map['js'];?>
    </head>
    <body>
        <table class="table table-striped table-condensed table-hover">
	    <tr>
	    	<td>No Laporan</td><td><?php echo $nolaporan; ?></td>
	    	<td>Kategori Harga</td><td><?php echo $kategoriharga; ?></td>
	    </tr>
	    <tr>
	    	<td>Jenis Data</td><td><?php echo $jenisdata; ?></td>
	    	<td>Harga</td><td><?php echo number_format($harga); ?></td>
    	</tr>
	    <tr>
	    	<td>Tahun Data</td><td><?php echo $tahundata; ?></td>
		    <td>Luas Tanah</td><td><?php echo number_format($lt); ?></td>
	    </tr>
	    <tr>
	    	<td>Alamat</td><td style="word-wrap: break-word;"><?php echo $alamat; ?></td>
	    	<td>Luas Bangunan</td><td><?php echo number_format($lb); ?></td>
	    </tr>
	    <tr>
	    	<td>Propinsi</td>
	    	<td>
		    	<?php 
		    	$data = $this->db->get_where('propinsi',array('id' => $lokasipropinsi));
		    	foreach ($data->result() as $row) {
			    	echo $row->propinsi; }
		    	?>	    		
	    	</td>
	    	<td>No. Kontak</td><td><?php echo $nokontak; ?></td>
		</tr>
	    <tr>
	    	<td>Kota/Kabupaten</td>
	    	<td>
		    	<?php //echo $kabupaten; 
		    	$data = $this->db->get_where('kabupaten',array('id' => $kabupaten));
			    	foreach ($data->result() as $row) {
				    	echo $row->kabupaten; }
		    	?>	    	
	    	</td>
	    	<td>Nama</td><td><?php echo $nama; ?></td>
    	</tr>	    
	    <tr>
		    <td rowspan="6">Gambar Properti</td><td rowspan="6"><?php echo $picture; ?></td>
		    <td>Properti</td><td><?php echo $properti; ?></td>
	    </tr>
	    <tr><td>Merk</td><td><?php echo $merek; ?></td></tr>
	    <tr><td>Kapasitas</td><td><?php echo $kapasitas; ?></td></tr>
    	<tr><td>Tahun Pembuatan</td><td><?php echo $tahunbuat; ?></td></tr>
		<tr><td>Create</td><td><?php echo $created." - ".$user_id." - ".$created_by; ?></td></tr>
		<tr><td>Update</td><td><?php echo $modified." - ".$modified_user_id." - ".$modified_by; ?></td></tr>
		<tr><td>Map</td><td colspan="3">
			<?php if($lat !== ''){
				echo $map['html']; 
			}else{
				echo "Data Koordinat Tidak Ditemukan";
			}
			?>
			</td>
	    	
    	</tr>
	</table>
</body>
</html>