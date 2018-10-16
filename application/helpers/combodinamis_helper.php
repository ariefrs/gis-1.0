<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function dropdown($name,$table,$field,$pk,$class,$kondisi=null,$selected=null,$data=null,$tags=null)
{
    $CI =& get_instance();
   echo"<select name='".$name."' class='span $class' $tags>";
        if($data!='')
        {
            foreach ($data as $data_value => $id)
            {
                echo "<option value='$id'>$data_value</option>";
            }
        }
        if(empty($kondisi))
        {
            $CI->db->order_by($field,'ASC');
            $record=$CI->db->get($table)->result();
        }
        else
        {
            $CI->db->order_by($field,'ASC');
            $record=$CI->db->get_where($table,$kondisi)->result();
        }
        foreach ($record as $r)
        {
            echo " <option value='".$r->$pk."' ";
            echo $r->$pk==$selected?'selected':'';
            //echo ">".strtoupper($r->$field)."</option>";
			echo ">".ucfirst($r->$field)."</option>";
        }
            echo"</select>";
}
/* End of file combodinamis_helper.php */
/* Location: ./application/helpers/combodinamis_helper.php */