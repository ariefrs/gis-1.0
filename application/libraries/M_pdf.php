<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
include_once APPPATH.'/third_party/mpdf/mpdf.php';
 
class M_pdf {
 
    public $param;
    public $pdf;
    
    public function __construct($param = '"en-GB-x","A4","","",10,10,10,10,6,3')
    {
        $this->param =$param;
        $this->pdf = new mPDF($this->param);
    }
    public function pdf(){
        $CI =& get_instance();
        //log_message('Debug', 'mPDF class is loaded.');
    }
    public function load($param=NULL){
        include_once APPPATH.'third_party/mpdf/mpdf.php';
        if($params == NULL){
            $param = '"en-GB-x","A4","","",10,10,10,10,6,3';
        }
        return new mPDF($param);
    }
}
