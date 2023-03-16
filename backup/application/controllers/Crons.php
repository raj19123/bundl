<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crons extends CI_Controller {

	function __construct() {
		parent::__construct();
    }

    public function index()
    {
    	
    }
    public function delete_delivery_files(){


    	$now_sub_8_days = date('Y-m-d' , strtotime('-8 days'));

    	$this->db->select("id , order_id , item_id , delivery_files");
    	$this->db->where("Date(created_at) <=" , $now_sub_8_days );
    	$this->db->where("files_deleted" , "no");
    	$files_to_delete = $this->db->get("order_item_management")->result_array();

    	

    	if($files_to_delete){
    		echo "All ";
    		foreach ($files_to_delete as $o_key => $o_val) {
    			$path = DOCUMENT_ROOT.'uploads/orders/';
    			$path = $path.$o_val['order_id'].'/';
    			$path = $path.$o_val['item_id'].'/';

    			if($o_val['delivery_files'] != ""){
    				$files = explode(',', $o_val['delivery_files']);
    				if(!empty($files)){
    					foreach ($files as $f_key => $f_val) {
    						if($f_val){
    							$file_info = $this->db->get_where("files" , array("id" => $f_val))->row_array();
    							if($file_info){
    								$file_name = $file_info['name'];
    								$file_path = $path.$file_name;
    								// echo '<a href="'.$file_path.'">here</a>'."<br>";
    								@unlink($file_path);
    							}

    						}
    					}
    				}
    			}
    			$this->db->where("id" , $o_val['id']);
    			$this->db->update("order_item_management" , ["files_deleted" => "yes"]);
    		}
    	}
    	echo "Done";


    }

}