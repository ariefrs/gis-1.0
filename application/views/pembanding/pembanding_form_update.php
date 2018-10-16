<div class="row">
    <h2 style="margin-top:50px">Form Data Pembanding</h2>
</div>
        <form action="<?php echo $action; ?>" method="post">
        <div class="row">
            <button type="submit" class="btn blue darken-4 z-depth-3"><?php echo $button ?></button> 
            <a href="<?php echo site_url('pembanding') ?>" class="btn red darken-4 z-depth-3">Cancel</a>
        </div><!-- End of Row -->
		<div class="row">
			<div class="input-field col s6">
                <input readonly type="text" class="" name="nolaporan" id="nolaporan" value="<?php echo $nolaporan; ?>">
                <label for="nolaporan">No Laporan <?php echo form_error('nolaporan') ?></label>
            </div>
            <div class="input-field col s6">
                <input type="text" class="" name="tahundata" id="tahundata" value="<?php echo $tahundata; ?>">
                <label for="tahundata">Tahun Data <?php echo form_error('tahundata') ?></label>
            </div>        			
        <div><!-- End of Row -->
        <div class="row">
			<div class="input-field col s6">
            <label for="jenisdata">Jenis Data <?php echo form_error('jenisdata') ?></label>
                <?php dropdown('jenisdata','klasifikasi_objek','description','description','browser-default select2','',$jenisdata_selected,'','style="width:100%"') ; ?>
            </div>
            <div class="input-field col s6">
            <label for="properti">Properti <?php echo form_error('properti') ?></label>
				<?php 
                    $p = array(
                        'Real Properti'         => 'Real Properti',
                        'Personal Properti'     => 'Personal Properti',
                        );
                    echo form_dropdown('properti',$p,$properti_selected,'class="browser-default select2" style="width:100%;"');
                ?>
			</div>			
		</div><!-- End of Row -->
        <div class="row">
            <div class="input-field col s12">                
                <textarea class="" rows="5" name="alamat" id="alamat"><?php echo $alamat; ?></textarea>
                <label for="alamat">Alamat <?php echo form_error('alamat') ?></label>
            </div>
        </div><!-- End of Row -->
		<div class="row">
            <div class="input-field col s6">
                <?php 
                    $pilihan = array(
                        'Penawaran'     => 'Penawaran',
                        'Transaksi'     => 'Transaksi',
                        );
                    echo form_dropdown('kategoriharga',$pilihan,$harga_selected,'class=""');
                ?>
                <label for="kategoriharga">Kategori Harga <?php echo form_error('kategoriharga') ?></label>
            </div>
			<div class="input-field col s6">
                <input type="text" class="" name="harga" id="harga" value="<?php echo $harga; ?>">
                <label for="harga">Harga <?php echo form_error('harga') ?></label>
            </div>			
		</div><!-- End of Row -->
	    <div class="row">
            <div class="input-field col s6">
                <label for="lt">Luas Tanah <?php echo form_error('lt') ?></label>
                <input type="number" class="" name="lt" id="lt" value="<?php echo $lt; ?>">
            </div>
            <div class="input-field col s6">
                <label for="lb">Luas Bangunan <?php echo form_error('lb') ?></label>
                <input type="number" class="" name="lb" id="lb" value="<?php echo $lb; ?>">
            </div>
        </div><!-- End of Row -->
	    <div class="row">
            <div class="input-field col s6">
                <label for="nokontak">No Kontak <?php echo form_error('nokontak') ?></label>
                <input type="text" class="" name="nokontak" id="nokontak" placeholder="Nomor Telephone Kontak" value ="<?php echo $nokontak; ?>">
            </div>
            <div class="input-field col s6">
                <label for="nama">Nama <?php echo form_error('nama') ?></label>
                <input type="text" class="" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>">
            </div>			        
        </div><!-- End of Row -->
	    <div class="row">
            <div class="input-field col s4">
                <label for="merek">Merek <?php echo form_error('merek') ?></label>
                <input type="text" class="" name="merek" id="merek" placeholder="Merek" value="<?php echo $merek; ?>">
            </div>
            <div class="input-field col s4">
                <label for="kapasitas">Kapasitas <?php echo form_error('kapasitas') ?></label>
                <input type="text" class="" name="kapasitas" id="kapasitas" placeholder="Kapasitas" value="<?php echo $kapasitas; ?>">
            </div>
			<div class="input-field col s4">
                <label for="tahunbuat">Tahunbuat <?php echo form_error('tahunbuat') ?></label>
                <input type="text" class="" name="tahunbuat" id="tahunbuat" placeholder="Tahunbuat" value="<?php echo $tahunbuat; ?>">
            </div>
        </div><!-- End of Row -->
	    <div class="row">
            <div class="input-field col s6">
                <label for="lokasipropinsi">Propinsi <?php echo form_error('lokasipropinsi') ?></label>
                <?php dropdown('lokasipropinsi','propinsi','propinsi','id',' browser-default select2','',$propinsi_selected,'','style="width:100%;"'); ?>
            </div>
            <div class="input-field col s6">
                <label for="kabupaten">Kabupaten <?php echo form_error('kabupaten') ?></label>
                <?php dropdown('kabupaten','kabupaten','kabupaten','id',' browser-default select2','',$kabupaten_selected,'','style="width:100%;"');?>
            </div>
        </div><!-- End of Row -->
        <div class="row">
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <button type="submit" class="btn blue darken-4 z-depth-3"><?php echo $button ?></button> 
            <a href="<?php echo site_url('pembanding') ?>" class="btn red darken-4 z-depth-3">Cancel</a>
        </div><!-- End of Row -->
	</form>