<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Pembanding List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Storage Id</th>
		<th>User Id</th>
		<th>Created</th>
		<th>Created By</th>
		<th>Modified User Id</th>
		<th>Modified</th>
		<th>Modified By</th>
		<th>Alamat</th>
		<th>Kategoriharga</th>
		<th>Harga</th>
		<th>Lt</th>
		<th>Lb</th>
		<th>Nokontak</th>
		<th>Nama</th>
		<th>Lat</th>
		<th>Picture</th>
		<th>Nolaporan</th>
		<th>Jenisdata</th>
		<th>Properti</th>
		<th>Merek</th>
		<th>Kapasitas</th>
		<th>Tahunbuat</th>
		<th>Lokasipropinsi</th>
		<th>Kabupaten</th>
		<th>Tahundata</th>
		
            </tr><?php
            foreach ($pembanding_data as $pembanding)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $pembanding->storage_id ?></td>
		      <td><?php echo $pembanding->user_id ?></td>
		      <td><?php echo $pembanding->created ?></td>
		      <td><?php echo $pembanding->created_by ?></td>
		      <td><?php echo $pembanding->modified_user_id ?></td>
		      <td><?php echo $pembanding->modified ?></td>
		      <td><?php echo $pembanding->modified_by ?></td>
		      <td><?php echo $pembanding->alamat ?></td>
		      <td><?php echo $pembanding->kategoriharga ?></td>
		      <td><?php echo $pembanding->harga ?></td>
		      <td><?php echo $pembanding->lt ?></td>
		      <td><?php echo $pembanding->lb ?></td>
		      <td><?php echo $pembanding->nokontak ?></td>
		      <td><?php echo $pembanding->nama ?></td>
		      <td><?php echo $pembanding->lat ?></td>
		      <td><?php echo $pembanding->picture ?></td>
		      <td><?php echo $pembanding->nolaporan ?></td>
		      <td><?php echo $pembanding->jenisdata ?></td>
		      <td><?php echo $pembanding->properti ?></td>
		      <td><?php echo $pembanding->merek ?></td>
		      <td><?php echo $pembanding->kapasitas ?></td>
		      <td><?php echo $pembanding->tahunbuat ?></td>
		      <td><?php echo $pembanding->lokasipropinsi ?></td>
		      <td><?php echo $pembanding->kabupaten ?></td>
		      <td><?php echo $pembanding->tahundata ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>