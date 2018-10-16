<!doctype html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <style type="text/css">
            #tahundata,#kategoriharga,#q,#jenisdata{
                color:gray;
            }
            /* select option,select option:first-child {
                color: gray;
            } */
            #search{
                width:50%;
                margin:0 auto;
                height:25px;
            }
            .container-full{
                text-align: left;
                margin:0 auto;
                width: 100%;
            }
            .make-it-full{
                margin:10px;
                padding:10px;
                width:100%;
                height: 100%;
                z-index: 1;
                border:solid 10px #400080;
                border-radius: 10px;
            }

        </style>
        <?php echo $map['js']; ?>
    </head>
    <body class="">
    <div class="row">
                <label>Filter <i class="fa fa-filter fa-2x blue-text"></i>: </label>
                <form action="<?php echo site_url('peta/index'); ?>" class="col s12" method="get">
                    <div class="row">
                            <div class="input-field col s6">
                                <i class="material-icons prefix red-text">event_note</i>
                                <select name="tahundata" id="tahundata">
                                <option value="0" selected disabled>Tahun Data</option>
                                <?php
                                foreach($tahun as $t)
                                {
                                    echo '<option value="'.$t->tahundata.'">'.$t->tahundata.'</option>';
                                }
                                ?>
                                </select>
                                <label for="tahundata">Tahun Data</label>
                            </div>
                            <div class="input-field col s6">
                                    <i class="material-icons prefix red-text">description</i>
                                    <input class="tooltip" type="text" name="jenisdata" id="jenisdata" data-position="bottom" data-tooltip="Tanah kosong,Rumah Tinggal, dsb">
                                    <label for="jenisdata">Jenis Data</label>
                            </div>
                    </div><!-- End of Row -->
                    <div class="row">
                            <div class="input-field col s6">
                                <i class="material-icons prefix red-text">list</i>
                                <select name="kategoriharga" id="kategoriharga">
                                    <option value="0" selected disabled>Kategori Harga</option>
                                    <option value="Penawaran">Penawaran</option>
                                    <option value="Transaksi">Transaksi</option>
                                </select>
                                <label for="kategoriharga" class="tooltip" data-position="bottom" data-tooltip="Harga Penawaran atau Harga Transaksi">Kategori Harga</label>
                            </div>
                            <div class="input-field col s6">
                                <i class="material-icons prefix indigo-text">room</i>
                                <input type="text"  id="q" name="q" value="<?php echo $q; ?>">
                                <label for="q">Cari alamat</label>
                            </div>
                    </div><!-- End of Row -->
                    <div class="row">
                                <div class="col s12 right">
                                <?php 
                                    if ($q <> '' XOR $jenisdata <>'' )
                                    {
                                    ?>                                        
                                    <a href="<?php echo site_url('peta/index'); ?>">
                                    <button type="submit"  class="btn green darken-4 right z-depth-3 tooltip" data-tooltip="Reset" data-position="top"><i class="material-icons white-text">replay</i></button>
                                    </a>
                                        <?php
                                    }
                                ?>
                            <button type="submit" class="btn <?php if(isset($color)){echo $color;}else{echo 'blue darken-2';} ?> right z-depth-3 tooltip" data-tooltip="Cari" data-position="top"><i class="material-icons white-text">search</i></button>

                                </div>
                    </div><!-- End of Row -->
                    <div class="row">
                        <div class="col s9">
                            <?php echo $pagination;?>    
                        </div>
                        <div class="col s9"><a href="#" class="btn indigo darken-2">Jumlah Data : <?php echo $total_rows; ?></a></div>
                    </div>
                </form>        
        </div>

    <div class="row">
        <div class="make-it-full col s12">
            <?php echo $map['html']; ?>                                    
        </div>    
    </div><!-- End Of Row <-->

    <script type="text/javascript">
        $(document).ready(function()
        {
            $('#jenisdata').autocomplete({
            source:"<?php echo site_url('peta/get_jenisdata_ajax') ?>",
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
    </body>
</html>