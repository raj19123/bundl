<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public $language;
	function __construct() {
		parent::__construct();
		$this->load->model('Email_Template','et');
		$this->load->helper(array('email'));
        $this->load->library(array('email'));
		$this->setup_email();
		$this->language = ($this->session->userdata('site_lang')) ? $this->session->userdata('site_lang') : 'english';
	}

	public function index() {

		/*if($this->session->userdata('user')){
			redirect(base_url('admin/dashboard'));
		}else{
			$data = array();
			$this->template->load_login($data);
		}*/
	}

	public function register()
	{
		if($this->input->post()){
			$data = $this->input->post();

			if( ! isset($data['g-recaptcha-response']) || empty($data['g-recaptcha-response'])){
				$this->session->set_flashdata('error_login', 'Recaptcha error');
				$this->session->set_flashdata('register', $data);
				redirect(base_url('?register=email'));
			}

			//check email is existed or not
			$email = $this->db->get_where('users', ['email' => $data['email']]);
			if($email->num_rows() > 0){
				$this->session->set_flashdata('error_login', $this->lang->line('email_existed'));
				$this->session->set_flashdata('register', $data);
				redirect(base_url('?register=email'));
			}else{
				unset($data['g-recaptcha-response']);
				$data['password'] = md5($data['password']);
				$data['email_verification_code'] = uniqid();
				$result = $this->db->insert('users', $data);
				if($result){
					$email = $this->verification_email($data['email']);
					//$this->session->set_flashdata('success', $this->lang->line('register_successfully'));
					$this->template->load_user('email-verification',['email' => $data['email']]);
				}
			}
		}else{
			redirect(base_url('?register=direct-hit'));
		}
	}

	public function verification_email($email, $resend = "")
	{
		$data['notification'] = $this->db->get_where('email_templates', ['slug' => 'bundldesigns'])->row_array();
		$data['language'] = $this->language;
		$query = $this->db->get_where('users', ['email' => $email]);
		if($query->num_rows() == 0){
			$this->session->set_flashdata('error', $this->lang->line('email_not_existed'));
			redirect(base_url('?register=email'));
		}else{
			$settings = $this->db->get('settings')->row_array();
			$facebook = $settings['facebook'];
			$instagram = $settings['instagram'];
			$linked_in = $settings['linked_in'];
			$twitter = $settings['twitter'];
			$user = $query->row_array();
	        $link_activate = base_url() . 'register/verify-email/' .  $user['email_verification_code'];
	        $contact_url = base_url('contact-us');
	        
	        $email_message = $this->load->view('email_templates/register_email', $data, true);
	        $email_message = str_replace("{name}", $user['full_name'], $email_message);
	        $email_message = str_replace("{email}", $user['email'], $email_message);
	        $email_message = str_replace("{link_activation}", $link_activate, $email_message);
	        $email_message = str_replace("{contact_url}", $contact_url, $email_message);
	        $email_message = str_replace("{facebook}", $facebook, $email_message);
	        $email_message = str_replace("{instagram}", $instagram, $email_message);
	        $email_message = str_replace("{linked_in}", $linked_in, $email_message);
	        $email_message = str_replace("{twitter}", $twitter, $email_message);

	        // $this->email->to($email);
	        // $this->email->subject('Bundl');
	        // $this->email->message($email_message);
	        // $this->email->send();

	       $this->et->send_general_email($email , 'Bundl' , $email_message);


	    }
	}

	public function verify_email($code)
	{
        $query = $this->db->get_where('users', ['email_verification_code' => $code]);
        if ($query->num_rows() > 0) {
            $this->db->update('users', ['email_verification_status' => 1] , ['email_verification_code' => $code]);
        	$this->session->set_flashdata('success', $this->lang->line('email_verified'));
        	redirect(base_url('?register=verify'));
        } else {
            $this->session->set_flashdata('error', $this->lang->line('email_not_verified'));
	        redirect(base_url('?register=not-verify'));
        }
	}

    public function setup_email()
    {
        $config['protocol'] = 'smtp';
        $config['smtp_crypto'] = 'ssl';
        $config['smtp_host'] = 'bundldesigns.com';
        $config['smtp_user'] = 'no-reply@bundldesigns.com';
        $config['smtp_pass'] = 'Rb4PSd#oR7xg';
        $config['smtp_port'] = 465;
        //$config['smtp_timeout'] = 30;
        $config['newline'] = "\r\n";
        $config['mailtype'] = "html";
        //$config['starttls'] = true;
        $this->load->library('email', $config);
        $this->email->initialize($config);
        $this->email->from('no-reply@bundldesigns.com', 'BUNDL DESIGNS');
    }

    public function test_email(){

    	$this->load->model('Email_Template', 'et');

    	ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

    	$view = 'order-confirmation';
    	$email = 'muhammadqadeer661@gmail.com';
    	$vars = [
            '{username}' => "Qadeer",
            '{email}' => "muhammadqadeer661@gmail.com",
            '{order_id}' => '190',
			'{order_date}' => date('m/d/Y'),
            '{btn_text}' => 'Fill Questionnaire Now',
            '{btn_link}' => 'dfdsfsdf'
        ];
        $this->et->template($email, 'order_confirmed', $vars, $view, true);


		// phpinfo();die();
		//$this->load->library('email');
		//$result = $this->email->from('bundl@appliconsoft.com')->to('thezainiji@gmail.com')->subject('Test mail Bundl')->message("testing ")->send();

    	/*$config['protocol'] = 'smtp';
        $config['smtp_crypto'] = 'ssl';
        $config['smtp_host'] = 'bundldesigns.com';
        $config['smtp_user'] = 'no-reply@bundldesigns.com';
        $config['smtp_pass'] = 'Rb4PSd#oR7xg';
        $config['smtp_port'] = 465;
        //$config['smtp_timeout'] = 30;
        $config['newline'] = "\r\n";
        $config['mailtype'] = "html";
        //$config['starttls'] = true;
        $config['charset'] = 'utf-8';*/

        /*$config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['smtp_host'] = 'mail.bundldesigns.com';
        $config['smtp_user'] = 'noreply@bundldesigns.com';
        $config['smtp_pass'] = 'Rb4PSd#oR7xg';
        $config['smtp_port'] = 26;
        $config['smtp_timeout'] = 30;
        $config['newline'] = "\r\n";
        $config['mailtype'] = 'html';*/
        /*$this->load->library('email', $config);
        $this->email->initialize($config);
        $this->email->from('no-reply@bundldesigns.com', 'BUNDL DESIGNS');*/


        /*$this->load->library('email');
        $this->email->initialize($config);
        $this->email->from('bundl@appliconsoft.com');*/
        /*$this->email->to('thezainiji@gmail.com');

        $this->email->subject('BundlDesigns');
        $this->email->message('testing body');
        $result = $this->email->send();

		var_dump($result);
		echo '<br />';
		echo '////////////////////////////////////////';
		echo '<br />';
		echo $this->email->print_debugger();*/
    }

    public function login()
    {
    	if($this->input->post()){
    		$data = $this->input->post();
    		$query = $this->db->get_where('users', ['email' => $data['email']]);
			if($query->num_rows() == 0){
				// user does not exist
				$this->session->set_flashdata('error_login', $this->lang->line('email_not_existed'));
				redirect(base_url('?register=email'));
			}else{
				$data['password'] = md5($data['password']);
				$login = $this->db->get_where('users',$data);
				if($login->num_rows() == 0){
					// user name and password combination failed
					$this->session->set_flashdata('error_login', $this->lang->line('login_failed'));
					redirect(base_url('?register=email'));
				}else{
					// user name and password is valid.
					$user = $login->row_array();
					// check account is blocked or not
					if($user['status'] == 0){
						// account is blocked.
						$this->session->set_flashdata('error_login', $this->lang->line('account_blocked'));
						redirect(base_url('?register=email'));
					}else{
						//account is active (not blocked)
						if($user['role'] == 2){
							//if user is admin than redirect to admin panel
							redirect(base_url('admin'));
						}else{
							// check user account is verified or not
							if($user['email_verification_status'] == 0){
								$this->session->set_flashdata('error_login', $this->lang->line('account_not_verified'));
								redirect(base_url('?register=email'));
							}else{
								// now user is able to logged in.
								$user = (object)$user;
								$this->session->set_userdata('site_user', $user);
								$this->session->set_userdata('site_lang', $user->language);
								if($this->cart->contents()){
									$this->session->set_flashdata('success_login', $this->lang->line('cart_login'));
									redirect(base_url('checkout'));
								}else{
									redirect(base_url('dashboard'));
								}
							}
						}
					}
				}
			}
    	}
    }

    public function logout()
    {
    	//$this->session->sess_destroy();
    	$this->session->unset_userdata('site_user');
		//$this->session->set_flashdata('success_login', $this->lang->line('logout_success'));
		redirect(base_url('?register=email'));
    }

    public function forgot_password()
    {
    	$this->template->load_user('forgot-password');
    }

    public function reset_password_email()
	{
	    $data = $this->input->post();
	    if($data){
	    	//print_r($data);die();
	    	$query = $this->db->get_where('users', ['email' => $data['email']]);
			if($query->num_rows() == 0){
				// email does not exist
				$this->session->set_flashdata('error', $this->lang->line('email_not_existed'));
				redirect(base_url('forgot-password'));
			}else{
				$user = $query->row_array();

				$data['notification'] = $this->db->get_where('email_templates', ['slug' => 'forgot-password'])->row_array();
				$data['language'] = $this->language;

				// $email_body = 'Hello {Name},<br /><br />
				// 		Looks like you forgot your password for Bundl account. If this is correct, click below link to reset your password.
				// 		<br /><br /> {link} <br /><br />
				// 		If you did not forgot your password, please ignore this email.
				// 		<br /><br />
				// 		Thanks,<br />Bundl Team <br /><br /> This is an automated message, please do not reply.';
            	$settings = $this->db->get('settings')->row_array();
				$facebook = $settings['facebook'];
				$instagram = $settings['instagram'];
				$linked_in = $settings['linked_in'];
				$twitter = $settings['twitter'];
				$contact_us_url = base_url('contact-us');
            	$link = base_url('set-password/') . $user['email_verification_code'];

	        	$email_message = $this->load->view('email_templates/forgot-password', $data, true);
            	
            	$email_message = str_replace("{Name}", $user['full_name'], $email_message);
            	$email_message = str_replace("{link}", $link, $email_message);
	        	$email_message = str_replace("{contact_url}", $contact_us_url, $email_message);
		        $email_message = str_replace("{facebook}", $facebook, $email_message);
		        $email_message = str_replace("{instagram}", $instagram, $email_message);
		        $email_message = str_replace("{linked_in}", $linked_in, $email_message);
		        $email_message = str_replace("{twitter}", $twitter, $email_message);

            	// $this->email->to($user['email']);
            	// $this->email->subject($data['notification']['email_subject_english']);
            	// $this->email->message($email_message);
            	// $this->email->send();
            	$this->et->send_general_email($user['email'] , $data['notification']['email_subject_english'] , $email_message);
            	$this->session->set_flashdata('success', $this->lang->line('reset_password'));
            	$this->template->load_user('resend-password',['user' => $user]);
			}
	    }
	}

	public function reset_password($code)
	{
		//echo $code;
		$this->template->load_user('reset-password',['code'=>$code]);
	}

	public function reset_forgot_password($value='')
	{
		if($this->input->post()){
			$data = $this->input->post();
			//print_r($data);die();

			if($data['password'] == $data['confirmPassword']){
				$user = $this->db->get_where('users',['email_verification_code'=>$data['code']]);
				if($user->num_rows() > 0){
					$user = $user->row_array();
					$result = $this->db->update('users', ['password' => md5($data['password'])], ['id' => $user['id']]);
					if($result){
						$data['notification'] = $this->db->get_where('email_templates', ['slug' => 'reset-password'])->row_array();
						$settings = $this->db->get('settings')->row_array();
						$facebook = $settings['facebook'];
						$instagram = $settings['instagram'];
						$linked_in = $settings['linked_in'];
						$twitter = $settings['twitter'];
						$contact_us_url = base_url('contact-us');
						$data['language'] = $this->language;

			        	$email_message = $this->load->view('email_templates/reset-password', $data, true);

	        			$email_message = str_replace("{contact_url}", $contact_us_url, $email_message);
				        $email_message = str_replace("{facebook}", $facebook, $email_message);
				        $email_message = str_replace("{instagram}", $instagram, $email_message);
				        $email_message = str_replace("{linked_in}", $linked_in, $email_message);
				        $email_message = str_replace("{twitter}", $twitter, $email_message);
				        
		            	// $this->email->to($user['email']);
		            	// $this->email->subject('Reset Password');
		            	// $this->email->message($email_message);
		            	// $this->email->send();

		            	$this->et->send_general_email($user['email'] , $data['notification']['email_subject_'.$this->language], $email_message);
						$this->session->set_flashdata('success_login', $this->lang->line('update_success_password'));
						redirect(base_url('?register=password'));
					}else{
						$this->session->set_flashdata('error', $this->lang->line('update_error_password'));
						redirect(base_url('?register=password'));
					}
				}else{
					$this->session->set_flashdata('error', $this->lang->line('invalid_email_code'));
					redirect(base_url('?register=password'));
				}
			}else{
				$this->session->set_flashdata('error', $this->lang->line('confirm_error_password'));
				$this->template->load_user('reset-password',['code'=>$data['code']]);
			}
		}
	}

	public function social_login()
	{
		if($this->input->post()){
			$data = $this->input->post();
			$response = [];
			//print_r($data);

			if(isset($data['id'])){
				$user = $this->db->get_where('users', ['email' => $data['email']]);
				if($user->num_rows() > 0){
					$user = $user->row_array();
					if($user['status'] == 0){
						// account is blocked.
						$this->session->set_flashdata('error', $this->lang->line('account_blocked'));
						$response['return_url'] = base_url('?register=email');
						echo json_encode($response);
					}else{
						// Login
						$user = (object)$user;
						$this->session->set_userdata('site_user', $user);
						
						if($this->cart->contents()){
							$this->session->set_flashdata('success', $this->lang->line('cart_login'));
							$response['return_url'] = base_url('checkout');
						}else{
							$response['return_url'] = base_url('dashboard');
						}
						echo json_encode($response);
					}
				}else{
					// register user
					$register = [
						'full_name' => $data['name'],
						'email' => $data['email'],
						'email_verification_status' => 1,
						'role' => 1,
						'status' => 1,
						'login_with' => $data['login_with'],
						'social_profile_id' => $data['id']
					];

					$result = $this->db->insert('users', $register);
					if($result){
						$user_login = $this->db->get_where('users', ['email' => $data['email']])->row_array();
						$user_login = (object)$user_login;
						$this->session->set_userdata('site_user', $user_login);

						if($this->cart->contents()){
							$this->session->set_flashdata('success', $this->lang->line('cart_login'));
							$response['return_url'] = base_url('checkout');
						}else{
							$response['return_url'] = base_url('dashboard');
						}
						echo json_encode($response);
					}
				}
			}
		}
	}
}//end controller