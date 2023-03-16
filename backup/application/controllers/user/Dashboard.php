<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends User_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('Orders_Model','orders_model');
		$this->load->model('Design_Model','design_model');
	}

	public function index()
	{
		//ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
		$conditions = [
			'user_id' => $this->User->id,
			'payment_status' => 1
		];

		$projects = $this->db->order_by('updated_on', 'DESC')->get_where('orders', $conditions)->result_array();
		
		/*
		update latest item questionnaire status. 
		Check if admin off/on an item questionnaire than update status accordingly 
		*/

		/*foreach ($projects as $key_project => $project) {
			$items = $this->db->get_where('order_items', ['order_id' => $project['id']])->result_array();
			foreach ($items as $key_item => $item) {
				//not applicable on package and logo
				if( ! in_array($item['item_type'], ['package','logo'])){

					//check answer of questionnaire is already submitted or not
					//this procedure only do when answers are not available
					$answers = $this->db->get_where('answer_design', ['order_id' => $project['id'], 'item_id' => $item['id']]);
					if($answers->num_rows() == 0){
						$questionnaire = $this->db->get_where('questions_design', ['design_id' => $item['item_id']])->row_array();
						if($questionnaire){
							if($questionnaire['language'] == 0 &&
							   $questionnaire['measurement'] == 0 &&
							   $questionnaire['content'] == 0 &&
							   $questionnaire['textbox'] == 0 &&
							   $questionnaire['attachment'] == 0
							){
								//update item status to 1 - in process
								$this->db->update('order_items', ['status' => 1], ['id' => $item['id']]);
							}else{
								//update item status to 0 - fill questionnaire
								$this->db->update('order_items', ['status' => 0], ['id' => $item['id']]);
							}
						}else{
							//update item status to 1 - in process
							$this->db->update('order_items', ['status' => 1], ['id' => $item['id']]);
						}
					}

				}
			}
		}*/

		$this->template->load_user('my-files', ['projects' => $projects],'files');
		//$this->template->load_user('my-files', [],'files');
	}

	public function reset_password()
	{
		$data = $this->input->post();
		if($data){
			$id = $this->User->id;
			//print_r($data);

			$is_password = $this->db->get_where('users', ['password' => md5($data['password'])])->row_array();
			if($is_password){
				if($data['new_password'] == $data['confirm_password']){
					$result = $this->db->update('users',['password' => md5($data['new_password'])], ['id' => $id]);
					if($result){
		    			$this->session->set_flashdata('success', $this->lang->line('update_success_password'));
		    		}else{
		    			$this->session->set_flashdata('error', $this->lang->line('update_error_password'));
		    		}
				}else{
					$this->session->set_flashdata('error', $this->lang->line('confirm_error_password'));
				}
			}else{
				$this->session->set_flashdata('error', $this->lang->line('not_found_error_password'));
			}
			redirect('set-profile-password');
		}else{
			$this->template->load_user('reset-profile-password',[],'profile');
		}
	}

	public function profile()
	{
		$user = $this->db->get_where('users', ['id'=> $this->User->id])->row_array();
		$this->template->load_user('my-profile',['user' => $user],'profile');
	}

	public function update_profile()
	{
		if($this->input->post()){
			$data = $this->input->post();
			//print_r($data);die();
			$result = $this->db->update('users', $data, ['id' => $this->User->id]);
			if($result){
				$user = $this->db->get_where('users', ['id' => $this->User->id])->row();
				$this->session->set_userdata('site_user', $user);
				$this->session->set_userdata('site_lang', $user->language);
				$this->session->set_flashdata('success', $this->lang->line('update_success_profile'));
			}else{
				$this->session->set_flashdata('error', $this->lang->line('update_error_profile'));
			}
			redirect(base_url('profile'));
		}
	}

	public function place_order()
	{

		//ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
		if($this->input->post()){
			$data = $this->input->post();			

			// echo "<pre>";
			// print_r($data);
			// print_rs($this->cart->contents());
			// print_r($this->User);
			// die();

			// 1. create order
			// 2. save order items from cart
			// 3. load PayTabs library
			// 4. make a payment component through SADAD account and credit card
			// 5. Item ids are collected for existing orders and use for identifying adjustment items later

			// 1. create order
			$crt_tot = $this->session->userdata("cart_total");
			if($this->session->userdata("cart_total_discounted")){
				$crt_tot = $this->session->userdata("cart_total_discounted");
			}


			$total_time = 0;
			$pack = false;
			$branding = 0;
			$order_id = '';
			$project_name = $this->session->userdata('project_name');
			
			//information collection loop
			foreach ($this->cart->contents() as $row_id => $item):
				// 1: calculate total time
				$total_time += (float)$item['subtotal_time'];

				// 2: package or adjustment 
				if($item['options']['type'] == 'package'){
					$pack = true;
				}

				// 3: branding or non-branding
				if($item['options']['type'] == 'logo'){
					$branding = 1;
				}

				// 4: custom bundle
				if(isset($item['custom_bundl'])){
					$pack = true;
					$project_name = $item['custom_bundl'];
					$branding = 0;
				}
			endforeach;

			if($pack == true){
				// new order
				$order = [
					'project_name' 	=> $project_name,
					'user_id' 		=> $this->User->id,
					'user_name' 	=> $this->User->full_name,
					'email' 		=> $data['email'],
					'phone' 		=> $data['phone'],
					'branding' 		=> $branding,
					'total_time' 	=> $total_time,
					'promo_code' 	=> $this->session->userdata('promo_code'),
					'total_amount' 	=> $crt_tot,
					'grand_total' 	=> $crt_tot
				];
				$order_result = $this->db->insert('orders', $order);
				if($order_result){
					$order_id = $this->db->insert_id();
				}
			}

			// jd if order is new
			if(isset($order_id) && !empty($order_id)){
				
			}
			
			// 2. save order items from cart
			$order_items = [];
			$order_item_ids = [];
			$adjustment_ids = [];
			foreach ($this->cart->contents() as $row_id => $item) {
				$design_id = $item['id'];

				if(empty($order_id)) {
					$order_id = isset($item['options']['order_id']) ? $item['options']['order_id'] : '';
				}

				if($item['options']['type'] != 'adjustment'){
					$order_items = [
						'status' => 100,
						'order_id' => $order_id,
						'item_id' => $design_id,
						'item_type' => $item['options']['type'],
						'item_name' => $item['name'],
						'unit_price' => $item['price'],
						'unit_time' => $item['time'],
						'qty' => $item['qty'],
						'subtotal_price' => $item['subtotal'],
						'subtotal_time' => $item['subtotal_time'],
						'measurement_type' => $item['options']['measurement_type'],
	        			'measurement_value' => $item['options']['measurement_value'],
						'created_by' => $this->User->id
					];
					$order_items_result = $this->db->insert('order_items', $order_items);
					// if($order_items_result){
					// 	// $item_id = $this->db->insert_id();
					// 	$item_id_jd = $this->db->insert_id();
					// 	array_push($order_item_ids, $item_id_jd);
					// }
				}

				if($item['options']['type'] == 'adjustment'){
					$item_id = $item['options']['item_id'];
					array_push($adjustment_ids, $item_id);
					$order_id = $this->db->get_where('order_items', ['id' => $item_id])->row_array();
					$order_id = $order_id['order_id'];

					$adjustment_items = [
						'status' => 0,
						'order_id' => $order_id,
						'item_id' => $item_id,
						'adjustment_id' => $item['id'],
						'item_type' => $item['options']['type'],
						'item_name' => $item['name'],
						'textbox' => $item['textbox'],
						'attachments' => $item['file_ids'],
						'unit_price' => $item['price'],
						'unit_time' => $item['time'],
						'qty' => $item['qty'],
						'subtotal_price' => $item['subtotal'],
						'subtotal_time' => $item['subtotal_time'],
						'measurement_type' => $item['options']['measurement_type'],
	        			'measurement_value' => $item['options']['measurement_value'],
	        			'file_link' => $item['file_link'],
						'created_by' => $this->User->id
					];
					//print_r($adjustment_items);die();
					$this->db->insert('adjustment_items', $adjustment_items);
				}
			}

			// 3. load PayTabs library
			$merchant_email='hala.alhussaini@gmail.com';
   			$secret_key='nOiZ1L2lukUrIRPq3tsxKMQn653rsLqQAJQCvSYZdSqVKgmNJOltAcRGhV8KHyBihrUMkTLxMctxsPlcEHGeTyVbt4VaCwsUYnHi';
   			$merchant_id='10041761';

   			$params = [
   				'merchant_email'=>$merchant_email,
                'merchant_id'=>$merchant_id,
                'secret_key'=>$secret_key
            ];
                 
   			$this->load->library('Paytabs',$params);

            // 4. make a payment component through SADAD account and credit card
   			/*$invoice = [
		        "site_url" => base_url(),
		        "return_url" => base_url('return-paytab'),
		        "title" => $data['f_name'].' '.$data['l_name'],
		        "cc_first_name" => $data['f_name'],
		        "cc_last_name" => $data['l_name'],
		        "cc_phone_number" => str_replace('+', '00', $data['phone']),
		        "phone_number" => $data['phone'],
		        "email" => $data['email'],
		        //"products_per_title" => "MobilePhone || Charger || Camera",
		        "products_per_title" => 'BundlDesigns Products', //$order['project_name'],
		        //"unit_price" => "12.123 || 21.345 || 35.678 ",
		        "unit_price" => $crt_tot,
		        //"quantity" => "2 || 3 || 1",
		        "quantity" => "1",
		        "other_charges" => "0.0",
		        //"amount" => "13.082",
		        "amount" => $crt_tot,
		        "discount" => "0.0",
		        "currency" => "SAR",
		        "reference_no" => $order_id,

		        "payment_type" => "mada",

		        "billing_address" => $data['city'],
		        "city" => $data['city'],
		        "state" => $data['state'],
		        "postal_code" => $data['postal_code'],
		        "country" => $data['country'],
		        "shipping_first_name" => $data['f_name'],
		        "shipping_last_name" => $data['l_name'],
		        "address_shipping" => $data['city'],
		        "city_shipping" => $data['city'],
		        "state_shipping" => $data['state'],
		        "postal_code_shipping" => $data['postal_code'],
		        "country_shipping" => $data['country'],
		        //"msg_lang" => "English",
		        "msg_lang" => ucfirst($this->language),
		        "cms_with_version" => "bundldesigns"
		    ];*/

		    //$response = $this->paytabs->create_pay_page($invoice);
		    //echo $response->payment_url;
		   	//print_r($response);die();

		    $invoice = [
	            "tran_type" => "sale",
	            "tran_class"=> "ecom",
	            "cart_id"=> 'TRN'.mt_rand(),
	            "cart_description"=> "BundlDesigns",
	            "cart_currency"=> "SAR",
	            "cart_amount"=> $crt_tot,
	            "hide_shipping"=> TRUE,
	            "customer_details" => [
	                "name" => $data['f_name'].' '.$data['l_name'],
	                "email"=> $data['email'],
	                "street1"=> $data['city'],
	                "city"=> $data['city'],
	                "state"=> "DU",
	                "country"=> "AE",
	                "ip"=> $this->input->ip_address()
	            ],
	            //"callback"=> base_url('paytabsCallback'),
	            "return"=> base_url('return-paytab')
	        ];

            $this->load->library('Paytabs');
            $response = $this->paytabs->makePayPage($invoice);
            $response = json_decode($response);

            // print_r($response); die();


		    // if($response->response_code == "4012"){
		    if(isset($response->tran_ref) && !empty($response->tran_ref)){
		    	if($pack == true){
		    		//$this->db->update('orders', ['trans_id' => $response->p_id], ['id' => $order_id]);
		    		$this->db->update('orders', ['trans_id' => $response->cart_id], ['id' => $order_id]);
		    		$this->db->update('order_items', ['trans_id' => $response->cart_id], ['order_id' => $order_id, 'trans_id' => NULL]);
		    		$this->db->update('adjustment_items', ['trans_id' => $response->cart_id], ['order_id' => $order_id, 'trans_id' => NULL]);
		    	}else{
		    		$this->db->update('order_items', ['trans_id' => $response->cart_id], ['order_id' => $order_id, 'trans_id' => NULL]);
		    		$this->db->update('adjustment_items', ['trans_id' => $response->cart_id], ['order_id' => $order_id, 'trans_id' => NULL]);
		    		// existed order
		    		$str_adj_ids = NULL;
		    		if($adjustment_ids){
		    			$str_adj_ids = json_encode($adjustment_ids);
		    		}
		    		// if($order_item_ids){
		    		// 	if($adjustment_ids){
			    	// 		$str_adj_ids = json_encode(array_merge($adjustment_ids,$order_item_ids));
		    		// 	}else{
		    		// 		$str_adj_ids = json_encode($order_item_ids);
		    		// 	}
		    		// }

		    		$payment = [
		    			'user_id' => $this->User->id,
		    			'order_id' => $order_id,
		    			'item_ids' => $str_adj_ids,
		    			'total_time' => $total_time,
		    			'total_amount' 	=> $crt_tot,
						'grand_total' 	=> $crt_tot,
						//'trans_id' => $response->p_id,
						'trans_id' => $response->cart_id,
						'payment_status' => 0
		    		];
		    		$this->db->insert('payments', $payment);
		    	}
		    	redirect($response->redirect_url);
		    }else{
		    	$this->session->set_flashdata('error', $this->lang->line('pm_failed'));
		    	//$this->session->set_flashdata('error', $response->result);
		    	redirect(base_url('checkout'));
		    }
		}
	}

	public function return_paytab()
	{
		// print_r($_REQUEST);die();
		if(isset($_SESSION['test_enabled'])){
			unset($_SESSION['test_enabled']);
			$this->session->set_userdata('is_test_enabled' , "Yes");
		}
		if($_REQUEST['respStatus'] == 'A'){
			
			$coupon_applied = $this->session->userdata('coupon');
			if($coupon_applied != ""){
				$coupon_detail = $this->db->get_where("coupons" , array("code" => $coupon_applied))->row_array();
				$data = array(
					"coupon_id" => $coupon_detail['id'],
					"user_id" => $this->User->id,
					"created_by" => $this->User->id,
					"updated_by" => $this->User->id
				);
				$is_inserted = $this->db->insert("coupon_usage" , $data);
				$this->session->unset_userdata('coupon');
			}
			
			//echo $_REQUEST['payment_reference'];
			//$merchant_email='hala.alhussaini@gmail.com';
   			//$secret_key='nOiZ1L2lukUrIRPq3tsxKMQn653rsLqQAJQCvSYZdSqVKgmNJOltAcRGhV8KHyBihrUMkTLxMctxsPlcEHGeTyVbt4VaCwsUYnHi';
   			//$merchant_id='10041761';

   			/*$params = [
   				'merchant_email'=>$merchant_email,
                'merchant_id'=>$merchant_id,
                'secret_key'=>$secret_key
            ];*/
                 
   			//$this->load->library('Paytabs',$params);
			//$response = $this->paytabs->verify_payment($_REQUEST['payment_reference']);
			//print_r($response);die();

			//if($response->response_code == 100){
				//if payment successful
				//$order = $this->db->get_where('orders', ['trans_id' => $_REQUEST['payment_reference']]);
				$order = $this->db->get_where('orders', ['trans_id' => $_REQUEST['cartId']]);
				if($order->num_rows() > 0){
					$order = $order->row_array();
					//update new order payment status to successful
					$this->db->update('orders', ['payment_status' => 1], ['id' => $order['id']]);

					//update status of all items of this new order
					$order_items = $this->db->get_where('order_items', ['order_id' => $order['id'], 'trans_id' => $_REQUEST['cartId']])->result_array(); 
					if($order['branding'] == 1){
						//branding order - has logo
						$branding_ids_db = $this->db->get_where("designs" , ['category_id' => 1])->result_array();
						if($branding_ids_db){
							$branding_ids = array_column($branding_ids_db, "id");
						}else{
							$branding_ids = array();
						}
						// Check if branding items are there
						$this->db->where(['order_id' => $order['id'] , 'item_type' => 'addon', 'trans_id' => $_REQUEST['cartId']]);
						$this->db->where_in("item_id" , $branding_ids);
						if($this->db->get("order_items")->num_rows() > 0){
							$branding_addon_exist = TRUE;
						}else{
							$branding_addon_exist = FALSE;
						}


						$is_logo_exist = in_array('logo', array_column($order_items, 'item_type')); // this will check if any logo item is present or not
						foreach ($order_items as $key => $item) {
							// $item_status = ($item['item_type'] == 'logo') ? '0' : '5';
							if($item['item_type'] == 'logo'){
								$item_status = 0;	
							}elseif($item['item_type'] == 'addon'){
								if($branding_addon_exist && !in_array($item['item_id'] , $branding_ids)){
									$item_status = 5;
								}else{
									if ($is_logo_exist) {
										$item_status = 5;
									} else {
										$item_status = 0;
									}
								}
							}else{
								$item_status = 5;
							}
							
							$this->db->update('order_items', ['status' => $item_status, 'pay_status' => 'yes'], ['id' => $item['id']]);
						}
					}else{
						//non branding order (custom bundle)
						$branding_ids_db = $this->db->get_where("designs" , ['category_id' => 1])->result_array();
						if($branding_ids_db){
							$branding_ids = array_column($branding_ids_db, "id");
						}else{
							$branding_ids = array();
						}
						// Check if branding items are there
						$this->db->where(['order_id' => $order['id'], 'item_type' => 'addon', 'trans_id' => $_REQUEST['cartId']]);
						$this->db->where_in("item_id" , $branding_ids);
						if($this->db->get("order_items")->num_rows() > 0){
							$branding_addon_exist = TRUE;
						}else{
							$branding_addon_exist = FALSE;
						}

						// $is_branding_items_there = $this->db->get_where('order_items', )->result_array();
						foreach ($order_items as $key => $item) {
							// check each design has questionnaire or not
							$q_exist = $this->db->get_where('questions_design', ['design_id' => $item['item_id']]);
							// Temp comenting because of in process coming on admin side
							// $item_status = ($q_exist->num_rows() > 0) ?  '0' : '1';
							if($branding_addon_exist && !in_array($item['item_id'] , $branding_ids)){
								$item_status = 5;
							}else{
								$item_status = 0;
							}
							$this->db->update('order_items', ['status' => $item_status, 'pay_status' => 'yes'], ['id' => $item['id']]);
						}
					}

					$order_return_id = $order['id'];
					$order_created_on = $order['created_on'];

					/*$this->cart->destroy();
					$this->session->unset_userdata('cart_total');
					$this->session->set_flashdata('success', $this->lang->line('pm_success'));
					$this->session->set_flashdata('order_id', $order['id']);
					redirect(base_url('questionnaire?oid=' . $order['id']));*/
					
				}else{
					// existing order payment
					$payment = $this->db->get_where('payments', ['trans_id' => $_REQUEST['cartId']]);
					if($payment->num_rows() > 0){
						$payment = $payment->row_array();
						//if order is existed
						$this->db->update('payments', ['payment_status' => 1], ['id' => $payment['id']]);
						$this->db->update('orders', ['order_status' => 1], ['id' => $payment['order_id']]);

						//check requested item is adjustment or not
						//item_ids field in payments table is using for adjustment ids
						if(isset($payment['item_ids']) && !empty($payment['item_ids']) && $payment['item_ids'] != NULL){
							$adj_ids = json_decode($payment['item_ids']);
							foreach ($adj_ids as $key => $adj_id) {
								$this->db->update('adjustment_items', ['status' => 1, 'pay_status' => 'yes'], ['item_id' => $adj_id]);
								$this->db->update('order_items', ['status' => 4], ['id' => $adj_id]);
							}

							$order_detail = $this->db->get_where('orders', ['id' => $payment['order_id']])->row_array();
							
							$view = 'order-adjustment';
							$email = $this->User->email;
				            $btn_link = base_url('dashboard');
				            $vars = [
				                '{username}' => $this->User->full_name,
				                '{email}' => $email,
				                '{order_date}' => date('m/d/Y'),
				                '{order_id}' => $payment['order_id'],
				                '{btn_text}' => 'Visit Dashboard',
				                '{btn_link}' => $btn_link,
				                '{order_name}' => $order_detail['project_name'],
				                '{cartJd}' => $_REQUEST['cartId'],
				            ];
				            $this->et->template($email, 'order-adjustment', $vars, $view, true);
						}
							
						//check customize add-on item
						$custom_addon = $this->db->get_where('order_items', ['order_id' => $payment['order_id'], 'item_type' => 'custom_addon', 'trans_id' => $_REQUEST['cartId']]);
						if($custom_addon->num_rows() > 0){
							$custom_addon = $custom_addon->result_array();
							// update only which are currently selected items
							foreach ($this->cart->contents() as $key => $item) {
								if($item['options']['type'] == 'custom_addon'){
									$design_id = $item['id'];

									$existed_order = $this->db->get_where('orders', ['id' => $item['options']['order_id']]);
									if($existed_order->num_rows() > 0){
										$existed_order = $existed_order->row_array();
										if($existed_order['branding'] == 1){
											$logo_is_approved = $this->db->get_where('order_items',[
												'order_id' => $existed_order['id'],         
												'item_type' => 'logo',
												'status' => 3
											]);

											if($logo_is_approved->num_rows() > 0){
												$q_exist = $this->db->get_where('questions_design', ['design_id' => $design_id]);
												$custom_item_status = ($q_exist->num_rows() > 0) ?  '0' : '1';
											}else{
												$custom_item_status = '5';
											}

										}else{
											$q_exist = $this->db->get_where('questions_design', ['design_id' => $design_id]);
											$custom_item_status = ($q_exist->num_rows() > 0) ?  '0' : '1';
										}
											
										$this->db->update('order_items', ['status' => $custom_item_status, 'pay_status' => 'yes'], [
											'order_id' => $existed_order['id'],
											'item_id' => $design_id,
											'item_type' => 'custom_addon',
											'trans_id' => $_REQUEST['cartId']
										]);
									}
								}
							}
						}

						$order_return_id = $payment['order_id'];
						$order_created_on = $payment['created_on'];
						
						$this->db->update('orders', ['updated_on' => date('Y-m-d H:i:s')], ['id' => $order_return_id]);
						/*$this->cart->destroy();
						$this->session->unset_userdata('cart_total');
						$this->session->set_flashdata('success', $this->lang->line('pm_success'));
						$this->session->set_flashdata('order_id', $payment['order_id']);
						redirect(base_url('dashboard'));*/
					}
				}

				// update purchase date for admin
				$this->db->update('orders', ['purchase_date' => date('Y-m-d H:i:s')], ['id' => $order_return_id]);

				$view = 'payment_receipt';
				$btn_link = base_url('dashboard');
				$email = $this->User->email;
				$order_detail = $this->db->get_where('orders', ['id' => $order_return_id])->row_array();
			  	$vars = [
		            '{username}' => $this->User->full_name,
		            '{email}' => $email,
		            '{order_id}' => $order_return_id,
					'{order_date}' => date('m/d/Y'),
					'{amount}' => "$22.00",
		            '{btn_link}' => $btn_link,
		            '{order_name}' => $order_detail['project_name'],
		            '{cartJd}' => $_REQUEST['cartId'],
		        ];


	            $this->et->template($email, 'payment_receipt', $vars, $view, true);


				//email for order confirmed
				$view = 'order-confirmation';
				$btn_link = base_url('dashboard');
				$email = $this->User->email;

                $vars = [
                    '{username}' => $this->User->full_name,
                    '{email}' => $email,
                    '{order_id}' => $order_return_id,
					'{order_date}' => date('m/d/Y'),
                    '{btn_link}' => $btn_link,
                    '{order_name}' => $order_detail['project_name'],
                    '{cartJd}' => $_REQUEST['cartId'],
                ];
                $this->et->template($email, 'order_confirmed', $vars, $view, true);

               

				$this->cart->destroy();
				$this->session->unset_userdata('cart_total');
				$this->session->unset_userdata('cart_total_discounted');
				$this->session->unset_userdata('project_name');
				$this->session->set_flashdata('success', $this->lang->line('pm_success'));
				$this->session->set_flashdata('order_id', $order_return_id);
				//$this->session->set_flashdata('paytab_data', $response);
				redirect(base_url('dashboard'));
			//}else{
				//if payment failed
				//$this->session->set_flashdata('error', $this->lang->line('pm_cancel'));
				//$this->session->set_flashdata('error', $response->result);
				//$this->session->set_flashdata('paytab_data', $response);
				//redirect(base_url('checkout'));
			//}

		}else{
			$this->session->set_flashdata('error', $this->lang->line('pm_failed'));
			redirect(base_url('checkout'));
		}
	}

	public function purchases()
	{
		$purchases = $this->db->order_by('created_on', 'DESC')->get_where('orders', ['user_id' => $this->User->id, 'payment_status' => 1])->result_array();
		$this->template->load_user('purchases',['purchases' => $purchases],'purchases');
	}

	public function questionnaire()
	{
		$countries = $this->db->get('country')->result_array();
		$cities = $this->db->get_where('city', ['country_id' => 166])->result_array();
		$this->template->load_user('questionnaire', ['countries' => $countries, 'saudi_cities' => $cities]);
	}

	public function branding_questions()
	{
		if($this->input->post()){
			$data = $this->input->post();
			// echo "<pre>";
			// print_r($data);
			// die();

			$data['7'] = implode(',', $data['7']);
			$data['8'] = json_encode($data['8']);

			$data['3'] = $data['city'] . ', ' . $data['country'];
			unset($data['city']);
			unset($data['country']);

			if(isset($data['14']['cs'])){
				$data['14'] = implode(',', $data['14']['cs']);
			}

			if(isset($data['14']['cp'])){
				$data['14'] = implode(',', $data['14']['cp']);
			}

			if(isset($data['20'])){
				$data['20'] = implode(',', $data['20']);
			}

			//return print_r($data);
			
			if(isset($data['logo_status'])){
				
				// calculate branding deadline
				$order_deadline = $this->db->get_where('orders',[
					'id' => $data['order_id']
				])->row_array();

				//1 day = 8 working hours
				// $deadline_hours = (float)$order_deadline['total_time'] * 8;
				// Hamza
				$deadline_hours = (float)$order_deadline['total_time'] * 24;
				$deadline_hours  = (int)$deadline_hours;
            	
            	$deadline = date('Y-m-d H:i:s', strtotime('+' . $deadline_hours . ' hours'));
				$this->db->update('order_items', [
					'status' => 1, 
					'deadline' => $deadline
				], [
					'order_id' => $data['order_id'],
					'item_type' => 'logo'
				]);

				// MAking branding_cat items in processs
				$branding_ids_db = $this->db->get_where("designs" , ['category_id' => 1])->result_array();
				if($branding_ids_db){
					$branding_ids = array_column($branding_ids_db, "id");
					$this->db->where([
						'order_id' => $data['order_id'],
						'item_type' => 'addon'
					]);
					$this->db->where_in("item_id" , $branding_ids);
					$this->db->update('order_items', [
						'status' => 1, 
						// 'deadline' => $deadline
					] );
				}

				//$deadline = $this->orders_model->get_deadline($item_for_deadline['id']);
            	//$deadline = ($deadline) ? $deadline : '0';
            	//$this->db->update('order_items', ['status' => '1', 'deadline' => $deadline], ['id' => $item_for_deadline['id']]);
				
				unset($data['logo_status']);
			}

			//print_r($data);die();

			foreach ($data as $question_id => $answer) {

				if($question_id == 'order_id') { continue; }
				
				$insert['user_id'] = $this->User->id;
				$insert['order_id'] = $data['order_id'];
				$insert['question_id'] = $question_id;
				
				if($question_id == '12'){
					$answer = json_encode($answer);
				}

				$insert['answer'] = $answer;
				$this->db->insert('answers_brand', $insert);
				//print_r($beck);
			}

			/*if( ! empty($_FILES['16']['name'])){
				// make upload path referred to order id
				$path = './uploads/orders/';
				if ( ! is_dir($path.$data['order_id'])) {
				    mkdir($path.$data['order_id'], 0777, TRUE);
				}
				$path = $path.$data['order_id'].'/';

				$config['upload_path'] = $path;
	            $config['allowed_types'] = 'ico|png|jpg|pdf|ai|psd|eps|indd|doc|docx|ppt|pptx|xlsx|xls';

	            $uploaded_file_ids = $this->files->multiUpload('16', $config);
	            //print_r($uploaded_file_ids);die();
	            $insert['user_id'] = $this->User->id;
				$insert['order_id'] = $data['order_id'];
				$insert['question_id'] = '16';
				$insert['answer'] = implode(',', $uploaded_file_ids);
				$this->db->insert('answers_brand', $insert);
            }*/

			//redirect(base_url('purchases'));
			$update = $this->db->update('orders', ['order_status' => 1], ['id' => $data['order_id']]);

			//email for questionnaire received
            $order_design_list = $this->db->select('designs.name_english,designs.name_arabic')
	            ->from('designs')
	            ->join('order_items', 'designs.id = order_items.item_id')
	            ->where('order_items.order_id', $data['order_id'])
	            ->where_in('order_items.item_type', ['design','addon'])
	            ->get()->result_array();
	        
	        $order_detail = $this->db->get_where('orders', ['id' => $data['order_id']])->row_array();

			$view = 'questionnaire-complete';
			$btn_link = base_url('dashboard');
			$email = $this->User->email;
            $vars = [
                '{username}' => $this->User->full_name,
                '{email}' => $email,
                'logo_adjustments' => $order_design_list,
                '{order_id}' => $data['order_id'],
				'{order_date}' => date('m/d/Y'),
                '{btn_text}' => 'Visit Dashboard',
                '{btn_link}' => $btn_link,
                '{order_name}' => $order_detail['project_name'],
            ];
            $email = $this->et->template($email, 'questionnaire_received', $vars, $view, true);

            $this->session->set_flashdata('success', $this->lang->line('branding_questionnaire_success'));
			echo ($update == 1) ? 'true': 'false';
		}
	}

	public function attachment_uploader($files = array())
	{
		if($files){

            $config['upload_path']          = './uploads/orders/';
            $config['allowed_types']        = 'ico|png|jpg|pdf|ai|psd|eps|indd|doc|docs|ppt|pptx|xlsx|xls';
            $config['max_size']             = 300;
            $config['max_width']            = 512;
            $config['max_height']           = 512;

            $file = $this->files->upload('icon', $config);

            if( ! isset($file['error'])){
                $data = $this->input->post();
                $data['slug'] = $this->slugify($data['name']);
                $data['created_at'] = date('Y-m-d H:i:s');
                $data['created_by_id'] = $this->User->id;
                $data['package_cat_image_id'] = $file['id'];

                $result = $this->db->insert('package_categories', $data);
                if($result){
                    $this->session->set_flashdata('success', $this->lang->line('add_cat_success'));
                }else{
                    $this->session->set_flashdata('error', $this->lang->line('add_cat_error'));
                }
            }else{
                $this->session->set_flashdata('error', $file['error']);
                redirect('admin/package/categories/add');
            }
            
            redirect('admin/package/categories');
        }else{
            $this->template->load_admin('package/categories/add');
        }
	}

	public function design_questions($item_id="")
	{
		if($item_id != ""){
			$item = $this->db->get_where('order_items', ['id' => $item_id])->row_array();
			if($item){
				$questionnaire = $this->db->get_where('questions_design', ['design_id' => $item['item_id']])->row_array();
				if($questionnaire){
					//print_r($questionnaire);
					$this->template->load_user('design-questionnaire', ['questionnaire' => $questionnaire, 'design' => $item, 'item_id' => $item_id]);
				}
			}
		}
	}

	public function save_questions_later()
	{
		$form_data = $this->input->post('form_data');
		$order_id = $this->input->post('order_id');
		$fdInsert = [];
		if (isset($form_data) && !empty($form_data)) {
			$this->db->delete('answers_brand_ex', array('order_id' => $order_id));
			$form_data = json_encode($form_data);
			$fdInsert['user_id'] = $this->User->id;
			$fdInsert['order_id'] = $order_id;
			$fdInsert['answers'] = $form_data;
			$this->db->insert('answers_brand_ex', $fdInsert);
		}
	}

	public function save_questions()
	{

		if($this->input->post()){
			$data = $this->input->post();

			$item_jd = $this->db->get_where('order_items', ['id' => $data['item_id']])->row_array();
			$order_id_jd = $item_jd['order_id'];

			$check_answers = $this->db->get_where('answers_brand', ['order_id' => $order_id_jd]);
			if($check_answers->num_rows() > 0){
				// $q_brand = true;

			if(isset($data['width'], $data['height'], $data['unit'])){
				$data['measurement'] = $data['width'].'X'.$data['height'].' '.$data['unit'];
				unset($data['width']);
				unset($data['height']);
				unset($data['unit']);
			}
			
			//return print_r($data);

			if(isset($data['content-slc'])) {
				$data['content'] = $data['content-slc'];
				unset($data['content-slc']);
			}

			$data['user_id'] = $this->User->id;

			$item = $this->db->get_where('order_items', ['id' => $data['item_id']])->row_array();
			if($item){
				$order_id = $item['order_id'];
				$data['order_id'] = $order_id;
				$data['file_link'] = $this->input->post("file_link");

	            $uploaded_files = $this->db->get_where("temp_design_files" , array("item_id" => $this->input->post("item_id")))->result_array();
	            if($uploaded_files){
	            	$uploaded_files_ids = array_column($uploaded_files, "attachment");
	            	$data['attachment'] = implode(',', $uploaded_files_ids);
	            }

	            $result = $this->db->insert('answer_design', $data);
	            if($result){
	            	$this->db->delete("temp_design_files" , array("item_id" => $this->input->post("item_id")));
	            	$order_detail = $this->db->get_where('orders', ['id' => $order_id])->row_array();
	            	$view = 'content-upload-complete';
					$btn_link = base_url('dashboard');
					$email = $this->User->email;
		            $vars = [
		                '{username}' => $this->User->full_name,
		                '{email}' => $email,
		                '{order_id}' => $order_id,
		                '{btn_link}' => $btn_link,
		                '{order_name}' => $order_detail['project_name']
		            ];
		            $email = $this->et->template($email, 'content-upload-complete', $vars, $view, true);

	            	/*$days_to_add = 0;
	            	if($item['item_type'] == 'design'){
	            		$get_pack_time = $this->db->get_where('order_items',[
	            			'order_id' => $order_id, 
	            			'item_type' => 'package'
	            		])->row_array();
	            		
	            		$days_to_add = $get_pack_time['unit_time'];
	            	}elseif($item['item_type'] == 'addon'){
	            		$days_to_add = $item['unit_time'];
	            	}

	            	$deadline = date('Y-m-d H:i:s', strtotime("+". $days_to_add ." days"));
	            	*/

	            	// calculate branding deadline
					$order_deadline = $this->db->get_where('orders',[
						'id' => $item['order_id']
					])->row_array();

					//1 day = 8 working hours
					// $deadline_hours = (float)$order_deadline['total_time'] * 8;
					//Hamza
					$deadline_hours = (float)$order_deadline['total_time'] * 24;
					$deadline_hours  = (int)$deadline_hours;
	            	
	            	$deadline = date('Y-m-d H:i:s', strtotime('+' . $deadline_hours . ' hours'));
					$this->db->update('order_items', ['status' => 1, 'deadline' => $deadline], ['id' => $item['id']]);

	            	//$deadline = $this->orders_model->get_deadline($item['id']);
	            	//$deadline = ($deadline) ? $deadline : '0';
	            	//$this->db->update('order_items', ['status' => '1', 'deadline' => $deadline], ['id' => $item['id']]);
					//$this->session->set_flashdata('success', $this->lang->line('add_success_answer'));
					
					//check this design is last or not
					$designs = $this->db->get_where('order_items', ['order_id' =>  $item['order_id'], 'item_type !=' => 'package', 'status' => 0]);
					if($designs->num_rows() > 0){
						$designs = $designs->result_array();
					}else{
						$designs = [];
					}

					if(!empty($designs)){
						$return_message = $this->lang->line('add_success_answer');
					}else{
						$return_message = 'zain';
					}
					return print_r($return_message);
				}else{
					//$this->session->set_flashdata('error', $this->lang->line('add_error_answer'));
					return print_r($this->lang->line('add_error_answer'));
				}
				//redirect(base_url('dashboard'));
	        }
	        }else{
				return print_r($this->lang->line('add_error_answer_first'));
				// $q_brand = false;
			}
		}
	}

	function get_order_items()
	{
		if($this->input->post()){
			$data = $this->input->post();
			$order_id = $this->db->get_where('order_items', ['id' => $data['item_id']])->row_array();
			if($order_id){
				$order_id = $order_id['order_id'];
				$order_items = $this->db->get_where('order_items', ['order_id' => $order_id])->result_array();
				$options = '';
				$options .= '<option value="">Choose</option>';
				foreach ($order_items as $key => $order_item) {
					$check_questionnaire = $this->db->get_where('answer_design', ['item_id' => $order_item['id']]);
					//only answered items will be displayed.
					if($check_questionnaire->num_rows() > 0){
						$options .= '<option value="'. $order_item['id'] .'">'. $order_item['item_name'] .'</option>';
					}
				}
				print_r($options);
			}
		}
	}

	public function get_order_items_detail()
	{
		$data = $this->input->post();
		if($data){
			$item_id = $data['item_id'];
			$detail = $this->db->get_where('answer_design', ['item_id' => $item_id]);
			if($detail->num_rows() > 0){
				$detail = $detail->row_array();
				echo json_encode(['status' => true, 'data' => $detail]);
			}else{
				echo json_encode(['status' => false]);
			}
		}
	}

	public function get_delivery_files_list()
    {
        if($this->input->post()){
        	$item_id = $this->input->post('item_id'	);

        	// comment this code to solve bug at user side not showing files uploaded by admin
        	// $sql = "SELECT `delivery_files`,`admin_remarks`, `order_id` 
        	// 	FROM `order_item_management` 
        	// 	WHERE `created_at` = 
        	// 		(SELECT MAX(`order_item_management`.`created_at`) 
        	// 			FROM `order_item_management` 
        	// 			WHERE `item_id` = '".$item_id."' AND `delivery_files` REGEXP '^[0-9]+$')";
        	$sql = "SELECT `delivery_files`,`admin_remarks`, `order_id` 
		    		FROM `order_item_management` 
		    		WHERE `item_id` = '".$item_id."' AND `created_at` = 
		    			(SELECT MAX(`order_item_management`.`created_at`) 
		    				FROM `order_item_management` 
		    				WHERE `item_id` = '".$item_id."')";


        	$query = $this->db->query($sql);
        	if($query->num_rows() > 0){
	        	$result = $query->row_array();
	        	$remarks = $result['admin_remarks'];
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
							      <small><i class="fa fa-download"></i> '.$this->lang->line('download').'</small>
							    </div>
							</a>';
        				
        			}
        			$list .= '</div>';

        			//remarks
        			if($remarks){
	        			$list .= '<div class="list-group">';
	        			$list .= '<div class="list-group-item flex-column align-items-start">
									<div class="d-flex w-100 justify-content-between">
									  <p class="w-100"><b>'.$this->lang->line('remarks').': </b>'.$remarks.'</p>
									</div>
								</div>';
	        			$list .= '</div>';
        			}
        			echo $list;
        		}
        	}
        }
    }

    public function get_cities()
    {
    	if($this->input->post()){
    		$data = $this->input->post();
    		$cities = $this->db->get_where('city', ['country_id' => $data['country_id']]);
    		if($cities->num_rows() > 0){
    			$cities = $cities->result_array();
    			$city_str = '';
    			foreach ($cities as $key => $city) {
    				$city_str .= '<option value="'.$city['name'].'">'.$city['name'].'</option>';
    			}
    		}
    		echo $city_str;
    	}
    }

    public function approve_item()
    {
    	if($this->input->post()){
    		$item_id = $this->input->post('item_id');
    		$item = $this->db->get_where('order_items', ['id' => $item_id])->row_array();
    		
    		if($item['item_type'] == 'logo' || $item['item_id'] == 76){
    			//get all order items
    			$order_items = $this->db->get_where('order_items', ['order_id' => $item['order_id']])->result_array();
    			foreach ($order_items as $key => $order_item) {
    				//check is questionnaire existed against this design item.
	    			$q_exist = $this->db->get_where('questions_design', ['design_id' => $order_item['item_id']]);
					$item_status = ($q_exist->num_rows() > 0) ?  '0' : '1';
					$this->db->update('order_items', ['status' => $item_status], ['id' => $order_item['id'], 'status' => '5']);

    			}

    			$order_design_list = $this->db->select('designs.name_english,designs.name_arabic')
	            ->from('designs')
	            ->join('order_items', 'designs.id = order_items.item_id')
	            ->where('order_items.order_id', $item['order_id'])
	            ->where_in('order_items.item_type', ['design',''])
	            ->get()->result_array();
	            $order_detail = $this->db->get_where('orders', ['id' => $item['order_id']])->row_array(); 

	            $package_time = $this->db->get_where("order_items" , array("order_id" => $item['order_id'] , "item_type" => "package") , "", "row")->row_array();
	            if (isset($package_time) && !empty($package_time)) {

	            	$package_time = $package_time['subtotal_time'];
	            } else {
	            	$the_time = $this->db->select('SUM(subtotal_time) AS totalTime')->get_where("order_items" , array("order_id" => $item['order_id']));
	            	if ($the_time->num_rows() > 0) {
						$package_time = $the_time->row_array()['totalTime'];      		
	            	}
	            }

	            if (isset($package_time) && !empty($package_time)) {
	            } else {
	            	$package_time = '0';
	            }

				$view = 'branding-approved';
				$btn_link = base_url('dashboard');
				$email = $this->User->email;
	            $vars = [
	                '{username}' => $this->User->full_name,
	                '{email}' => $email,
	                'logo_adjustments' => $order_design_list,
	                '{order_id}' => $item['order_id'],
	                '{branding_date}' => date('m/d/Y' , strtotime($order_detail['created_on'].' +'.ceil($package_time).' days')),
					'{order_date}' => date('m/d/Y' , strtotime($order_detail['created_on'])),
	                '{btn_link}' => $btn_link,
	                '{order_name}' => $order_detail['project_name'],
	            ];
	            $email = $this->et->template($email, 'branding-approved', $vars, $view, true);
    		}
    		$result = $this->db->update('order_items', ['status' => 3], ['id' => $item_id]);

    		if($result){
	    		//update order table for dashboard project sorting by last update
	    		$this->db->update('orders', ['updated_on' => date('Y-m-d H:i:s')], ['id' => $item['order_id']]);

	   //  		//email for order placed
				// $view = 'feedback';
				// $btn_link = base_url('feedback');
				// $email = $this->User->email;
	   //          $vars = [
	   //              '{username}' => $this->User->full_name,
	   //              '{email}' => $email,
	   //              '{btn_link}' => $btn_link
	   //          ];
	   //          $email = $this->et->template($email, 'artwork_downloaded', $vars, $view, true);
    		}
	    	echo $result;
    	}
    }

    public function adjustments($item_id)
    {
    	if($this->cart->contents()){
    		$this->cart->destroy();
    		$this->session->unset_userdata('project_name');
    	}
    	
    	$item = $this->db->get_where('order_items', ['id' => $item_id])->row_array();
    	if( in_array($item['item_type'], ['addon', 'custom_addon', 'design']) ){
    		$type = 'design';
    	}elseif ($item['item_type'] == 'logo') {
    		$type = 'branding';
    	}

    	//update order table for dashboard project sorting by last update
	   	$this->db->update('orders', ['updated_on' => date('Y-m-d H:i:s')], ['id' => $item['order_id']]);


    	$adjustments = $this->design_model->get_design_adjustments($item['item_id']);
    	$main = false;
		$extras = false;
		if($adjustments){
			foreach ($adjustments as $key => $adjustment){
				if($adjustment['adjustment_category'] == 'main'){
					$main = true;
				}
				if($adjustment['adjustment_category'] == 'extras'){
					$extras = true;
				}
			}
		}

		$design = $this->db->get_where('designs', ['id' => $item['item_id']])->row_array();
    	
    	$addons_cats = $this->db->order_by('sort_order', 'ASC')->get('design_categories')->result_array();
    	
    	$this->template->load_user('adjustments', [
    		'adjustments' => $adjustments,
    		'item' => $item, 
    		'design' => $design,
    		'type' => $type,
    		'addons_cats' => $addons_cats,
    		'main' => $main,
    		'extras' => $extras
    	]);
    }

    public function adjustment_files()
    {
    	//print_r($_POST);
    	//return print_r($_FILES);
    	
		if( ! empty($_FILES['files']['name'])){
			
			$order_id = $_POST['order_id'];
			$item_id = $_POST['item_id'];

			// make path
            $path = './uploads/orders/';
            if ( ! is_dir($path.$order_id)) {
                mkdir($path.$order_id, 0777, TRUE);
            }
            $path = $path.$order_id.'/';
            if ( ! is_dir($path.$item_id)) {
                mkdir($path.$item_id, 0777, TRUE);
            }
            $path = $path.$item_id.'/';
            if ( ! is_dir($path.'adjustments')) {
                mkdir($path.'adjustments', 0777, TRUE);
            }
            $path = $path.'adjustments/';

			$config['upload_path'] = $path;
            $config['allowed_types'] = 'ico|png|jpg|pdf|ai|psd|eps|indd|doc|docx|ppt|pptx|xlsx|xls';

            $uploaded_file_ids = $this->files->multiUpload('files', $config);

            if(isset($_POST['existingFiles']) && !empty($_POST['existingFiles'])){
            	$existingFiles = explode(',', $_POST['existingFiles']);
            	$uploaded_file_ids = array_merge($existingFiles, $uploaded_file_ids);
            }

            $uploaded_file_ids = implode(',', $uploaded_file_ids);

            //print_r($uploaded_file_ids);die();
            if(isset($_POST['cart_row_id']) && !empty($_POST['cart_row_id'])){
            	echo "in if <BR>";
				$cart_row_id = $_POST['cart_row_id'];
				$update = [
	    			'rowid' => $cart_row_id,
	    			'file_ids' => $uploaded_file_ids
	    		];
            }else{
            	echo "in else <br>";
				$cart_content = $this->cart->contents();
				
				if($cart_content){
					foreach ($cart_content as $row_id => $item) {

						if($item['my_id'] == $this->input->post("my_id")){
							$cart_row_id = $row_id;
							break;
						}
					}
				}

				print_r($cart_content);
	    		
	    		$update = [
	    			'rowid' => $cart_row_id,
	    			'file_ids' => $cart_content[$cart_row_id]["file_ids"].",".$uploaded_file_ids
    			];
            }

            
    		echo ($this->cart->update($update)) ? 'true' : 'false';
        }
    }

    public function dz_files()
    {
    	//print_r($_POST);
    	//print_r($_FILES);
    	//return;
		if( ! empty($_FILES['files']['name'])){
			

			$order_id = isset($_POST['order_id']) ? $_POST['order_id'] : '';
			$item_id = isset($_POST['item_id']) ? $_POST['item_id'] : '';
			$q_type = isset($_POST['q_type']) ? $_POST['q_type'] : '';

			// make path
            $path = './uploads/orders/';
            if ( ! is_dir($path.$order_id)) {
                mkdir($path.$order_id, 0777, TRUE);
            }
            $path = $path.$order_id.'/';
            /*if ( ! is_dir($path.$item_id)) {
                mkdir($path.$item_id, 0777, TRUE);
            }
            $path = $path.$item_id.'/';
            if ( ! is_dir($path.'adjustments')) {
                mkdir($path.'adjustments', 0777, TRUE);
            }
            $path = $path.'adjustments/';*/

			$config['upload_path'] = $path;
            $config['allowed_types'] = 'ico|png|jpg|jpeg|pdf|ai|psd|eps|indd|doc|docx|ppt|pptx|xlsx|xls';

            $uploaded_file_ids = $this->files->multiUpload('files', $config);
            var_dump($uploaded_file_ids);
            $uploaded_file_ids = implode(',', $uploaded_file_ids);

            //print_r($uploaded_file_ids);die();
            if($q_type == 'design'){
            	$insert = array(
            		"item_id" => $item_id,
            		"attachment" => $uploaded_file_ids,
            		"created_by" => $this->User->id,
            		"updated_by" => $this->User->id,
            	);
				$up = $this->db->insert('temp_design_files', $insert);
            }else{
            	$insert = [
            		'user_id' => $this->User->id,
            		'order_id' => $order_id,
            		'question_id' => '16',
            		'answer' => $uploaded_file_ids
            	];
				$up = $this->db->insert('answers_brand', $insert);
            }
			echo ($up) ? 'true' : 'false';
        }
    }

	public function dz_files_delete()
    {
    	$data = $this->input->post();
    	if($data){
    		$file = $this->db->get_where('files', ['name' => $data['fileName']])->row_array();
    		if($file){

    			$updated_str = $this->remove_item_from_string($data['existing_attachments'], $file['id']);

    			$update = [
	    			'rowid' => $data['cart_row_id'],
	    			'file_ids' => $updated_str
	    		];
	    		$this->cart->update($update);

    			$path = './uploads/orders/'.$data['order_id'].'/'.$data['item_id'].'/adjustments/';
    			$this->files->delete_by_name($data['fileName'],$path);


    			/*$adjustment_items_conditions = [
    				'order_id' => $data['order_id'],
    				'item_id' => $data['item_id'],
    				'adjustment_id' => $data['adjustment_id']
    			];

    			$adjustment_item = $this->db->get_where('adjustment_items', $adjustment_items_conditions);
    			if($adjustment_item->num_rows() > 0){
    				$adjustment_item = $adjustment_item->row_array();
    				$updated_str = $this->remove_item_from_string($adjustment_item['attachments'], $file['id']);
    				
    				$this->db->update('adjustment_items', ['attachments' => $updated_str], $adjustment_items_conditions);
    			}
    			*/	
    		}
    	}
    }

    function remove_item_from_string($str, $item) {
        $parts = explode(',', $str);
        while(($i = array_search($item, $parts)) !== false) {
            unset($parts[$i]);
        }
        return implode(',', $parts);
    }

    public function apply_promo()
    {
    	if($this->input->post()){
    		$data = $this->input->post();
    		$code_exist = $this->db->get_where('coupons', ['code' => $data['code'], 'status' => 1]);
    		if($code_exist->num_rows() > 0){
    			$code_exist = $code_exist->row_array();
    			//Checking usage criteria
    			$can_apply_token = $this->can_apply_token($code_exist);
    			
    			$today = date('Y-m-d');
    			$code_expiry = date('Y-m-d', strtotime($code_exist['expiry']));
    			if($code_expiry > $today && $can_apply_token){
    				$cart_total = $this->cart->total();
    				$discount = ((float)$cart_total * (float)$code_exist['discount']) / 100;
    				$discount_price = (float)$cart_total - $discount;
    				$this->session->set_userdata('cart_total_discounted', $discount_price);
    				$this->session->set_userdata('promo_code', $data['code']);
    				$this->session->set_userdata('coupon', $data['code']);
    				echo 'success';
    			}else{
    				echo 'failed';
    			}
    		}else{
    			echo 'failed';
    		}
    	}else{
    		echo 'failed';
    	}
    }
    public function can_apply_token($coupon_detail){

    	//user applicable to apply the coupon or not
    	if($coupon_detail['applicable_on_customers'] == "" || in_array($this->User->id, explode(',', $coupon_detail['applicable_on_customers']))){

	    	$times_coupon_used = $this->db->select("COUNT(id) as coupon_applied_for")
	    			->where("coupon_id" , $coupon_detail['id'])
	    			->get("coupon_usage")->row_array();
	    	$times_coupon_used = $times_coupon_used['coupon_applied_for'];
	    	if($coupon_detail['usage_per_coupon'] == 0 || $coupon_detail['usage_per_coupon'] > $times_coupon_used){


		    	$times_coupon_used_user = $this->db->select("COUNT(id) as coupon_applied_for")
		    			->where("user_id" , $this->User->id)
		    			->where("coupon_id" , $coupon_detail['id'])
		    			->get("coupon_usage")->row_array();
		    	$times_coupon_used_user = $times_coupon_used_user['coupon_applied_for'];
		    	if($coupon_detail['usage_per_customer'] == 0 || $coupon_detail['usage_per_customer'] > $times_coupon_used_user){
		    		return TRUE;
		    	}else{
		    		echo "user usage";
		    		return FALSE;
		    	}
	    	}else{
	    		echo "coupon usage";
	    		return FALSE;
	    	}
    	}else{
    		echo "applicable customer";
    		return FALSE;
    	}
    }

    public function edit_bundl()
    {
    	if($this->cart->contents()){
    		$this->cart->destroy();
    		$this->session->unset_userdata('project_name');
    	}

    	$orders = $this->db->get_where('orders',[
    		'user_id' => $this->User->id,
    		'payment_status' => 1
    		//'order_status' => 0
    	])->result_array();

    	$addons_cats = $this->db->order_by('sort_order', 'ASC')->get('design_categories')->result_array();
    	$this->template->load_user('edit-bundl',[
    		'addons_cats' => $addons_cats,
    		'orders' => $orders
    	]);
    }

    public function get_order_detail()
    {
    	if($this->input->post()){
    		$data = $this->input->post();
    		//print_r($data);

    		$package = $this->db->get_where('order_items',['order_id' => $data['order_id'], 'item_type' => 'package'])->row_array();
    		$pack_detail = $this->db->get_where('packages',['id' => $package['item_id']])->row_array();
    		echo $pack_detail['description_english'];
    	}
    }

    public function feedback()
    {
    	// get project ids which are already feedback given earlier
    	$not_in = [0];
    	$prjs = $this->db->distinct('order_id')->select('order_id')->get('client_feedback');
    	if($prjs->num_rows() > 0){
    		$prjs = $prjs->result_array();
    		foreach ($prjs as $key => $value) {
    			$not_in[] = $value['order_id'];
    		}
    	}

    	// get projects for getting feedback
    	$projects = $this->db->where(['user_id' => $this->User->id, 'order_status' => 2])
    		->where_not_in('id', $not_in)->get('orders')->result_array();
    	//print_r($projects);die();
    	$this->template->load_user('feedback',['projects' => $projects],'feedback');
    }

    public function feedback_response()
    {
    	$data = $this->input->post();
    	if($data){
    		$order_id = $data['order_id'];
    		$feedback = $data['feedback'];
    		//print_r($feedback);
    		foreach ($feedback as $key => $value) {
    			$value['question_id'] = $key;
    			$value['order_id'] = $order_id;
    			$this->db->insert('client_feedback', $value);
    		}
    		echo "yes";
    	}
    }

    public function recommend()
    {
    	$this->template->load_user('recommend',[],'recommend');
    }

    public function recommend_us_process()
    {
    	$data = $this->input->post();
    	if($data){
    		$email = $data['friend_email'];
    		$invitee = $this->User->full_name;
    		$message = $data['message'];
    		$contact_us_url = base_url('contact-us');
    		$email_data['notification'] = $this->db->get_where('email_templates', ['slug' => 'recommended'])->row_array();
    		$email_data['language'] = $this->language;
    		$settings = $this->db->get('settings')->row_array();
			$facebook = $settings['facebook'];
			$instagram = $settings['instagram'];
			$linked_in = $settings['linked_in'];
			$twitter = $settings['twitter'];

    		$link_activate = base_url() . '?register=email';
	        $email_message = $this->load->view('email_templates/recommend', $email_data, true);
	        $email_message = str_replace("{name}", $data['friend_name'], $email_message);	
	        $email_message = str_replace("{email}", $email, $email_message);
	        $email_message = str_replace("{link_activation}", $link_activate, $email_message);
	        $email_message = str_replace("{invitee}", $invitee, $email_message);
	        $email_message = str_replace("{friend_message}", $message, $email_message);
	        $email_message = str_replace("{contact_url}", $contact_us_url, $email_message);
	        $email_message = str_replace("{facebook}", $facebook, $email_message);
	        $email_message = str_replace("{instagram}", $instagram, $email_message);
	        $email_message = str_replace("{linked_in}", $linked_in, $email_message);
	        $email_message = str_replace("{twitter}", $twitter, $email_message);


	        // $this->email->to($email);
	        // $this->email->bcc($this->config->item('admin_email'));
	        // $this->email->subject('BundlDesigns');
	        // $this->email->message($email_message);
	        // $result = $this->email->send();
	        $result = $this->et->send_general_email($email , 'BundlDesigns' , $email_message);
	        // $this->email->clear();

	        //inviter has completed project or not
	        $completed_projects = $this->db->get_where('orders', ['user_id' => $this->User->id, 'order_status' => 2]);
	        if($completed_projects->num_rows() > 0){
	        	$email_promo = $this->User->email;
				$full_name = $this->User->full_name;
				
				$email_data_promo['notification'] = $this->db->get_where('email_templates', ['slug' => 'promo-code'])->row_array();
				$email_data_promo['language'] = $this->language;

				//get promo code
				$promo = $this->db->get_where('coupons', ['id' => 8])->row_array();

				$exclusive_users = $promo['applicable_on_customers'].",".$this->User->id;
				$this->db->where("id" , 8);
				$this->db->update('coupons' , ["applicable_on_customers" => $exclusive_users]);
				
				$settings = $this->db->get('settings')->row_array();
				$facebook = $settings['facebook'];
				$instagram = $settings['instagram'];
				$linked_in = $settings['linked_in'];
				$twitter = $settings['twitter'];

		        $email_message_promo = $this->load->view('email_templates/promo-code', $email_data_promo, true);
		        $email_message_promo = str_replace("{name}", $full_name, $email_message_promo);
		        $email_message_promo = str_replace("{email}", $email, $email_message_promo);
		        $p_span = "<span style='font-weight: 600;color: #ae74a1;'>$promo[code]</span>";
		        $email_message_promo = str_replace("{promo_code}", $p_span, $email_message_promo);

		        $email_message_promo = str_replace("{facebook}", $facebook, $email_message_promo);
		        $email_message_promo = str_replace("{instagram}", $instagram, $email_message_promo);
		        $email_message_promo = str_replace("{linked_in}", $linked_in, $email_message_promo);
		        $email_message_promo = str_replace("{twitter}", $twitter, $email_message_promo);

		        /*print_r($email_message_promo);
		        echo $email_promo;
		        die();*/

		        //$this->email->clear();

		        // $this->email->from('no-reply@bundldesigns.com', 'BUNDL DESIGNS');
		        // $this->email->to($email_promo);
		        // $this->email->bcc($this->config->item('admin_email'));
		        // $this->email->subject('BundlDesigns');
		        // $this->email->message($email_message_promo);
		        // $result_email = $this->email->send();
		        $result_email = $this->et->send_general_email($email_promo , 'BundlDesigns' , $email_message_promo);
		        /*if( ! $result_email) {
			        echo $this->email->print_debugger();
			        die();
			    }*/
	        }

	        /*if($result){
				$this->session->set_flashdata('success', $this->lang->line('recommend_us_success'));
			}else{
				$this->session->set_flashdata('error', $this->lang->line('recommend_us_failed'));
			}*/
			$this->session->set_flashdata('success', $this->lang->line('recommend_us_success'));
			redirect(base_url('recommend'));
    	}
    }
    public function test(){

			$view = 'payment_receipt';
		  	$vars = [
	            '{username}' => "Hamza Ali",
	            '{email}' => "hamza15137024@gmail.com",
	            '{order_id}' => "490",
				'{order_date}' => date('m/d/Y'),
				'{amount}' => "$22.00",
	            '{btn_link}' => "bundle.com",
	        ];
	        $email = "hamza15137024@gmail.com";

	       
	       $a =  $this->et->template($email, 'payment_receipt', $vars, $view, true);
	       var_dump($a);
	}

	public function tempFunc()
	{

		$tran_ref = $this->input->get('tran_ref');

		$merchant_email='hala.alhussaini@gmail.com';
		$secret_key='nOiZ1L2lukUrIRPq3tsxKMQn653rsLqQAJQCvSYZdSqVKgmNJOltAcRGhV8KHyBihrUMkTLxMctxsPlcEHGeTyVbt4VaCwsUYnHi';
		$merchant_id='10041761';

		$params = [
			'merchant_email'=>$merchant_email,
            'merchant_id'=>$merchant_id,
            'secret_key'=>$secret_key
        ];
                 
		$this->load->library('Paytabs',$params);

		// $this->load->library('Paytabs');
        $response = $this->paytabs->getPaymentQuery(["cart_id" => $tran_ref]);
        echo "<pre>";
        print_r(json_decode($response));
        echo "</pre>";
	}

	// script to add transaction ids
	/*public function addTransIdz()
	{
		$order_ids = [483,492,556,578,618,665,679,689,692,700,703,705,707,717,718,721,725,729,730,736,737,738,739,740,743,744,745,747,748,749,762];
		$orders_data = $this->db->select('id, trans_id')
				->from('orders')
				// ->where([])
				->where_in('id', $order_ids)
				->get()->result_array();

		foreach ($orders_data as $o_key => $o_val) {
			// $smt_arr = $this->common_model->smart_array();
			// UPDATE `order_items` SET `trans_id` = 'TRN1547977787' WHERE `order_items`.`id` = 9958;
			// $yoo = $this->db->get_where('order_items', ['order_id' => $o_val['id']])->result_array();
			// echo "<pre>";
			// print_r($yoo);
			$this->db->update('order_items', ['pay_status' => 'yes' , 'trans_id' => $o_val['trans_id']], ['order_id' => $o_val['id']]);

		}
		echo "string";
	}*/

    /*public function promo_code_email()
    {
		//$email = $this->User->email;
		$email_promo = 'zain@appliconsoft.com';
		$full_name = $this->User->full_name;
		
		$email_data_promo['notification'] = $this->db->get_where('email_templates', ['slug' => 'promo-code'])->row_array();
		$email_data_promo['language'] = $this->language;

		//get promo code
		$promo = $this->db->get_where('coupons', ['id' => 8])->row_array();
		
		$settings = $this->db->get('settings')->row_array();
		$facebook = $settings['facebook'];
		$instagram = $settings['instagram'];
		$linked_in = $settings['linked_in'];
		$twitter = $settings['twitter'];

        $email_message_promo = $this->load->view('email_templates/promo-code', $email_data_promo, true);
        $email_message_promo = str_replace("{name}", $full_name, $email_message_promo);
        $email_message_promo = str_replace("{email}", $email, $email_message_promo);
        $email_message_promo = str_replace("{promo_code}", $promo['code'], $email_message_promo);

        $email_message_promo = str_replace("{facebook}", $facebook, $email_message_promo);
        $email_message_promo = str_replace("{instagram}", $instagram, $email_message_promo);
        $email_message_promo = str_replace("{linked_in}", $linked_in, $email_message_promo);
        $email_message_promo = str_replace("{twitter}", $twitter, $email_message_promo);

        //print_r($email_message_promo);die();

        $this->email->to($email_promo);
        $this->email->subject('BundlDesigns');
        $this->email->message($email_message_promo);
        $result_email = $this->email->send();
        return $result_email;
    }*/
}//end controller