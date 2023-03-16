<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Package extends Admin_Controller {
//class Design extends CI_Controller {

	function __construct() {
		parent::__construct();
        $this->load->model('Package_Model','package_model');
        $this->load->model('Design_Model','design_model');
    }

    public function index()
    {
    	$list = $this->package_model->get_packages_list();
    	$this->template->load_admin('package/list',['list' => $list]);
    }

    public function edit($id="")
    {
    	if( ! empty($id)){
            $row = $this->package_model->get_row($id);
    		$selected_components = $this->package_model->get_selected_componenets($id);
    		$cats = $this->package_model->get_package_cats();
            $components = $this->package_model->get_components();
    		$this->template->load_admin('package/add',['edit' => $row, 'cats' => $cats, 'components' => $components, 'selected_components' => $selected_components]);
    	}
    }

    public function add()
    {
    	if($this->input->post()){
    		$data = $this->input->post();

    		$data['slug'] = $this->slugify($data['name_english']);
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by_id'] = $this->User->id;

            $component_ids = $data['components'];
            unset($data['components']);

            $result = $this->db->insert('packages', $data);
            if($result){
                $package_id = $this->db->insert_id();
                foreach ($component_ids as $component) {
                    $this->db->insert('component_package', ['package_id' => $package_id, 'component_id' => $component]);
                }
    			$this->session->set_flashdata('success', $this->lang->line('add_success'));
    		}else{
    			$this->session->set_flashdata('error', $this->lang->line('add_error'));
    		}
    		redirect('admin/package');
    	}else{
    		$cats = $this->package_model->get_package_cats();
            $components = $this->package_model->get_components();
    		$this->template->load_admin('package/add', ['cats' => $cats, 'components' => $components]);
    	}
    }

    public function update()
    {
        $data = $this->input->post();
        if($data){
            $id = $data['id'];
            unset($data['id']);

            //$data['designs'] = implode(',', $data['designs']);

            $this->db->delete('component_package', ['package_id' => $id]);
            foreach ($data['components'] as $component) {
                $this->db->insert('component_package', ['package_id' => $id, 'component_id' => $component]);
            }

            unset($data['components']);

            $data['updated_at'] = date('Y-m-d H:i:s');
            $data['updated_by_id'] = $this->User->id;
            
            //print_r($data);die();
            $result = $this->package_model->update($id, $data);
            if($result){
                $this->session->set_flashdata('success', $this->lang->line('update_success'));
            }else{
                $this->session->set_flashdata('error', $this->lang->line('update_error'));
            }
            redirect('admin/package');
        }
    }

    /*public function delete($id="")
    {
        if( ! empty($id)){
            $result = $this->package_model->delete($id);
            if($result){
                $this->session->set_flashdata('success', $this->lang->line('delete_success'));
            }else{
                $this->session->set_flashdata('error', $this->lang->line('delete_error'));
            }
            redirect('admin/package');
        }
    }*/

    public function delete()
    {
        $data = $this->input->post();
        echo $this->delete_record($data);
    }

    public function cats_list()
    {
        $this->db->select('package_categories.* , files.name as icon');
        $this->db->from('package_categories');
        $this->db->join('files', 'package_categories.package_cat_image_id = files.id', 'left');
        $list = $this->db->get()->result_array();
        $this->template->load_admin('package/categories/list',['list' => $list]);
    }

    /*public function cats_delete($id="")
    {
        if( ! empty($id)){
            $file = $this->db->get_where('package_categories', ['id' => $id])->row_array();
            $fileId = $file['package_cat_image_id'];
            $result = $this->db->delete('package_categories', ['id' => $id]);
            if($result){
                $this->files->delete_by_id($fileId);
                $this->session->set_flashdata('success', $this->lang->line('delete_cat_success'));
            }else{
                $this->session->set_flashdata('error', $this->lang->line('delete_cat_error'));
            }
            redirect('admin/package/categories');
        }
    }*/

    public function cats_add()
    {
        if($this->input->post()){
            $data = $this->input->post();
            $data['slug'] = $this->slugify($data['name']);
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by_id'] = $this->User->id;

            if(isset($_FILES) && !empty($_FILES['icon']['name'])) {
                $config['upload_path']          = './uploads/icons/';
                $config['allowed_types']        = 'ico|png|jpg';
                $config['max_size']             = 300;
                $config['max_width']            = 512;
                $config['max_height']           = 512;

                $file = $this->files->upload('icon', $config);
                if( ! isset($file['error'])){
                    $data['package_cat_image_id'] = $file['id'];
                }else{
                    $this->session->set_flashdata('error', $file['error']);
                    redirect('admin/package/categories/add');
                }
            }

            $result = $this->db->insert('package_categories', $data);
            if($result){
                $this->session->set_flashdata('success', $this->lang->line('add_cat_success'));
            }else{
                $this->session->set_flashdata('error', $this->lang->line('add_cat_error'));
            }
            
            redirect('admin/package/categories');
        }else{
            $this->template->load_admin('package/categories/add');
        }
    }

    public function cats_edit($id="")
    {
        if( ! empty($id)){
            $cats = $this->db->get_where('package_categories',['id' => $id])->row_array();
            //print_r($cats);die;
            if($cats){
                $file = $this->db->get_where('files', ['id' => $cats['package_cat_image_id']])->row_array();
                //print_r($file);die();
                $file = ($file) ? $file : false;
                $this->template->load_admin('package/categories/add',['edit' => $cats, 'file' => $file]);
            }
        }
    }

    public function cats_update()
    {
        $data = $this->input->post();
        if($data){
            if(isset($_FILES) && !empty($_FILES['icon']['name'])) {
                $result = $this->files->delete_by_name($data['old_file']);
                
                $config['upload_path']          = './uploads/icons/';
                $config['allowed_types']        = 'ico|png|jpg';
                $config['max_size']             = 300;
                $config['max_width']            = 512;
                $config['max_height']           = 512;

                $file = $this->files->upload('icon', $config);

                if(isset($file['error'])){
                    $this->session->set_flashdata('success', $this->lang->line('update_cat_success'));
                    redirect('admin/package/categories');
                }else{
                    $data['package_cat_image_id'] = $file['id'];
                }      
            }

            $id = $data['id'];
            unset($data['id']);
            if(isset($data['old_file'])){
                unset($data['old_file']);
            }

            $data['updated_at'] = date('Y-m-d H:i:s');
            $data['updated_by_id'] = $this->User->id;
            
            $result = $this->db->update('package_categories', $data, ['id' => $id]);
            //echo $this->db->last_query();die();
            if($result){
                $this->session->set_flashdata('success', $this->lang->line('update_cat_success'));
            }else{
                $this->session->set_flashdata('error', $this->lang->line('update_cat_error'));
            }
            redirect('admin/package/categories');
        }
    }

    public function components_list()
    {
        $list = $this->db->order_by('sort_order', 'ASC')->get('package_components')->result_array();
        $this->template->load_admin('package/components/list',['list' => $list]);
    }

    public function components_add()
    {
        if($this->input->post()){
            $data = $this->input->post();
            $data['slug'] = $this->slugify($data['name_english']);
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = $this->User->id;

            //$design_ids = $data['designs'];
            //unset($data['designs']);

            $result = $this->db->insert('package_components', $data);
            if($result){
                /*$component_id = $this->db->insert_id();
                foreach ($design_ids as $design) {
                    $this->db->insert('component_design', ['component_id' => $component_id, 'design_id' => $design]);
                }*/
                $this->session->set_flashdata('success', $this->lang->line('add_component_success'));
            }else{
                $this->session->set_flashdata('error', $this->lang->line('add_component_error'));
            }
            redirect('admin/package/components');

        }else{
            //$designs = $this->design_model->get_designs_list();
            $designs = $this->design_model->get_designs();
            $this->template->load_admin('package/components/add', ['designs' => $designs]);
        }
    }

    public function components_delete($id="")
    {
        if( ! empty($id)){
            $result = $this->db->delete('package_components', array('id' => $id));
            if($result){
                $this->db->delete('component_design', array('component_id' => $id));
                $this->session->set_flashdata('success', $this->lang->line('delete_component_success'));
            }else{
                $this->session->set_flashdata('error', $this->lang->line('delete_component_error'));
            }
            redirect('admin/package/components');
        }
    }

    public function components_edit($id='')
    {
        if( ! empty($id)){
            $compo = $this->db->get_where('package_components',['id' => $id])->row_array();
            //print_r($cats);die;
            if($compo){
                $selected_designs = $this->package_model->get_selected_designs($id);
                //$designs = $this->design_model->get_designs_list();
                $designs = $this->design_model->get_designs();
                $this->template->load_admin('package/components/add',[
                    'edit' => $compo, 
                    'designs' => $designs, 
                    'selected_designs' => $selected_designs
                ]);
            }
        }
    }

    public function components_update()
    {
        $data = $this->input->post();
        if($data){
            $id = $data['id'];
            unset($data['id']);

            //$data['designs'] = implode(',', $data['designs']);

            /*$this->db->delete('component_design', ['component_id' => $id]);
            foreach ($data['designs'] as $design) {
                $this->db->insert('component_design', ['component_id' => $id, 'design_id' => $design]);
            }

            unset($data['designs']);*/

            $data['updated_at'] = date('Y-m-d H:i:s');
            $data['updated_by'] = $this->User->id;
            
            //print_r($data);die();
            $result = $this->db->update('package_components', $data, ['id' => $id]);
            if($result){
                $this->session->set_flashdata('success', $this->lang->line('update_component_success'));
            }else{
                $this->session->set_flashdata('error', $this->lang->line('update_component_error'));
            }
            redirect('admin/package/components');
        }
    }

    public function add_designs($component_id='')
    {
        if(empty($component_id)){
            show_404();
        }

        $component = $this->db->get_where('package_components', ['id' => $component_id])->row_array();

        $designs = $this->design_model->get_designs();

        $selected_designs = $this->package_model->get_selected_designs($component_id);

        $this->template->load_admin('package/components/designs', [
            'component' => $component,
            'designs' => $designs,
            'selected_designs' => $selected_designs
        ]);
    }

    public function update_designs()
    {
        $data = $this->input->post();
        if($data){
            $result = $this->db->insert('component_design', $data);
            if($result){
                $this->session->set_flashdata('success', 'Design added to the component successfully!');
            }else{
                $this->session->set_flashdata('error', 'Design failed to add. Try again!');
            }
            redirect('admin/package/components/add-designs/'.$data['component_id']);
        }else{
            show_404();
        }
    }

    public function remove_designs($component_design_id='',$component_id='')
    {
        if(empty($component_design_id) || empty($component_id)){
            show_404();
        }

        $result = $this->db->delete('component_design', ['id' => $component_design_id]);
        if($result){
            $this->session->set_flashdata('success', 'Design deleted successfully!');
        }else{
            $this->session->set_flashdata('error', 'Design failed to delete. Try again!');
        }
        redirect('admin/package/components/add-designs/'.$component_id);
    }
}