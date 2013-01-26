<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller 
{
	function __construct(){
		
		parent::__construct();
		
		  // load library
		$this->load->library(array('table','form_validation'));
		
		// load helper
		$this->load->helper('url');
		
		// load model
		$this->load->model('LoginModel','',TRUE);
	}
	
 	public function index()
	{
		$info['registration']= site_url('register/registration');
		$this->load->view('RegisterView', $info);
	}
		
	function registration()
	{
		$this->_set_register_rules();
		$usernamesignup = $this->input->post('usernamesignup');
		$passwordsignup = $this->input->post('passwordsignup');
		$emailsignup = $this->input->post('emailsignup');
		$info['registration'] = site_url('register/registration');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('RegisterView', $info);
		}
		else
		{
//			$result = $this->LoginModel->checkValidation($user, $pass);
			$result = false;		
			if($result)
			{	
				$this->load->view('WelcomeView', $info);
			}
			else {
				$this->form_validation->set_message('Please enter correct username and password');
				$this->load->view('RegisterView', $info);
			}
		}
	}
	
	function _set_register_rules()
	{
		$config_rules = array(
		   array(
				 'field'   => 'usernamesignup',
				 'label'   => 'Username',
				 'rules'   => 'required|min_length[3]|max_length[10]'
			  ),
		   array(
				 'field'   => 'emailsignup',
				 'label'   => 'Email',
				 'rules'   => 'required|valid_email'
			  ),
			array(
				 'field'   => 'passwordsignup',
				 'label'   => 'Password',
				 'rules'   => 'required|matches[passwordsignup_confirm]'
			  ),
			array(
				 'field'   => 'passwordsignup_confirm',
				 'label'   => 'Confirm Password',
				 'rules'   => 'required'
			  )			  
         );		
		$this->form_validation->set_rules($config_rules);
	}

	function _set_fields()
	{
		$config = array(
		   array(
				 'field'   => 'username',
				 'label'   => 'Username',
				 'rules'   => 'required'
			  ),
		   array(
				 'field'   => 'password',
				 'label'   => 'Password',
				 'rules'   => 'required'
			  )
         );
			
		$this->form_validation->set_fields($config);
	}
		
}
?>