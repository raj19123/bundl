<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Package_Model extends CI_Model
{
	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	public function get_packages_list()
	{
		$this->db->select('packages.*, package_categories.name_english as category_name_english, package_categories.name_arabic as category_name_arabic');
		$this->db->from('packages');
		$this->db->join('package_categories', 'packages.category_id = package_categories.id', 'left');
		$query = $this->db->get();
		$data = $query->result_array();
		return ($data) ? $data : false;
	}

	public function get_packages()
	{
		$data = $this->db->get('packages')->result_array();
		return ($data) ? $data : false;
	}

	public function get_package_cats()
	{
		$data = $this->db->get('package_categories')->result_array();
		return ($data) ? $data : false;
	}

	public function get_row($id="")
	{
		if( ! empty($id)){
			$row = $this->db->get_where('packages', ['id' => $id])->row_array();
			return ($row) ? $row : false;
		}
	}

	public function update($id="", $data=array())
	{
		if( ! empty($data)){
			$result = $this->db->update('packages', $data, array('id' => $id));
			return $result;
		}
	}

	public function add($data=array())
	{
		if( ! empty($data)){
			$result = $this->db->insert('packages', $data);
			return $result;
		}
	}

	public function delete($id="")
	{
		if( ! empty($id)){
			$result = $this->db->delete('packages', array('id' => $id));
			return $result;
		}
	}

	public function get_selected_designs($component_id="")
	{
		if( ! empty($component_id)){
			$select = "
				component_design.id AS component_design_id,
				component_design.component_id AS component_id,
				component_design.design_id AS design_id,
				component_design.quantity AS quantity,
				component_design.created_on AS updated_on,
				designs.name_english AS design_name
			";
			$this->db->select($select)->from('component_design');
			$this->db->join('designs', 'designs.id = component_design.design_id');
			$this->db->where('component_design.component_id', $component_id);
			$result = $this->db->get();
			return ($result->num_rows() > 0) ? $result->result_array() : false;
		}
	}

	public function get_components()
	{
		$data = $this->db->get_where('package_components', ['status' => 1])->result_array();
		return ($data) ? $data : false;
	}

	public function get_selected_componenets($package_id="")
	{
		if( ! empty($package_id)){
			$this->db->reset_query();
			$this->db->select('component_id');
			$this->db->where('package_id', $package_id);
			$result = $this->db->get('component_package');
			return ($result->num_rows() > 0) ? $result->result_array() : false; 
		}
	}

	public function get_component_ids($package_id='')
	{
		if($package_id != ''){
			$this->db->reset_query();
			$this->db->select('component_id');
			$this->db->where('package_id', $package_id);
			$components = $this->db->get('component_package');
			$component_ids =  ($components->num_rows() > 0) ? $components->result_array() : array();
			
			$ids = [];
			if($component_ids){
				foreach ($component_ids as $key => $value) {
					$ids[] = $value['component_id'];
				}
			}
			return $ids;
		}
	}

	public function get_design_ids($component_ids=array())
	{
		if($component_ids){
			$design_ids = $this->db->where_in('component_id', $component_ids)->get('component_design')->result_array();

			$ids = [];
			if($design_ids){
				foreach ($design_ids as $key => $value) {
					$ids[] = $value['design_id'];
				}
			}
			return $ids;
		}
	}
}