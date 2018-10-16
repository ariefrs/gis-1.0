<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function tgl_indo($tgl){
    $ubah = gmdate($tgl, time()+60*60*8);
    $pecah = explode("-",$ubah);
    $tanggal = $pecah[2];
    $bulan = bulan($pecah[1]);
    $tahun = $pecah[0];
    return $tanggal.' '.$bulan.' '.$tahun;
}
function tgldikit($tgl){
 
        $inttime=date('Y-m-d H:i:s',$tgl);
 
        $arr_bulan=array("","Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Des");
        $tglBaru=explode(" ",$inttime);
        $tglBaru1=$tglBaru[0];$tglBaru2=$tglBaru[1];
        $tglBarua=explode("-",$tglBaru1);
        $tgl=$tglBarua[2]; $bln=$tglBarua[1]; $thn=$tglBarua[0];
        if(substr($bln,0,1)=="0") $bln=substr($bln,1,1);
        $bln=substr($arr_bulan[$bln],0,10);
        $ubahTanggal="$tgl $bln $thn";
 
     return $ubahTanggal;
}
function rupiah($nilai, $pecahan = 0){
   return number_format($nilai, $pecahan, ',', '.');
}
function rupiah2($harga)
{
    $a=(string)$harga; //membuat $harga menjadi string
    $len=strlen($a); //menghitung panjang string $a
 
    if ( $len <=18 )
    {
        $ratril=$len-3-1;
        $ramil=$len-6-1;
        $rajut=$len-9-1; //untuk mengecek apakah ada nilai ratusan juta (9angka dari belakang)
        $juta=$len-12-1; //untuk mengecek apakah ada nilai jutaan (6angka belakang)
        $ribu=$len-15-1; //untuk mengecek apakah ada nilai ribuan (3angka belakang)
 
        $angka='';
        for ($i=0;$i<$len;$i++)
        {
            if ( $i == $ratril )
            {
                $angka=$angka.$a[$i].".";
            }
            else if ($i == $ramil )
            {
                $angka=$angka.$a[$i].".";
            }
            else if ( $i == $rajut )
            {
                $angka=$angka.$a[$i]."."; //meletakkan tanda titik setelah 3angka dari depan
            }
            else if ( $i == $juta )
            {
                $angka=$angka.$a[$i]."."; //meletakkan tanda titik setelah 6angka dari depan
            }
            else if ( $i == $ribu )
            {
                $angka=$angka.$a[$i]."."; //meletakkan tanda titik setelah 9angka dari depan
            }
            else
            {
                $angka=$angka.$a[$i];
            }
        }
    }
    echo $angka.",-";
    }
function kekata($x) {
    $x = abs($x);
    $angka = array("", "satu", "dua", "tiga", "empat", "lima",
    "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($x <12) {
        $temp = " ". $angka[$x];
    } else if ($x <20) {
        $temp = kekata($x - 10). " belas";
    } else if ($x <100) {
        $temp = kekata($x/10)." puluh". kekata($x % 10);
    } else if ($x <200) {
        $temp = " seratus" . kekata($x - 100);
    } else if ($x <1000) {
        $temp = kekata($x/100) . " ratus" . kekata($x % 100);
    } else if ($x <2000) {
        $temp = " seribu" . kekata($x - 1000);
    } else if ($x <1000000) {
        $temp = kekata($x/1000) . " ribu" . kekata($x % 1000);
    } else if ($x <1000000000) {
        $temp = kekata($x/1000000) . " juta" . kekata($x % 1000000);
    } else if ($x <1000000000000) {
        $temp = kekata($x/1000000000) . " milyar" . kekata(fmod($x,1000000000));
    } else if ($x <1000000000000000) {
        $temp = kekata($x/1000000000000) . " trilyun" . kekata(fmod($x,1000000000000));
    }     
        return $temp;
}
function terbilang($x, $style=4) {
    if($x<0) {
        $hasil = "minus ". trim(kekata($x));
    } else {
        $hasil = trim(kekata($x));
    }     
    switch ($style) {
        case 1:
            $hasil = strtoupper($hasil);
            break;
        case 2:
            $hasil = strtolower($hasil);
            break;
        case 3:
            $hasil = ucwords($hasil);
            break;
        default:
            $hasil = ucfirst($hasil);
            break;
    }     
    return $hasil;
}
function terbilang1($x) {
    if($x<0) {
        $hasil = "minus ". trim(kekata($x));
    } else {
        $hasil = trim(kekata($x))." rupiah";
    }     
    return $hasil;
}
function indonesian_date ($timestamp = '', $date_format = 'l, j F Y | H:i', $suffix = 'WIB') {
    if (trim ($timestamp) == '')
    {
            $timestamp = time ();
    }
    elseif (!ctype_digit ($timestamp))
    {
        $timestamp = strtotime ($timestamp);
    }
    # remove S (st,nd,rd,th) there are no such things in indonesia :p
    $date_format = preg_replace ("/S/", "", $date_format);
    $pattern = array (
        '/Mon[^day]/','/Tue[^sday]/','/Wed[^nesday]/','/Thu[^rsday]/',
        '/Fri[^day]/','/Sat[^urday]/','/Sun[^day]/','/Monday/','/Tuesday/',
        '/Wednesday/','/Thursday/','/Friday/','/Saturday/','/Sunday/',
        '/Jan[^uary]/','/Feb[^ruary]/','/Mar[^ch]/','/Apr[^il]/','/May/',
        '/Jun[^e]/','/Jul[^y]/','/Aug[^ust]/','/Sep[^tember]/','/Oct[^ober]/',
        '/Nov[^ember]/','/Dec[^ember]/','/January/','/February/','/March/',
        '/April/','/June/','/July/','/August/','/September/','/October/',
        '/November/','/December/',
    );
    $replace = array ( 'Sen','Sel','Rab','Kam','Jum','Sab','Min',
        'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu',
        'Jan ','Feb ','Mar ','Apr ','Mei ','Jun ','Jul ','Agu ','Sep ','Okt ','Nov ','Des ',
        'Januari','Februari','Maret','April','Juni','Juli','Agustus','Sepember',
        'Oktober','November','Desember',
    );
    $date = date ($date_format, $timestamp);
    $date = preg_replace ($pattern, $replace, $date);
    $date = "{$date} {$suffix}";
    return $date;
} 
    
/* End of file formatindonesia_helper.php */
/* Location: ./application/helpers/combodinamis_helper.php */
//See more at: http://fabernainggolan.net/membuat-fungsi-helper-di-codeigniter#sthash.lrn60njt.dpuf