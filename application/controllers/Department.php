<?php
/**
 * Department
 * 
 * @package CI
 * @subpackage Controller
 * @author Prajay Patel <patelprajay@gmail.com>
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 class Department extends CI_Controller {
     public function __construct()
     {
          parent::__construct();
          $this->load->helper('url');
          $this->load->database();
     }

     function index()
     {
          //load the department_model
          $this->load->model('department_model');  
          //call the model function to get the department data
          $deptresult = $this->department_model->get_department_list();           
          $data['deptlist'] = $deptresult;
          //load the department_view
          $this->load->view('department_view',$data);
          //$this->load->view('employee_view',$data);
     }
}
?>
