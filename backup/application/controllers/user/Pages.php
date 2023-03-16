<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//require_once './MailChimp.php';

class Pages extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('Files_Model', 'files');
		$this->load->model('Email_Template','et');
	}

	public function index() {}
	
	public function about_us() {
		$settings = $this->db->get('settings')->row_array();
		$about = $this->db->get_where('about_us')->row_array();
		$this->template->load_user('about-us', ['about' => $about, 'settings' => $settings]);
	}

	public function terms_and_conditions() {
		$terms = $this->db->get('terms_conditions')->result_array();
		$this->template->load_user('term-condition', ['terms' => $terms]);
	}

	public function legal() {
		$privacy_policy = $this->db->get('privacy_policy')->result_array();
		$this->template->load_user('legal', ['terms' => $privacy_policy]);
	}

	public function privacy_policy() {
		$this->template->load_user('privacy-policy');
	}

	public function our_work() {
		$projects = $this->db->order_by('id','DESC')->get('projects')->result_array();
		$projectImages = array();
		$hero_images = [];
		if ($projects) {
			$hero_image_ids = [];
			foreach ($projects as $key => $project) {
				if(!empty($project['hero_image'])){
					array_push($hero_image_ids, $project['hero_image']);
				}
				if(!empty($project['images'])){
					$img_ids = explode(',', $project['images']);
					$projectImages[$project['id']] = $this->db->where_in('id', $img_ids)->get('files')->result_array();
				}
			}
			if($hero_image_ids){
				$hero_images = $this->db->where_in('id', $hero_image_ids)->get('files')->result_array();
			}
		}

		$this->template->load_user('our-work', [
			'projects' => $projects,
			'projectImages' => $projectImages,
			'hero_images' => $hero_images
		]);
	}

	public function contact_us() {
		$this->template->load_user('contact-us');
	}

	public function contact_us_email()
	{
		$data = $this->input->post();
		//return print_r($data);
		if($data){


			$view = 'contact-us-confirmation';
			$email = $data['cemail'];
            $vars = [
                '{email}' => $email,
            ];
            $this->et->template($email, 'contact-us-confirmation', $vars, $view);


			$email_message = "From: " . $data['cname'] . "<br />";
			$email_message .= "Email: " . $data['cemail'] . "<br />";
			$email_message .= "Phone: " . $data['cphone'] . "<br />";
			$email_message .= "Message: " . $data['cmsg'] . "<br />";

			$email = $this->config->item('admin_email');

            $is_sent = $this->et->send_general_email($email , 'Contact Us' , $email_message);
            
            if($is_sent){
	        	echo "success";
	        }else{
	        	echo "false";
	        }
		}
	}

	public function faqs() {
		$cats = $this->db->get('faqs_categories')->result_array();
		$this->template->load_user('faqs', ['cats' => $cats]);
	}

	public function careers() {
		$careers = $this->db->order_by('id', 'DESC')->get_where('careers', ['status' => 1])->result_array();
		$this->template->load_user('careers', ['careers' => $careers]);
	}

	public function vacancy_apply()
	{
		$data = $this->input->post();
		if($data){
			//print_r($data);
			$view = 'vacancy-application-confirmation';
			$email = $data['email'];
            $vars = [
                '{email}' => $email,
            ];
            $this->et->template($email, 'vacancy-application-confirmation', $vars, $view);

            
			$res = $this->db->insert('vacancy_applications', $data);
			echo ($res) ? $this->db->insert_id() : 'false';
		}
	}

	public function dz_files_vacancy()
	{
		if( ! empty($_FILES['files']['name'])){
			
			$application_id = isset($_POST['application_id']) ? $_POST['application_id'] : '';

			if( ! empty($application_id) ){
				$path = './uploads/vacancy/';
                if ( ! is_dir($path)) {
                    mkdir($path, 0777, TRUE);
                }
				$config['upload_path'] = $path;
	            $config['allowed_types'] = 'ico|png|jpg|pdf|ai|psd|eps|indd|doc|docx|ppt|pptx|xlsx|xls';

	            $uploaded_file_ids = $this->files->multiUpload('files', $config);
	            $uploaded_file_ids = implode(',', $uploaded_file_ids);

	            $up = $this->db->update('vacancy_applications', 
	                                    ['attachments' => $uploaded_file_ids], 
	                                    ['id' => $application_id]
	                                );
				echo ($up) ? 'true' : 'false';
			}else{
				echo 'false';
			}

        }
	}

	public function signup_for_newsletter()
	{
		$data = $this->input->post();
		if($data){
			$email = $data['email-newsletter'];
			
			$this->load->library('Mailchimp');
			$this->load->config('mailchimp');
			
			//$lists = $this->mailchimp->call('GET', 'lists');
			//print_r($lists);
			
			$list_id = $this->config->item('mc_list_id');

			$result = $this->mailchimp->call("POST", "lists/$list_id/members", [
                'email_address' => $email,
                //'merge_fields' => ['FNAME'=>'Ralph', 'LNAME'=>'Vugts'],
                'status'        => 'subscribed'
            ]);

            if($result) {
            	echo 'success';
            }else{
            	echo 'false';
            }
		}
	}

	public function our_work_detail()
	{
		$project = [];
		$images = [];
		$data = $this->input->post();
		if($data){
			$project_id = $data['project_id'];

			$project = $this->db->get_where('projects', ['id' => $project_id]);
			if($project->num_rows() > 0){
				$project = $project->row_array();
				if(!empty($project['images'])){
					$img_ids = explode(',', $project['images']);
					$images = $this->db->where_in('id', $img_ids)->get('files')->result_array();
				}
				$output = ['status' => true, 'project' => $project, 'prjImages' => $images];
			}else{
				$output = ['status' => false];
			}
		}else{
			$output = ['status' => false];
		}
		echo json_encode($output);
	}
}