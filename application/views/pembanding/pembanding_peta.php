<!doctype html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <script>
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
            #search{
                width:50%;
                margin:0 auto;
                height:25px;
            }
            .container-full{
                margin:0 auto;
                width: 100%;
            }
            .make-it-full{
                margin:10px;
                padding:10px;
                width:99%;
                height: 100%;
                z-index: 1;
                border:solid 10px #575757;
                border-radius: 10px;
            }
        </style>
        
        <?php echo $map['js']; ?>
    </head>
    <body class="container-full">
    <div class="row">
        <div id="pagination"  class="col-md-7">
            <?php echo $pagination;?>
        </div>
    <div class="row">
    <div class="col-md-12 text-right">
                <form action="<?php echo site_url('pembanding/peta'); ?>" class="form-inline" method="get">
                    <div class="col-md-12 form-group form-inline">
                    <label>Filter <i class="fa fa-filter text-primary"></i>: </label>
                    <select name="tahundata" class="form-control" id="tahundata">
                    <?php
                    echo '<option value="">Tahun Data</option>'; 
                    foreach($tahun as $t)
                    {
                        echo '<option value="'.$t->tahundata.'">'.$t->tahundata.'</option>';
                    }
                    ?>
                    </select>                            
                    <input type="text" class="form-control ui-widget" name="jenisdata" id="jenisdata" placeholder="Jenis Data">
                    <select name="propinsi" id="propinsi" class="form-control">
                        <?php 
                        $pilihan = get_all(array('id','propinsi'),'propinsi');
                        echo '<option value="">Pilih Propinsi</option>'; 
                            foreach($pilihan as $s)
                            {
                                echo '<option value="'.$s->id.'">'.$s->propinsi.'</option>';
                            }
                            ?>
                    </select>  
                    <select name="kategoriharga" class="form-control" id="kategoriharga">
                        <option value="Penawaran">Penawaran</option>
                        <option value="Transaksi">Transaksi</option>
                        <option value="">Transaksi & Penawaran</option>
                    </select>                     
                    <input type="text" class="form-control" name="q" placeholder="Cari alamat" value="<?php echo $q; ?>">
                    <!-- <span class="input-group-btn">-->
                        <?php 
                            if ($q <> '')
                            {
                                ?>
                                <a href="<?php echo site_url('pembanding'); ?>" title="Reset" class="btn btn-success fa fa-refresh"></a>
                                <?php
                            }
                        ?>
                      <button class="btn btn-primary fa fa-search" title="Search" type="submit"></button>
                    <!-- </span> -->
                    </div>
                </form>
            </div>
    </div><!-- End of Row -->
    <div class="row">
    <div class="make-it-full col-md-12">
        <?php echo $map['html']; ?>                                    
    </div>    
    </div><!-- End Of Row <-->
    
    
    </body>
</html>