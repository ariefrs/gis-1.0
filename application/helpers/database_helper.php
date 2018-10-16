<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Fungsi untuk mendapatkan field pada table tertentu
 * @param field
 * @param table
 * @return string
 */
if(!function_exists('get_all'))
{
function get_all($field,$table) {
		$CI = &get_instance();
	    $CI->db->select($field);
	    $CI->db->order_by($field,'ASC');
	    $query = $CI->db->get($table);
    return $query->result();
    }
}
/**
 * Fungsi untuk mendapatkan field berdasarkan kriteria tertentu pada table
 * @param field
 * @param condition
 * @param table
 * @return string
 */
if(!function_exists('get_where'))
{
function get_where($field,$condition,$table) {
		$CI = &get_instance();
	    $CI->db->select($field);
	    $CI->db->where($condition);
	    $CI->db->order_by($field,'ASC');
	    $query = $CI->db->get($table);
    return $query->result();
    }
}
/**
 * Fungsi untuk mendapatkan distinct field pada table tertentu
 * @param field
 * @param table
 * @return string
 */

if(!function_exists('get_distinct'))
{
function get_distinct($field,$table) {
		$CI = &get_instance();
	    $CI->db->distinct();
	    $CI->db->select($field);
	    $CI->db->order_by($field,'DESC');
	    $query = $CI->db->get($table);
    return $query->result();
    }
}
/**
 * Fungsi untuk mendapatkan field berdasarkan kriteria tertentu pada table
 * Digunakan untuk cek duplikasi
 * @param condition
 * @param table
 * @return Boolean
 */
if(!function_exists('get_duplicate'))
{
function get_duplicate($condition,$table) {
		$CI = &get_instance();
	    $CI->db->where($condition);
	    $query = $CI->db->get($table);
	    if ($query->num_rows() > 0 )
	    {
	    	return TRUE;
	    }else
	    {
	    	return FALSE;
	    }
    
    }
}