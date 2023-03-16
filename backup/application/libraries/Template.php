<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
    class Template 
    {
        var $ci;
        function __construct() 
        {
            $this->ci =& get_instance();
        }
		
		function load_user($view, $data = null, $page = '') 
		{
			// Need for view only
			$data['language'] = ($this->ci->session->userdata('site_lang')) ? $this->ci->session->userdata('site_lang') : 'english';
			switch ($data['language']) {
				case 'english':
					$ln = 'en';
					break;
				case 'arabic':
					$ln = 'ar';
					break;
				default:
					$ln = 'en';
					break;
			}
			$data['ln'] = $ln;

			$data['main_content'] = $this->ci->load->view('user/'.$view,$data,TRUE);
			$data['header_data'] = [];
			$data['footer_data'] = [];
			$data['page'] = $page;
			$this->ci->parser->parse('user/template', $data);
		}

		function load_user_ajax($view, $data = null) 
		{
			// Need for view only
			$data['language'] = ($this->ci->session->userdata('site_lang')) ? $this->ci->session->userdata('site_lang') : 'english';
			switch ($data['language']) {
				case 'english':
					$ln = 'en';
					break;
				case 'arabic':
					$ln = 'ar';
					break;
				default:
					$ln = 'en';
					break;
			}
			$data['ln'] = $ln;

			$content = $this->ci->load->view('user/'.$view,$data,TRUE);
			return $content;
		}

		function load_admin($view, $data = null) 
		{
			$data['main_content'] = $this->ci->load->view('admin/'.$view,$data,TRUE);
			$data['page_title']='BundlDesigns';
			$data['site_title']='BundlDesigns';
			$this->ci->parser->parse('admin/template', $data);
		}

		function load_login($data = null) 
		{
			$data['page_title']='BundlDesigns';
			$data['site_title']='BundlDesigns';
			echo $this->ci->load->view('admin/login/login',$data,TRUE);
			//echo $this->ci->parser->parse('login/login', $data);
		}

		/*function load($template,$view, $data = null) 
		{
			$this->ci->load->model('Pages_Model','pages_model');
			if($view!='')
			$data['main_content'] = $this->ci->load->view($view,$data,TRUE);
			$data['footer_url'] = ''; //$this->ci->pages_model->get_url_and_subscription();
			$this->ci->parser->parse(''.$template, $data);
		}*/
    }