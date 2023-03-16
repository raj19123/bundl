<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Careers extends Admin_Controller {

	function __construct() {
		parent::__construct();
    }

    public function index()
    {
    	$list = $this->db->get('careers')->result_array();
    	$this->template->load_admin('careers/list',['list' => $list]);
    }

    public function add()
    {
    	if($this->input->post()){
            $data = $this->input->post();
            $data['created_on'] = date('Y-m-d H:i:s');

    		$result = $this->db->insert('careers', $data);
    		if($result){
    			$this->session->set_flashdata('success', $this->lang->line('add_success'));
			}else{
				$this->session->set_flashdata('error', $this->lang->line('add_error'));
			}
			redirect('admin/careers');
    	}else{
    		$this->template->load_admin('careers/add');
    	}
    }

    public function edit($id="")
    {
    	if( ! empty($id)){
    		$row = $this->db->get_where('careers', ['id' => $id])->row_array(); 
    		$this->template->load_admin('careers/add',['edit' => $row]);
    	}
    }

    public function update()
    {
    	$data = $this->input->post();
    	if($data){
    		$id = $data['id'];
    		unset($data['id']);
            
    		$result = $this->db->update('careers', $data, ['id' => $id]);
    		if($result){
    			$this->session->set_flashdata('success', $this->lang->line('update_success'));
    		}else{
    			$this->session->set_flashdata('error', $this->lang->line('update_error'));
    		}
    		redirect('admin/careers');
    	}
    }

    /*public function delete($id="")
    {
        if( ! empty($id)){
            $result = $this->db->delete('careers', ['id' => $id]);
            if($result){
                $this->session->set_flashdata('success', $this->lang->line('delete_success'));
            }else{
                $this->session->set_flashdata('error', $this->lang->line('delete_error'));
            }
            redirect('admin/careers');
        }
    }*/

    public function application_list()
    {
        $list = $this->db->select('careers.vacancy_english as vacancy, vacancy_applications.*')
            ->join('careers','careers.id = vacancy_applications.vacancy_id', 'left')
            ->get('vacancy_applications')->result_array();
        //print_r($list);die();
        $this->template->load_admin('careers/applications',['list' => $list]);
    }

    /*public function application_delete($id="")
    {
        if( ! empty($id) ){
            // delete related files
            $application = $this->db->get_where('vacancy_applications', ['id' => $id])->row_array();
            $file_ids = explode(',', $application['attachments']);
            $files = $this->db->where_in('id', $file_ids)->get('files');
            if($files->num_rows() > 0){
                $files = $files->result_array();
                $path = './uploads/vacancy/';
                foreach ($files as $key => $file) {
                    $this->files->delete_by_name($file['name'], $path);
                }
            }

            $result = $this->db->delete('vacancy_applications', ['id' => $id]);
            if($result){
                $this->session->set_flashdata('success', $this->lang->line('delete_applicant_success'));
            }else{
                $this->session->set_flashdata('error', $this->lang->line('delete_applicant_error'));
            }
            redirect('admin/careers/applications');
        }
    }*/

    public function delete()
    {
        $data = $this->input->post();
        //print_r($data);
        echo $this->delete_record($data);
    }
}