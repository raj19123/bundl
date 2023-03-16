<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

	public $language;

	function __construct() {
		parent::__construct();
		$this->language = ($this->session->userdata('site_lang')) ? $this->session->userdata('site_lang') : 'english';
        $this->load->model('Package_Model','package_model');
        $this->load->model('Design_Model','design_model');
    }

    public function add_to_cart()
	{
		//return print_r($this->input->post());
		if($this->input->post()){
			$data = $this->input->post();

			//clear old package, logo and designs from cart than add new data
			if($this->cart->contents()){
				foreach ($this->cart->contents() as $key => $value) {
					if(in_array($value['options']['type'], ['package', 'logo', 'design'])){
						$this->cart->update(['rowid' => $key, 'qty' => 0]);
					}
				}
			}

			//return print_r($this->cart->contents());

			$add_to_cart = [];
			$package = $this->db->get_where('packages', ['id' => $data['package_id']]);
			if($package->num_rows() > 0){
				$package = $package->row_array();
				$bundl = [
					'id'      => $package['id'],
			        'name'    => $package['name_'.$this->language],
			        'price'   => $package['price'],
			        'time'    => $package['time'],
			        'qty'     => 1,
			        'subtotal_time' => $package['time'],
			        'options' => [
			        	'measurement_type' => 'quantity',
						'measurement_value' => 1,
				        'type' => 'package'
			        ]
				];

				array_push($add_to_cart, $bundl);

				//logo functionality
				if(isset($data['logo'])){
					$logo_design = $this->db->get_where('designs', ['slug' => 'logo'])->row_array();
					$price = ($data['logo'] == 'both') ? $logo_design['dual_lang_price'] : 0;
					$time = ($data['logo'] == 'both') ? $logo_design['dual_lang_time'] : 0;
					$logo = [
						'id'      => $logo_design['id'],
				        'name'    => $data['logo'],
				        'price'   => $price,
				        'time'    => $time,
				        'qty'     => 1,
				        'subtotal_time' => $time,
				        'options' => [
				        	'measurement_type' => 'quantity',
						    'measurement_value' => 1,
					        'type' => 'logo'
				        ]
					];
					array_push($add_to_cart, $logo);
				}

				
				// package designs functionality
				if(isset($data['designs'])){
					//print_r($data['designs']);
					//$i = 0;
					foreach ($data['designs'] as $design_id => $val) {
						//print_r($val);
						//echo '<br>';
						//get design detail
						$design = $this->db->get_where('designs', ['id' => $design_id])->row_array();

						//get component design default quantity
						$component_design_qty = $this->db->get_where('component_design', ['component_id' => $val['component_id'], 'design_id' => $design_id])->row_array();
						$component_design_qty = $component_design_qty['quantity']; 
						//print_r($component_design_qty);
						//echo '<br>';
						//die();

						//remove all addons of this design from cart
						if($this->cart->contents()){
							foreach ($this->cart->contents() as $kc => $vc) {
								if($vc['id'] == $design_id){
									$this->cart->update(['rowid' => $kc, 'qty' => 0]);
								}
							}
						}

						$qty = (int)$val['qty'];

						//Measurement type and Measurement value handling
						$measurement_type = 'quantity';
						$measurement_value = $qty;
						if(isset($val['mtype'])){
							$measurement_type = $design['type'];
							$measurement_value = $val['mtype'];
						}

						//Prepare item array for cart with default values
						$items = [
							'id'      => $design['id'],
					        'name'    => $design['name_'.$this->language],
					        'price'   => 0,
					        'qty'     => 1,
					        'time'    => $design['time'],
					        'subtotal_time' => 0,
					        'options' => [
					        	'measurement_type' => $measurement_type,
						        'measurement_value' => $measurement_value,
						        'type' => 'design'
					        ]
						];

						//Make changes if item has higher quantity
						if($qty > 1){
							for ($i=1; $i <= $qty; $i++) {
								
								//Item name handling
								$items['name'] = $design['name_'.$this->language].' '.$i;
								if($measurement_type != 'quantity'){
									$items['name'] .= ' ('.$measurement_value.')';
								}

								//price and time limit
								if($i > $component_design_qty){
									$extra_qty = $i - $component_design_qty;
									//extra qty used for showing price on right item
									//echo $extra_qty.'<br>';
									if($extra_qty > 0){
										/*$price = (float)$val['price'] / ((int)$qty - 1);
										$time = (float)$val['time'] / ((int)$qty - 1);*/

										$payable_qty = (int)$qty - (int)$component_design_qty;

										$price = (float)$val['price'] / ($payable_qty);
										$time = (float)$val['time'] / ($payable_qty);

										/*$price = (float)$design['price'];
										$time = (float)$design['time'];*/

										$items['price'] = $price;
										$items['subtotal_time'] = $time;
									}
								}

								//every design greater than 1 qty should be count as add-on
								if($i > 1){
									$items['options']['type'] = 'addon';
								}

								//add a unique identifier in item options for create a new row in cart
								$items['options']['roll_no'] = $i;
								
								array_push($add_to_cart, $items);
							}
						}else{
							array_push($add_to_cart, $items);
						}

					}

					//return print_r($add_to_cart);
					$this->cart->product_name_rules = '[:print:]';
					$this->cart->insert($add_to_cart);
					$this->session->set_userdata('project_name', $data['project_name']);
					echo $this->load->view('user/side-bar', ['language' => $this->language], TRUE);
					//print_r($this->cart->contents());
					//$this->cart->destroy();
				}
			}
		}
	}

	public function addon_to_cart()
	{
		if($this->input->post()){
			$data = $this->input->post();
			//return print_r($data);
			$addon = $this->db->get_where('designs', ['id' => $data['addonid']])->row_array();

			// Calculate Measurement Type
			$measurement_type = 'quantity';
			$measurement_value = 1;
			if(isset($data['mtype'])){
				$measurement_type = $addon['type'];
				$measurement_value = $data['mtype'];
			}
			
			// Calculate Price and Time for item quantity = 1
			$subtotal_price = $data['price'];
			$subtotal_time = $data['time'];


			//add-ons name handling and counter functionality
			$item_name = $addon['name_'.$this->language];

			if($this->cart->contents()){
				$existed_items = [];
				foreach ($this->cart->contents() as $row_id => $item) {
					$type = $item['options']['type'];
					if($item['id'] == $addon['id'] && in_array($type, ['design','addon','custom_addon'])){
						$existed_items[] = $item;
					}
				}

				//if only one item exist in package than change package item name
				if(count($existed_items) == 1){
					$existed_items_rowid = $existed_items[0]['rowid'];
					$existed_items_id = $existed_items[0]['id'];
					$existed_items_measurement_type = $existed_items[0]['options']['measurement_type'];
					$existed_items_measurement_value = $existed_items[0]['options']['measurement_value'];

					$addon_item = $this->db->get_where('designs', ['id' => $existed_items_id])->row_array();
					$addon_item_name = $addon_item['name_'.$this->language].' 1';

					if ($existed_items_id == 76) {
						$addon_item_name = $existed_items[0]['name'] . ' 1';
					}

					if($existed_items_measurement_type != 'quantity'){
						$addon_item_name .= ' ('.$existed_items_measurement_value.')';
					}

					$update_name = [
						'rowid' => $existed_items_rowid,
	        			'name' => $addon_item_name
					];
					$this->cart->update($update_name);
				}

				//change addon item name
				if(count($existed_items) > 0){
					$counter = count($existed_items) + 1;
					$item_name = $addon['name_'.$this->language].' '.$counter;
				}

				// Calculate Price and Time for item quantity >= 1
				if(count($existed_items) >= 1 && $measurement_type == 'quantity'){
					//add increments in price and time
					$price_increment_percentage = (float)$data['priceIncrement'];
					$time_increment_percentage = (float)$data['timeIncrement'];

					$price = (float)$data['price'];
					$time = (float)$data['time'];

					$subtotal_price = ($price * $price_increment_percentage) / 100;
					$subtotal_time = ($time * $time_increment_percentage) / 100;
				}
			}

			if($measurement_type != 'quantity'){
				$item_name .= ' ('.$measurement_value.')';
			}

			if (array_key_exists('logo', $data)) {
				switch ($data['logo']) {
					case 'arabic':
						$item_name = $this->lang->line('logo').'('.$this->lang->line('languages_arabic').')';
						break;
					
					case 'both':
						$item_name = $this->lang->line('logo').'('.$this->lang->line('languages_both').')';
						$addon['time'] += 10;
						break;
					
					default:
						$item_name = $this->lang->line('logo').'('.$this->lang->line('languages_english').')';
						break;
				}
				if (isset($counter) && !empty($counter)) {
					$item_name .= ' '.$counter;
					if ($data['logo'] == 'both') {
						$addon['time'] = $addon['time']/2;
					}
				} else {
					$subtotal_price = $data['price'];
					$subtotal_time = $data['time'];
				}
			}

			$items = [
				'id'      => $addon['id'],
		        'name'    => $item_name,
		        'price'   => $subtotal_price,
		        'time'    => $addon['time'],
		        'qty'     => 1,
		        'subtotal_time' => $subtotal_time,
		        'options' => [
		        	'measurement_type' => $measurement_type,
	        		'measurement_value' => $measurement_value,
	        		'type' => 'addon'
		        ]
			];

			if(isset($counter)){
				$items['options']['roll_no'] = $counter;
			}else{
				$items['options']['roll_no'] = 1;
			}

			//for existing order - Addon to This Bundl functionality
			if( isset($data['order_id']) && !empty($data['order_id']) ){
				$items['options']['order_id'] = $data['order_id'];
				$items['options']['type'] = 'custom_addon';
			}

			//for custom bundl order
			if( isset($data['project_name']) && !empty($data['project_name']) ){
				$items['custom_bundl'] = $data['project_name'];
				//$items['type'] = 'custom_addon';
			}

			//return print_r($items);
			$this->cart->product_name_rules = '[:print:]';
			$this->cart->insert($items);
			echo $this->load->view('user/side-bar', ['language' => $this->language], TRUE);
			//$this->cart->destroy();
		}
	}

	public function get_cart_list()
    {
        if($this->input->post()){
        	$item_id = $this->input->post('item_id'	);

        	$sql = "SELECT `delivery_files`, `order_id` 
        		FROM `order_item_management` 
        		WHERE `created_at` = 
        			(SELECT MAX(`order_item_management`.`created_at`) 
        				FROM `order_item_management` 
        				WHERE `item_id` = '".$item_id."')";

        	$query = $this->db->query($sql);
        	if($query->num_rows() > 0){
	        	$result = $query->row_array();
	        	$file_ids = $result['delivery_files'];
	        	$file_ids_array = explode(',', $file_ids);
	        	$files = $this->db->where_in('id', $file_ids_array)->get('files');
        		if($files->num_rows() > 0){
        			$files = $files->result_array();
        			//print_r($files);
        			$link = base_url('uploads/orders/') . $result['order_id'] . '/' . $item_id . '/';
        			$list = '<div class="list-group">';
        			foreach ($files as $key => $file) {
		        		$list .=
		        			'<a href="'.$link.$file['name'].'" download="'.$file['name'].'" target="_blank" class="list-group-item list-group-item-action flex-column align-items-start">
							    <div class="d-flex w-100 justify-content-between">
							      <h5 class="mb-1">File-'.($key + 1).'</h5>
							      <small><i class="fa fa-download"></i> <?= $this->lang->line("download"); ?></small>
							    </div>
							  </a>';
        				
        			}
        			$list .= '</div>';
        			echo $list;
        		}
        	}
        }
    }

    public function adjustment_to_cart()
	{
		if($this->input->post()){
			$data = $this->input->post();
			//return print_r($data);
			
			$order_item = $this->db->get_where('order_items', ['id' => $data['item_id']])->row_array();
			$design_adjustment = $this->db->get_where('design_adjustments', ['id' => $data['design_adjustments_id']])->row_array();
			$adjustment = $this->db->get_where('adjustments', ['id' => $design_adjustment['adjustment_id']])->row_array();
			//$design = $this->db->get_where('designs', ['id' => $design_adjustment['design_id']])->row_array();
			//return print_r($adjustment);

			//clear old adjustment item and replace with new one
			$existed_file_ids = '';
			if($this->cart->contents()){
				foreach ($this->cart->contents() as $row_id => $item) {
					$type = $item['options']['type'];
					if($item['id'] == $design_adjustment['id'] && in_array($type, ['adjustment'])){
						$existed_file_ids = $item['file_ids'];
						$this->cart->update(['rowid' => $row_id, 'qty' => 0]);
					}
				}
			}

			if(isset($data['mtype'])){
				//measurement type adjustment handling - publication items
				$items = [
					'id'      => $design_adjustment['id'],
			        'name'    => ucfirst($data['measurement_type'].': '.$data['mtype']),
			        'price'   => $data['price'],
			        'time'    => $data['time'],
			        'qty'     => 1,
			        'subtotal_time' => $data['time'],
			        'options' => [
			        	'measurement_type' => $data['measurement_type'],
			        	'measurement_value' => $data['mtype'],
				        'type' 		=> 'adjustment',
			        	'item_id' 	=> $data['item_id'],
			        	'order_id' 	=> $data['order_id']
			        ],
			        'file_ids' => $existed_file_ids,
			        'my_id' => $this->input->post("my_id"),
				];
			}else{
				//All other adjustment
				$items = [
					'id'      => $design_adjustment['id'],
			        'name'    => $adjustment['name_'.$this->language],
			        'price'   => $design_adjustment['price'],
			        'time'    => $design_adjustment['time_limit'],
			        'qty'     => 1,
			        'subtotal_time' => $design_adjustment['time_limit'],
			        'textbox' => $data['textbox'],
			        'file_link' => $data['file_link'],
			        'options' => [
			        	'measurement_type' => $order_item['measurement_type'],
			        	'measurement_value' => $order_item['measurement_value'],
				        'type' 		=> 'adjustment',
			        	'item_id' 	=> $data['item_id'],
			        	'order_id' 	=> $data['order_id']
			        ],
			        'file_ids' => $existed_file_ids,
			        'my_id' => $this->input->post("my_id")
				];
			}


			//return print_r($items);
			$this->cart->product_name_rules = '[:print:]';
			$this->cart->insert($items);
			echo $this->load->view('user/side-bar', ['language' => $this->language], TRUE);
			//$this->cart->destroy();
		}
	}

	public function update_cart()
	{
		if($this->input->post()){
			$data = $this->input->post();
			//return print_r($data);

			$itemIs = $this->cart->get_item($data['rowid']); // to fix pricing on update -jd
			$sub_time = ($itemIs['options']['measurement_value'] == 1) ? $itemIs['time'] : $itemIs['subtotal_time']; // to fix time -jd

			$update_to_cart = [];
			$id = $data['id'];
			//$qty = (int)$data['qty'];
			$qty = 1;

			$design = $this->db->get_where('designs', ['id' => $id])->row_array();


			//Measurement type and Measurement value handling
			$measurement_type = 'quantity';
			$measurement_value = $qty;
			if(isset($data['mtype'])){
				$measurement_type = $design['type'];
				$measurement_value = $data['mtype'];
			}

			//Prepare item array for cart with default values
			$items = [
				'id'      => $design['id'],
		        'name'    => $design['name_'.$this->language],
		        'price'   => $itemIs['price'],
		        'qty'     => 1,
		        'time'    => $itemIs['time'],
		        'subtotal_time' => $sub_time,
		        'options' => [
		        	'measurement_type' => $measurement_type,
			        'measurement_value' => $measurement_value,
			        'type' => $data['itemtype']
		        ]
			];

			$counter = 0;
			if($this->cart->contents()){
				$existed_items = [];
				foreach ($this->cart->contents() as $row_id => $item) {
					$type = $item['options']['type'];
					if($item['id'] == $design['id'] && in_array($type, ['design','addon','custom_addon'])){
						$existed_items[] = $item;
					}
				}

				//get highest counter number
				if(count($existed_items) > 0){
					$last_item = end($existed_items);
					$counter = $last_item['options']['roll_no'];
					if(empty($counter)){
						$counter = count($existed_items);
					}else{
						$counter = (int)$counter;
					}
				}

				//if only one item exist in package than change package item name
				if(count($existed_items) == 1){
					$existed_items_rowid = $existed_items[0]['rowid'];
					$existed_items_id = $existed_items[0]['id'];
					$existed_items_measurement_type = $existed_items[0]['options']['measurement_type'];
					$existed_items_measurement_value = $existed_items[0]['options']['measurement_value'];

					$existed_item_name .= $design['name_'.$this->language].' 1';
					if($existed_items_measurement_type != 'quantity'){
						$existed_item_name .= ' ('.$existed_items_measurement_value.')';
					}

					$update_name = [
						'rowid' => $existed_items_rowid,
	        			'name' => $existed_item_name
					];
					$this->cart->update($update_name);
					
					//change current item name
					$items['name'] .= ' 2';
					if($measurement_type != 'quantity'){
						$items['name'] .= ' ('.$measurement_value.')';
					}
					$items['options']['roll_no'] = 2;
				}

				// Calculate Price and Time for item quantity >= 1
				if(count($existed_items) >= 1 && $measurement_type == 'quantity'){
					//add increments in price and time
					$price_increment_percentage = (float)$design['price_increment'];
					$time_increment_percentage = (float)$design['time_increment'];

					$price = (float)$design['price'];
					$time = (float)$design['time'];

					$subtotal_price = ($price * $price_increment_percentage) / 100;
					$subtotal_time = ($time * $time_increment_percentage) / 100;

					$items['price'] = $subtotal_price;
					$items['time'] = $subtotal_time;
					$items['subtotal_time'] = $subtotal_time;
				}
			}


			// Prepare items array for cart
			for ($i=1; $i <= $qty; $i++) {
				$counter++;
				
				//Item name handling
				$items['name'] = $design['name_'.$this->language].' '.$counter;
				if($measurement_type != 'quantity'){
					$items['name'] .= ' ('.$measurement_value.')';
				}
				$items['options']['roll_no'] = $counter;
				
				array_push($update_to_cart, $items);
			}
			$this->cart->product_name_rules = '[:print:]';
			// echo ($this->cart->insert($update_to_cart)) ? 'true' : 'false';
			if ($this->cart->insert($update_to_cart)) {

				$items['price_sar'] = preg_replace("/\.?0*$/",'',number_format( (float) $items['price'], 2, '.', ','));
				$cartData = $this->cart->contents();

				$last = end($cartData);
				$data['new_row_id'] = $last['rowid'];
				$data['msg'] = 'true';				
				$data['item'] = $items;
				echo json_encode($data);				
			}else{
				$data['msg'] = 'false';				
				echo json_encode($data);
			}
			//return print_r($update_to_cart);
		}
	}

	public function cartfree()
	{
		$this->cart->destroy();
		$this->session->unset_userdata('project_name');
		redirect(base_url());
	}

	public function cartempty()
	{
		$this->cart->destroy();
		$this->session->unset_userdata('project_name');
		echo 'true';
	}

	public function cart()
	{
		if($this->cart->contents()){
			foreach ($this->cart->contents() as $key => $value){
				
				if(isset($value['options']['order_id'])){
					$project = $this->db->get_where('orders', ['id' => $value['options']['order_id']])->row_array();
					$this->session->set_userdata('project_name', $project['project_name']);
				}

				if(isset($value['custom_bundl'])){
					$this->session->set_userdata('project_name', $value['custom_bundl']);
				}
			}
		}
		$this->template->load_user('cart');
	}

	public function remove_cart($id="")
	{
		if($id != ""){
			$all_items = $this->cart->contents();
			if ($all_items[$id]['options']['roll_no'] == 1) {
				foreach ($all_items as $item_key => $item_val) {
					if ($item_val['id'] == $all_items[$id]['id']) {
						if ($all_items[$id]['options']['measurement_type'] == 'quantity') {
							$id = $item_key;
						}
					}
				}
			}
			$data = ['rowid' => $id, 'qty' => 0];
			$res = $this->cart->update($data);
			echo json_decode($res);
			// $this->session->set_flashdata('success', $this->lang->line('remove_cart'));
			// redirect(base_url('cart'));

		}
	}

	public function remove_cart_all($id="")
	{
		if($id != ""){
			$all_items = $this->cart->contents();
			foreach ($all_items as $a_key => $a_val) {
				if ($a_val['id'] == $id) {
					$data = ['rowid' => $a_key, 'qty' => 0];
					$res = $this->cart->update($data);
				}
			}
		}
	}

	public function checkout()
	{
		if($this->input->get("test")){
			$this->session->set_userdata('test_enabled' , "Yes");
		}
		if( ! $this->session->has_userdata('cart_total')){
			//$this->session->unset_userdata('cart_total');
			$this->session->set_userdata('cart_total', $this->cart->total());
		}else{
			$this->session->unset_userdata('cart_total');
			$this->session->set_userdata('cart_total', $this->cart->total());
		}

		if($this->session->userdata('site_user')){
			if($this->cart->contents()){
				$this->template->load_user('checkout', ['user' => (array)$this->session->userdata('site_user')]);
			}else{
				redirect(base_url('cart'));
			}
		}else{
			redirect(base_url('cart?register=email'));
		}
	}
}//end controller