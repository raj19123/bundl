<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pages_Model extends CI_Model
{
	
	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	//	$this->load->model('Portfolio_model','portfolio_model');
	}

	public function update_page($id,$data)
	{
		$this->db->where('id', $id);
		$return =  $this->db->update('switch_content_page_0', $data);
		return $return;
	}
	
	public function get_page($id)
	{
		$this->db->select('*');
		$this->db->from('switch_content_page_0');
		$this->db->where('id', $id);
		return $this->db->get()->result_array();
	}

	public function get_url_and_subscription()
	{
		$this->db->select('*');
		$this->db->from('url_and_subscription');
		return $this->db->get()->result_array();
	}
	
	public function get_faqs($type)
	{
		$this->db->select('*');
		$this->db->from('faqs');
		$this->db->where('type', $type);
		$this->db->where('status', 'Enable');
		$this->db->order_by('question_order', 'desc');
		return $this->db->get()->result_array();
	
	}	

	public function url_and_subscription($id, $data)
	{
		$this->db->where('id', $id);
		$return =  $this->db->update('url_and_subscription', $data);
		return $return;
	}

	public function url_and_subscription_save($data)
	{
		// $this->db->where('id', $id);
		$return =  $this->db->insert('url_and_subscription', $data);
		return $return;
	
	}

	public function insert_about_form($data)
	{
		return $this->db->insert('about_us',$data);
	}
	
	
	public function insert_contact_form($data)
	{		
		return $this->db->insert('contact_us',$data);
	}
	
	
	
}	