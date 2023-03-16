<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Terms_Conditions extends Admin_Controller {

	function __construct() {
		parent::__construct();
    }

    public function index()
    {
    	$list = $this->db->get('terms_conditions')->result_array();
    	$this->template->load_admin('terms_condition/list',['list' => $list]);
    }

    public function edit($id="")
    {
    	if( ! empty($id)){
    		$row = $this->db->get_where('terms_conditions',['id' => $id])->row_array();
    		$this->template->load_admin('terms_condition/add',['edit' => $row]);
    	}
    }

    public function update()
    {
    	$data = $this->input->post();
    	if($data){
    		$id = $data['id'];
    		unset($data['id']);
            
    		$result = $this->db->update('terms_conditions', $data, ['id' => $id]);
    		if($result){
    			$this->session->set_flashdata('success', 'Terms & Condition has been updated successfully!');
    		}else{
    			$this->session->set_flashdata('error', 'Terms & Condition has been failed to update.');
    		}
    		redirect('admin/terms');
    	}
    }

    public function add()
    {
    	if($this->input->post()){
    		$data = $this->input->post();

    		$result = $this->db->insert('terms_conditions', $data);
    		if($result){
    			$this->session->set_flashdata('success', 'Terms & Condition has been added successfully!');
    		}else{
    			$this->session->set_flashdata('error', 'Terms & Condition has been failed to add.');
    		}
    		redirect('admin/terms');
    	}else{
    		$this->template->load_admin('terms_condition/add');
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