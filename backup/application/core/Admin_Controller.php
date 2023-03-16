<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Controller extends CI_Controller {

	public $User;
	public $language;

	function __construct() {
		parent::__construct();
        //$this->language = ($this->session->userdata('site_lang')) ? $this->session->userdata('site_lang') : 'english';
		$this->language = 'english';
		$this->User = $this->session->userdata('user');
		if(! $this->User){
			$this->session->set_flashdata('login_error', 'Please login to proceed with protected section.');
			redirect(base_url('admin'));
			exit;
		}
		$this->load->model('Files_Model','files');
		$this->load->model('Email_Template','et');
		//$this->setup_email();
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

    /*public function setup_email()
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
    }*/

    public function delete_record($data)
    {
    	//return $data;
        $result = false;
        if(isset($data['id']) && isset($data['table'])){
            $id = $data['id'];
            $table = $data['table'];
            $images = 'no';
            if(isset($data['images'])){
            	$images = $data['images'];
            }

            // delete related files
            if($images == 'yes'){
            	$imagesColumn = $data['imagesColumn'];
            	$imagesPath = $data['imagesPath'];

                $row = $this->db->get_where($table, ['id' => $id])->row_array();
                if(isset($row[$imagesColumn]) && !empty($row[$imagesColumn])){
	                $file_ids = explode(',', $row[$imagesColumn]);
	                $files = $this->db->where_in('id', $file_ids)->get('files');
	                if($files->num_rows() > 0){
	                    $files = $files->result_array();
	                    $path = $imagesPath;
	                    foreach ($files as $key => $file) {
	                        $this->files->delete_by_name($file['name'], $path);
	                    }
	                }
                }
            }
            //delete required row
            $result = $this->db->delete($table, ['id' => $id]);
        }

        if ($result) {
            $type = 'success';
            $msg = 'Delete operation has been successfully made!';
        } else {
            $type = 'error';
            $msg = 'Delete operation has been failed. Please try again!';
        }

        echo json_encode(['type' => $type, 'msg' => $msg]);
    }
}

