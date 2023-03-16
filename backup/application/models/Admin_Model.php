<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_Model extends CI_Model
{
	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	public function login_check($username, $password)
	{
		$query = $this->db->get_where('users', [
			'email' => $username,
			'password' => $password,
			'role' => '2',
			'status' => '1',
			'email_verification_status' => '1'
		]);
       // echo $this->db->last_query(); die;
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
	
	public function update_user($data, $id){
		$this->db->where('id', $id);
		$return=$this->db->update('users', $data);		
		//print_r($data); die;
		return $return;
	}

	public function get_user_by_id($id)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('id', $id);
		$item = $this->db->get();
		if($item->num_rows()> 0 ){
			return $item->result_array();
		}else{
			return false;
		}
		exit();	
	}

	public function check_users_oldpassword($id,$password){
		$this->db->select('*');
        $this->db->from('users'); 
        $this->db->where('id',$id);
        $this->db->where('password',$password);
        $result = $this->db->get()->first_row();
        return $result;
	}
}	