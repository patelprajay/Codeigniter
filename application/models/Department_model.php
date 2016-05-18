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
	 * get department details on based on $limit and $start
	 * 
	 * @param string $limit number of records to featch from database
	 * @param string $start number from where to start to featch the records from the database
	 * @return array
	 */
	function get_department_list($limit,$start)
	{
		$this->db->select('department_id');
		$this->db->select('department_name');
		$this->db->from('tbl_department');
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		$result = $query->result();
		
		return $result;
	}
}
?>
