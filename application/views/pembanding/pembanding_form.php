<!doctype html>
<html>
<head>
    <title>Form Data Pembanding</title>
    <script>
    jQuery(document).ready(function(){                  
    $('.select2').select2();
    $('#tahundata').mask('9999');

});
    </script>
</head>
<body class="container">
    <h2>Form Data Pembanding</h2>
    <form action="<?php echo $action; ?>" method="post">
    <span class="pull-right">
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
    </span>
    <div class="row" style="margin:10px;">
        <div class="col-md-12">
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">
                        <label class="input-group-addon" for="nolaporan">No Laporan</label>
                    </span>
                    <input readonly type="text" class="form-control" name="nolaporan" id="nolaporan" placeholder="Nomor laporan" value="<?php echo $laporan; ?>">
                    <input type="hidden" class="form-control" name="penilaianid" id="penilaianid" value="<?php echo $penilaianid; ?>">    
                </div>
            </div>
        </div><!-- End of Col -->
    </div><!-- End of Row -->
    <div class="row" style="margin:10px;">
        <?php for ($i = 1 ; $i <= $banyak_objek; $i++)
            {
        ?>
            <input type="hidden" name="id[]" value="<?php echo $id; ?>" /> 
            <div class="box box-solid">
                <div class="box-header with-border" style="color:#fff;background:#11092b;">
                    <?php echo 'Data Banding # '.$i; ?>                
                </div><!-- End of Box Header -->
                <div class="box-body">
                    <div class="form-group">
                        <div class="input-group">
                        <label class="input-group-addon" for="alamat">Alamat <span class="text-danger"><?php echo form_error('alamat') ?></span></label>
                        <textarea class="form-control" rows="3" name="alamat[]" id="alamat" placeholder="Alamat"><?php echo $alamat; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <label class="input-group-addon" for="tahundata">Tahun Data <span class="text-danger"><?php echo form_error('tahundata') ?></span></label>
                            <input type="text" class="form-control" name="tahundata[]" id="tahundata" placeholder="Tahun Data" value="<?php echo $tahundata; ?>">
                            <label class="input-group-addon" for="kategoriharga">Kategori Harga <span class="text-danger"><?php echo form_error('kategoriharga') ?></span></label>
                            <?php 
                                $pilihan = array(
                                    'Penawaran'     => 'Penawaran',
                                    'Transaksi'     => 'Transaksi',
                                    );
                                echo form_dropdown('kategoriharga[]',$pilihan,$harga_selected,'class="form-control"');
                            ?>
                            <label class="input-group-addon" for="harga">Harga 
                                <span class="text-danger"><?php echo form_error('harga') ?></span>
                            </label>
                            <input type="number" class="form-control" name="harga[]" id="harga" placeholder="Harga" value="<?php echo $harga; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <label class="input-group-addon" for="lt">Luas Tanah <span class="text-danger"><?php echo form_error('lt') ?></span></label>
                            <input type="number" class="form-control" name="lt[]" id="lt" placeholder="Luas Tanah" value="<?php echo $lt; ?>"><?php if($lt != ''){echo number_format($lt);} ?>
                            <label class="input-group-addon" for="lb">Luas Bangunan <span class="text-danger"><?php echo form_error('lb') ?></span></label>
                            <input type="number" class="form-control" name="lb[]" id="lb" placeholder="Luas Bangunan" value="<?php echo $lb; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <label class="input-group-addon" for="nokontak">No Kontak <span class="text-danger"><?php echo form_error('nokontak') ?></span></label>
                            <input type="text" class="form-control" name="nokontak[]" id="nokontak" placeholder="Nomor Kontak" value="<?php echo $nokontak; ?>">
                            <label class="input-group-addon" for="nama">Nama Kontak<span class="text-danger"><?php echo form_error('nama') ?></span></label>
                            <input type="text" class="form-control" name="nama[]" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <label class="input-group-addon" for="jenisdata">Jenis Data <span class="text-danger"><?php echo form_error('jenisdata') ?></span></label>
                            <?php dropdown('jenisdata[]','klasifikasi_objek','description','description',' form-control select2','',$jenisdata_selected,'','style="width:100%"') ; ?>
                            <label class="input-group-addon" for="properti">Properti <span class="text-danger"><?php echo form_error('properti') ?></span></label>
                            <?php 
                                $p = array(
                                    'Real Properti'         => 'Real Properti',
                                    'Personal Properti'     => 'Personal Properti',
                                    );
                                echo form_dropdown('properti[]',$p,$properti_selected,'class="form-control select2" style="width:100%;"');
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <label class="input-group-addon" for="merek">Merek <span class="text-danger"><?php echo form_error('merek') ?></span></label>
                            <input type="text" class="form-control" name="merek[]" id="merek" placeholder="Merek" value="<?php echo $merek; ?>">
                            <label class="input-group-addon" for="kapasitas">Kapasitas <span class="text-danger"><?php echo form_error('kapasitas') ?></span></label>
                            <input type="text" class="form-control" name="kapasitas[]" id="kapasitas" placeholder="Kapasitas" value="<?php echo $kapasitas; ?>">
                            <label class="input-group-addon" for="tahunbuat">Tahun Pembuatan <span class="text-danger"><?php echo form_error('tahunbuat') ?></span></label>
                            <input type="text" class="form-control" name="tahunbuat[]" id="tahunbuat" placeholder="Tahun Pembuatan"><?php echo $tahunbuat; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <label class="input-group-addon" for="lokasipropinsi">Propinsi <span class="text-danger"><?php echo form_error('lokasipropinsi') ?></span></label>                
                            <?php dropdown('lokasipropinsi[]','propinsi','propinsi','id',' form-control select2','',$propinsi_selected,'','style="width:100%;"'); ?>
                            <label class="input-group-addon" for="kabupaten">Kabupaten <span class="text-danger"><?php echo form_error('kabupaten') ?></span>
                            </label>
                            <?php dropdown('kabupaten[]','kabupaten','kabupaten','id',' form-control select2','',$kabupaten_selected,'','style="width:100%;"');
                            ?>
                        </div>
                    </div>
                </div><!-- End of Box Body-->
            </div><!-- End of Box Solid -->
        <?php } ?>
    </div><!-- End of Row-->
    <div class="row">
        <input type="hidden" id="banyak_objek" name="banyak_objek" value="<?php echo $banyak_objek; ?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
    </div>
    </div><!-- End of Row -->
</form>
</body>
</html>