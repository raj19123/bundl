<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once($_SERVER['DOCUMENT_ROOT'].'/'. 'vendor/autoload.php');  
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Orders extends Admin_Controller {

	function __construct() {
		parent::__construct();
    }

    public function index()
    {
    	$list = $this->db->get_where('orders', ['payment_status' => 1])->result_array();
        // for addons after the exact purchase as well
        $this->calculate_total_price($list);
    	$this->template->load_admin('orders/list',['list' => $list]);
    }
    protected function calculate_total_price(&$order_list){

        $order_items_jd = $this->db->select("SUM(subtotal_price) total_price_of_order, MAX(created_on) created_on , order_id")->where(['item_type != ' => 'custom_addon'])->group_by("order_id")->get('order_items')->result_array();
        if(!empty($order_items_jd)){
            $order_item_jd_st = $this->common_model->smart_array($order_items_jd , "order_id");
        }

        $order_items = $this->db->select("SUM(subtotal_price) total_price_of_order, MAX(created_on) created_on , order_id")->group_by("order_id")->get('order_items')->result_array();
        if(!empty($order_items)){
            $order_item_st = $this->common_model->smart_array($order_items , "order_id");
            if(!empty($order_list)){
                foreach ($order_list as $ol_key => $ol_val) {

                    if(isset($order_item_st[$ol_val['id']]) && $order_item_st[$ol_val['id']]['total_price_of_order']){
                        $order_list[$ol_key]['grand_total'] = $order_item_st[$ol_val['id']]['total_price_of_order'];
                        if ($order_list[$ol_key]['total_amount'] < $order_item_jd_st[$ol_val['id']]['total_price_of_order']){
                            $order_list[$ol_key]['total_amount'] = ((($order_list[$ol_key]['total_amount']/$order_item_jd_st[$ol_val['id']]['total_price_of_order'])) * $order_item_st[$ol_val['id']]['total_price_of_order']);
                        }else{
                            $order_list[$ol_key]['total_amount'] = $order_item_st[$ol_val['id']]['total_price_of_order'];
                        }
                    }else{
                        $order_list[$ol_key]['grand_total'] = 0;
                    }
                    if(isset($order_item_st[$ol_val['id']]) && $order_item_st[$ol_val['id']]['created_on']){
                        $order_list[$ol_key]['created_on'] = $order_item_st[$ol_val['id']]['created_on'];
                    }
                }
            }
        }
    }

    public function detail($order_id='')
    {
    	if($order_id != ''){
    		//echo $order_id;
            $order_detail = [];
    		$order = $this->db->get_where('orders', ['id' => $order_id])->row_array();
    		if(count($order) > 0){    
                //print_r($order);
                
                //calculate progress
                $order_detail['progress'] = 0;
                $all_items = $this->db->get_where('order_items', ['order_id' => $order_id]);
                $all_items = $all_items->num_rows();

                $complete_items = $this->db->get_where('order_items', ['order_id' => $order_id, 'status' => 3]);
                if($complete_items->num_rows() > 0){
                    $complete_items = $complete_items->num_rows();
                    $order_detail['progress'] = ((int)$complete_items / (int)$all_items) * 100;
                }
            }
            
            $order_items = $this->db->get_where('order_items', ['order_id' => $order_id, 'status !=' => 100])->result_array();
    		
            $package_detail = [];
    		if(count($order_items) > 0){
				$package_detail['package_deadline'] = 0;
				$package_detail['design_time'] = 0;
                $package_detail['logo_time'] = 0;
                $package_detail['addon_deadline'] = 0;
				$package_detail['order_deadline'] = 0;
				
    			foreach ($order_items as $key => $item) {

                    $content_uploaded = FALSE;
                    if($item['item_type'] == 'logo' || $item['item_id'] == 76){
                        $content_uploaded_detail = $this->db->get_where('answers_brand', ['order_id' => $item['order_id']])->row_array();
                        if($content_uploaded_detail){
                            $content_uploaded = TRUE;
                            $order_items[$key]['content_uploaded_date'] = $content_uploaded_detail['created_on'];
                        }
                    }else{
                        $content_uploaded_detail = $this->db->get_where('answer_design', ['order_id' => $item['order_id']])->row_array();
                        if($content_uploaded_detail){
                            $content_uploaded = TRUE;
                            $order_items[$key]['content_uploaded_date'] = $content_uploaded_detail['created_on'];
                        }
                    }
                    if($content_uploaded){
                        $time_unit_detail = $this->db->get_where('designs', ['id' => $item['item_id']])->row_array();
                        if($time_unit_detail){
                            $order_items[$key]['unit_time'] = $time_unit_detail['time'];
                        }else{
                            $order_items[$key]['unit_time'] = 0;
                        }
                    }


                    $package_detail['order_deadline'] += (float)$item['subtotal_time'];
    				// get package name
					if($item['item_type'] == 'package'){
						$package_detail['package_name'] = $item['item_name'];
						$package_detail['package_time'] = $item['subtotal_time'];
						$package_detail['package_deadline'] += (float)$package_detail['package_time'];
					}
					// get total design time
					if($item['item_type'] == 'design' && $item['subtotal_time'] != 0){
						$package_detail['design_time'] += (float)$item['subtotal_time'];
						$package_detail['package_deadline'] += (float)$package_detail['design_time'];
					}
					// get logo total time if exist
					if($item['item_type'] == 'logo' && $item['subtotal_time'] != 0){
						$package_detail['logo_time'] += (float)$item['subtotal_time'];
						$package_detail['package_deadline'] += (float)$package_detail['logo_time'];
					}
                    // get add on total time if exist
                    if(in_array($item['item_type'], ['addon','custom_addon']) && $item['subtotal_time'] != 0){
                        $package_detail['addon_deadline'] += (float)$item['subtotal_time'];
                    }
	            }
    		}

            //Adjustments time
            $adjustments = $this->db->select_sum('subtotal_time')->from('adjustment_items')->where(['order_id' => $order_id, 'status' => 1])->get()->row_array();
            $adjustments_time = $adjustments['subtotal_time'];

            //deadline date
            $the_deadline = (float)$package_detail['addon_deadline'] + (float)$package_detail['package_deadline'] + (float)$adjustments['subtotal_time'];
            $order_detail['last_date'] = date('Y-m-d', strtotime($order['created_on'].' +'.ceil($the_deadline).' days'));
            //$order_detail['time_left'] = round((strtotime($order_detail['last_date']) - time()) / (60 * 60 * 24));
                

            // Questionnaire (branding)
            //$q = $this->db->get_where('answers_brand', ['order_id' => $order_id])->result_array();
            $this->db->select('questions_brand.question as question, answers_brand.*');
            $this->db->from('answers_brand');
            $this->db->join('questions_brand', 'answers_brand.question_id = questions_brand.id', 'LEFT');
            $this->db->where('answers_brand.order_id', $order_id);
            $q = $this->db->get();
            $q = $q->result_array();
            //print_r($q);

            //Client Feedback
            $feedback = $this->db->get_where('client_feedback', ['order_id' => $order_id])->result_array();

            //Customer Info
            $customer = $this->db->get_where('users', ['id' => $order['user_id']])->row_array();

    		$this->template->load_admin('orders/detail',[
                'order' => $order,
    			'order_detail' => $order_detail,
    			'order_items' => $order_items,
                'package_detail' => $package_detail,
    			'brand_questionnaire' => $q,
                'feedback' => $feedback,
                'adjustments_time' => $adjustments_time,
                'customer' => $customer
    		]);
    	}
    }

    public function view_item($id='')
    {
        if($id != ''){
            //echo $id;
            $item = $this->db->get_where('order_items', ['id' => $id])->row_array();
            if(count($item) > 0){
                //print_r($item);
                $questionnaire = $this->db->get_where('answer_design', ['item_id' => $item['id']])->row_array();
                $history = $this->db->get_where('order_item_management', ['item_id' => $item['id']])->result_array();
                $adjustments = $this->db->get_where('adjustment_items', ['item_id' => $item['id']])->result_array();
                $this->template->load_admin('orders/item', [
                    'item' => $item,
                    'questionnaire' => $questionnaire,
                    'history' => $history,
                    'adjustments' => $adjustments
                ]);
            }
        }
    }

    public function view_item_update($id='')
    {
        if($id != ''){
            $this->db->update('order_items', ['status' => 1], ['id' => $id]);

            $item = $this->db->get_where('order_items', ['id' => $id])->row_array();
            if(count($item) > 0){
                $questionnaire = $this->db->get_where('answer_design', ['item_id' => $item['id']])->row_array();
                $history = $this->db->get_where('order_item_management', ['item_id' => $item['id']])->result_array();
                $adjustments = $this->db->get_where('adjustment_items', ['item_id' => $item['id']])->result_array();
                $this->template->load_admin('orders/item', [
                    'item' => $item,
                    'questionnaire' => $questionnaire,
                    'history' => $history,
                    'adjustments' => $adjustments
                ]);
            }
        }
    }

    public function approve_item_by_admin($item_id, $order_id)
    {
        //echo "string";die();    
        if($item_id && $order_id){
            $result = $this->db->update('order_items', ['status' => 3], ['id' => $item_id]);
            if($result){
                $this->db->update('order_items', ['status' => 0], ['order_id' => $order_id, 'status' => 5]);
                $this->session->set_flashdata('success', 'Item has been approved by Admin successfully!');
            }else{
                $this->session->set_flashdata('error', 'Item has been failed to self approve.');
            }

            redirect(base_url('admin/orders/item/'.$item_id));
        }else{
            show_404();
        }
    }

    public function delivery_files()
    {
        if( ! empty($_FILES['files']['name'])){
            //print_r($_FILES);
            //print_r($_POST);

            $item_id = $_POST['item_id'];
            $order_id = $_POST['order_id'];
            $remarks = $_POST['remarks'];

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

            $config['upload_path'] = $path;
            $config['allowed_types'] = 'ico|png|jpg|pdf|ai|psd|eps|indd|doc|docs|ppt|pptx|xlsx|xls|zip|ttf|ttc|otf|mov';
            //$config['max_size']             = 300;
            //$config['max_width']            = 512;
            //$config['max_height']           = 512;

            //$file = $this->files->upload('file', $config);

            $uploaded_file_ids = $this->files->multiUpload('files', $config);
            $data['delivery_files'] = implode(',', $uploaded_file_ids);
            $data['order_id'] = $order_id;
            $data['item_id'] = $item_id;
            $data['admin_remarks'] = $remarks;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = $this->User->id;

            $this->db->insert('order_item_management', $data);
            $this->db->update('order_items', ['status' => 2], ['id' => $item_id]);

            // enable content upload if customized bundle and branding items exist

            $logo_item = $this->db->get_where("order_items" , ['item_type' => 'logo' , 'order_id' => $order_id]);
            $items_info = $this->db->get_where("order_items" , ['id' => $item_id])->row_array(); 
            if($logo_item->num_rows() <= 0){

                $branding_ids_db = $this->db->get_where("designs" , ['category_id' => 1])->result_array();
                if($branding_ids_db){
                    $branding_ids = array_column($branding_ids_db, "id");
                }else{
                    $branding_ids = array();
                }
                if ($items_info['item_type'] == "addon" && !in_array($items_info['item_id'], $branding_ids)){
                    $this->db->update('order_items', ['status' => 0], ['order_id' => $order_id , 'status' => 5]);
                }
            }



            //print_r($_FILES);
            //print_r($_POST);

            //email for branding done
            $order_item = $this->db->get_where('order_items', ['id' => $item_id])->row_array();
            $order = $this->db->get_where('orders', ['id' => $order_id])->row_array();
            $customer = $this->db->get_where('users', ['id' => $order['user_id']])->row_array();
            
            //load customer's language for sending email
            $lang = $customer['language'];
            $this->lang->load('common',$lang);
            
            $email = $customer['email'];
            $btn_link = base_url('dashboard');
            $vars = [
                '{username}' => $customer['full_name'],
                '{email}' => $email,
                '{order_id}' => $order_id,
                '{btn_link}' => $btn_link,
                '{bundle_name}' => '<span style="color: #b172ac;">'.$order['project_name'].'</span>',
                '{order_name}' => $order['project_name']
            ];
            if($order_item['item_type'] == 'logo'){
                $view = 'branding-artwork-done';
                $this->et->template($email, 'branding_done', $vars, $view, true, $lang);
            }else{
                $view = 'item-artwork-done';
                $this->et->template($email, 'artwork_done', $vars, $view, true, $lang);
            }
        }
    }

    public function pdfdoc()
    {
        /*ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);*/

        $order_summery_qry = $this->db->select('designs.name_english, designs.name_arabic, designs.category_id, order_items.item_name, order_items.item_type, order_items.subtotal_price, order_items.item_id, order_items.id')
                ->from('designs')
                ->join('order_items', 'designs.id = order_items.item_id')
                ->where(['order_items.order_id' => '738', 'order_items.trans_id' => 'TRN2063560916'])
                ->order_by('designs.category_id', 'ASC')
                ->order_by('order_items.item_name', 'ASC')
                ->get();
        if ($order_summery_qry->num_rows() > 0) {

            $order_item_jd_st = $order_summery_qry->result_array();

            $pos = array_search('package', array_column($order_item_jd_st, 'item_type'));
            if ($pos !== false) {
                $bundl_name = $order_item_jd_st[$pos]['name_english'];
            } else {
                $bundl_name = 'Customized Bundl';
            }

            $order_details = $this->db->get_where('orders', ['id' => '738'])->row_array();

            $order_item_jd_st = $this->common_model->jd_array($order_item_jd_st , "category_id");
            // echo "<pre>";
            // print_r($order_item_jd_st);
        } else {

        }
        // return false;


        $email = 'awais@appliconsoft.com';
        $this->load->library('Pdf');
        // if(!$this->load->is_loaded('Pdf')){
        //     echo "noah";
        // }else{
        //     echo "yeah";
        // }
        $html = $this->load->view('invoice', ['order_summery' => $order_item_jd_st, 'bundl_name' => $bundl_name, 'order_details' => $order_details], true);
        
        // $html = '<h1 style="color: red;">Zain</h1>';
        $this->pdf->createPDF($html, 'invoice.pdf', FALSE);

        // echo "<pre>";
        // print_r(file_get_contents("invoice.pdf"));

        // move_uploaded_file($invoicePDF,"uploads/invoice.pdf");

        return false;

        $mail = new PHPMailer(true);
        $mail->SMTPDebug = FALSE;                               
        $mail->isSMTP();            
        $mail->Host = "bundldesigns.com";
        $mail->SMTPAuth = TRUE;                          
        $mail->Username = "no-reply@bundldesigns.com";                 
        $mail->Password = "Rb4PSd#oR7xg";                           
        $mail->SMTPSecure = "tls";                           
        $mail->Port = 587;  
        $mail->isHTML(true);
        $mail->CharSet  = "UTF-8";
        $mail->AddAttachment('uploads/invoice.pdf', '', $encoding = 'base64', $type = 'application/pdf');
        // $mail->AddAttachment($invoicePDF,'application/pdf','invoice.pdf', false);
        $mail->From = "no-reply@bundldesigns.com";
        $mail->addReplyTo('no-reply@bundldesigns.com', 'BUNDL DESIGNS');
        $mail->FromName = "BUNDL DESIGNS";
        if(is_array($email)){
            foreach ($email as $email_key => $email_val) {
                $mail->addAddress($email_val);
            }
        }else{
            $mail->addAddress($email);
        }
        $mail->addBCC('info@bundldesigns.com');
        $mail->Subject = '$subject';
        $mail->Body = '$email_message' ;
        try {
            $mail->send();
            return TRUE;
        }catch (Exception $e) {
            return FALSE;
        }


        // $this->load->library('pdf');
        // $html = $this->load->view('GeneratePdfView', [], true);
        // $this->pdf->createPDF($html, 'mypdf', false);
    }

    public function complete_order_items($id='')
    {
        //update order item status to done
        $this->db->update('order_items', ['status' => 3],['order_id' => $id, 'status !=' => 100]);
        $this->session->set_flashdata('success', 'Order items has been done by Admin successfully!');
        redirect(base_url('admin/orders/detail/'.$id));
    }

    public function client_feedback($id='')
    {
        $feedback = $this->db->order_by('id', 'DESC')->get('client_feedback')->result_array();
        $feedbacks = $this->common_model->jd_array($feedback,'order_id');

        $this->template->load_admin('dashboard/feedback',['feedbacks'=>$feedbacks]);
    }

    public function transaction_log($id='')
    {
        if ($id != '') {
            $query = $this->db->get_where('transaction_log',['order_id' => $id]);
            $qry = $this->db->get_where('orders',['id' => $id])->row_array();
            $pay_qry = $this->db->get_where('payments',['order_id' => $id, 'payment_status' => 1]);
            if ($pay_qry->num_rows() > 0) {
                $pay_data = $pay_qry->result_array();
                $trans_ids = array_column($pay_data, 'trans_id');
            }
            if ($query->num_rows() > 0 && in_array($qry['trans_id'], array_column($query->result_array(), 'cart_id'))) {
                $dataBatch = [];
                if (isset($trans_ids) && !empty($trans_ids)) {
                    foreach ($trans_ids as $t_key => $t_val) {
                        if (in_array($t_val, array_column($query->result_array(), 'cart_id'))) {
                            continue;
                        } else {

                            $response = $this->transQuery($t_val);
                            if(is_array($response)){
                                $dataArray = array(
                                    'order_id' => $id,
                                    'payment_id' => $pay_data[$t_key]['id'],
                                    'addon_item_ids' => '',
                                    'adjustment_item_ids' => $pay_data[$t_key]['item_ids'],
                                    'tran_ref' => $response[0]->tran_ref,
                                    'tran_type' => $response[0]->tran_type,
                                    'cart_id' => $response[0]->cart_id,
                                    'cart_description' => $response[0]->cart_description,
                                    'cart_currency' => $response[0]->cart_currency,
                                    'cart_amount' => $response[0]->cart_amount,
                                    'name' => $response[0]->customer_details->name,
                                    'email' => $response[0]->customer_details->email,
                                    'ip' => $response[0]->customer_details->ip,
                                    'response_status' => $response[0]->payment_result->response_status,
                                    'response_code' => $response[0]->payment_result->response_code,
                                    'response_message' => $response[0]->payment_result->response_message,
                                    'acquirer_message' => $response[0]->payment_result->acquirer_message,
                                    'acquirer_rrn' => $response[0]->payment_result->acquirer_rrn,
                                    'transaction_time' => $response[0]->payment_result->transaction_time,
                                    'card_type' => $response[0]->payment_info->card_type,
                                    'card_scheme' => $response[0]->payment_info->card_scheme,
                                    'payment_description' => $response[0]->payment_info->payment_description,
                                    'created_on' => $pay_data[$t_key]['created_on']
                                );
                                array_push($dataBatch, $dataArray);
                            }
                        }
                    }
                    if (isset($dataBatch) && !empty($dataBatch)) {
                        $this->db->insert_batch('transaction_log', $dataBatch);
                        $this->transaction_log($id);
                    } else {
                        $result = $query->result_array();
                            $this->template->load_admin('orders/transaction',[
                            'trans' => $result
                        ]);
                    }
                } else {
                    $result = $query->result_array();
                        $this->template->load_admin('orders/transaction',[
                        'trans' => $result
                    ]);
                }
            } else {

                $response = $this->transQuery($qry['trans_id']);
                if(is_array($response)){
                    $dataArray = array(
                        'order_id' => $id,
                        'tran_ref' => $response[0]->tran_ref,
                        'tran_type' => $response[0]->tran_type,
                        'cart_id' => $response[0]->cart_id,
                        'cart_description' => $response[0]->cart_description,
                        'cart_currency' => $response[0]->cart_currency,
                        'cart_amount' => $response[0]->cart_amount,
                        'name' => $response[0]->customer_details->name,
                        'email' => $response[0]->customer_details->email,
                        'ip' => $response[0]->customer_details->ip,
                        'response_status' => $response[0]->payment_result->response_status,
                        'response_code' => $response[0]->payment_result->response_code,
                        'response_message' => $response[0]->payment_result->response_message,
                        'acquirer_message' => $response[0]->payment_result->acquirer_message,
                        'acquirer_rrn' => $response[0]->payment_result->acquirer_rrn,
                        'transaction_time' => $response[0]->payment_result->transaction_time,
                        'card_type' => $response[0]->payment_info->card_type,
                        'card_scheme' => $response[0]->payment_info->card_scheme,
                        'payment_description' => $response[0]->payment_info->payment_description,
                        'created_on' => $qry['created_on']
                    );
                    $this->db->insert('transaction_log', $dataArray);
                    $this->transaction_log($id);
                }else{
                    $this->template->load_admin('orders/transaction',[
                        'trans' => []
                    ]);
                }
            }
        }
    }

    public function complete_order($id='')
    {
        //ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
        if($id != ''){
            $order = $this->db->get_where('orders', ['id' => $id]);
            if($order->num_rows() > 0){
                $order = $order->row_array();
                
                //update order status to complete
                $this->db->update('orders', ['order_status' => 2],['id' => $id]);
                
                //get customer detail
                $user = $this->db->get_where('users', ['id' => $order['user_id']])->row_array();
                
                //email for feedback
                $view = 'feedback';
                $btn_link = base_url('feedback');
                $contact_url = base_url('contact-us');
                $email = $user['email'];
                $vars = [
                    '{email}' => $email,
                    '{btn_link}' => $btn_link,
                    '{contact_url}' => $contact_url
                ];
                $this->et->template($email, 'artwork_downloaded', $vars, $view, true, $user['language']);
                
                //recommend us email

                $email_promo = $user['email'];
                $full_name = $user['full_name'];
                
                $email_data_promo['notification'] = $this->db->get_where('email_templates', ['slug' => 'recommend-us'])->row_array();
                $email_data_promo['language'] = $user['language'];
                
                $settings = $this->db->get('settings')->row_array();
                $facebook = $settings['facebook'];
                $instagram = $settings['instagram'];
                $linked_in = $settings['linked_in'];
                $twitter = $settings['twitter'];

                $rec_link = base_url('recommend');

                $email_message_promo = $this->load->view('email_templates/recommend-us', $email_data_promo, true);
                $email_message_promo = str_replace("{name}", $full_name, $email_message_promo);
                $email_message_promo = str_replace("{email}", $email, $email_message_promo);
                $email_message_promo = str_replace("{link_activation}", $rec_link, $email_message_promo);

                $email_message_promo = str_replace("{facebook}", $facebook, $email_message_promo);
                $email_message_promo = str_replace("{instagram}", $instagram, $email_message_promo);
                $email_message_promo = str_replace("{linked_in}", $linked_in, $email_message_promo);
                $email_message_promo = str_replace("{twitter}", $twitter, $email_message_promo);

                /*print_r($email_message_promo);
                echo $email_promo;
                die();*/

                $this->email->clear();
                
                // $this->email->from('no-reply@bundldesigns.com', 'BUNDL DESIGNS');
                // $this->email->to($email_promo);
                // $this->email->subject('BundlDesigns');
                // $this->email->message($email_message_promo);
                // $result_email = $this->email->send();
                $result_email = $this->et->send_general_email($email_promo , 'BundlDesigns' , $email_message_promo);

                /*if( ! $result_email) {
                    echo $this->email->print_debugger();
                    die();
                }*/

                //recommend us email end


                redirect(base_url('admin/orders'));
            } else {
                show_404();
            }
        } else {
            show_404();
        }
    }
    public function delete(){
        $this->delete_all_entries_related_order($this->uri->segment(4));
        $this->delete_all_files_related_order($this->uri->segment(4));
        redirect(base_url('admin/orders/'),'refresh');
    }
    protected function delete_all_entries_related_order($order_id){


        //delete from files table first

        $attachments1 = array();
        $attachments2 = array();
        $attachments3 = array();
        $attachments4 = array();


        $this->db->select("attachments");
        $this->db->where("order_id" , $order_id);
        $attachments_r = $this->db->get("adjustment_items")->result_array();

        if(!empty($attachments_r)){
            $attachments1 = array_column($attachments_r, "attachments");
        }

        $this->db->select("delivery_files");
        $this->db->where("order_id" , $order_id);
        $attachments_r = $this->db->get("order_item_management")->result_array();

        if(!empty($attachments_r)){
            $attachments2 = array_column($attachments_r, "delivery_files");
        }

        $this->db->select("attachment");
        $this->db->where("order_id" , $order_id);
        $attachments_r = $this->db->get("answer_design")->result_array();

        if(!empty($attachments_r)){
            $attachments3 = array_column($attachments_r, "attachment");
        }


        $this->db->select("answer");
        $this->db->where("order_id" , $order_id);
        $this->db->where("question_id" , "16");
        $attachments_r = $this->db->get("answers_brand")->result_array();

        if(!empty($attachments_r)){
            $attachments4 = array_column($attachments_r, "answer");
        }

        $files = array_merge($attachments1 , $attachments2 , $attachments3 , $attachments4);
        $file_ids = array();

        if(!empty($files)){
            foreach ($files as $f_key => $f_val) {
                if($f_val != ""){
                    $ids = explode(',', $f_val);
                    $file_ids = array_merge($file_ids , $ids);
                }
            }
        }
        
        if(!empty($file_ids)){
            $this->db->where_in("id" , $file_ids);
            $this->db->delete("files");
        }

        // Deleting orders ddata from tables

        $this->db->where("order_id" , $order_id);
        $this->db->delete("adjustment_items");

        $this->db->where("order_id" , $order_id);
        $this->db->delete("answers_brand");

        $this->db->where("order_id" , $order_id);
        $this->db->delete("answer_design");

        $this->db->where("order_id" , $order_id);
        $this->db->delete("order_items");

        $this->db->where("order_id" , $order_id);
        $this->db->delete("order_item_management");

        $this->db->where("id" , $order_id);
        $this->db->delete("orders");

    }
    protected function delete_all_files_related_order($order_id){
        $this->removeDirectory(DOCUMENT_ROOT.'uploads/orders/'.$order_id);
    } 
    protected function removeDirectory($path) {

        $files = glob($path . '/*');
        foreach ($files as $file) {
            is_dir($file) ? $this->removeDirectory($file) : @unlink($file);
        }
        @rmdir($path);

        return;
    }
    protected function transQuery($tran_ref)
    {
        $merchant_email='hala.alhussaini@gmail.com';
        $secret_key='nOiZ1L2lukUrIRPq3tsxKMQn653rsLqQAJQCvSYZdSqVKgmNJOltAcRGhV8KHyBihrUMkTLxMctxsPlcEHGeTyVbt4VaCwsUYnHi';
        $merchant_id='10041761';

        $params = [
            'merchant_email'=>$merchant_email,
            'merchant_id'=>$merchant_id,
            'secret_key'=>$secret_key
        ];
                 
        $this->load->library('Paytabs',$params);

        $response = $this->paytabs->getPaymentQuery(["cart_id" => $tran_ref]);
        return json_decode($response);
    }
}