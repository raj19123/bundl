<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Adjustments extends Admin_Controller {

	function __construct() {
		parent::__construct();
    }

    public function index()
    {
    	$list = $this->db->get('adjustments')->result_array();
    	$this->template->load_admin('adjustments/list',['list' => $list]);
    }

    public function add()
    {
    	if($this->input->post()){
    		$data = $this->input->post();
    		$data['created_on'] = date('Y-m-d H:i:s');
    		$data['slug'] = $this->slugify($data['name_english']);
    		//print_r($data);die();
    		$result = $this->db->insert('adjustments', $data);
    		if($result){
    			$this->session->set_flashdata('success', $this->lang->line('add_success_answer'));
			}else{
				$this->session->set_flashdata('error', $this->lang->line('add_error_answer'));
			}
			redirect('admin/adjustments');
    	}else{
    		$this->template->load_admin('adjustments/add');
    	}
    }

    public function edit($id="")
    {
    	if( ! empty($id)){
    		$row = $this->db->get_where('adjustments', ['id' => $id])->row_array();
    		//print_r($row);die;
    		$this->template->load_admin('adjustments/add',['edit' => $row]);
    	}
    }

    public function update()
    {
    	$data = $this->input->post();
    	if($data){
    		$id = $data['id'];
    		unset($data['id']);

            //$data['updated_at'] = date('Y-m-d H:i:s');
            //$data['updated_by_id'] = $this->User->id;
            
    		$result = $this->db->update('adjustments', $data, ['id' => $id]);
    		if($result){
    			$this->session->set_flashdata('success', $this->lang->line('update_success'));
    		}else{
    			$this->session->set_flashdata('error', $this->lang->line('update_error'));
    		}
    		redirect('admin/adjustments');
    	}
    }

    /*public function delete($id="")
    {
        if( ! empty($id)){
            $result = $this->db->delete('adjustments', ['id' => $id]);
            if($result){
                $this->session->set_flashdata('success', $this->lang->line('delete_success'));
            }else{
                $this->session->set_flashdata('error', $this->lang->line('delete_error'));
            }
            redirect('admin/adjustments');
        }
    }*/

    public function delete()
    {
        $data = $this->input->post();
        echo $this->delete_record($data);
    }
}