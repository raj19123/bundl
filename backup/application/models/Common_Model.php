<?php
class Common_Model extends CI_Model
{

	function __construct()
	{
        // Call the Model constructor
		parent::__construct();
		$this->load->library('image_lib');
		$this->load->library('encryption');
	}

    public function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
		    $randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
    
    public function update($tbl , $whr , $data){
    	$this->db->where($whr);
    	$this->db->update($tbl , $data);
    	return true;
    }
    public function get($tbl , $whr = '' , $slct = "" , $return_type = "array"){
    	if($slct != ""){
    		$this->db->select($slct);
    	}
    	if($whr != ""){
    		$this->db->where($whr);
    	}
    	$result = $this->db->get($tbl);
        if($result->num_rows() > 0){
            if($return_type == "array"):
                return $result->result_array();
            else:
                return $result->row_array();
            endif;    
        }else{
            return false;
        }
    }
    public function log($tbl , $data){
            $this->db->insert($tbl,$data);
            $inserted_id = $this->db->insert_id();
            return $inserted_id;
    }
    public function delete($whr , $tbl){

        $this->db->where($whr);
        return $this->db->delete($tbl);
    }
    public function isExist($whr , $tbl){
        $this->db->where($whr);
        $query = $this->db->get($tbl);
        if($query->num_rows() > 0):
            return $query->result_array()[0]['id'];
        else:
            return false;
        endif;
    }
    public function insert_batch($tbl , $data){

        $this->db->insert_batch($tbl , $data);
        return TRUE;
    }
  
    public function group_assoc($arr , $key){

        $result = array();
        if(!empty($arr)){
            foreach ($arr as $arr_key => $arr_val) {
                $result[$arr_val[$key]][] = $arr_val;
            }
            return $result;
        }else{
            return $arr;
        }
    }
    public function smart_array($arr , $key){

        $result = array();
        if(!empty($arr)){
            foreach ($arr as $arr_key => $arr_val) {
                $result[$arr_val[$key]] = $arr_val;
            }
            return $result;
        }else{
            return $arr;
        }
    }
    public function jd_array($arr , $key){

        $result = array();
        if(!empty($arr)){
            foreach ($arr as $arr_key => $arr_val) {
                $result[$arr_val[$key]][] = $arr_val;
            }
            return $result;
        }else{
            return $arr;
        }
    }
}