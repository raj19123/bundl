<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Privacy_Policy extends Admin_Controller {

	function __construct() {
		parent::__construct();
    }

    public function index()
    {
    	$list = $this->db->get('privacy_policy')->result_array();
    	$this->template->load_admin('privacy_policy/list',['list' => $list]);
    }

    public function edit($id="")
    {
    	if( ! empty($id)){
    		$row = $this->db->get_where('privacy_policy',['id' => $id])->row_array();
    		$this->template->load_admin('privacy_policy/add',['edit' => $row]);
    	}
    }

    public function update()
    {
    	$data = $this->input->post();
    	if($data){
    		$id = $data['id'];
    		unset($data['id']);
            
    		$result = $this->db->update('privacy_policy', $data, ['id' => $id]);
    		if($result){
    			$this->session->set_flashdata('success', 'Privacy Policy has been updated successfully!');
    		}else{
    			$this->session->set_flashdata('error', 'Privacy Policy has been failed to update.');
    		}
    		redirect('admin/privacy');
    	}
    }

    public function add()
    {
    	if($this->input->post()){
    		$data = $this->input->post();

    		$result = $this->db->insert('privacy_policy', $data);
    		if($result){
    			$this->session->set_flashdata('success', 'Privacy Policy has been added successfully!');
    		}else{
    			$this->session->set_flashdata('error', 'Privacy Policy has been failed to add.');
    		}
    		redirect('admin/privacy');
    	}else{
    		$this->template->load_admin('privacy_policy/add');
    	}
    }

    /*public function delete($id="")
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

    public function delete()
    {
        $data = $this->input->post();
        echo $this->delete_record($data);
    }
}