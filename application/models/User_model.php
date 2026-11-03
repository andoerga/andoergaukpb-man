<?php

class User_model extends CI_Model {

	private $table_name = 'user';

	public function __construct() {
		parent::__construct();
		$this->db = $this->load->database('db', TRUE);
	}
	
	public function get_all() {
		$query = $this->db->get($this->table_name);
		return $query->result();
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
	
	public function check_login($username, $password){
		$query = $this->db->get_where($this->table_name, array('username' => $username), 1);
		$row = $query->row();
		if(!is_object($row)){
			return false;
		}
		if($row->password != $password){
			return false;
		}
		return $row;
	}

}