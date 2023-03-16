<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('Admin_Model','admin_model');
	}

	public function index() {
		if($this->session->userdata('user')){
			redirect(base_url('admin/dashboard'));
		}else{
			$data = array();
			$this->template->load_login($data);
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('user');
		//$this->session->sess_destroy();
		$this->session->set_flashdata('login_success_message', 'You Have Successfully Logged Out Of Your Account.');
		$data = array();
		$this->template->load_login($data);
	
	}
	public function login()
	{
		//print_r($this->input->post());die();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
	
		if ($this->form_validation->run() == true){
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$result = $this->admin_model->login_check($username, md5($password));
			//print_r($result);die();
			if($result){
				$this->session->set_userdata('user', $result[0]);
				redirect(base_url('admin/dashboard'));
			}else{
				$this->session->set_flashdata('login_error', 'Incorrect username/password combination being used.');
				redirect(base_url('admin'));
			}
		}else{
			$this->session->set_flashdata('login_error', 'Incorrect username/password combination being used.');
			redirect(base_url('admin'));
		}
	}

	public function forgot_password(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'email', 'required|valid_email');
		
		if ($this->form_validation->run() == true)
		{
			$user = $this->admin_model->get_user_by_email($_POST['email']);
			if (empty($user )) {
				$this->session->set_flashdata('login_error', 'Email is not found. Please try again.');
				redirect(base_url().'user/index/#signup');
				exit;
			}
			
			$this->load->model('Email_Model','Email_model');
			
			$new_password= $this->Email_model->random_string(7);
			$email_send = $this->Email_model->send_forget_password($user,$new_password);
			if(! $email_send)
			{ 
				$this->session->set_flashdata('login_error', 'Could not send email. Please try again.');
				redirect(base_url().'user/index/#signup');
				exit;
			}else{
				$update = array('password' =>md5($new_password));
				$this->admin_model->update_user($update, $user->id);
				$this->session->set_flashdata('login_success_message', 'Please check your email to find your password');
				redirect(base_url().'user/index');
			}
			
		}else{
			$this->session->set_flashdata('login_error', 'Incorrect email being used.');
			redirect(base_url().'user/index/#signup');
			exit;			
		}
	}
}