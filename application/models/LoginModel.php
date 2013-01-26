<?php
class LoginModel extends CI_Model {
	var $username = '';
	var $password = '';
	public function __construct()
	{
		//$this->load->database();
	}
	
	function checkValidation()
	{
		$query = $this->db->query('select * from demoapp.user where username = "'.$this->username.'" and password = "'.$this->password.'"');
		if($query->num_rows() == 1)
		{
			return true;
		}
		else 
		{
			return false;
		}
	} 
}
?>