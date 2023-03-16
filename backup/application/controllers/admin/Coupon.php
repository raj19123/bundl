<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coupon extends Admin_Controller {

	function __construct() {
		parent::__construct();
    }

    public function index()
    {
    	$list = $this->db->get('coupons')->result_array();
    	$this->template->load_admin('coupon/list',['list' => $list]);
    }

    public function edit($id="")
    {
    	if( ! empty($id)){
    		$row = $this->db->get_where('coupons',['id' => $id])->row_array();
            $users = $this->db->select("full_name , email , id")->get("users")->result_array();
    		$this->template->load_admin('coupon/add',['edit' => $row , 'users' => $users]);
    	}
    }

    public function update()
    {
    	$data = $this->input->post();
    	if($data){
    		$id = $data['id'];
    		unset($data['id']);


            if(!empty($this->input->post("applicable_on_customers"))){
                $data['applicable_on_customers'] = implode(',', $this->input->post("applicable_on_customers"));
            }else{
                $data['applicable_on_customers'] = "";
            }

            //$data['updated_at'] = date('Y-m-d H:i:s');
            //$data['updated_by_id'] = $this->User->id;
            
    		$result = $this->db->update('coupons', $data, ['id' => $id]);
    		if($result){
    			$this->session->set_flashdata('success', $this->lang->line('update_success'));
    		}else{
    			$this->session->set_flashdata('error', $this->lang->line('update_error'));
    		}
    		redirect('admin/coupon');
    	}
    }

    public function add()
    {
    	if($this->input->post()){
    		$data = $this->input->post();

    		//$data['slug'] = $this->slugify($data['code']);
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by_id'] = $this->User->id;
            
            if(!empty($this->input->post("applicable_on_customers"))){
                $data['applicable_on_customers'] = implode(',', $this->input->post("applicable_on_customers"));
            }else{
                $data['applicable_on_customers'] = "";
            }

    		$result = $this->db->insert('coupons', $data);
    		if($result){
                
                // $lang = $customer['language'];
                // $this->lang->load('common',$this->lang);
                if(!empty($this->input->post("applicable_on_customers"))){
                    $this->db->where_in("id" , $this->input->post("applicable_on_customers"));
                    $customers = $this->db->get("users")->result_array();
                    if(!empty($customers)){
                        foreach ($customers as $cus_key => $cus_val) {
                            $email = $cus_val['email'];
                            $view = "special_coupon";
                            // $btn_link = base_url('dashboard');
                            $p_span = "<span style='font-weight: 600;color: #ae74a1;'>".$this->input->post("code")."</span>";
                            $vars = [
                                '{username}' => $cus_val['full_name'],
                                '{email}' => $email,
                                '{coupon}' => $p_span,
                                '{discount}' => $this->input->post("discount")."%",
                            ];
                            // echo "emailll == ". $cus_val['email']."<br>";
                            $a = $this->et->template($email, 'special_coupon', $vars, $view);
                            // var_dump($a);
                        }
                    }
                }
                // die();


    			$this->session->set_flashdata('success', $this->lang->line('add_success'));
    		}else{
    			$this->session->set_flashdata('error', $this->lang->line('add_error'));
    		}
    		redirect('admin/coupon');
    	}else{
            $data['users'] = $this->db->select("full_name , email , id")->get("users")->result_array();
    		$this->template->load_admin('coupon/add' , $data);
    	}
    }
    public function show_coupon_on_web(){

        $data = array(
            "show_on_web" => "no"
        );
        $this->db->update("coupons" , $data);
        $data = array(
            "show_on_web" => "yes"
        );
        $this->db->where("id" , $this->input->post("id"));
        $this->db->update("coupons" , $data);
        $this->session->set_flashdata('success', 'Default coupon set successfully.');
        echo "true";
        exit();


        
    }

    /*public function delete($id="")
    {
        if( ! empty($id)){
            $result = $this->db->delete('coupons', ['id' => $id]);
            if($result){
                $this->session->set_flashdata('success', $this->lang->line('delete_success'));
            }else{
                $this->session->set_flashdata('error', $this->lang->line('delete_error'));
            }
            redirect('admin/coupon');
        }
    }*/

    public function delete()
    {
        $data = $this->input->post();
        echo $this->delete_record($data);
    }
}