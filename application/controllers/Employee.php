<?php
/**
 * Employee
 * 
 * @package CI
 * @subpackage Controller
 * @author Prajay Patel <patelprajay@gmail.com>
 * 
 */
 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employee extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->database();
		$this->load->library('form_validation');
		$this->load->model('employee_model');
		$this->output->cache(60); // used to create the cache page
	}
	
	/**
	 * get the list of all emloyee
	 * 
	 */
	function index()
	{
		// fecth data from department and designation tables
		$data['department'] = $this->employee_model->get_department();
		$data['designation'] = $this->employee_model->get_designation();
		
		//Set validation rules
		$this->form_validation->set_rules('employeeno','Employee No','trim|required|numeric');
		$this->form_validation->set_rules('employeename','Employee Name'.'trim|required|xss_clean|callback_alpha_only_space');
		$this->form_validation->set_rules('department','Department','callback_combo_check');
		$this->form_validation->set_rules('designation','Designation','callback_combo_check');
		$this->form_validation->set_rules('hireddate','Hired Date','required');
		$this->form_validation->set_rules('salary','Salary','required|numeric');
		
		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('employee_view',$data);
		}
		else
		{
			$data = array(	'employee_no' => $this->input->post('employeeno'),
							'employee_name' => $this->input->post('employeename'),
							'department_id' => $this->input->post('department'),
							'designation_id' => $this->input->post('designation'),
							'hired_date' => @date('Y-m-d',@strtotime($this->input->post('hireddate'))),
							'salary' => $this->input->post('salary'),
						);
			$this->db->insert('tbl_employee',$data);
			$this->session->set_flashdata('msg','<div class="alert alert-sucess text-center">Employees details added to Database!!!</div>');
			redirect('employee/index');
		}
	}
	
	/**
	 * custom validation function for dropdown input
	 * 
	 * @param string $str value of the dropdownbox
	 * @return boolean
	 */
	function combo_check($str)
	{
		if($str == '-SELECT-')
		{
			$this->form_validation->set_message('combo_check','Valid %s Name is required');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	/**
	 * custom validation function to accept only alpha and space input
	 * 
	 * @param string $str To check weather inputed string contains only aplhabets and space
	 * @return boolean
	 */
	function alpha_only_space($str)
	{
		if(!preg_match("/^([-a-z ])+$/i",$str))
		{
			$this->form_validation->set_message('alpha_only_space', 'The %s field must contain only alphabets or spaces');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
}
?>
