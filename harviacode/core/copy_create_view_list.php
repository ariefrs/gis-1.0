<?php 

$string = "<!doctype html>
<html>
    <head>
        <title><?php echo \$title; ?></title>
        <style>
            .content
            {
                font-size: 1em;
            }
            th{
                text-align:center;
            }
        </style>
    </head>
    <body>
        <h2 style=\"margin-top:0px\"> Data ".ucfirst($table_name)." </h2>
        <div class=\"row\" style=\"margin-bottom: 10px\">
            <div class=\"col-md-2\">
                <?php echo anchor(site_url('".$c_url."/create'),'Tambah', 'class=\"btn btn-primary\"'); ?>
            </div>
            <div class=\"col-md-10 text-center\">
                <div style=\"margin-top: 8px\" id=\"message\">
                    <?php echo \$this->session->userdata('message') <> '' ? \$this->session->userdata('message') : ''; ?>
                </div>
            </div>
        </div>
        <div class=\"row\" style=\"margin: 10px\">
        <label>Filter <i class=\"fa fa-filter text-primary\"></i>: </label>
            <div class=\"col-md-12 text-right\">
                <form action=\"<?php echo site_url('$c_url/index'); ?>\" class=\"form-inline\" method=\"get\">
                    <div class=\"input-group\">
                        
                        <input type=\"text\" class=\"form-control\" name=\"q\" value=\"<?php echo \$q; ?>\">
                        <span class=\"input-group-btn\">
                            <?php 
                                if (\$q <> '')
                                {
                                    ?>
                                    <a href=\"<?php echo site_url('$c_url'); ?>\" title=\"Reset\" class=\"btn btn-success\"><i class=\"fa fa-refresh\"></i></a>
                                    <?php
                                }
                            ?>
                          <button class=\"btn btn-primary\" title=\"Search\" type=\"submit\"><i class=\"fa fa-search\"></i></button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <div class=\"row table-responsive\">
        <table class=\"table table-bordered table-striped\" style=\"margin: 10px\">
            <tr>
                <th>No</th>";
foreach ($non_pk as $row) {
    $string .= "\n\t\t<th>" . label($row['column_name']) . "</th>";
}
$string .= "\n\t\t<th>Action</th>";
$string .= "\n\t\t<th>ID</th></tr>";
$string .= "<?php
            foreach ($" . $c_url . "_data as \$$c_url)
            {
                ?>
                <tr>";

$string .= "\n\t\t\t<td width=\"20px\"><?php echo ++\$start ?></td>";
foreach ($non_pk as $row) {
    $string .= "\n\t\t\t<td><?php echo $" . $c_url ."->". $row['column_name'] . " ?></td>";
}


$string .= "\n\t\t\t<td style=\"text-align:center\" width=\"100px\">"
        . "\n\t\t\t\t<?php "
        . "\n\t\t\t\techo anchor(site_url('".$c_url."/read/'.$".$c_url."->".$pk."),'<btn class=\"text-primary fa fa-search\", title=\"Read\">'); "
        . "\n\t\t\t\techo ' | '; "
        . "\n\t\t\t\techo anchor(site_url('".$c_url."/update/'.$".$c_url."->".$pk."),'<btn class=\"text-success fa fa-pencil\", title=\"Update\">'); "
        . "\n\t\t\t\techo ' | '; "
        . "\n\t\t\t\techo anchor(site_url('".$c_url."/delete/'.$".$c_url."->".$pk."),'<btn class=\"text-danger fa fa-trash\", title=\"Delete\">','onclick=\"javasciprt: return confirm(\\'Are You Sure ?\\')\"'); "
        . "\n\t\t\t\t?>"
        . "\n\t\t\t</td>"
        . "\n\t\t\t<td width=\"20px\"><?php echo $".$c_url."->".$pk."; ?></td>";

$string .=  "\n\t\t</tr>
                <?php
            }
            ?>
        </table>
        </div>
        <div class=\"row\">
            <div class=\"col-md-6\">
                <a href=\"#\" class=\"btn btn-primary\">Total Record : <?php echo \$total_rows ?></a>";
if ($export_excel == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/excel'), 'Excel', 'class=\"btn btn-success\"'); ?>";
}
if ($export_word == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/word'), 'Word', 'class=\"btn btn-primary\"'); ?>";
}
if ($export_pdf == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/pdf'), 'PDF', 'class=\"btn btn-primary\"'); ?>";
}
$string .= "\n\t    </div>
            <div class=\"col-md-6 text-right\">
                <?php echo \$pagination ?>
            </div>
        </div>
    </body>
</html>";


$hasil_view_list = createFile($string, $target."views/" . $c_url . "/" . $v_list_file);

?>