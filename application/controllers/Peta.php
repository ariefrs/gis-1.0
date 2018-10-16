<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//ini_set('max_execution_time', 0); 
class Peta extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pembanding_model');
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->library('googlemaps');
		
    }
    public function index()
    {
        $config = array();
    	$q 		= urldecode($this->input->get('q', TRUE));
        $tahun  = urldecode($this->input->get('tahundata', TRUE));
        $jenis  = urldecode($this->input->get('jenisdata',TRUE));
        $harga  = urldecode($this->input->get('kategoriharga',TRUE));
    	$start 	= intval($this->input->get('start'));
    	if ($q <> '') {
            $config['base_url'] = base_url() .'peta/pembanding.html?tahundata='.urlencode('$tahun')
                                    .'&jenisdata='.urlencode('$jenis')
                                    .'&harga='.urlencode('$harga')
                                    .'&q=' . urlencode($q);
            $config['first_url'] = base_url() .'peta/pembanding.html?tahundata='.urlencode('$tahun')
                                    .'&jenisdata='.urlencode('$jenis')
                                    .'&harga='.urlencode('$harga')
                                    .'&q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'peta/pembanding.html';
            $config['first_url'] = base_url() . 'peta/pembanding.html';
        }
        $config = array(
            'uri_segment'           => 3,
            'per_page'              => 50,  
            'page_query_string'     => TRUE,
            'reuse_query_string'    => TRUE,
            'total_rows'			=> $this->Pembanding_model->get_allmapcount($tahun,$jenis,$harga,$q),
            );
        $pembanding             = $this->getdatabanding($config['per_page'], $start,$tahun,$jenis,$harga,$q);
        //echo $this->db->last_query();
        $config['first_link']           = '<i class="fa fa-fast-backward"></i>';
        $config['prev_link']            = '<i class="fa fa-step-backward"></i>';
        $config['next_link']            = '<i class="fa fa-step-forward"></i>';
        $config['last_link']            = '<i class="fa fa-fast-forward"></i>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $config['center']       = '-0.1007596,117.2045936';
        $config['zoom']         = '5';
        $config['backgroundColor'] = '#eee';
        $this->googlemaps->initialize($config);
        foreach ($pembanding as $p) {
            $marker = array();
            $apart = array('unit apartemen','apartemen');
            $jenisdata = strtolower($p->jenisdata);
            switch ($jenisdata) {
            	case (preg_match('/.*toko.*/', $jenisdata) ? true : false):
            		$marker['icon'] = base_url().'images/icon/pin-ruko.png';
            		break;
        		case "mobil":
            		$marker['icon'] = base_url().'images/icon/pin-cars.png';
            		break;
            	case "kios":
            		$marker['icon'] = base_url().'images/icon/pin-kios.png';
            		break;
        		case "tanah kosong":
        			$marker['icon'] = base_url().'images/icon/pin-land.png';
        			break;
                case "rumah tinggal":
					$marker['icon'] = base_url().'images/icon/pin-home.png';
					break;
                // case "tanah bangunan rumah tinggal":
                //     $marker['icon'] = base_url().'images/icon/pin-home-land.png';
                //     break;
                // case "tanah dan bangunan rumah tinggal":
                //     $marker['icon'] = base_url().'images/icon/pin-home-land.png';
                //     break;
				case (preg_match('/.*apart.*/', $jenisdata) ? true : false):
					$marker['icon'] = base_url().'images/icon/pin-apartment.png';
                    break;
                case (preg_match('/.*bangunan.*/', $jenisdata) ? true : false):
					$marker['icon'] = base_url().'images/icon/pin-home-land.png';
                    break;
                case (preg_match('/.*wagon.*/', $jenisdata) ? true : false):
                    $marker['icon'] = base_url().'images/icon/pin-truck.png';
                    break;
				default:
					$marker['icon'] = base_url().'images/icon/marker.png';
            }
            $marker['position'] = $p->lat;
            $marker['title'] = 	$p->jenisdata
            					.'\n'.' Nilai '.number_format($p->harga)
            					.'\n Tahun Data: '.$p->tahundata;
            $marker['infowindow_content']    = 
            '<h5>'.$p->jenisdata.'</h5>'
            .'<h4>&nbsp;&nbsp;<i class="fa fa-money fa-1x text-success"></i> Nilai : '.number_format($p->harga).'</h4><br/>'
            .'&nbsp;&nbsp;<i class="fa fa-tag fa-1x text-primary"></i> Kategori Harga : '.$p->kategoriharga.'<br/>'
            .'&nbsp;&nbsp;<i class="fa fa-resize-horizontal fa-1x text-primary"></i> Luas Tanah : '.$p->lt.'<br/>'
            .'&nbsp;&nbsp;<i class="fa fa-building fa-1x text-primary"></i> Luas Bangunan : '.$p->lb.'<br/>'
            .'&nbsp;&nbsp;<i class="fa fa-database fa-1x text-success"></i> Tahun Data : '.$p->tahundata.'<br/>' 
            .'&nbsp;&nbsp;<i class="fa fa-map-marker text-danger"></i><strong> Koordinat :</strong>'.$p->lat.'<br/>'
            .'&nbsp;&nbsp;<i class="fa fa-map-marker text-danger"></i><strong> Marker ID :</strong>'.$p->id
            ;
            $this->googlemaps->add_marker($marker);
        }        
        $marker = array(
            'q'					=> $q,
            'jenisdata'					=> $jenis,
        	'pagination' 		=> $this->pagination->create_links(),
            'total_rows' 		=> $config['total_rows'],
            'start' 			=> $start,
            'tahun'             => $this->get_tahundata(),
            'main_content'      => 'peta/pembanding',
            'title'             => 'Peta Data Pembanding',
            'map'               => $this->googlemaps->create_map(),
            'color'             => 'indigo'
        );            
            $this->load->view('includes/materialize', $marker);
    }
    public function get_tahundata() {
    $this->db->distinct();
    $this->db->select('tahundata');
    $this->db->order_by('tahundata','DESC');
    $query = $this->db->get('pembanding');
    return $query->result();
    
    }
    public function get_jenisdata() {
    $this->db->distinct();
    $this->db->select('jenisdata');
    $this->db->order_by('jenisdata','ASC');
    $query = $this->db->get('pembanding');
    return $query->result();
    }
    public function get_data_ajax($search)
    {
        $this->db->distinct();
        $this->db->select('jenisdata');
        $this->db->like('jenisdata',$search);    
        $this->db->order_by('jenisdata','ASC');
        $query = $this->db->get('pembanding');
        //echo $this->db->last_query();
        return $query->result_array();
    }
    public function get_jenisdata_ajax()
    {
        $term = $this->input->get('term'); // Mengambil data id yg dikirim dari view
        if (!empty($term))
        {
            $q = strtolower($term);
            $query = $this->get_data_ajax($q);
            if (count($query) > 0)
            {
                foreach ($query as $row)
                {
                    $new_row['label']       = htmlentities(stripcslashes($row['jenisdata']));
                    $new_row['value']       = htmlentities(stripcslashes($row['jenisdata']));
                    $row_set[] = $new_row;
                }

                echo json_encode($row_set);
            }
        }
    }
    public function getdatabanding($limit, $start = 0,$tahundata=NULL, $jenisdata=NULL, $kategoriharga=NULL, $q=NULL)
    {
        
        if(!empty($tahundata)){$this->db->like('tahundata', $tahundata);}
        if(!empty($jenisdata)){$this->db->like('jenisdata', $jenisdata);}
        if(!empty($kategoriharga)){$this->db->like('kategoriharga', $kategoriharga);}
        $where = "lat != '' ";
        $this->db->where($where);
        $this->db->like('alamat', $q);
        $this->db->order_by('id','DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get('pembanding');
        return $query->result();
    }
    public function databanding()
    {
        $config['center']       = '-0.1007596,117.2045936';
        $config['zoom']         = '5';
        $this->googlemaps->initialize($config);
        $data = array(
            'main_content'      => 'peta/myplaces',
            'title'                        => 'Peta Data Pembanding',
        );
       $this->load->view('includes/materialize', $data);
    }
}