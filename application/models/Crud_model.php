<?php

class Crud_model extends CI_Model {

	private $table_name = 'crud';
	private $view_name = 'crud_module';

	public function __construct() {
		parent::__construct();
		$this->db = $this->load->database('db', TRUE);
	}
	
	public function get_by_module($module_id){
		$query = $this->db->get_where($this->table_name, array('module_id' => $module_id));
		return $query->result();
	}
	
	public function get_by_user_group($user_group_id){
		$query = $this->db->get_where($this->view_name, array('user_group_id' => $user_group_id));
		return $query->result();
	}
	
	public function get_all($array = false) {
		$query = $this->db->get($this->table_name);
		$result = $query->result();
		if(!$array){
			return $query->result();
		}
		
		$return = array();
		foreach($result as $r){
			$return[$r->id] = $r;
		}
		return $return;
	}
	
	public function add($data) {
		$this->db->insert($this->table_name, $data);
		return $this->db->insert_id();
	}
	
	public function get_row($id) {
		$query = $this->db->get_where($this->table_name, array('id' => $id), 1);
		return $query->row();
	}
	
	public function edit($id, $data) {
		$this->db->where('id', $id);
		$this->db->update($this->table_name, $data);
		return $id;
	}
	
	public function delete($id) {
		$this->db->where('id', $id);
		$this->db->delete($this->table_name);
	}

}