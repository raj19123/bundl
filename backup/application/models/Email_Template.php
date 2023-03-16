<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once($_SERVER['DOCUMENT_ROOT'].'/'. 'vendor/autoload.php');  
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class Email_Template extends CI_Model
{
    public $language;
    public function __construct()
    {
        parent::__construct();
        //$this->load->helper('email');
        //$this->load->library('email');
        $this->load->model("Common_Model" , "common_model");
        $this->setup_email();
        $this->language = ($this->session->userdata('site_lang')) ? $this->session->userdata('site_lang') : 'english';
    }

    public function setup_email()
    {
        $config['protocol'] = 'smtp';
        $config['smtp_crypto'] = 'ssl';
        $config['smtp_host'] = 'bundldesigns.com';
        $config['smtp_user'] = 'no-reply@bundldesigns.com';
        $config['smtp_pass'] = 'Rb4PSd#oR7xg';
        $config['smtp_port'] = 465;
        //$config['smtp_timeout'] = 30;
        $config['newline'] = "\r\n";
        $config['mailtype'] = "html";
        $config['starttls'] = true;
        $this->load->library('email', $config);
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from('no-reply@bundldesigns.com', 'BUNDL DESIGNS');
    }

    public function template($email='', $slug='', $vars=array(), $view='common_template', $btn=false, $lang='')
    {   
        $this->setup_email();
        if(!empty($slug)){
            $notification = $this->db->get_where('email_templates', ['slug' => $slug])->row_array();
            $vars['{contact_url}'] = base_url('contact-us');
            
            $language = $this->language;
            if(empty($language)){
                $language = 'english';
            }

            //if admin is logged in than get customer's language
            //only admin can send $lang parameter
            if( ! empty($lang)){
                $language = $lang;
            }

            $data = [
                'btn' => $btn,
                'notification' => $notification,
                'language' => $language
            ];
            if ($view == 'questionnaire-complete' || $view == 'branding-approved' ) {
                $data['logo_adjustments'] = $vars['logo_adjustments'];
                unset($vars['logo_adjustments']);
            }
            $whereJd = ['order_items.order_id' => $vars['{order_id}']];
            if ($view == 'payment_receipt' || $view == 'order-confirmation' || 'order-adjustment') {
                // $data['cartJd'] = $vars['cartJd'];
                // unset($vars['cartJd']);
                $whereJd = ['order_items.order_id' => $vars['{order_id}'], 'order_items.trans_id' => $vars['{cartJd}']];
            }

            if (isset($vars['{order_id}']) && !empty($vars['{order_id}'])) {
                $data['all_adj_item_ids'] = [];
                $adj_summary_pro = [];
                $adj_check = $this->db->get_where('adjustment_items', ['trans_id' => $vars['{cartJd}']]);
                if ($adj_check->num_rows() > 0) {
                    $all_adj_data = $adj_check->result_array();
                    $all_adj_item_ids = array_column($all_adj_data, 'item_id');
                    $data['all_adj_item_ids'] = $all_adj_item_ids;
                    // $adj_summary_pro = [];
                    foreach ($all_adj_data as $key => $value) {
                        $adj_summary_mini = $this->db->select('designs.name_english, designs.name_arabic, designs.category_id, order_items.item_name, order_items.item_type, order_items.subtotal_price, order_items.item_id, order_items.id')
                        ->from('designs')
                        ->join('order_items', 'designs.id = order_items.item_id')
                        ->where('order_items.id', $value['item_id'])
                        ->order_by('designs.category_id', 'ASC')
                        ->order_by('order_items.item_name', 'ASC')
                        ->get()->row_array();
                        $adj_summary_mini['subtotal_price'] = $value['subtotal_price'];
                        array_push($adj_summary_pro, $adj_summary_mini);
                    }

                    // $order_sum_q = $this->db->select('designs.name_english, designs.name_arabic, order_items.item_name, order_items.item_type, order_items.subtotal_price, order_items.item_id, order_items.id')
                    //     ->from('designs')
                    //     ->join('order_items', 'designs.id = order_items.item_id')
                    //     ->where_in('order_items.id', $all_adj_item_ids)
                    //     ->get();

                    // if ($order_sum_q->num_rows() > 0) {
                    //     $order_sum_d = $order_sum_q->result_array();
                    //     foreach ($order_sum_d as $d_key => $d_val) {
                    //         foreach ($all_adj_data as $key => $value) {
                                
                    //         }
                    //     }
                    // }

                } else {

                }

                $order_summery_qry = $this->db->select('designs.name_english, designs.name_arabic, designs.category_id, order_items.item_name, order_items.item_type, order_items.subtotal_price, order_items.item_id, order_items.id')
                ->from('designs')
                ->join('order_items', 'designs.id = order_items.item_id')
                ->where($whereJd)
                ->order_by('designs.category_id', 'ASC')
                ->order_by('order_items.item_name', 'ASC')
                ->get();
                if ($order_summery_qry->num_rows() > 0 && isset($adj_summary_pro) && !empty($adj_summary_pro)) {
                    // $data['order_summery'] = $order_summery_qry->result_array();
                    $data['order_summery'] = array_merge($adj_summary_pro, $order_summery_qry->result_array());
                } else if ($order_summery_qry->num_rows() > 0) {
                    $data['order_summery'] = $order_summery_qry->result_array();
                    // $adj_items_qry = $this->db->get_where('adjustment_items', ['trans_id' => $vars['{cartJd}']]);
                    // if ($adj_items_qry->num_rows() > 0) {
                    //     $adj_items = $adj_items_qry->result_array();
                        
                    //     $order_sum_qry = $this->db->select('designs.name_english,designs.name_arabic , order_items.item_name , order_items.item_type , order_items.subtotal_price , order_items.item_id , order_items.id')
                    //     ->from('designs')
                    //     ->join('order_items', 'designs.id = order_items.item_id')
                    //     ->where($whereJd)
                    //     ->where_in('order_items.id', array_column($adj_items, 'item_id'))
                    //     ->get();

                    //     if ($order_sum_qry->num_rows() > 0) {
                    //         $adj_items = $this->common_model->smart_array($adj_items, 'item_id');
                    //         $order_sum = $order_sum_qry->result_array();
                    //         foreach ($order_sum as $o_key => $o_val) {
                    //             $order_sum[$o_key]['subtotal_price'] = $adj_items[$o_val['id']]['subtotal_price'];
                    //         }
                    //         $data['order_summery'] = $order_sum;
                    //     } else {
                    //         $data['order_summery'] = [];
                    //     }
                    // } else {
                    //     $data['order_summery'] = [];
                    // }
                } else {
                    $data['order_summery'] = $adj_summary_pro;
                }
                // $data['order_summery'] = $this->db->select('item_name , item_type , subtotal_price')->get_where('order_items', ['order_id' => $vars['{order_id}']])->result_array();
                $data['order_adjustments'] = $this->db->select('item_name')->get_where('adjustment_items', ['order_id' => $vars['{order_id}'], 'trans_id' => $vars['{cartJd}']])->result_array();
                $data_grand_total = $this->db->select("grand_total , promo_code")->get_where("orders" , array("id" => $vars['{order_id}'], 'trans_id' => $vars['{cartJd}']));
                if ($data_grand_total->num_rows() > 0) {
                    $data['grand_total'] = $data_grand_total->row_array();
                } else {
                    $data['grand_total']['grand_total'] = '';
                    $data['grand_total']['promo_code'] = '';
                }
                if($data['grand_total']['promo_code']){
                    $data['payment_details'] = array();
                    $this->db->select("discount");
                    $this->db->where("code" , $data['grand_total']['promo_code']);
                    $coupon_detail = $this->db->get("coupons")->row_array();
                    $original_price = round($data['grand_total']['grand_total']/((100 - $coupon_detail['discount'])/100));
                    $discount_price = $original_price - $data['grand_total']['grand_total'];
                    $data['payment_details']['discount'] = $coupon_detail['discount'];
                    $data['payment_details']['total_price_paid'] = $data['grand_total']['grand_total'];
                    $data['payment_details']['discounted_amount'] = $discount_price;
                    $data['payment_details']['total_price'] = $original_price;

                }else{
                    $data['payment_details'] = array();
                    $data['payment_details']['discount'] = 0;
                    $data['payment_details']['total_price_paid'] = $data['grand_total']['grand_total'];
                    $data['payment_details']['discounted_amount'] = 0;
                    $data['payment_details']['total_price'] = $data['grand_total']['grand_total'];
                }
                
                // echo "<pre>";
                // print_r($this->User);
                // die();
            }
            $settings = $this->db->get('settings')->row_array();
            $vars['{facebook}'] = $settings['facebook'];
            $vars['{instagram}'] = $settings['instagram'];
            $vars['{linked_in}'] = $settings['linked_in'];
            $vars['{twitter}'] = $settings['twitter'];

            if ($view == 'payment_receipt') {
                //
                $isLive = true;
                if(isset($_SESSION['is_test_enabled'])){
                    unset($_SESSION['is_test_enabled']);
                    $isLive = false;
                }
            
                $merchant_email='hala.alhussaini@gmail.com';
                $secret_key='nOiZ1L2lukUrIRPq3tsxKMQn653rsLqQAJQCvSYZdSqVKgmNJOltAcRGhV8KHyBihrUMkTLxMctxsPlcEHGeTyVbt4VaCwsUYnHi';
                $merchant_id='10041761';

                $params = [
                    'merchant_email'=>$merchant_email,
                    'merchant_id'=>$merchant_id,
                    'secret_key'=>$secret_key
                ];
                         
                $this->load->library('Paytabs',$params);

                $response = $this->paytabs->getPaymentQuery(["cart_id" => $_REQUEST['cartId']], $isLive);
                $response = json_decode($response);

                //
                $order_item_jd_st = $data['order_summery'];

                $pos = array_search('package', array_column($order_item_jd_st, 'item_type'));
                if ($pos !== false) {
                    $bundl_name = $order_item_jd_st[$pos]['item_name'];
                } else {
                    $bundl_name = 'Customized Bundl';
                }

                $order_details = $this->db->get_where('orders', ['id' => $vars['{order_id}']])->row_array();

                $order_item_jd_st = $this->common_model->jd_array($order_item_jd_st , "category_id");

                //
                $this->load->library('Pdf');
                $html = $this->load->view('invoice', ['order_summery' => $order_item_jd_st, 'bundl_name' => $bundl_name, 'order_details' => $order_details, 'response' => $response], true);
                $this->pdf->createPDF($html, 'invoice.pdf', FALSE);
            }

            
            $email_message = $this->load->view('email_templates/'.$view, $data, true);


            if($vars){
                foreach ($vars as $key => $value) {
                    $email_message = str_replace($key, $value, $email_message);
                }
            }

            // print_r($email_message);die();
            if($slug == "special_coupon"){
                $subject = "Recommendation";
            }else{
                $subject = $notification['email_subject_'.$language];
            } 

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
            if ($view == 'payment_receipt') {
                $mail->AddAttachment('uploads/invoice.pdf', '', $encoding = 'base64', $type = 'application/pdf');
            }
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
            $mail->Subject = $subject;
            $mail->Body = $email_message ;
            try {
                $mail->send();
                return TRUE;
            }catch (Exception $e) {
                return FALSE;
            }

            // $this->email->to($email);
            // $this->email->bcc($this->config->item('admin_email'));
            // $this->email->subject($subject);
            // $this->email->message($email_message);
            // // echo $email_message;
            // // die();
            // $is_send = $this->email->send(FALSE);
            // // if($slug == "special_coupon"){
            // //     echo "<pre>";
            // //     $a = $this->email->print_debugger();
            // //     print_r($a);
            // // }
            // return ($is_send) ? true : false;
        }
    }
    
    public function send_general_email($email , $subject , $email_message){
        
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
            $mail->Subject = $subject;
            $mail->Body = $email_message ;
            try {
                $mail->send();
                return TRUE;
            }catch (Exception $e) {
                return FALSE;
            }
    }

    public function contactus_email($email='', $vars=array())
    {
            $data = [
                'notification' => $vars
            ];
            $email_message = $this->load->view('email_templates/contactus_email_template', $data, true);
            $this->email->to($email);
            $this->email->bcc($this->config->item('admin_email'));
            $this->email->bcc($this->config->item('admin_email'));
            $this->email->subject($vars['email_subject']);
            $this->email->message($email_message);
            $is_send = $this->email->send();
            return ($is_send) ? true : false;
    }

    public function forgot_password_email($email='', $vars=array(), $btn=false)
    {
        $description = 'You recently requested to reset your password for your Digital mining account. Click the below link to reset it. If you did not request a password reset, Please ignore this email.';

        $vars['{btn_text}'] = 'Reset Password';
        $vars['{btn_link}'] = $vars['{link_activation}'];
        $vars['{email_subject}'] = 'Forgot Password';
        $vars['{email_body}'] = $description;
        $data = [
            'btn' => $btn,
            'notification' => $vars
        ];
        $email_message = $this->load->view('email_templates/forgot_password_template', $data, true);
        if($vars){
            foreach ($vars as $key => $value) {
                $email_message = str_replace($key, $value, $email_message);
            }
        }
        // print_r($email_message);

        $this->email->to($email);
        $this->email->subject('Forgot Password');
        $this->email->message($email_message);
        $is_send = $this->email->send();
        return ($is_send) ? true : false;
    }

    public function user_registration_email($email='', $vars=array(), $btn=false)
    {
        $description = 'Welcome to Digital Mining. <br> To complete your account sign-up, please click on the button below to confirm your email.<br><small>Note: If you did not sign up for Digital Mining, there is no further action required from your end.</small>';

        $vars['{btn_text}'] = 'Verify';
        $vars['{btn_link}'] = $vars['{link_activation}'];
        $vars['{email_subject}'] = 'Account Registration';
        $vars['{email_body}'] = $description;
        $data = [
            'btn' => $btn,
            'notification' => $vars
        ];
        $email_message = $this->load->view('email_templates/forgot_password_template', $data, true);
        if($vars){
            foreach ($vars as $key => $value) {
                $email_message = str_replace($key, $value, $email_message);
            }
        }
        // print_r($email_message);

        $this->email->to($email);
        $this->email->bcc($this->config->item('admin_email'));
        $this->email->subject('Account Registration');
        $this->email->message($email_message);
        $is_send = $this->email->send();
        return ($is_send) ? true : false;
    }

    
}