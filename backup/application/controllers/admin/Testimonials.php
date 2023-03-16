<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testimonials extends Admin_Controller {

	function __construct() {
		parent::__construct();
    }

    public function index()
    {
    	$list = $this->db->get('testimonials')->result_array();
    	$this->template->load_admin('testimonials/list',['list' => $list]);
    }

    public function edit($id="")
    {
    	if( ! empty($id)){
    		$row = $this->db->get_where('testimonials',['id' => $id])->row_array();
    		$this->template->load_admin('testimonials/add',['edit' => $row]);
    	}
    }

    public function update()
    {
    	$data = $this->input->post();
    	if($data){
    		$id = $data['id'];
    		unset($data['id']);
            
    		$result = $this->db->update('testimonials', $data, ['id' => $id]);
    		if($result){
    			$this->session->set_flashdata('success', 'Testimonial has been updated successfully!');
    		}else{
    			$this->session->set_flashdata('error', 'Testimonial has been failed to update.');
    		}
    		redirect('admin/testimonials');
    	}
    }

    public function add()
    {
    	if($this->input->post()){
    		$data = $this->input->post();

    		$result = $this->db->insert('testimonials', $data);
    		if($result){
    			$this->session->set_flashdata('success', 'Testimonial has been added successfully!');
    		}else{
    			$this->session->set_flashdata('error', 'Testimonial has been failed to add.');
    		}
    		redirect('admin/testimonials');
    	}else{
    		$this->template->load_admin('testimonials/add');
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