<!doctype html>
<html>
    <head>
        <title>Data Pembanding</title>
        <script type="text/javascript">
        $(document).ready(function()
        {
            $('#jenisdata').autocomplete({
            source:"<?php echo site_url('pembanding/get_jenisdata_ajax') ?>",
            focus: function(event,ui)
            {
                event.preventDefault();
                $(this).val(ui.item.label);
                $('#jenisdata').val(ui.item.value);
                return false;   
            },
            select: function(event, ui){
                event.preventDefault();
                $(this).val(ui.item.label);
                $('#jenisdata').val(ui.item.value);
                return false;
            }                           
        });

        });
        
        </script>
        <style type="text/css">
            #tahundata,#kategoriharga,#q,#jenisdata{
                color:gray;
            }
            select option,select option:first-child {
                color: gray;
            }
			th{
                text-align:center;
                background-color:#022b6d;
                color:#fff;
            } 
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Data Pembanding <?php echo $q;?></h2>
        <div class="row" style="margin-bottom:10px;">
            <div class="col m12 text-right" style="margin-bottom: 10px">
                <form action="<?php echo site_url('pembanding/index'); ?>" class="form-inline" method="get">
                <div class="col m12">
                    <label>Filter <i class="fa fa-filter text-primary"></i>: </label>
                    <div class="row">
                            <div class="col s6 input-field">
                            <i class="material-icons prefix red-text">event_note</i>
                            <select name="tahundata" id="tahundata">
                            <?php
                            echo '<option value="">Pilih Tahun Data</option>'; 
                            foreach($tahun as $t)
                            {
                                echo '<option value="'.$t->tahundata.'">'.$t->tahundata.'</option>';
                            }
                            ?>
                            </select>
                            <label for="tahundata" class="tooltip" data-position="bottom" data-tooltip="Pilih Tahun">Tahun Data</label>                             
                            </div>
                            <div class="col s6 input-field">
                                <i class="material-icons prefix red-text">list</i>
                                <input type="text" name="jenisdata" id="jenisdata">
                                <label  for="jenisdata" class="tooltip" data-position="bottom" data-tooltip="Tanah Kosong,Rumah Tinggal,Bangunan Kantor,dlsb">Jenis Data</label>
                            </div>
                    </div><!-- End of Row --> 
                    <div class="row">
                            <div class="col s6 input-field">
                                <i class="material-icons prefix green-text darken-4">compare</i>    
                                <select name="propinsi" id="propinsi" >
                                        <?php 
                                        $pilihan = get_all(array('id','propinsi'),'propinsi');
                                        echo '<option value="">Pilih Propinsi</option>'; 
                                            foreach($pilihan as $s)
                                            {
                                                echo '<option value="'.$s->id.'">'.$s->propinsi.'</option>';
                                            }
                                            ?>
                                    </select>
                                    <label for="propinsi" class="tooltip" data-position="bottom" data-tooltip="Pilih Propinsi">Propinsi</label> 
                            </div>
                            <div class="col s6 input-field">
                                    <i class="material-icons prefix green-text darken-4">loyalty</i>        
                                    <select name="kategoriharga"  id="kategoriharga">
                                        <option value="Penawaran">Penawaran</option>
                                        <option value="Transaksi">Transaksi</option>
                                        <option value="">Transaksi & Penawaran</option>
                                    </select>
                                    <label for="kategoriharga" class="tooltip" data-position="bottom" data-tooltip="Harga Penawaran atau Harga Transaksi">Kategori Harga</label> 
                            </div>
                    </div><!--End of Row-->
                    <div class="row">
                        <div class="col s6 input-field">
                            <i class="material-icons prefix indigo-text darken-4">chrome_reader_mode</i>
                            <input type="text"  name="q">
                            <label for="q" class="tooltip" data-position="bottom" data-tooltip="Filter berdasarkan nomor laporan">Nomor Laporan</label>
                        </div>
                        <div class="col s6 input-field right">
                            <?php 
                                if ($q <> '' XOR $jenisdata <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('pembanding'); ?>" title="Reset" class="btn"><i class="material-icons">replay</i></a>
                                    <?php
                                }
                            ?>
                        <button class="btn deep-orange darken-4 z-depth-3" title="Search" type="submit"><i class="fa fa-search"></i></button>
                      </div>
                    </div><!-- End of Row -->
                    </div>
                </form>
            </div>
        </div>
        <div class="row" style="margin:10px;">
            <?php
                foreach ($pembanding_data as $pembanding)
                {
                    $jenisdata = strtolower($pembanding->jenisdata);
                    switch ( $jenisdata ){
                    case (preg_match('/.*toko.*/', $jenisdata) ? true : false):
                        $icon   = base_url().'/images/icon/pin-ruko.png';
                        $bg     = 'orange darken-3';
                        break;
                    case (preg_match('/.*kantor.*/', $jenisdata) ? true : false):
                        $icon = base_url().'/images/icon/pin-ruko.png';
                        $bg     = 'indigo darken-3';
                        break;
                    case "mobil":
                        $icon = base_url().'/images/icon/pin-cars.png';
                        $bg     = 'green darken-3';
                        break;
                    case "kios":
                        $icon   = base_url().'/images/icon/pin-kios.png';
                        $bg     = 'purple darken-3';
                        break;
                    case "tanah kosong":
                        $icon = base_url().'/images/icon/pin-land.png';
                        $bg     = 'indigo darken-4';
                        break;
                    case (preg_match('/.*tinggal.*/', $jenisdata) ? true : false):
                        $icon = base_url().'/images/icon/pin-home.png';
                        $bg     ='deep-orange darken-4';
                        break;
                    case (preg_match('/.*apart.*/', $jenisdata) ? true : false):
                        $icon = base_url().'/images/icon/pin-apartment.png';
                        $bg     = 'light-green darken-4';
                        break;
                    default:
                        $icon = base_url().'/images/icon/marker.png';
                        $bg     = 'pink darken-4';
                }
            ?>
                <div class="col m6">
                    <div class="card <?php echo $bg; ?> z-depth-3">
                        <div class="card-content">
                        <a href="<?php echo site_url('pembanding/read/'.$pembanding->id); ?>" target="_blank" class="white-text tooltip" data-position="bottom" data-tooltip="Click untuk mellihat lebih detil"> 
                            <span class="right" style="margin-right:10px;"><img src="<?php echo $icon; ?>" ></span>
                            <span class="card-title"><?php echo $pembanding->jenisdata?></span>    
                            <span><h5><?php echo number_format($pembanding->harga);?></h5></span>
                            <br/><?php echo $pembanding->alamat ?>              
                            <br/><span><?php echo $pembanding->kategoriharga.' | LT : '.number_format($pembanding->lt).' | LB : '.number_format($pembanding->lb).' | <i class="fa fa-calendar text-red"></i> Data : '.$pembanding->tahundata ?></span>
                            <span><?php echo $pembanding->nolaporan; ?></span>
                            <hr />
                            </a> 
                            <small>
                            <span class="right">
                                <?php
                                        echo anchor(site_url('pembanding/update/'.$pembanding->id),'<class="tooltip" title="Modify Data"><i class="material-icons green-text">create</i>');
                                        
                                        echo anchor(site_url('pembanding/update_coordinate/'.$pembanding->id),'<class="tooltip" title="Update Lokasi"><i class="material-icons grey-text">room</i>');
                                        
                                        echo anchor(site_url('pembanding/trash/'.$pembanding->id),'<class="tooltip" title="Delete"><i class="material-icons red-text">delete</i>','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
                                    ?>
                            </span>
                            </small>
                        </div><!-- /.card-content -->    
                    </div><!-- Card -->
                </div><!-- End of Column -->
                <?php
            }
            ?>
        </div><!-- End of Row -->
        <div class="row">
            <div class="col s12 right">
                <a href="#" class="btn deep-orange darken-4 z-depth-3">Total Record : <?php echo $total_rows ?></a>
        		<?php echo $pagination ?>
	       </div>
        </div>
    </body>
</html>
