<?php 
$string = "<!doctype html>
<html>
    <head>
        <title><?php echo \$title; ?></title>
    </head>
    <body>
        <h2 style=\"margin-top:0px\"> Form ".ucfirst($table_name)."</h2>
        <form action=\"<?php echo \$action; ?>\" method=\"post\">";
foreach ($non_pk as $row) {
    if ($row["data_type"] == 'text')
    {
    $string .= "\n\t    <div class=\"form-group\">
            <div class=\"col-md-3\">
            <label for=\"".$row["column_name"]."\">".label($row["column_name"])." <?php echo form_error('".$row["column_name"]."') ?></label>
            </div>
            <div class=\"col-md-9\">
            <textarea class=\"form-control\" rows=\"3\" name=\"".$row["column_name"]."\" id=\"".$row["column_name"]."\" placeholder=\"".label($row["column_name"])."\"><?php echo $".$row["column_name"]."; ?></textarea>
            </div>
        </div>";
    } else
    {
    $string .= "\n\t    <div class=\"form-group\">
            <div class=\"col-md-3\">
            <label for=\"".$row["column_name"]."\">".label($row["column_name"])." <?php echo form_error('".$row["column_name"]."') ?></label>
            </div>
            <div class=\"col-md-9\">
            <input type=\"text\" class=\"form-control\" name=\"".$row["column_name"]."\" id=\"".$row["column_name"]."\" placeholder=\"".label($row["column_name"])."\" value=\"<?php echo $".$row["column_name"]."; ?>\" />
            </div>
        </div>";
    }
}
$string .= "\n\t    <input type=\"hidden\" name=\"".$pk."\" value=\"<?php echo $".$pk."; ?>\" /> ";
$string .= "\n\t    <button type=\"submit\" class=\"btn btn-primary\"><?php echo \$button ?></button> ";
$string .= "\n\t    <a href=\"<?php echo site_url('".$c_url."') ?>\" class=\"btn btn-danger\">Cancel</a>";
$string .= "\n\t</form>
    </body>
</html>";

$hasil_view_form = createFile($string, $target."views/" . $c_url . "/" . $v_form_file);

?>