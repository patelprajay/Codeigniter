<?php
/**
 * Department
 * 
 * @package CI
 * @subpackage Model
 * @author Prajay Patel <patelprajay@gmail.com>
 */
 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class department_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * get department table to populate the department name dropdown
	 * 
	 * @return array
	 */
	function get_department_list()
	{
		$this->db->select('department_id');
		$this->db->select('department_name');
		$this->db->from('tbl_department');
		$query = $this->db->get();
		$result = $query->result();
		
		return $result;
	}
}
?>
