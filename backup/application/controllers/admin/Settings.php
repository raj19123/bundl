<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends Admin_Controller {

	function __construct() {
		parent::__construct();
    }

    public function index()
    {
    	$edit = $this->db->get('settings')->row_array();
    	$this->template->load_admin('settings/add',['edit' => $edit]);
    }

    public function update()
    {
        $data = [];
        $data = $this->input->post();
        
        if(isset($_FILES) && $_FILES['video_home_page']['error'] == 0) {

            $path = './uploads/settings/';
            if ( ! is_dir($path)) {
                mkdir($path, 0777, TRUE);
            }

            $config['upload_path'] = $path;
            $config['allowed_types'] = 'mp4';
            $config['max_size'] = '0';
            $config['max_filename'] = '255';
            $config['encrypt_name'] = FALSE;
            $video_data = array();

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('video_home_page')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('admin/settings');
            } else {
                $video_data = $this->upload->data();
                $data['video_home_page'] = $video_data['file_name'];
            }
        }

        if($data){
            $is_exist = $this->db->get('settings');
            if($is_exist->num_rows() > 0){
                $old_settings = $is_exist->row_array();
                //delete old file
                $vfile = $path . $old_settings['video_home_page'];
                if (file_exists($vfile)) {
                    unlink($vfile);
                }
                
                $this->db->update('settings', $data, ['id' => 1]);
            }else{
                $this->db->insert('settings', $data);
            }
            $this->session->set_flashdata('success', 'Settings saved successfully!');
        }else{
            $this->session->set_flashdata('error', 'Settings are failed to update.');
        }
        redirect('admin/settings');
    }


    public function social_update()
    {

        $data = $this->input->post();
        $update = $this->db->update('settings', $data);
        redirect('admin/settings');
    }

    public function add()
    {
    	if($this->input->post()){
            $data = $this->input->post();
            $data['created_at'] = date('Y-m-d H:i:s');

            //print_r($_FILES);die();
            if(isset($_FILES) && !empty($_FILES['image']['name'])) {
                $path = './uploads/projects/';
                if ( ! is_dir($path)) {
                    mkdir($path, 0777, TRUE);
                }
                
                $config['upload_path'] = $path;
                $config['allowed_types'] = 'png|jpg';

                $file = $this->files->upload('image', $config);
                if( ! isset($file['error'])){
                    $data['images'] = $file['id'];
                }else{
                    $this->session->set_flashdata('error', $file['error']);
                    redirect('admin/projects');
                }
            }

            $result = $this->db->insert('projects', $data);
            if($result){
                $this->session->set_flashdata('success', $this->lang->line('add_success'));
            }else{
                $this->session->set_flashdata('error', $this->lang->line('add_error'));
            }
            redirect('admin/projects');
    	}else{
    		$this->template->load_admin('projects/add');
    	}
    }

    public function edit($id="")
    {
    	if( ! empty($id)){
    		$row = $this->db->get_where('projects', ['id' => $id])->row_array();
            if($row){
                $file = $this->db->get_where('files', ['id' => $row['images']])->row_array();
                //print_r($file);die();
                $file = ($file) ? $file : false;
        		//print_r($row);die;
        		$this->template->load_admin('projects/add',['edit' => $row, 'file' => $file]);
            }
    	}
    }

    /*public function delete($id="")
    {
        if( ! empty($id)){

            //delete files
            $row = $this->db->get_where('projects', ['id' => $id])->row_array();
            $this->files->delete_by_id($row['images'], './uploads/projects/');

            //delete record
            $result = $this->db->delete('projects', ['id' => $id]);
            if($result){
                $this->session->set_flashdata('success', $this->lang->line('delete_success'));
            }else{
                $this->session->set_flashdata('error', $this->lang->line('delete_error'));
            }
            redirect('admin/projects');
        }
    }*/

    public function delete()
    {
        $data = $this->input->post();
        echo $this->delete_record($data);
    }
}