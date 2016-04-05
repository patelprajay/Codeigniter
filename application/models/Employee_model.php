<?php
/**
 * Employee
 * 
 * @package CI
 * @subpackage Model
 * @author Prajay Patel <patelprajay@gmail.com>
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class employee_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * get employee detail for particaler empno
	 * 
	 * @param string $empno value of the employee number
	 * @return array
	 */
	function get_employee_record($empno)
	{
		$this->db->where('employee_no', $empno);
		$this->db->from('tbl_employee');
		$query = $this->db->get();
		return $query->result();
	}
	
	/**
	 * get employee detail with its department and designation
	 * 
	 * @return array
	 */
	
	function get_employee_list()
	{
		$this->db->from('tbl_employee');
		$this->db->join('tbl_department','tbl_employee.department_id = tbl_department.department_id');
		$this->db->join('tbl_designation','tbl_employee.designation_id = tbl_designation.designation_id');
		$query = $this->db->get();
		return $query->result();
	}
	/**
	 * get department table to populate the department name dropdown
	 * 
	 * @return array
	 */
	function get_department()
	{
		$this->db->select('department_id');
		$this->db->select('department_name');
		$this->db->from('tbl_department');
		$query = $this->db->get();
		$result = $query->result();
		
		$dept_id = array('-SELECT-');
		$dept_name = array('-SELECT-');
		
		for($i=0;$i < count($result);$i++)
		{
			array_push($dept_id,$result[$i]->department_id);
			array_push($dept_name, $result[$i]->department_name);
		}
		return $department_result = array_combine($dept_id,$dept_name);
	}
	
	/**
	 * get designation table to populate the designation name dropdown
	 * 
	 * @return array
	 */
	function get_designation()
	{
		$this->db->select('designation_id');
		$this->db->select('designation_name');
		$this->db->from('tbl_designation');
		$query = $this->db->get();
		$result = $query->result();
		
		$designation_id = array('-SELECT-');
		$designation_name = array('-SELECT-');
		
		for($i=0;$i < count($result);$i++)
		{
			array_push($designation_id,$result[$i]->designation_id);
			array_push($designation_name,$result[$i]->designation_name);
		}
		return $designation_result = array_combine($designation_id,$designation_name);
	}
}
?>
