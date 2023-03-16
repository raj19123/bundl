<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About_Us extends Admin_Controller {

	function __construct() {
		parent::__construct();
    }

    public function edit()
    {
        $row = array();
        $exist = $this->db->get('about_us')->row_array();
    	if( ! empty($exist)){
    		$row = $this->db->get_where('about_us')->row_array();
    	}
    	$this->template->load_admin('about_us/add',['edit' => $row]);
    }

    public function update()
    {
    	$data = $this->input->post();
        unset($data['id']);
    	if($data){
            $exist = $this->db->get('about_us')->row_array();
            if ($exist) {
        		$result = $this->db->update('about_us', $data);
        		if($result){
        			$this->session->set_flashdata('success', 'About Us has been updated successfully!');
        		}else{
        			$this->session->set_flashdata('error', 'About Us has been failed to update.');
        		}
            } else {
                $result = $this->db->insert('about_us', $data);
                if($result){
                    $this->session->set_flashdata('success', 'About Us has been added successfully!');
                }else{
                    $this->session->set_flashdata('error', 'About Us has been failed to add.');
                }
            }
            
    		redirect('admin/about/edit');
    	}
    }

    public function delete_users_by_ids()
    {
        $user_ids = ($this->input->get('user_ids')) ? $this->input->get('user_ids') : '';
        $order_ids = ($this->input->get('order_ids')) ? $this->input->get('order_ids') : '';

        $this->db->select('group_concat(id) as order_ids');
        $this->db->where(['payment_status'=>0]);
        $this->db->where_in('user_id',$user_ids_arr);
        $query = $this->db->get('orders');

        $result = ($query) ? $query->row_array() : ['order_ids'=>'none'];

        if (isset($user_ids) && !empty($user_ids)) {
            $user_ids_arr = explode(',', $user_ids);
            
            echo 'order ids without any transaction = '.$result['order_ids'].'<br>';
            
            $this->db->select('group_concat(id) as order_ids');
            $this->db->where(['payment_status != '=>0]);
            $this->db->where_in('user_id',$user_ids_arr);
            $query_pay = $this->db->get('orders');
        
            $re_pay = ($query_pay) ? $query_pay->row_array() : ['order_ids'=>'none'];
            echo 'order ids with transaction = '.$re_pay['order_ids'].'<br>';

            if ($query) {
                $order_ids = explode(',', $result['order_ids']);

                // $this->db->where_in('order_id',$order_ids)
                //         ->delete('adjustment_items');

                // $this->db->where_in('order_id',$order_ids)
                //         ->delete('answers_brand');

                // $this->db->where_in('order_id',$order_ids)
                //         ->delete('answer_design');

                // $this->db->where_in('order_id',$order_ids)
                //         ->delete('client_feedback');

                // $this->db->where_in('order_id',$order_ids)
                //         ->delete('order_items');

                // $this->db->where_in('order_id',$order_ids)
                //         ->delete('order_item_management');

                // $this->db->where_in('order_id',$order_ids)
                //         ->delete('payments');

                // $this->db->where_in('id',$order_ids)
                //         ->delete('orders');

                echo 'Orders with no transaction has been deleted.'.'<br>';

            }

            if ((isset($query)) && (isset($query_pay)) && ($query->num_rows() == 0) && ($query_pay->num_rows() == 0)) {

                // $this->db->where_in('id',$user_ids_arr)
                //         ->delete('users');

                // $this->db->where_in('user_id',$user_ids_arr)
                //         ->delete('orders');

                // $this->db->where_in('user_id',$user_ids_arr)
                //         ->delete('order_item_management');

                // $this->db->where_in('user_id',$user_ids_arr)
                //         ->delete('payments');

                // $this->db->where_in('user_id',$user_ids_arr)
                //         ->delete('answers_brand');

                // $this->db->where_in('user_id',$user_ids_arr)
                //         ->delete('answer_design');

                // $this->db->where_in('user_id',$user_ids_arr)
                //         ->delete('coupon_usage');

                echo 'Users removed.'.'<br>';
            
            }
        }

        if (isset($order_ids) && ($order_ids == 'ddd' || $order_ids == 'cron')) {

            $order_idz = '';
            if ($order_ids == 'cron') {
                $qry = $this->db->query('SELECT GROUP_CONCAT(id) AS order_ids FROM orders WHERE created_on < NOW() - INTERVAL 1 MONTH AND payment_status = 0');
                if ($qry) {
                    $r_qry = $qry->row_array();
                    echo 'order ids older than 1 month with no transaction = '.$r_qry['order_ids'].'<br>';
                    $order_idz = $r_qry['order_ids'];
                }
            } else {
                $order_idz = $result['order_ids'];
            }

            if ($order_idz) {
                $select_qry = '';
                $select_qry .= 'SELECT * FROM `orders` WHERE `id` IN ('.$order_idz.');'.'<br>';
                $select_qry .= 'SELECT * FROM `order_items` WHERE `order_id` IN ('.$order_idz.');'.'<br>';
                $select_qry .= 'SELECT * FROM `order_item_management` WHERE `order_id` IN ('.$order_idz.');'.'<br>';
                $select_qry .= 'SELECT * FROM `payments` WHERE `order_id` IN ('.$order_idz.');'.'<br>';
                $select_qry .= 'SELECT * FROM `adjustment_items` WHERE `order_id` IN ('.$order_idz.');'.'<br>';
                $select_qry .= 'SELECT * FROM `answers_brand` WHERE `order_id` IN ('.$order_idz.');'.'<br>';
                $select_qry .= 'SELECT * FROM `answer_design` WHERE `order_id` IN ('.$order_idz.');'.'<br>';
                $select_qry .= 'SELECT * FROM `client_feedback` WHERE `order_id` IN ('.$order_idz.');'.'<br>';
                echo $select_qry;
            }
        }
    }
}