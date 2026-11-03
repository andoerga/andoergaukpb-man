<?php

class Faq_model extends CI_Model {

	private $table_name = 'faq';
	private $view_name = 'v_faq';

	public function __construct() {
		parent::__construct();
		$this->db = $this->load->database('db', TRUE);
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
	
	public function count_all(){
		return $this->db->count_all($this->table_name);
	}
	
	private function filtering($filter){
		//$masking_field = array('doc_design', 'doc_surat_tugas', 'doc_laporan', 'doc_biodata', 'doc_hasil');
		
		foreach($filter as $f){
			/*
			if(in_array($f['name'], $masking_field)){
				if($f['value'] == 'true'){
					$this->db->where('TRIM(' . $f['name'] . ') <> ""');
				}else if($f['value'] == 'false'){
					$this->db->where('(' . $f['name'] . ' = "" OR ' . $f['name'] . ' IS NULL)');
				}
			}else */
			if(isset($f['method'])){
				if($f['method'] == 'like'){
					$this->db->like($f['name'], $f['value']);
				}else{
					$this->db->where($f['name'], $f['value']);
				}
			}else{
				$this->db->where($f['name'], $f['value']);
			}
		}
	}
	
	public function count_filter($filter){
		$this->filtering($filter);
		
		return $this->db->count_all_results($this->table_name);
	}
	
	public function get_filter($filter, $limit = 5, $offset = 0, $order_column = 'id', $order_method = 'ASC'){
		$this->filtering($filter);
		
		$this->db->limit($limit, $offset);
		$this->db->order_by($order_column, $order_method);
		
		$query = $this->db->get($this->table_name);
		$result = $query->result();
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

}