<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//ini_set('max_execution_time', 0); 
class Pembanding extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $models = array(
            'Pembanding_model'      => 'Pembanding_model',
            );
        $this->load->model($models);
        $this->load->library('form_validation');
        $this->load->library('googlemaps');
        $this->load->helper('combodinamis');
    }
    public function index()
    {
		$tahun  = urldecode($this->input->get('tahundata', TRUE));
        $jenis  = urldecode($this->input->get('jenisdata',TRUE));
        $harga  = urldecode($this->input->get('kategoriharga',TRUE));
        $propinsi  = urldecode($this->input->get('propinsi',TRUE));
        $q 		= urldecode($this->input->get('q', TRUE));
        $start 	= intval($this->input->get('start'));
        
        if (isset($tahun) && isset($jenis) && isset($harga) && $q <> '') {
            $config['base_url'] = base_url() . 'pembanding/index.html?tahundata='.urlencode('$tahun')
                                    .'&jenisdata='.urlencode('$jenis')
                                    .'&harga='.urlencode('$harga')
                                    .'&propinsi='.urlencode('$propinsi')
                                    .'&q=' . urlencode($q);
            $config['first_url'] = base_url() . 'pembanding/index.html?tahundata='.urlencode('$tahun')
                                    .'&jenisdata='.urlencode('$jenis')
                                    .'&harga='.urlencode('$harga')
                                    .'&propinsi='.urlencode('$propinsi')
                                    .'&q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'pembanding/index.html';
            $config['first_url'] = base_url() . 'pembanding/index.html';
        }
        $config = array(
        	'uri_segment'			=> 3,
        	'per_page'				=> 3,	
  			'page_query_string'     => TRUE,
  			'reuse_query_string'    => TRUE,
  			'total_rows'			=> $this->Pembanding_model->total_rows($tahun,$jenis,$harga,$propinsi,$q),
		);
        $pembanding = $this->Pembanding_model->get_limit_data($config['per_page'], $start,$tahun,$jenis,$harga,$propinsi,$q);
        $this->load->library('pagination');
        $this->pagination->initialize($config);
        $data = array(
            'pembanding_data' 		=> $pembanding,
            'q' 					=> $q,
            'pagination' 			=> $this->pagination->create_links(),
            'total_rows' 			=> $config['total_rows'],
            'start' 				=> $start,
            'tahun'             	=> $this->get_tahundata(),
            'jenisdata'             =>$jenis,
			'main_content'			=> 'pembanding/pembanding_list',
            'title'					=> 'Data Pembanding',
            'color'                 => 'orange darken-4'
        );
		$this->load->view('includes/materialize', $data);
    }
    public function restricted()
    {
        $type = trim(strtolower($this->session->userdata('usertype')));
            if($type !== 'Data Entry' xor $type !== 'Supervisor' xor $type xor 'Super Administrator')
            {
                $this->session->set_flashdata('message', "<div class=\"red darken-4 z-depth-3 white-text center\">Anda tidak memiliki otoritas untuk melakukan aksi ini </div>");
                redirect(site_url('pembanding'));
            }
    }
    public function get_klasifikasiobjek()
    {
        $klas = get_distinct('description','klasifikasi_objek');
    }
    public function get_tahundata() {
	    $this->db->distinct();
	    $this->db->select('tahundata');
	    $this->db->order_by('tahundata','DESC');
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
    public function peta()
    {
    	$config 						= array();
        $tahun  = urldecode($this->input->get('tahundata', TRUE));
        $jenis  = urldecode($this->input->get('jenisdata',TRUE));
        $harga  = urldecode($this->input->get('kategoriharga',TRUE));
        $propinsi  = urldecode($this->input->get('propinsi',TRUE));
    	$q 								= urldecode($this->input->get('q', TRUE));
    	$start 							= intval($this->input->get('start'));
    	if ($q <> '') {
            $config['base_url'] = base_url() . 'pembanding/peta.html?tahundata='.urlencode('$tahun')
                                    .'&jenisdata='.urlencode('$jenis')
                                    .'&harga='.urlencode('$harga')
                                    .'&propinsi='.urlencode('$propinsi')
                                    .'&q=' . urlencode($q);
            $config['first_url'] = base_url() . 'pembanding/peta.html?tahundata='.urlencode('$tahun')
                                    .'&jenisdata='.urlencode('$jenis')
                                    .'&harga='.urlencode('$harga')
                                    .'&propinsi='.urlencode('$propinsi')
                                    .'&q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'pembanding/peta.html';
            $config['first_url'] = base_url() . 'pembanding/peta.html';
        }
    	$config = array(
            'uri_segment'           => 3,
            'per_page'              => 5,  
            'page_query_string'     => TRUE,
            'reuse_query_string'    => TRUE,
            'total_rows'            => $this->Pembanding_model->get_allmapcount($tahun,$jenis,$harga,$propinsi,$q),
        );
        $pembanding = $this->Pembanding_model->get_allmaplimit($config['per_page'], $start,$tahun,$jenis,$harga,$propinsi,$q);
        //echo $this->db->last_query();

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $config['center']       = '-0.1007596,117.2045936';
        $config['zoom']         = '5';
        $this->googlemaps->initialize($config);
        foreach ($pembanding as $p) {
            $marker = array();
            
            $jenisdata = strtolower($p->jenisdata);
            switch ($jenisdata) {
            	case (preg_match('/.*toko.*/', $jenisdata) ? true : false):
                    $marker['icon'] = base_url().'/images/icon/pin-ruko.png';
                    break;
                case (preg_match('/.*kantor.*/', $jenisdata) ? true : false):
                    $marker['icon'] = base_url().'/images/icon/pin-ruko.png';
                    break;
                case "mobil":
                    $marker['icon'] = base_url().'/images/icon/pin-cars.png';
                    break;
                case "kios":
                    $marker['icon'] = base_url().'/images/icon/pin-kios.png';
                    break;
                case "tanah kosong":
                    $marker['icon'] = base_url().'/images/icon/pin-land.png';
                    break;
                case (preg_match('/.*tinggal.*/', $jenisdata) ? true : false):
                    $marker['icon'] = base_url().'/images/icon/pin-home.png';
                    break;
                case (preg_match('/.*apart.*/', $jenisdata) ? true : false):
                    $marker['icon'] = base_url().'/images/icon/pin-apartment.png';
                    break;
                default:
					$marker['icon'] = base_url().'/images/icon/pin-kjpp.png';
            }
            $marker['position'] = $p->lat;
            $marker['title'] = 	$p->jenisdata
            					.'\n'.' Nilai '.number_format($p->harga)
            					.'\n Tahun Data: '.$p->tahundata;
            $marker['infowindow_content']    = 
            '<h5>'.$p->jenisdata.'</h5>'
            .'<h4>&nbsp;&nbsp;<i class="material-icons money fa-1x text-success"></i> Nilai : '.number_format($p->harga)
            .'</h4><br/>'
            .'&nbsp;&nbsp;<i class="material-icons tag fa-1x text-primary"></i> Kategori Harga : '.$p->kategoriharga.'<br/>'
            .'&nbsp;&nbsp;<i class="material-icons resize fa-1x text-primary"></i> Luas Tanah : '.number_format($p->lt).'<br/>'
            .'&nbsp;&nbsp;<i class="material-icons building fa-1x text-primary"></i> Luas Bangunan : '.number_format($p->lb).'<br/>'
            .'&nbsp;&nbsp;<i class="material-icons calendar fa-1x text-success"></i> Tahun Data : '.$p->tahundata.'<br/>' 
            .'&nbsp;&nbsp;<i class="material-icons map-marker fa-1x text-danger"></i><strong> Koordinat :</strong>'.$p->lat.'<br/>'
            ;
            $this->googlemaps->add_marker($marker);
        }        
        $marker = array(
        	'q'					=> $q,
        	'pagination' 		=> $this->pagination->create_links(),
            'total_rows' 		=> $config['total_rows'],
            'start' 			=> $start,
            'main_content'      => 'pembanding/pembanding_peta',
            'tahun'             => $this->get_tahundata(),
            'title'             => 'Peta Data Pembanding',
            'map'               => $this->googlemaps->create_map(),
            'color'             => 'red darken-3',
        );            
            $this->load->view('includes/materialize', $marker);
    }
    public function read($id) 
    {
		$coords 				= $this->Pembanding_model->get_by_id($id);
		if(!empty($coords->lat))
		{
		$config['center']		= $coords->lat;
		$config['zoom']			= '17';
		$this->googlemaps->initialize($config);
		
		$marker					= array();
		$marker['position']		= $coords->lat;
		$marker['title'] 		= $coords->jenisdata.' di '.$coords->alamat
            					.'\n'.' Nilai '.number_format($coords->harga)
            					.'\n Tahun Data: '.$coords->tahundata;
        $marker['infowindow_content']    = '<h5> Alamat : '.$coords->alamat.'</h5>'
		.'&nbsp;&nbsp;<i class="material-icons map-marker fa-1x text-danger"></i><strong> Koordinat :</strong>'.$coords->lat.'<br/>'
		.'&nbsp;&nbsp;<i class="material-icons money fa-1x text-success"></i> Nilai : '.number_format($coords->harga).'<br/>'
		.'&nbsp;&nbsp;<i class="material-icons tag fa-1x text-primary"></i> Kategori Harga : '.$coords->kategoriharga.'<br/>'
		.'&nbsp;&nbsp;<i class="material-icons resize-horizontal fa-1x text-primary"></i> Luas Tanah : '.$coords->lt.'<br/>'
		.'&nbsp;&nbsp;<i class="material-icons building fa-1x text-primary"></i> Luas Bangunan : '.$coords->lb.'<br/>'
		.'&nbsp;&nbsp;<i class="material-icons database fa-1x text-danger"></i> Jenis Data : '.$coords->jenisdata.'<br/>'          
		.'&nbsp;&nbsp;<i class="material-icons database fa-1x text-success"></i> Tahun Data : '.$coords->tahundata.'<br/>' 
		;
		$jenisdata = strtolower(trim($coords->jenisdata));
            switch ($jenisdata) {
            	case (preg_match('/.*toko.*/', $jenisdata) ? true : false):
                    $marker['icon'] = base_url().'/images/icon/pin-ruko.png';
                    break;
                case (preg_match('/.*kantor.*/', $jenisdata) ? true : false):
                    $marker['icon'] = base_url().'/images/icon/pin-ruko.png';
                    break;
                case "mobil":
                    $marker['icon'] = base_url().'/images/icon/pin-cars.png';
                    break;
                case "kios":
                    $marker['icon'] = base_url().'/images/icon/pin-kios.png';
                    break;
                case "tanah kosong":
                    $marker['icon'] = base_url().'/images/icon/pin-land.png';
                    break;
                case (preg_match('/.*tinggal.*/', $jenisdata) ? true : false):
                    $marker['icon'] = base_url().'/images/icon/pin-home.png';
                    break;
                case (preg_match('/.*apart.*/', $jenisdata) ? true : false):
                    $marker['icon'] = base_url().'/images/icon/pin-apartment.png';
                    break;
                default:
					$marker['icon'] = base_url().'/images/icon/marker.png';
            }

		$this->googlemaps->add_marker($marker);				

		}

        $row = $this->Pembanding_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'user_id' => $row->user_id,
		'created' => $row->created,
		'created_by' => $row->created_by,
		'modified_user_id' => $row->modified_user_id,
		'modified' => $row->modified,
		'modified_by' => $row->modified_by,
		'alamat' => $row->alamat,
		'kategoriharga' => $row->kategoriharga,
		'harga' => $row->harga,
		'lt' => $row->lt,
		'lb' => $row->lb,
		'nokontak' => $row->nokontak,
		'nama' => $row->nama,
		'lat' => $row->lat,
		'picture' => $row->picture,
		'nolaporan' => $row->nolaporan,
		'jenisdata' => $row->jenisdata,
		'properti' => $row->properti,
		'merek' => $row->merek,
		'kapasitas' => $row->kapasitas,
		'tahunbuat' => $row->tahunbuat,
		'lokasipropinsi' => $row->lokasipropinsi,
		'kabupaten' => $row->kabupaten,
		'tahundata' => $row->tahundata,
	    );
			
			$data['map']			= $this->googlemaps->create_map();
			$data ['main_content']  = 'pembanding/pembanding_read';
            $data ['title']			= 'Detail Data Pembanding';
            $data ['color']         = 'green';
            //$this->load->view('pembanding/pembanding_read', $data);
			$this->load->view('includes/materialize',$data);
			
        } else {
            $this->session->set_flashdata('message', "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"message\">Data Tidak Ditemukan</div></div>");
            redirect(site_url('pembanding'));
        }
    }
    public function banyak_data($penilaianid)
    {
        $banyak_objek   = $this->input->post('banyak_objek',TRUE);
        $row            = $this->Penilaian_model->get_by_id($penilaianid);
        
        if($banyak_objek==NULL) {
            $data = array (
                'main_content'          => 'pembanding/pembanding_input_objek',
                'title'                 => 'Masukkan Jumlah Data Banding',
                'laporan'               => $row->nolap,
                'penilaianid'           => $penilaianid,
                );
            $this->load->view('includes/materialize',$data);
        }else{
            $data = array(
                'laporan'               => $row->nolap,
                'penilaianid'           => $penilaianid,
                'banyak_objek'          => $banyak_objek,
                );

            redirect('pembanding/create/'.$banyak_objek.'/'.$penilaianid);
        }
    }
    public function create($banyak_objek,$penilaianid) 
    {

        //$this->restricted();
        $row            = $this->Penilaian_model->get_by_id($penilaianid);
        $data = array(
            'button'            => 'Simpan',
            'action'            => site_url('pembanding/create_action'),
            'id'                => set_value('id'),
            'user_id'           => set_value('user_id'),
            'created'           => set_value('created'),
            'created_by'        => set_value('created_by'),
            'penilaianid'       => $penilaianid,
            'banyak_objek'      => $banyak_objek,
            'laporan'           => $row->nolap,
            'alamat'            => set_value('alamat'),
            'kategoriharga'     => set_value('kategoriharga'),
            'harga_selected'    => 'Penawaran',
            'harga'             => set_value('harga'),
            'lt'                => set_value('lt'),
            'lb'                => set_value('lb'),
            'nokontak'          => set_value('nokontak'),
            'nama'              => set_value('nama'),
            'picture'           => set_value('picture'),
            'nolaporan'         => set_value('nolaporan'),
            'jenisdata'         => set_value('jenisdata'),
            'jenisdata_selected'=> NULL,
            'properti'          => set_value('properti'),
            'properti_selected' => NULL,
            'merek'             => set_value('merek'),
            'kapasitas'         => set_value('kapasitas'),
            'tahunbuat'         => set_value('tahunbuat'),
            'lokasipropinsi'    => set_value('lokasipropinsi'),
            'propinsi_selected' => NULL,
            'kabupaten'         => set_value('kabupaten'),
            'kabupaten_selected'=> NULL,
            'tahundata'         => set_value('tahundata'),
            'breadcrumb_icon'   => 'material-icons pencil text-yellow',
            'breadcrumb_title'  => 'Daftar Laporan Penilaian',
            'breadcrumb'        => 'penilaian/index',
	);
		$data['main_content'] 	= 'pembanding/pembanding_form';
		$data['title']			= 'Form Data Pembanding';
		$this->load->view('includes/materialize', $data);
    }
    
    public function create_action() 
    {
        $this->create_rules();
        if ($this->form_validation->run() == FALSE) {
            $banyak_objek   = $this->input->post('banyak_objek',TRUE);
            $penilaianid    = $this->input->post('penilaianid',TRUE);
            $this->create($banyak_objek,$penilaianid);
            $this->session->set_flashdata('message', "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"message\">Data Banding Tidak Valid</div></div>");
            //redirect(site_url('penilaian'));
        } else {
            $nolaporan         = $this->input->post('nolaporan',TRUE);
            $jenisdata         = $this->input->post('jenisdata',TRUE);
            $alamat            = $this->input->post('alamat',TRUE);
            $kategoriharga     = $this->input->post('kategoriharga',TRUE);
            $harga             = $this->input->post('harga',TRUE);
            $lt                = $this->input->post('lt',TRUE);
            $lb                = $this->input->post('lb',TRUE);
            $nokontak          = $this->input->post('nokontak',TRUE);
            $nama              = $this->input->post('nama',TRUE);            
            $properti          = $this->input->post('properti',TRUE);
            $merek             = $this->input->post('merek',TRUE);
            $kapasitas         = $this->input->post('kapasitas',TRUE);
            $tahunbuat         = $this->input->post('tahunbuat',TRUE);
            $lokasipropinsi    = $this->input->post('lokasipropinsi',TRUE);
            $kabupaten         = $this->input->post('kabupaten',TRUE);
            $tahundata         = $this->input->post('tahundata',TRUE);                
            for ($i=0 ; $i < sizeof ($jenisdata); $i++)
            {
                $data[$i] = array(
    				'user_id'           => $this->session->userdata('id'),
    				'created'           => date('Y-m-d H:i:s'),
    				'created_by'        => $this->session->userdata('name'),
    				'nolaporan'         => $nolaporan,
                    'jenisdata'         => $jenisdata[$i],
                    'alamat'            => $alamat[$i],
                    'kategoriharga'     => $kategoriharga[$i],
                    'harga'             => $harga[$i],
                    'lt'                => $lt[$i],
                    'lb'                => $lb[$i],
                    'nokontak'          => $nokontak[$i],
                    'nama'              => $nama[$i],
    				'properti'          => $properti[$i],
    				'lokasipropinsi'    => $lokasipropinsi[$i],
    				'kabupaten'         => $kabupaten[$i],
    				'tahundata'         => $tahundata[$i],
    				'merek'             => $merek[$i],
                    'kapasitas'         => $kapasitas[$i],
                    'tahunbuat'         => $tahunbuat[$i],
                );
            }
                //var_dump($data);
                $this->db->insert_batch('pembanding',$data);
                $this->session->set_flashdata('message', "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"message\">Tambah Data Pembanding Berhasil</div></div>");
                redirect(site_url('penilaian'));
        }
    }
    
    public function update($id) 
    {
        // $this->restricted();
        $row = $this->Pembanding_model->get_by_id($id);

        if ($row) {
            $data = array(
				'button'            => 'Update',
				'action'            => site_url('pembanding/update_action'),
				'id'                => set_value('id', $row->id),
				'modified_user_id'  => set_value('modified_user_id', $row->modified_user_id),
				'modified'          => set_value('modified', $row->modified),
				'modified_by'       => set_value('modified_by', $row->modified_by),
				'alamat'            => set_value('alamat', $row->alamat),
				'kategoriharga'     => set_value('kategoriharga', $row->kategoriharga),
				'harga'             => set_value('harga', $row->harga),
                'harga_selected'    => $row->harga,
				'lt'                => set_value('lt', $row->lt),
				'lb'                => set_value('lb', $row->lb),
				'nokontak'          => set_value('nokontak', $row->nokontak),
				'nama'              => set_value('nama', $row->nama),
				'nolaporan'         => set_value('nolaporan', $row->nolaporan),
				'jenisdata'         => set_value('jenisdata', $row->jenisdata),
                'jenisdata_selected'=> $row->jenisdata,
				'properti'          => set_value('properti', $row->properti),
                'properti_selected' => $row->properti,
				'merek'             => set_value('merek', $row->merek),
				'kapasitas'         => set_value('kapasitas', $row->kapasitas),
				'tahunbuat'         => set_value('tahunbuat', $row->tahunbuat),
				'lokasipropinsi'    => set_value('lokasipropinsi', $row->lokasipropinsi),
                'propinsi_selected' => $row->lokasipropinsi,
				'kabupaten'         => set_value('kabupaten', $row->kabupaten),
                'kabupaten_selected'=> $row->kabupaten,
				'tahundata'         => set_value('tahundata', $row->tahundata),
				'main_content'      => 'pembanding/pembanding_form_update',
                'breadcrumb_icon'   => 'material-icons pencil text-yellow',
                'breadcrumb_title'  => 'Daftar Laporan Penilaian',
                'breadcrumb'        => 'penilaian/index',
	    );
			$data['title'] = 'Update Data Pembanding';
			$this->load->view('includes/materialize', $data);
        } else {
            $this->session->set_flashdata('message', "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"message\">Data Tidak Ditemukan</div></div>");
            redirect(site_url('pembanding'));
        }
    }
    public function update_action() 
    {
        $this->update_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'alamat'            => $this->input->post('alamat',TRUE),
                'kategoriharga'     => $this->input->post('kategoriharga',TRUE),
                'harga'             => $this->input->post('harga',TRUE),
                'lt'                => $this->input->post('lt',TRUE),
                'lb'                => $this->input->post('lb',TRUE),
                'nokontak'          => $this->input->post('nokontak',TRUE),
                'nama'              => $this->input->post('nama',TRUE),
                'jenisdata'         => $this->input->post('jenisdata',TRUE),
                'properti'          => $this->input->post('properti',TRUE),
                'merek'             => $this->input->post('merek',TRUE),
                'kapasitas'         => $this->input->post('kapasitas',TRUE),
                'tahunbuat'         => $this->input->post('tahunbuat',TRUE),
                'lokasipropinsi'    => $this->input->post('lokasipropinsi',TRUE),
                'kabupaten'         => $this->input->post('kabupaten',TRUE),
                'tahundata'         => $this->input->post('tahundata',TRUE),
                'modified_user_id'  => $this->session->userdata('id'),
                'modified'          => date('Y-m-d H:i:s'),
                'modified_by'       => $this->session->userdata('name'),
            );
            $this->Pembanding_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"message\">Update Data Pembanding Berhasil</div></div>");
            redirect(site_url('pembanding'));
        }
    }
    
    public function update_coordinate($id)
    {
    	$row = $this->Pembanding_model->get_by_id($id);
        $config                 = array();
        if($row->lat==''){
            $config['center']     = $row->alamat;
        }else{
            $config['center']     = $row->lat;
        }
        $config['places']       = TRUE;
        $config['zoom']         = '17';
        $this->googlemaps->initialize($config);
        
        $marker                = array();
        $marker['draggable']  = TRUE;
        $marker['ondragend']  = 'updateKoordinat(event.latLng.lat(),event.latLng.lng());';
        if($row->lat==''){
            $marker['position']     = $row->alamat;
        }else{
            $marker['position']     = $row->lat;
        }
        $marker['title']        = $row->jenisdata.' di '.$row->alamat
                                .'\n'.' Nilai '.number_format($row->harga)
                                .'\n Tahun data: '.$row->tahundata;
        $marker['infowindow_content']    = '<h5> Alamat : '.$row->alamat.'</h5>'
        .'&nbsp;&nbsp;<i class="material-icons map-marker fa-1x text-danger"></i><strong> Koordinat :</strong>'.$row->lat.'<br/>'
        .'&nbsp;&nbsp;<i class="material-icons money fa-1x text-success"></i> Nilai : '.number_format($row->harga).'<br/>'
        .'&nbsp;&nbsp;<i class="material-icons tag fa-1x text-primary"></i> Kategori Harga : '.$row->kategoriharga.'<br/>'
        .'&nbsp;&nbsp;<i class="material-icons resize-horizontal fa-1x text-primary"></i> Luas Tanah : '.$row->lt.'<br/>'
        .'&nbsp;&nbsp;<i class="material-icons building fa-1x text-primary"></i> Luas Bangunan : '.$row->lb.'<br/>'
        .'&nbsp;&nbsp;<i class="material-icons markerbase fa-1x text-danger"></i> Jenis data : '.$row->jenisdata.'<br/>'          
        .'&nbsp;&nbsp;<i class="material-icons markerbase fa-1x text-success"></i> Tahun data : '.$row->tahundata.'<br/>' 
        ;
        $jenisdata = strtolower(trim($row->jenisdata));
            switch ($jenisdata) {
                case (preg_match('/.*toko.*/', $jenisdata) ? true : false):
                    $marker['icon'] = base_url().'/images/icon/pin-ruko.png';
                    break;
                case (preg_match('/.*kantor.*/', $jenisdata) ? true : false):
                    $marker['icon'] = base_url().'/images/icon/pin-ruko.png';
                    break;
                case "mobil":
                    $marker['icon'] = base_url().'/images/icon/pin-cars.png';
                    break;
                case "kios":
                    $marker['icon'] = base_url().'/images/icon/pin-kios.png';
                    break;
                case "tanah kosong":
                    $marker['icon'] = base_url().'/images/icon/pin-land.png';
                    break;
                case (preg_match('/.*tinggal.*/', $jenisdata) ? true : false):
                    $marker['icon'] = base_url().'/images/icon/pin-home-land.png';
                    break;
                case (preg_match('/.*apart.*/', $jenisdata) ? true : false):
                    $marker['icon'] = base_url().'/images/icon/pin-apartment.png';
                    break;
                default:
                    $marker['icon'] = base_url().'/images/icon/pin-kjpp.png';
            }
        $this->googlemaps->add_marker($marker);             
        if ($row) {
            $data = array(
            	'button' 			=> 'Update Koordinat',
				'action' 			=> site_url('pembanding/update_coordinate_action'),
            	'id' 				=> set_value('id', $row->id),
            	'lat' 				=> set_value('lat', $row->lat),
				'modified_user_id' 	=> set_value('modified_user_id', $row->modified_user_id),
				'modified' 			=> set_value('modified', $row->modified),
				'modified_by' 		=> set_value('modified_by', $row->modified_by),
            	'jenisdata' 		=> $row->jenisdata,
            	'alamat' 			=> $row->alamat,
            	'tahundata' 		=> $row->tahundata,
            	'harga'				=> $row->harga,
            	'kategoriharga'		=> $row->kategoriharga,
            	'lt'				=> $row->lt,
            	'lb'				=> $row->lb,
            	'tahundata'			=> $row->tahundata,
            	'main_content'		=> 'pembanding/pembanding_coordinate',
            	'title'				=> 'Update Koordinat Data Pembanding',
                'breadcrumb_icon'   => 'material-icons bank text-success',
                'breadcrumb_title'  => 'Daftar Laporan Penilaian',
                'breadcrumb'        => 'penilaian/index',
            	);
            $data['map'] = $this->googlemaps->create_map();
			$this->load->view('includes/materialize', $data);
            //$this->load->view('pembanding/pembanding_coordinate', $data);
		}else {
            $this->session->set_flashdata('message', "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"message\">Data Tidak Ditemukan</div></div>");
            redirect(site_url('pembanding'));
        }				
    }

    public function update_coordinate_action()
    {
    	$this->form_validation->set_rules('lat', 'lat', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->update_coordinate($this->input->post('id', TRUE));
        } else {
            $data = array(
				'modified_user_id'  => $this->session->userdata('id'),
                'modified'          => date('Y-m-d H:i:s'),
                'modified_by'       => $this->session->userdata('name'),
				'lat'               => $this->input->post('lat',TRUE),
				);
            $this->Pembanding_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', "<div class=\"green darken-4 white-text\">Update Koordinat Data Pembanding Berhasil</div>");
            redirect(site_url('pembanding'));
		}
    }
    
    public function delete($id) 
    {
        $this->restricted();
        $row = $this->Pembanding_model->get_by_id($id);

        if ($row) {
            $this->Pembanding_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Data Pembanding Berhasil');
            redirect(site_url('pembanding'));
        } else {
            $this->session->set_flashdata('message', "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"message\">Data Tidak Ditemukan</div></div>");
            redirect(site_url('pembanding'));
        }
    }

    public function create_rules() 
    {
	$this->form_validation->set_rules('alamat[]', 'Alamat', 'trim|required');
	$this->form_validation->set_rules('kategoriharga[]', 'Kategori Harga', 'trim|required');
	$this->form_validation->set_rules('harga[]', 'Harga', 'trim|required');
	$this->form_validation->set_rules('nokontak[]', 'No Kontak', 'trim|required');
	$this->form_validation->set_rules('nama[]', 'Nama Kontak', 'trim|required');
	//$this->form_validation->set_rules('nolaporan', 'nolaporan', 'trim|required');
	$this->form_validation->set_rules('jenisdata[]', 'Jenis Data', 'trim|required');
	$this->form_validation->set_rules('properti[]', 'Properti', 'trim|required');
	$this->form_validation->set_rules('tahundata[]', 'Tahun Data', 'trim|required');
	$this->form_validation->set_rules('lokasipropinsi[]', 'Propinsi', 'trim|required');
	$this->form_validation->set_rules('kabupaten[]', 'Kabupaten', 'trim|required');
	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
	public function update_rules() 
    {
	$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
	$this->form_validation->set_rules('kategoriharga', 'Kategori Harga', 'trim|required');
	$this->form_validation->set_rules('harga', 'Harga', 'trim|required');
	$this->form_validation->set_rules('nokontak', 'No Kontak', 'trim|required');
	$this->form_validation->set_rules('nama', 'Nama Kontak', 'trim|required');
	$this->form_validation->set_rules('jenisdata', 'Jenis Data', 'trim|required');
	$this->form_validation->set_rules('properti', 'Properti', 'trim|required');
	$this->form_validation->set_rules('tahundata', 'Tahun Data', 'trim|required');
	$this->form_validation->set_rules('lokasipropinsi', 'Propinsi', 'trim|required');
	$this->form_validation->set_rules('kabupaten', 'Kabupaten', 'trim|required');
	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "pembanding.xls";
        $judul = "pembanding";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Storage Id");
	xlsWriteLabel($tablehead, $kolomhead++, "User Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Created");
	xlsWriteLabel($tablehead, $kolomhead++, "Created By");
	xlsWriteLabel($tablehead, $kolomhead++, "Modified User Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Modified");
	xlsWriteLabel($tablehead, $kolomhead++, "Modified By");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
	xlsWriteLabel($tablehead, $kolomhead++, "Kategoriharga");
	xlsWriteLabel($tablehead, $kolomhead++, "Harga");
	xlsWriteLabel($tablehead, $kolomhead++, "Lt");
	xlsWriteLabel($tablehead, $kolomhead++, "Lb");
	xlsWriteLabel($tablehead, $kolomhead++, "Nokontak");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama");
	xlsWriteLabel($tablehead, $kolomhead++, "Lat");
	xlsWriteLabel($tablehead, $kolomhead++, "Picture");
	xlsWriteLabel($tablehead, $kolomhead++, "Nolaporan");
	xlsWriteLabel($tablehead, $kolomhead++, "Jenisdata");
	xlsWriteLabel($tablehead, $kolomhead++, "Properti");
	xlsWriteLabel($tablehead, $kolomhead++, "Merek");
	xlsWriteLabel($tablehead, $kolomhead++, "Kapasitas");
	xlsWriteLabel($tablehead, $kolomhead++, "Tahunbuat");
	xlsWriteLabel($tablehead, $kolomhead++, "Lokasipropinsi");
	xlsWriteLabel($tablehead, $kolomhead++, "Kabupaten");
	xlsWriteLabel($tablehead, $kolomhead++, "Tahundata");

	foreach ($this->Pembanding_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->storage_id);
	    xlsWriteNumber($tablebody, $kolombody++, $data->user_id);
	    xlsWriteLabel($tablebody, $kolombody++, $data->created);
	    xlsWriteLabel($tablebody, $kolombody++, $data->created_by);
	    xlsWriteNumber($tablebody, $kolombody++, $data->modified_user_id);
	    xlsWriteLabel($tablebody, $kolombody++, $data->modified);
	    xlsWriteLabel($tablebody, $kolombody++, $data->modified_by);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kategoriharga);
	    xlsWriteLabel($tablebody, $kolombody++, $data->harga);
	    xlsWriteLabel($tablebody, $kolombody++, $data->lt);
	    xlsWriteLabel($tablebody, $kolombody++, $data->lb);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nokontak);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama);
	    xlsWriteLabel($tablebody, $kolombody++, $data->lat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->picture);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nolaporan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jenisdata);
	    xlsWriteLabel($tablebody, $kolombody++, $data->properti);
	    xlsWriteLabel($tablebody, $kolombody++, $data->merek);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kapasitas);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tahunbuat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->lokasipropinsi);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kabupaten);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tahundata);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=pembanding.doc");

        $data = array(
            'pembanding_data' => $this->Pembanding_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('pembanding/pembanding_doc',$data);
    }

}

/* End of file Pembanding.php */
/* Location: ./application/controllers/Pembanding.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-01-09 06:08:28 */
/* http://harviacode.com */