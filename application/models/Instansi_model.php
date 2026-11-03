<?php

class Instansi_model extends CI_Model {

	private $table_name = 'instansi';

	public function __construct() {
		parent::__construct();
		$this->db = $this->load->database('db', TRUE);
	}
	
	public function get_by_initial($initial){
		$this->db->where('initial', $initial);
		$query = $this->db->get($this->table_name);
		$result = $query->row();
		return $result;
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
	
	public function get_child($parent_array = false){
		$this->db->where_in('parent_id', $parent_array);
		$query = $this->db->get($this->table_name);
		return $query->result();
	}
	
	public function get_active($array = false) {
		$this->db->where('active', 1);
		$this->db->order_by('ordered_number', 'asc');
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
	
	public function get_filter($filter, $limit = false, $offset = false, $order_column = false, $order_method = false){
		$this->filtering($filter);
		
		if($limit){
		$this->db->limit($limit, $offset);
		}
		if($order_column){
		$this->db->order_by($order_column, $order_method);
		}
		
		$query = $this->db->get($this->view_name);
		$result = $query->result();
		return $query->result();
	}
	
	private function filtering($filter){
		$masking_field = array('doc_design', 'doc_surat_tugas', 'doc_laporan', 'doc_biodata', 'doc_hasil');
		$masking_field2 = array('status_kegiatan');
		
		foreach($filter as $f){
			if(in_array($f['name'], $masking_field)){
				if($f['value'] == 'true'){
					$this->db->where('TRIM(' . $f['name'] . ') <> ""');
				}else if($f['value'] == 'false'){
					$this->db->where('(' . $f['name'] . ' = "" OR ' . $f['name'] . ' IS NULL)');
				}
			}if(in_array($f['name'], $masking_field2)){
				if($f['value'] == 'true'){
					$this->db->where($f['name'], 1);
				}else if($f['value'] == 'false'){
					$this->db->where($f['name'], 0);
				}
			}else if(isset($f['method'])){
				if($f['method'] == 'like'){
					$this->db->where('(TRIM(' . $f['name'] . ') = "" OR ' . $f['name'] . ' IS NULL)');
				}else{
					$this->db->like($f['name'], $f['value']);
				}
			}else{
				$this->db->like($f['name'], $f['value']);
			}
		}
	}
	
	public function get_available_id($parent_id){
		$parent_array = array($parent_id);
		$return = array($parent_id);
		$stop = false;
		do{
			$child = $this->get_child($parent_array);
			$parent_array = array();
			if($child){
				foreach($child as $c){
					$parent_array[] = $c->id;
					$return[] = $c->id;
				}
			}else{
				$stop = true;
			}
		}while(!$stop);
		
		return $return;
			
	}
	
	public function get_available($parent_id){
		$parent = $this->get_row($parent_id);
		if(!$parent){
			return false;
		}
		$return[0] = array($parent);
		$parent_array = array($parent_id);
		$stop = false;
		do{
			$child = $this->get_child($parent_array);
			if($child){
				$parent_array = array();
				foreach($child as $c){
					$return[$c->parent_id][] = $c;
					$parent_array[] = $c->id;
				}
			}else{
				$stop = true;
			}
		}while(!$stop);
		
		return $return;
	}

}