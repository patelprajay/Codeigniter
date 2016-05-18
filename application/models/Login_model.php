<?php
/**
 * Login
 * 
 * @package CI
 * @subpackage Model
 * @author Prajay Patel<patelprajay@gmail.com>
 */
 
if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Login_model extends CI_Model{
	
	public function __construct(){
		parent::__construct();
	}
	
	/**
	 * get user details from the username and password entered
	 * 
	 * @param string $usr Username of the user
	 * @param string $pwd Password of the user
	 * @return array
	 */
	function get_user($usr,$pwd)
	{
		$sql = "SELECT * FROM tbl_user WHERE username = '".$usr."' AND password = '".md5($pwd)."' AND status = 'active'";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
}
?>
