<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LanguageSwitcher extends CI_Controller
{
    public function __construct() {
        parent::__construct();     
    }
 
    function switchLang($language = "") {
        
        $language = ($language != "") ? $language : "english";
        $this->session->set_userdata('site_lang', $language);

        $user = $this->session->userdata('site_user');
        if($user){
            $this->db->update('users', ['language' => $language], ['id' => $user->id]);
        }
        
        if(isset($_SERVER['HTTP_REFERER'])) {
        	redirect($_SERVER['HTTP_REFERER']);
		}else{
			redirect(base_url());
		}
        
    }
}