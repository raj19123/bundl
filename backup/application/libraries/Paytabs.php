<?php defined('BASEPATH') OR exit('No direct script access allowed');
  
define("AUTHENTICATION", "https://www.paytabs.com/apiv2/validate_secret_key");
define("PAYPAGE_URL", "https://www.paytabs.com/apiv2/create_pay_page");
define("VERIFY_URL", "https://www.paytabs.com/apiv2/verify_payment");

class Paytabs
{

    public $merchant_id;
    public $secret_key;
    public $api_key;
  
    public function __construct($params)
    {
      	//parent::__construct($base_url,$api_key,$timeout='');

        if(!function_exists('curl_init')) 
        {
            throw new RuntimeException('Paytabs requires cURL module');
        }
        $this->merchant_email = $params['merchant_email'];
        $this->merchant_id = $params['merchant_id'];
        $this->secret_key = $params['secret_key'];
        $this->api_key = "";
    }
  
    function authentication(){
        $obj = json_decode($this->runpost(AUTHENTICATION, array("merchant_email"=> $this->merchant_email, "secret_key"=>  $this->secret_key)));
        if($obj->access == "granted")
            $this->api_key = $obj->api_key;
        else 
            $this->api_key = "";
        return $this->api_key;
    }
    
    function create_pay_page($values) {
        $values['merchant_email'] = $this->merchant_email;
        $values['secret_key'] = $this->secret_key;
        $values['ip_customer'] = $_SERVER['REMOTE_ADDR'];
        $values['ip_merchant'] = $_SERVER['SERVER_ADDR'];
        return json_decode($this->runpost(PAYPAGE_URL, $values));
        //$res = json_decode($this->runpost(PAYPAGE_URL, $values));
        //print_r($res);die();
    }
    
     function verify_payment($payment_reference){
        $values['merchant_email'] = $this->merchant_email;
        $values['secret_key'] = $this->secret_key;
        $values['payment_reference'] = $payment_reference;
        return json_decode($this->runpost(VERIFY_URL, $values));
    }
    
    function runpost($url, $fields) {
        $fields_string = "";
        foreach ($fields as $key => $value) {
            $fields_string .= $key . '=' . $value . '&';
        }
        rtrim($fields_string, '&');
        $ch = curl_init();
        $ip = $_SERVER['REMOTE_ADDR'];

        $ipaddress = array(
            "REMOTE_ADDR" => $ip,
            "HTTP_X_FORWARDED_FOR" => $ip
        );
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $ipaddress);
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_REFERER, 1);

        $result = curl_exec($ch);
        //print_r($result);
        curl_close($ch);
        
        return $result;
    }  


    //PayTabs v2
    function makePayPage($data=array())
    {
        if(empty($data)){
            return;
        }

        //print_r($data);die();

        if(isset($_SESSION['test_enabled'])){
    		$server_key = "S6JN9ZWK2T-JBJN2DTKTZ-NTKN66TW9T"; //test bundl key
            $data['profile_id'] = 60516; //test Bundl
        }else{
            $server_key = "SDJN9ZWKNL-JBJZGBDRJW-KWZRRNB6BB"; //live bundl key
            $data['profile_id'] = 63543; //live bund
    	}	

        $data = json_encode($data);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://secure.paytabs.sa/payment/request",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                "content-type: application/json",
                "authorization: ".$server_key
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }

    // transaction query
    function getPaymentQuery($data=array(), $isLive=true)
    {
        if ($isLive) {
            $server_key = "SDJN9ZWKNL-JBJZGBDRJW-KWZRRNB6BB"; //live bundl key
            $data['profile_id'] = 63543; //live Bundl
        } else {
            $server_key = "S6JN9ZWK2T-JBJN2DTKTZ-NTKN66TW9T"; //test bundl key
            $data['profile_id'] = 60516; //test Bundl
        }

        $data = json_encode($data);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://secure.paytabs.sa/payment/query",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                "content-type: application/json",
                "authorization: ".$server_key
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }
}