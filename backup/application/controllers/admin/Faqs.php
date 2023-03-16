<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faqs extends Admin_Controller {
//class Design extends CI_Controller {

	function __construct() {
		parent::__construct();
    }

    public function index()
    {
    	$list = $this->db->get('faqs')->result_array();
    	$this->template->load_admin('faqs/list',['list' => $list]);
    }

    public function edit($id="")
    {
    	if( ! empty($id)){
    		$row = $this->db->get_where('faqs', ['id' => $id])->row_array();
    		$cats = $this->db->get('faqs_categories')->result_array();
    		//print_r($row);die;
    		$this->template->load_admin('faqs/add',['edit' => $row, 'cats' => $cats]);
    	}
    }

    public function update()
    {
    	$data = $this->input->post();
    	if($data){
    		$id = $data['id'];
    		unset($data['id']);

            $data['updated_at'] = date('Y-m-d H:i:s');
            $data['updated_by_id'] = $this->User->id;
            
    		$result = $this->db->update('faqs', $data, ['id' => $id]);
    		if($result){
    			$this->session->set_flashdata('success', 'FAQs has been updated successfully!');
    		}else{
    			$this->session->set_flashdata('error', 'FAQs has been failed to update.');
    		}
    		redirect('admin/faqs');
    	}
    }

    public function add()
    {
    	if($this->input->post()){
    		$data = $this->input->post();

            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by_id'] = $this->User->id;

    		$result = $this->db->insert('faqs', $data);
    		if($result){
    			$this->session->set_flashdata('success', 'New FAQs has been created!');
    		}else{
    			$this->session->set_flashdata('error', 'FAQs has been failed to create.');
    		}
    		redirect('admin/faqs');
    	}else{
    		$cats = $this->db->get('faqs_categories')->result_array();
    		$this->template->load_admin('faqs/add', ['cats' => $cats]);
    	}
    }

    /*public function delete($id="")
    {
        if( ! empty($id)){
            $result = $this->db->delete('faqs', ['id' => $id]);
            if($result){
                $this->session->set_flashdata('success', 'FAQs has been deleted successfully!');
            }else{
                $this->session->set_flashdata('error', 'FAQs has been failed to delete.');
            }
            redirect('admin/faqs');
        }
    }*/

    /*public function cats_delete($id="")
    {
    	if( ! empty($id)){
            $file = $this->db->get_where('faqs_categories', ['id' => $id])->row_array();
            $fileId = $file['design_icon_id'];
            $result = $this->db->delete('faqs_categories', ['id' => $id]);
            if($result){
                $this->files->delete_by_id($fileId);
    			$this->session->set_flashdata('success', $this->lang->line('delete_cat_success'));
    		}else{
    			$this->session->set_flashdata('error', $this->lang->line('delete_cat_error'));
    		}
    		redirect('admin/faqs/categories');
    	}
    }*/

    public function delete()
    {
        $data = $this->input->post();
        echo $this->delete_record($data);
    }

    public function cats_list()
    {
        $this->db->select('faqs_categories.* , files.name as icon');
        $this->db->from('faqs_categories');
        $this->db->join('files', 'faqs_categories.design_icon_id = files.id', 'left');
        $list = $this->db->get()->result_array();
        $this->template->load_admin('faqs/categories/list',['list' => $list]);
    }

    public function cats_add()
    {
        if($this->input->post()){

            $config['upload_path']          = './uploads/icons/';
            $config['allowed_types']        = 'ico|png|jpg';
            $config['max_size']             = 300;
            $config['max_width']            = 512;
            $config['max_height']           = 512;

            $file = $this->files->upload('icon', $config);

            if( ! isset($file['error'])){
                $data = $this->input->post();
                $data['slug'] = $this->slugify($data['name']);
                $data['created_at'] = date('Y-m-d H:i:s');
                $data['created_by_id'] = $this->User->id;
                $data['design_icon_id'] = $file['id'];

                $result = $this->db->insert('faqs_categories', $data);
                if($result){
                    $this->session->set_flashdata('success', $this->lang->line('add_cat_success'));
                }else{
                    $this->session->set_flashdata('error', $this->lang->line('add_cat_error'));
                }
            }else{
                $this->session->set_flashdata('error', $file['error']);
                redirect('admin/faqs/categories/add');
            }
            
            redirect('admin/faqs/categories');
        }else{
            $this->template->load_admin('faqs/categories/add');
        }
    }

    public function cats_edit($id="")
    {
        if( ! empty($id)){
            $cats = $this->db->get_where('faqs_categories',['id' => $id])->row_array();
            //print_r($cats);die;
            if($cats){
                $file = $this->db->get_where('files', ['id' => $cats['design_icon_id']])->row_array();
                //print_r($file);die();
                $file = ($file) ? $file : false;
                $this->template->load_admin('faqs/categories/add',['edit' => $cats, 'file' => $file]);
            }
        }
    }

    public function cats_update()
    {
        $data = $this->input->post();
        if($data){
            $id = $data['id'];
            unset($data['id']);
            $data['updated_at'] = date('Y-m-d H:i:s');
            $data['updated_by_id'] = $this->User->id;

            if(! empty($_FILES['icon']['name'])) {
                $config['upload_path']          = './uploads/icons/';
                $config['allowed_types']        = 'ico|png|jpg';
                $config['max_size']             = 300;
                $config['max_width']            = 512;
                $config['max_height']           = 512;

                $file = $this->files->upload('icon', $config);

                if(isset($file['error'])){
                    $this->session->set_flashdata('error', $file['error']);
                    redirect('admin/faqs/categories');
                }else{
                    $data['design_icon_id'] = $file['id'];
                    $this->files->delete_by_name($data['old_file']);
                }  
            }
            unset($data['old_file']);

            $result = $this->db->update('faqs_categories', $data, ['id' => $id]);
            //echo $this->db->last_query();die();
            if($result){
                $this->session->set_flashdata('success', $this->lang->line('update_cat_success'));
            }else{
                $this->session->set_flashdata('error', $this->lang->line('update_cat_error'));
            }
            redirect('admin/faqs/categories');
        }
    }
}