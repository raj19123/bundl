<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Design extends Admin_Controller {
//class Design extends CI_Controller {

	function __construct() {
		parent::__construct();
        $this->load->model('Design_Model','design_model');
    }

    public function index()
    {
    	$list = $this->design_model->get_designs_list();
    	$this->template->load_admin('design/list',['list' => $list]);
    }

    public function edit($id="")
    {
    	if( ! empty($id)){
    		$row = $this->design_model->get_row($id);
    		$cats = $this->design_model->get_design_cats();
    		//print_r($row);die;
    		$this->template->load_admin('design/add',['edit' => $row, 'cats' => $cats]);
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
            
    		$result = $this->design_model->update($id, $data);
    		if($result){
    			$this->session->set_flashdata('success', 'Questionnaire has been update successfully!');
    		}else{
    			$this->session->set_flashdata('error', $this->lang->line('update_error'));
    		}
    		redirect('admin/design');
    	}
    }

    public function add()
    {
    	if($this->input->post()){
    		$data = $this->input->post();

    		$data['slug'] = $this->slugify($data['name']);
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by_id'] = $this->User->id;

    		$result = $this->design_model->add($data);
    		if($result){
    			$this->session->set_flashdata('success', $this->lang->line('add_success'));
    		}else{
    			$this->session->set_flashdata('error', $this->lang->line('add_error'));
    		}
    		redirect('admin/design');
    	}else{
    		$cats = $this->design_model->get_design_cats();
    		$this->template->load_admin('design/add', ['cats' => $cats]);
    	}
    }

    /*public function delete($id="")
    {
        if( ! empty($id)){
            $result = $this->design_model->delete($id);
            if($result){
                $this->session->set_flashdata('success', $this->lang->line('delete_success'));
            }else{
                $this->session->set_flashdata('error', $this->lang->line('delete_error'));
            }
            redirect('admin/design');
        }
    }*/

    public function delete()
    {
        $data = $this->input->post();
        echo $this->delete_record($data);
    }

    /*public function cats_delete($id="")
    {
    	if( ! empty($id)){
            $file = $this->db->get_where('design_categories', ['id' => $id])->row_array();
            $fileId = $file['design_icon_id'];
            $result = $this->db->delete('design_categories', ['id' => $id]);
            if($result){
                $this->files->delete_by_id($fileId);
    			$this->session->set_flashdata('success', $this->lang->line('delete_cat_success'));
    		}else{
    			$this->session->set_flashdata('error', $this->lang->line('delete_cat_error'));
    		}
    		redirect('admin/design/categories');
    	}
    }*/

    public function cats_list()
    {
        $this->db->select('design_categories.* , files.name as icon');
        $this->db->from('design_categories');
        $this->db->join('files', 'design_categories.design_icon_id = files.id', 'left');
        $list = $this->db->get()->result_array();
        $this->template->load_admin('design/categories/list',['list' => $list]);
    }

    public function cats_add()
    {
        if($this->input->post()){
            $data = $this->input->post();
            $data['slug'] = $this->slugify($data['name']);
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by_id'] = $this->User->id;

            if(! empty($_FILES['icon']['name'])){
                $config['upload_path']          = './uploads/icons/';
                $config['allowed_types']        = 'ico|png|jpg';
                $config['max_size']             = 300;
                $config['max_width']            = 512;
                $config['max_height']           = 512;

                $file = $this->files->upload('icon', $config);
                if( ! isset($file['error'])){
                    $data['design_icon_id'] = $file['id'];
                }
            }

            $result = $this->db->insert('design_categories', $data);
            if($result){
                $this->session->set_flashdata('success', $this->lang->line('add_cat_success'));
            }else{
                $this->session->set_flashdata('error', $this->lang->line('add_cat_error'));
            }

            redirect('admin/design/categories');
        }else{
            $this->template->load_admin('design/categories/add');
        }
    }

    public function cats_edit($id="")
    {
        if( ! empty($id)){
            $cats = $this->db->get_where('design_categories',['id' => $id])->row_array();
            //print_r($cats);die;
            if($cats){
                $file = $this->db->get_where('files', ['id' => $cats['design_icon_id']])->row_array();
                //print_r($file);die();
                $file = ($file) ? $file : false;
                $this->template->load_admin('design/categories/add',['edit' => $cats, 'file' => $file]);
            }
        }
    }

    public function cats_update()
    {
        $data = $this->input->post();
        //print_r($_FILES);die();
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
                    redirect('admin/design/categories');
                }else{
                    $data['design_icon_id'] = $file['id'];
                    $this->files->delete_by_name($data['old_file']);
                }  
            }
            unset($data['old_file']);

            //print_r($data);die();

            $result = $this->db->update('design_categories', $data, ['id' => $id]);
            //echo $this->db->last_query();die();
            if($result){
                $this->session->set_flashdata('success', $this->lang->line('update_cat_success'));
            }else{
                $this->session->set_flashdata('error', $this->lang->line('update_cat_error'));
            }
            redirect('admin/design/categories');
        }
    }

    public function show_questionnaire($id)
    {
        if($id){
            $design = $this->db->get_where('designs', ['id' => $id])->row_array();
            $questionnaire = $this->db->get_where('questions_design', ['design_id' => $id])->row_array();
            $this->template->load_admin('design/questionnaire', ['design' => $design, 'questionnaire' => $questionnaire]);
        }else{
            show_404();
        }
    }

    public function add_questionnaire()
    {
        if($this->input->post()){
            $data = $this->input->post();
            //print_r($data);die();
            $result = $this->db->insert('questions_design', $data);
            if($result){
                $this->session->set_flashdata('success', $this->lang->line('add_q_success'));
            }else{
                $this->session->set_flashdata('error', $this->lang->line('add_q_error'));
            }
            redirect('admin/design/questionnaire/'.$data['design_id']);
        }
    }

    public function update_questionnaire()
    {
        if($this->input->post()){
            $data = $this->input->post();
            //print_r($data);die();
            $design_id = $data['design_id'];
            unset($data['design_id']);

            $update = [
                'language'      => isset($data['language']) ? '1' : '0',
                'measurement'   => isset($data['measurement']) ? '1' : '0',
                'content'       => isset($data['content']) ? '1' : '0',
                'textbox'       => isset($data['textbox']) ? '1' : '0',
                'attachment'    => isset($data['attachment']) ? '1' : '0'
            ];

            //print_r($update);die();

            $result = $this->db->update('questions_design', $update, ['design_id' => $design_id]);
            if($result){
                $this->session->set_flashdata('success', $this->lang->line('update_q_success'));
            }else{
                $this->session->set_flashdata('error', $this->lang->line('update_q_error'));
            }
            redirect('admin/design/questionnaire/'.$design_id);
        }
    }

    public function show_adjustments($id)
    {
        if($id){
            //print_r($id);die();
            $design = $this->db->get_where('designs', ['id' => $id])->row_array();
            $adjustments = $this->db->get_where('adjustments', ['status' => 1])->result_array();
            $design_adjustments = $this->design_model->get_design_adjustments($id);
            
            $this->template->load_admin('design/adjustments', [
                'design' => $design,
                'adjustments' => $adjustments,
                'design_adjustments' => $design_adjustments
            ]);
        }else{
            show_404();
        }
    }

    public function add_adjustments()
    {
        $data = $this->input->post();
        if($data){
            $id = $data['the_id'];
            unset($data['the_id']);

            $data['textbox'] = isset($data['textbox']) ? '1' : '0';
            $data['attachment'] = isset($data['attachment']) ? '1' : '0';
            $data['status'] = 1;

            //print_r($data);
            if(isset($id) && !empty($id)){
                $result = $this->db->update('design_adjustments', $data, ['id'=>$id]);
                $msg = 'Adjustment has been successfully updated!';
                $err = 'Adjustment has been failed to update.';
            }else{
                $result = $this->db->insert('design_adjustments', $data);
                $msg = 'Adjustment has been successfully added!';
                $err = 'Adjustment has been failed to add.';
            }
            if($result){
                $this->session->set_flashdata('success', $msg);
            }else{
                $this->session->set_flashdata('error', $err);
            }
            redirect('admin/design/adjustments/'.$data['design_id']);
        }else{
            show_404();
        }
    }

    public function edit_adjustments()
    {
        $data = $this->input->post();
        if($data){
            $result = $this->db->get_where('design_adjustments', ['design_id' => $data['design_id'], 'adjustment_id' => $data['adjustment_id']])->row_array();
            echo json_encode($result); 
        }
    }

    public function remove_adjustments($design_id, $adjustment_id)
    {
        if($design_id && $adjustment_id){
            $result = $this->db->delete('design_adjustments', ['design_id' => $design_id, 'adjustment_id' => $adjustment_id]);
            
            if($result){
                $this->session->set_flashdata('success', 'Adjustment has been successfully deleted!');
            }else{
                $this->session->set_flashdata('error', 'Adjustment has been failed to delete.');
            }
            redirect('admin/design/adjustments/'.$design_id);
        }
    }

    public function questionnaire_cats_update()
    {
        $data = $this->input->post();
        //print_r($data);//drop
        if($data){
            if(isset($_FILES)) {
                $result = $this->files->delete_by_name($data['old_file']);
                unset($data['old_file']);
                
                $config['upload_path']          = './uploads/icons/';
                $config['allowed_types']        = 'ico|png|jpg';
                $config['max_size']             = 300;
                $config['max_width']            = 512;
                $config['max_height']           = 512;

                $file = $this->files->upload('icon', $config);

                if(isset($file['error'])){
                    $this->session->set_flashdata('success', $this->lang->line('update_cat_success'));
                    redirect('admin/design/categories');
                }else{
                    $data['design_icon_id'] = $file['id'];
                }
                
            }

            $id = $data['id'];
            unset($data['id']);

            $data['updated_at'] = date('Y-m-d H:i:s');
            $data['updated_by_id'] = $this->User->id;

            $result = $this->db->update('design_categories', $data, ['id' => $id]);
            //echo $this->db->last_query();die();
            if($result){
                $this->session->set_flashdata('success', $this->lang->line('update_cat_success'));
            }else{
                $this->session->set_flashdata('error', $this->lang->line('update_cat_error'));
            }
            redirect('admin/design/categories');
        }
    }
}