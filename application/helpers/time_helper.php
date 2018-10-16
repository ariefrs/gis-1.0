<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Fungsi untuk convert waktu ke d-m-Y
 * @param date 
 * @return string
 */

if ( function_exists( 'date_default_timezone_set' ) )
date_default_timezone_set('Asia/Jakarta');

if(!function_exists('waktu'))
{
	function waktu($date, $format = 'd-M-Y')
	{
		if($date != '0000-00-00') {
			$convert_date_to_unix = strtotime($date);
			$formating = date( $format, $convert_date_to_unix);    		
		} else {
			$formating = '';	
		}

		return $formating;
	}

}
if(!function_exists('waktu1'))
{
	function waktu1($date, $format = 'd-m-Y H:i:s')
	{
		if($date != '0000-00-00') {
			$convert_date_to_unix = strtotime($date);
			$formating = date( $format, $convert_date_to_unix);    		
		} else {
			$formating = '';	
		}

		return $formating; 
	}

}
/**
 * Fungsi untuk convert waktu mysql db 'Y-m-d H:i:s'
 * @param date $data
 * @param date $format
 * @return string
 */

if(!function_exists('tanggal_db'))
{
	function tanggal_db( $date, $format = 'Y-m-d H:i:s' )
	{
		$convert_date_to_unix = strtotime( $date );
		$formating = date( $format, $convert_date_to_unix);
		return $formating;
	}

}
if(!function_exists('tgldb'))
{
	function tgldb( $date, $format = 'Y-m-d' )
	{
		$convert_date_to_unix = strtotime( $date );
		$formating = date( $format, $convert_date_to_unix);
		return $formating;
	}

}

/**
 * Fungsi untuk mendapatkan bulan pada waktu tertentu
 * @param date
 * @return string
 */

if(!function_exists('get_bulan'))
{
	function get_bulan( $date )
	{
		$convert_date_to_unix = strtotime( $date );
		$formating = date( 'n', $convert_date_to_unix);
		return $formating;
	}

}

/**
 * Fungsi menghitung hari
 * @param date
 * @return string
 */

if(!function_exists('count_date'))
{
	function count_date( $date2 )
	{
		$date1 = date('Y-m-d');
		$days = (strtotime($date1) - strtotime($date2)) / (60 * 60 * 24);
		return $days;
	}

}