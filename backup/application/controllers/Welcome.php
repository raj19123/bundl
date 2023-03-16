<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public $language;

	function __construct() {
		parent::__construct();
		$this->language = ($this->session->userdata('site_lang')) ? $this->session->userdata('site_lang') : 'english';
        $this->load->model('Package_Model','package_model');
        $this->load->model('Email_Template','et');
        //$this->load->model('Design_Model','design_model');
    }

	public function index()
	{
		$packages = $this->db->order_by('sort_order', 'ASC')->get_where('packages',['status' => 1])->result_array();
		
		$hero_images = [];
		$projects = $this->db->get('projects')->result_array();
		if ($projects) {
			$hero_image_ids = [];
			foreach ($projects as $key => $project) {
				if(!empty($project['hero_image'])){
					array_push($hero_image_ids, $project['hero_image']);
				}
			}
			if($hero_image_ids){
				$hero_images = $this->db->where_in('id', $hero_image_ids)->order_by('id','DESC')->get('files')->result_array();	
			}
		}

		$this->db->select('design_categories.* , files.name as icon');
        $this->db->from('design_categories');
        $this->db->join('files', 'design_categories.design_icon_id = files.id', 'left');
        $this->db->order_by('sort_order', 'ASC');
        $design_categories = $this->db->get()->result_array();

        $settings = $this->db->get('settings')->row_array();

        $testimonials = $this->db->limit(3)->get('testimonials')->result_array();

		$this->template->load_user('index', [
			'packages' => $packages, 
			'design_categories' => $design_categories,
			'settings' => $settings,
			'hero_images' => $hero_images,
			'testimonials' => $testimonials
		]);
	}

	public function select_bundl($id="")
	{
		if(!empty($id)){
			//echo $id;
			$cart_contents = [];
			if($this->cart->contents()){
				//$this->cart->destroy();
				$cart_contents = $this->cart->contents();
				//print_r($cart_contents);

				//get package id
				foreach ($cart_contents as $key => $value) {
					if($value['options']['type'] == 'package'){
						$id = $value['id'];
					}
				}	
			}


			$package = $this->db->get_where('packages', ['id' => $id]);
			//echo $this->db->last_query();die();
			if($package->num_rows() > 0){
				$package = $package->row_array();

				// get package category
				$category = $this->db->get_where('package_categories', ['id' => $package['category_id']])->row_array();
				
				// get package icon by category from files table
				$icon = $this->db->get_where('files',['id' => $category['package_cat_image_id']])->row_array();

				// get component ids
				$component_ids = $this->package_model->get_component_ids($package['id']);

				// get components detail
				$components = [];
				if($component_ids){
					$components = $this->db->where_in('id', $component_ids)->order_by('sort_order', 'ASC')->get('package_components')->result_array();
				}

				//Add-On functionality
				$addons_cats = $this->db->order_by('sort_order', 'ASC')->get('design_categories')->result_array();

				$this->template->load_user('select-bundl', [
					'package' => $package, 
					'category' => $category,
					'components' => $components,
					'icon' => $icon,
					'addons_cats' => $addons_cats,
					'cart_contents' => $cart_contents
				]);
			}else{
				redirect(base_url());
			}
		}else{
			redirect(base_url());
		}
	}

	public function custom_bundl()
	{
		$addons_cats = $this->db->order_by('sort_order', 'ASC')->get('design_categories')->result_array();
		$this->template->load_user('custom-bundl', ['addons_cats' => $addons_cats]);
	}

	public function search()
	{
		if($_REQUEST){
			$term = $_REQUEST['query'];
			$term = $this->db->escape_like_str($term);
			$result = [];
			//print_r($term);

			// Search in items
			$items = $this->db->like('name_english', $term, 'both')->or_like('name_arabic', $term, 'both')->get('designs');
			if($items->num_rows() > 0){
				$items = $items->result_array();
				//print_r($items);
				$result['items'] = $items;
			}

			// Search in packages
			$packages = $this->db->like('name_english', $term, 'both')->or_like('name_arabic', $term, 'both')->get('packages');
			if($packages->num_rows() > 0){
				$packages = $packages->result_array();
				//print_r($packages);
				$result['packages'] = $packages;
			}

			// Search in pages
			$return_pages = [];
			$pages = [
				'faqs' 					=> 'faqs',
				'careers' 				=> 'careers',
				'about us' 				=> 'about',
				'terms and conditions' 	=> 'terms-and-conditions',
				'legal' 				=> 'legal',
				'contact us' 			=> 'contact-us',
				'our work' 				=> 'our-work'
			];
			foreach ($pages as $page => $url) {
				if(empty($term)){
					$return_pages[$page] = $url;
				}else{
					if(strpos($page, $term) !== false){
						$return_pages[$page] = $url;
					}
				}
			}
			if($return_pages){
				$result['pages'] = $return_pages;
			}
		}else{
			$result = [];
		}
		$this->template->load_user('search', ['result' => $result]);
	}

	public function language($lang='english')
	{
		$this->session->set_userdata('site_lang', $lang);
		$user = $this->session->userdata('site_user');
        if($user){
            $this->db->update('users', ['language' => $lang], ['id' => $user->id]);
        }
		$url = base_url();
		if($_GET['url']){
			$url = $_GET['url'];
		}
		redirect($url);
	}

	public function test_email_template()
	{
		$this->load->view('email_templates/common_template');
	}

	public function check_bundl()
	{
		$data = $this->input->post();
		//print_r($data);
		$bundl = 'no';
		if($this->cart->contents()){
			$bundl = 'yes';
			/*foreach ($this->cart->contents() as $key => $value) {
				if($value['options']['type'] == 'package'){
					if($value['id'] == $data['package_id']){
						$bundl = 'yes';
					}else{
						$bundl = 'no';
					}
				}else{
					$bundl = 'yes';
				}
			}*/
		}
		echo $bundl;
	}

	public function webster_bundl()
	{
		$package = $this->uri->segment(1);
		if ($package == 'premium') {
			$this->template->load_user('webster',['package' => TRUE]);
		} else {
			$this->template->load_user('webster',['package' => FALSE]);
		}
	}

	public function request_webster()
	{
		$data = $this->input->post();
		//print_r($data); die();
		if($data){
			$result = $this->db->insert('webster', $data);

			$view = 'webster-confirmation';
			$email = $data['email'];
            $vars = [
                '{email}' => $email,
            ];
            $this->et->template($email, 'webster-confirmation', $vars, $view);

			$email_message = "Project Name: " . $data['project_name'] . "<br />";
			$email_message .= "Bundl Details: " . $data['details'] . "<br /><br />";
			$email_message .= "Customer Name: " . $data['customer_name'] . "<br />";
			$email_message .= "Mobile Number: " . $data['mobile_number'] . "<br />";
			$email_message .= "Email: " . $data['email'] . "<br /><br />";
			$email_message .= "Message: " . $data['message'] . "<br />";

			$email = $this->config->item('admin_email');
			$subject = ($data['request_for'] == 'premium') ? 'BUNDL Premium Order' : 'Webster Order';
			// $this->email->to($email);
			// $this->email->bcc('mcs_sohail@yahoo.com');//verifying if emails are sending or not
   //          $this->email->subject('Webster Order');
   //          $this->email->message($email_message);
			$result_email = $this->et->send_general_email($email , $subject , $email_message);
			if($result_email){
	        	$this->session->set_flashdata("success", $this->lang->line('thank_you_for_message_we_call_you_soon'));
	        }else{
	        	$this->session->set_flashdata("error", $this->lang->line('request_failed_plese_try_again'));
	        }
	        
			
			
			
		}else{
			$this->session->set_flashdata("error", $this->lang->line('request_failed_plese_try_again'));
		}
		redirect('webster');
		// $this->template->load_user('webster');
	}

	public function user_data_deletion()
	{
		echo "Get user data deletion policy information from hello@bundldesigns.com";
	}

	public function show_date()
	{
		echo date('Y-m-d H:i:s');
		echo '<br />';
		echo $this->config->item('admin_email');
	}
	public function test(){

		
			$view = 'payment_receipt';
		  	$vars = [
	            '{username}' => "Hamza Ali",
	            '{email}' => "hamza15137024@gmail.com",
	            '{order_id}' => "489",
				'{order_date}' => date('m/d/Y'),
				'{amount}' => "$22.00",
	            '{btn_link}' => "bundle.com",
	            // 'package' => $package,
	            // 'designs' => $designs
	        ];


	       $a =  $this->et->template($email, 'payment_receipt', $vars, $view, true);
	       var_dump($a);
	}
	public function tt(){
		$this->load->view('email_templates/content-upload-complete');
	}
	public function test_email(){

		$vars = [
            '{username}' => "Hamza Ali",
            '{email}' => "hamza15137024@gmail.com",
            '{order_id}' => 497,
            '{btn_link}' => "ddddd"
        ];
        $view = 'branding-artwork-done';
        $this->et->template($email, 'branding_done', $vars, $view, true, $lang);
	}

}// end controller
