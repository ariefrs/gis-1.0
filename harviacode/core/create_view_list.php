<?php 

$string = "<!doctype html>
<html>
    <head>
        <title><?php echo \$title; ?></title>
        <style>
        th{
                text-align:center;
                background-color:#022b6d;
                color:#fff;
            }
        </style>
    </head>
    <body>
            <h2 style=\"margin-top:0px\"><?php echo anchor(site_url('".$c_url."/index'),'Data ".ucfirst($table_name)."'); ?></h2>
        <div class=\"row\" style=\"margin: 10px\">
            <div class=\"col-md-2\">
                <?php echo anchor(site_url('".$c_url."/create'),'Tambah', 'class=\"btn btn-primary\"'); ?>
            </div>
            <div class=\"col-md-10 text-center\">
                <div style=\"margin-top: 8px\" id=\"message\">
                    <?php echo \$this->session->userdata('message') <> '' ? \$this->session->userdata('message') : ''; ?>
                </div>
            </div>
        </div><!--End of Row -->
        <div class=\"row\" style=\"margin: 10px\">
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
                          <button class=\"btn btn-primary\" type=\"submit\" title=\"Search\"><i class=\"fa fa-search\"></i></button>
                        </span>
                    </div>
                </form>
            </div>
        </div><!--End of Row -->
        <table class=\"table table-bordered table-hover table-condensed\" style=\"margin: 10px\">
            <tr>
                <th style=\"text-align:center;background-color:#022b6d;color:#fff;\">No</th>";
foreach ($non_pk as $row) {
    $string .= "\n\t\t<th style=\"text-align:center;background-color:#022b6d;color:#fff;\">" . label($row['column_name']) . "</th>";
}
$string .= "\n\t\t<th style=\"text-align:center;background-color:#022b6d;color:#fff;\">Action</th>";
$string .= "\n\t\t\t<th style=\"text-align:center;background-color:#022b6d;color:#fff;\" width=\"50px\">ID</th></tr>";
$string .= "<?php
            foreach ($" . $c_url . "_data as \$$c_url)
            {
                ?>
                <tr>";

$string .= "\n\t\t\t<td width=\"80px\"><?php echo ++\$start ?></td>";
foreach ($non_pk as $row) {
    $string .= "\n\t\t\t<td><?php echo $" . $c_url ."->". $row['column_name'] . " ?></td>";
}
$string .= "\n\t\t\t<td style=\"text-align:center\" width=\"200px\">"
        . "\n\t\t\t\t<?php "
        . "\n\t\t\t\techo anchor(site_url('".$c_url."/read/'.$".$c_url."->".$pk."),'<btn class=\"text-primary fa fa-search\" title=\"Read\">'); "
        . "\n\t\t\t\techo ' | '; "
        . "\n\t\t\t\techo anchor(site_url('".$c_url."/update/'.$".$c_url."->".$pk."),'<btn class=\"text-success fa fa-pencil\" title=\"Update\">'); "
        . "\n\t\t\t\techo ' | '; "
        . "\n\t\t\t\techo anchor(site_url('".$c_url."/delete/'.$".$c_url."->".$pk."),'<btn class=\"text-danger fa fa-trash\" title=\"Delete\">','onclick=\"javasciprt: return confirm(\\'Are You Sure ?\\')\"'); "
        . "\n\t\t\t\t?>"
        . "\n\t\t\t</td>";
$string .=  "\n\t\t<td><?php echo $".$c_url."->".$pk." ?></td>";
$string .=  "\n\t\t</tr>
                <?php
            }
            ?>
        </table>
        <div class=\"row\">
            <div class=\"col-md-6\">
                <a href=\"#\" class=\"btn btn-primary\">Total Record : <?php echo \$total_rows ?></a>";
if ($export_excel == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/excel'), 'Excel', 'class=\"btn btn-primary\"'); ?>";
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