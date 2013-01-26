<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller 
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
		$info['loginaction']= site_url('login/authonticate');
		$info['registration']= site_url('login/registration');
		$this->load->view('LoginView', $info);
	}
	
	 public function authonticate()
	{
		$this->_set_login_rules();
		$this->LoginModel->username = $this->input->post('username');
		$this->LoginModel->password = $this->input->post('password');
		$info['loginaction']= site_url('login/authonticate');
		$info['registration'] = site_url('login/registration');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('LoginView', $info);
		}
		else
		{
			$result = $this->LoginModel->checkValidation();
			
			if($result)
			{	
				$this->load->view('WelcomeView', $info);
			}
			else {
				$this->form_validation->set_message('Please enter correct username and password');
				$this->load->view('LoginView', $info);
			}
		}
	}
	
	function registration()
	{
		$this->_set_register_rules();
		$usernamesignup = $this->input->post('usernamesignup');
		$passwordsignup = $this->input->post('passwordsignup');
		$emailsignup = $this->input->post('emailsignup');
		$info['loginaction']= site_url('login/authonticate');
		$info['registration'] = site_url('login/registration');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('LoginView', $info);
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
				$this->load->view('LoginView', $info);
			}
		}
	}
	
	function _set_login_rules()
	{
		$config_rules = array(
		   array(
				 'field'   => 'username',
				 'label'   => 'Username',
				 'rules'   => 'required|min_length[3]|max_length[10]'
			  ),
		   array(
				 'field'   => 'password',
				 'label'   => 'Password',
				 'rules'   => 'required'
			  )
         );		
		$this->form_validation->set_rules($config_rules);
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
				 'rules'   => 'required|match(passwordsignup_confirm)'
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