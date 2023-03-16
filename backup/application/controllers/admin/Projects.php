<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Projects extends Admin_Controller {

	function __construct() {
		parent::__construct();
    }

    public function index()
    {
    	$list = $this->db->get('projects')->result_array();
    	$this->template->load_admin('projects/list',['list' => $list]);
    }

    public function add()
    {

    	if($this->input->post()){
            $data = $this->input->post();
            $data['created_at'] = date('Y-m-d H:i:s');

            if(isset($data['projectId'])){
                unset($data['projectId']);
            }
            //print_r($_FILES);die();
    
            $result = $this->db->insert('projects', $data);
            if($result){
                $prj_id = $this->db->insert_id();
                $this->session->set_flashdata('success', $this->lang->line('add_success'));
                echo json_encode([
                    "error" => false,
                    "project_id" => $prj_id,
                    "message" => "Uploading process has been succeed."
                ]);
            }else{
                $this->session->set_flashdata('error', $this->lang->line('add_error'));
                echo json_encode(["error"=> true, "message" => "Uploading process has been failed."]);
            }
            //redirect('admin/projects');
    	}else{
    		$this->template->load_admin('projects/add');
    	}
    }

    public function edit($id="")
    {
    	if( ! empty($id)){
    		$row = $this->db->get_where('projects', ['id' => $id])->row_array();
            if($row){
                $images = [];
                if ($row['images']) {
                    $project_images = explode(',', $row['images']);
                    $files = $this->db->where_in('id', $project_images)->get('files')->result_array();
                    foreach ($files as $key => $file) {
                        $images[] = [
                            'name' => $file['name'],
                            'size' => $file['size'],
                            'url' => $file['name'],
                            'type' => $file['type'],
                            'id' => $file['id']
                        ];
                    }
                }
                $images = ($images) ? $images : false;
        		$this->template->load_admin('projects/add',['edit' => $row, 'images' => $images]);
            }
    	}
    }

    public function update()
    {
    	$data = $this->input->post();
    	if($data){

    		$id = $data['id'];
    		unset($data['id']);
            
    		$result = $this->db->update('projects', $data, ['id' => $id]);
    		if($result){
    			$this->session->set_flashdata('success', $this->lang->line('update_success'));
                echo json_encode(["error"=> false, "project_id" => $id, "message" => "Uploading process has been succeed."]);
    		}else{
    			$this->session->set_flashdata('error', $this->lang->line('update_error'));
                echo json_encode(array("error"=> true,'message' => "Uploading process has been failed."));
    		}
    		// redirect('admin/projects');
    	}
    }

    public function delete()
    {
        $data = $this->input->post();
        echo $this->delete_record($data);
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

    public function project_files()
    {
        //print_r($_POST);
        //return print_r($_FILES);
        
        if( ! empty($_FILES['files']['name'])){

            // make path
            $path = './uploads/projects/';
            if ( ! is_dir($path.$order_id)) {
                mkdir($path.$order_id, 0777, TRUE);
            }

            $config['upload_path'] = $path;
            $config['allowed_types'] = 'png|jpg|jpeg';

            $uploaded_file_ids = $this->files->multiUpload('files', $config);

            if(isset($_POST['existingFiles']) && !empty($_POST['existingFiles'])){
                $existingFiles = explode(',', $_POST['existingFiles']);
                $uploaded_file_ids = array_merge($existingFiles, $uploaded_file_ids);
            }

            $uploaded_file_ids = implode(',', $uploaded_file_ids);

            //print_r($uploaded_file_ids);die();
            $project_id = $_POST['project_id'];
            $result = $this->db->update('projects', ['images' => $uploaded_file_ids], ['id' => $project_id]);
            echo $result;
        }
    }

    public function delete_project_image()
    {
        $data = $this->input->post();
        if($data){
            $file = $this->db->get_where('files', ['name' => $data['fileName']])->row_array();
            if($file){

                $path = './uploads/projects/';
                $this->files->delete_by_name($data['fileName'], $path);

                $project = $this->db->get_where('projects', ['id' => $data['project_id']])->row_array();
                $existedImages = $project['images'];
                
                $updated_str = $this->remove_item_from_string($existedImages, $file['id']);

                $this->db->update('projects', ['images' => $updated_str], ['id' => $data['project_id']]);
            }
        }
    }
    
    public function remove_item_from_string($str, $item) 
    {
        $parts = explode(',', $str);
        while(($i = array_search($item, $parts)) !== false) {
            unset($parts[$i]);
        }
        return implode(',', $parts);
    }

    public function hero_image($project_id='')
    {
        if(empty($project_id)){
            show_404();
        }
        $project = $this->db->get_where('projects', ['id' => $project_id])->row_array();
        $this->template->load_admin('projects/hero_image', ['project' => $project]);
    }

    public function update_hero_image()
    {
        $data = $this->input->post();
        if($data){
            //print_r($data);
            $is_update = $this->db->update('projects', ['hero_image' => $data['hero_image']], ['id' => $data['project_id']]);
            echo ($is_update) ? "TRUE" : "FALSE";
        }
    }
}