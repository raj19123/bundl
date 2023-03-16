<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Orders_Model extends CI_Model
{
	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	public function get_deadline($item_id='')
	{
		if($item_id != ''){
			$item = $this->db->get_where('order_items', ['id' => $item_id]);
			if($item->num_rows() > 0){
				$item = $item->row_array();
				$days_to_add = 0;
	        	if($item['item_type'] == 'design'){
	        		$get_pack_time = $this->db->get_where('order_items',[
	        			'order_id' => $item['order_id'], 
	        			'item_type' => 'package'
	        		])->row_array();
	        		$days_to_add = $get_pack_time['unit_time'];

	        	}elseif($item['item_type'] == 'addon'){
	        		$days_to_add = $item['unit_time'];
	        	}
        		$deadline = date('Y-m-d H:i:s', strtotime("+". $days_to_add ." days"));
        		return $deadline;
			}else{
				return false;
			}	
		}else{
			return false;
		}
	}
}