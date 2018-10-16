<?php 

$string = "<!doctype html>
<html>
    <head>
        <title><?php echo \$title ?></title>
    </head>
    <body>
        <h2 style=\"margin-top:0px\">Detail ".ucfirst($table_name)." </h2>
        <table class=\"table\">";
foreach ($non_pk as $row) {
    $string .= "\n\t    <tr><td>".label($row["column_name"])."</td><td><?php echo $".$row["column_name"]."; ?></td></tr>";
}
$string .= "\n\t    <tr><td></td><td><a href=\"<?php echo site_url('".$c_url."') ?>\" class=\"btn btn-danger\">Cancel</a></td></tr>";
$string .= "\n\t</table>
        </body>
</html>";



$hasil_view_read = createFile($string, $target."views/" . $c_url . "/" . $v_read_file);

?>