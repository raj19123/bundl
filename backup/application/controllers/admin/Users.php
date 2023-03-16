<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Admin_Controller {

	function __construct() {
		parent::__construct();
    }

    public function index()
    {
    	$list = $this->db->get_where('users','role != 2')->result_array();
    	$this->template->load_admin('users/list',['list' => $list]);
    }

    public function update_request()
    {
        $post = $this->input->post();

        $result_user = $this->db->update('users', ['email_verification_status' => 1], ['id' => $post['user_id']]);    

        if ($result_user) {
            echo json_encode(array('status' => true));
        } else {
            echo json_encode(array('status' => false));
        }
    }

    public function block($id='')
    {
        if($id != ''){
            $result = $this->db->update('users', ['status' => 0], ['id' => $id]);
            if($result){
                $this->session->set_flashdata('success', $this->lang->line('block_success'));
            }else{
                $this->session->set_flashdata('error', $this->lang->line('block_error'));
            }
            redirect('admin/users');
        }
    }

    public function unblock($id='')
    {
        if($id != ''){
            $result = $this->db->update('users', ['status' => 1], ['id' => $id]);
            if($result){
                $this->session->set_flashdata('success', $this->lang->line('unblock_success'));
            }else{
                $this->session->set_flashdata('error', $this->lang->line('unblock_error'));
            }
            redirect('admin/users');
        }
    }

    /*public function edit($id="")
    {
    	if( ! empty($id)){
    		$row = $this->db->get_where('email_templates',['id' => $id])->row_array();
    		$this->template->load_admin('email_templates/add',['edit' => $row]);
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
            
    		$result = $this->db->update('email_templates', $data, ['id' => $id]);
    		if($result){
    			$this->session->set_flashdata('success', $this->lang->line('update_success'));
    		}else{
    			$this->session->set_flashdata('error', $this->lang->line('update_error'));
    		}
    		redirect('admin/email');
    	}
    }

    public function add()
    {
    	if($this->input->post()){
    		$data = $this->input->post();

    		$data['slug'] = $this->slugify($data['email_subject_english']);
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by_id'] = $this->User->id;

    		$result = $this->db->insert('email_templates', $data);
    		if($result){
    			$this->session->set_flashdata('success', $this->lang->line('add_success'));
    		}else{
    			$this->session->set_flashdata('error', $this->lang->line('add_error'));
    		}
    		redirect('admin/email');
    	}else{
    		$this->template->load_admin('email_templates/add');
    	}
    }

    public function delete($id="")
    {
        if( ! empty($id)){
            $result = $this->db->delete('email_templates', ['id' => $id]);
            if($result){
                $this->session->set_flashdata('success', $this->lang->line('delete_success'));
            }else{
                $this->session->set_flashdata('error', $this->lang->line('delete_error'));
            }
            redirect('admin/email');
        }
    }*/
}