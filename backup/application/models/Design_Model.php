<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Design_Model extends CI_Model
{
	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	public function get_designs_list()
	{
		$this->db->select('designs.*, design_categories.name_english as category_name_english, design_categories.name_arabic as category_name_arabic');
		$this->db->from('designs');
		$this->db->join('design_categories', 'designs.category_id = design_categories.id', 'left');
		$query = $this->db->get();
		$data = $query->result_array();
		return ($data) ? $data : false;
	}

	public function get_designs()
	{
		$data = $this->db->order_by("name_english", "ASC")->get_where('designs', ['status' => 1])->result_array();
		return ($data) ? $data : false;
	}

	public function get_design_cats()
	{
		$data = $this->db->get('design_categories')->result_array();
		return ($data) ? $data : false;
	}

	public function get_row($id="")
	{
		if( ! empty($id)){
			$row = $this->db->get_where('designs', ['id' => $id])->row_array();
			return ($row) ? $row : false;
		}
	}

	public function update($id="", $data=array())
	{
		if( ! empty($data)){
			$result = $this->db->update('designs', $data, array('id' => $id));
			return $result;
		}
	}

	public function add($data=array())
	{
		if( ! empty($data)){
			$result = $this->db->insert('designs', $data);
			return $result;
		}
	}

	public function delete($id="")
	{
		if( ! empty($id)){
			$result = $this->db->delete('designs', array('id' => $id));
			return $result;
		}
	}

	public function get_design_adjustments($id)
	{
		$select = '
			adjustments.id as adjustment_id,
			adjustments.name_english as adjustment_name_english,
			adjustments.name_arabic as adjustment_name_arabic,
			design_adjustments.design_id as design_id,
			design_adjustments.id as design_adjustments_id,
			design_adjustments.category as adjustment_category,
			design_adjustments.price as price,
			design_adjustments.time_limit as time_limit,
			design_adjustments.textbox as textbox,
			design_adjustments.attachment as attachment,
			design_adjustments.updated_on as updated_on
		';

		$this->db->select($select);
		$this->db->from('design_adjustments');
		$this->db->join('adjustments', 'design_adjustments.adjustment_id = adjustments.id', 'INNER');
		$this->db->where('design_adjustments.design_id', $id);
		$query = $this->db->get();
		return $query->result_array();
	}
}