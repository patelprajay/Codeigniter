<?php
/**
 * DeleteEmployee
 * 
 * @package CI
 * @subpackage Contoller
 * @author Prajay Patel <patelprajay@gmail.com>
 */

if(!defined('BASEPATH')) exit('No direct script access allowed!');

class DeleteEmployee extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->database();
		$this->load->model('employee_model');
	}
	
	/**
	 * get the list of all employee with department and designation and pass it to its view
	 */
	function index()
	{
		$data['employee_list'] = $this->employee_model->get_employee_list();
		$this->load->view('delete_employee_view',$data);
	}
	
	/**
	 * delete the employee on basis of the $id
	 * 
	 * @param string $id value of employee id 
	 */
	function delete_employee($id)
	{
		$this->db->where('employee_id',$id);
		$this->db->delete('tbl_employee');
		redirect('deleteEmployee/index');
	}
}
?>
