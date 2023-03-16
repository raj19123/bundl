<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_Controller extends CI_Controller {

	public $User;
	public $language;

	function __construct() {
		parent::__construct();
		
		$this->language = ($this->session->userdata('site_lang')) ? $this->session->userdata('site_lang') : 'english';
		
		$this->User = $this->session->userdata('site_user');
		if(! $this->User){
			$this->session->set_flashdata('error', 'Please login to proceed with protected section.');
			redirect(base_url('?register=logout'));
			exit;
		}

		$this->language = $this->User->language;

		$this->load->model('Files_Model','files');
		$this->load->model('Email_Template','et');
    }

    public static function slugify($text)
	{
	  // replace non letter or digits by -
	  $text = preg_replace('~[^\pL\d]+~u', '-', $text);

	  // transliterate
	  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

	  // remove unwanted characters
	  $text = preg_replace('~[^-\w]+~', '', $text);

	  // trim
	  $text = trim($text, '-');

	  // remove duplicate -
	  $text = preg_replace('~-+~', '-', $text);

	  // lowercase
	  $text = strtolower($text);

	  if (empty($text)) {
	    return time();
	  }

	  return $text;
	}
}

