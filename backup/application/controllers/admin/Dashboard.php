<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller 
//class Dashboard extends CI_Controller 
{
	function __construct() 
	{	
		 parent::__construct();
		 // $this->load->model('Pages_model','Pages_model');
		 $this->load->model('Admin_Model','admin_model');
    } 

	public function index()
	{
		$stats = [];
		$stats['designs'] = $this->db->count_all('designs');
		$stats['packages'] = $this->db->count_all('packages');
		$stats['email_templates'] = $this->db->count_all('email_templates');
		$stats['files'] = $this->db->count_all('files');
		$stats['users'] = $this->db->where('role',1)->from('users')->count_all_results();
		$usage = $this->db->select_sum('size')->get('files')->row_array();
		$stats['usage'] = $usage['size'];
		//print_r($stats);
		$this->template->load_admin('dashboard/dashboard', $stats);
	}
	
	private function upload_files($path, $title, $image)
    {
        $this->load->library('image_lib');
    	$date = date('dmYHis');
   		$ext = strrchr($image, ".");
    	$userid = $this->loginUser->id;
    	$fileName = $title.'_'.$date.'_'.$userid.''.$ext;
        $config = array(
            'upload_path'   => $path,
            'allowed_types' => 'jpg|gif|png',
            'max_size' => 5000,
            'max_width' => 50000,
            'max_height' => 50000,
            'file_name' => $fileName,
            'overwrite'     => 1,                       
        );
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload('profile_picture')) 
        {
        	$this->upload->data();
			$config2['image_library'] = 'gd2';
		    $config2['source_image'] = $path.'/'.$fileName;;
		    $config2['new_image'] = './upload/profile_images/'.$fileName;
		    $config2['create_thumb'] = TRUE;
		    $config2['maintain_ratio'] = TRUE;
		    $config2['width'] = 210;
		    $config2['height'] = 70;
		    $this->image_lib->clear();
		    $this->image_lib->initialize($config2);
		    $this->image_lib->resize();
			return $this->upload->data();
        }
        else 
        {
            return false;
        } 
    }

    public function update_profile()
	{
		$data = $this->input->post();
    	if($data){
    		$id = $data['id'];
    		unset($data['id']);
            
    		$result = $this->db->update('users', $data, ['id' => $id]);
    		if($result){
    			$this->session->set_flashdata('success', $this->lang->line('update_success_profile'));
    		}else{
    			$this->session->set_flashdata('error', $this->lang->line('update_error_profile'));
    		}
    		redirect('admin/profile');
    	}
	}

	public function profile()
	{
		$id = $this->User->id;
		$edit= $this->db->get_where('users',['id' => $id])->row_array();
		$this->template->load_admin('profiles/profile',['edit' => $edit]);
	}

	public function password()
	{
		$this->template->load_admin('profiles/change_password');
	}

	public function update_password()
	{
		$data = $this->input->post();
		if($data){
			$id = $this->User->id;
			//print_r($data);

			$is_password = $this->db->get_where('users', ['password' => md5($data['password'])])->row_array();
			if($is_password){
				if($data['new_password'] == $data['confirm_password']){
					$result = $this->db->update('users',['password' => md5($data['new_password'])], ['id' => $id]);
					if($result){
		    			$this->session->set_flashdata('success', $this->lang->line('update_success_password'));
		    		}else{
		    			$this->session->set_flashdata('error', $this->lang->line('update_error_password'));
		    		}
				}else{
					$this->session->set_flashdata('error', $this->lang->line('confirm_error_password'));
				}
			}else{
				$this->session->set_flashdata('error', $this->lang->line('not_found_error_password'));
			}
			redirect('admin/profile/password');
		}
	}
}
