<?php

class Nilai_model extends CI_Model {

	private $table_name = 'ujian_log';
	private $view_name = 'v_ujian_log';
	private $table_soal = 'soal';
	private $view_soal = 'v_soal';
	
	private $db;

	public function __construct() {
		parent::__construct();
		$this->db = $this->load->database('db', TRUE);
	}
	
	public function get_all($array = false) {
		$query = $this->db->get($this->view_name);
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
		return $this->db->count_all($this->view_name);
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
					$this->db->like($f['name'], $f['value']);
				}else{
					$this->db->where($f['name'] . ' ' . $f['method'], $f['value']);
				}
			}else{
				if(is_array($f['value'])){
					$this->db->where_in($f['name'], $f['value']);
				}else{
					$this->db->like($f['name'], $f['value']);
				}
			}
		}
		$this->db->where('user_id >= ','1517');
	}
	
	public function count_filter($filter){
		$this->filtering($filter);
		
		return $this->db->count_all_results($this->view_name);
	}
	
	public function get_filter($filter, $limit, $offset, $order_column, $order_method){
		$this->filtering($filter);
		
		$this->db->limit($limit, $offset);
		$this->db->order_by($order_column, $order_method);
		
		$query = $this->db->get($this->view_name);
		$result = $query->result();
		return $query->result();
	}
	
	public function get_row($id) {
		$query = $this->db->get_where($this->view_name, array('id' => $id), 1);
		return $query->row();
	}
	
	public function get_soal($id_ujian, $tipe_soal){
		$this->db->where('ujian_id', $id_ujian);
		$this->db->where('tipe_soal', $tipe_soal);
		$query = $this->db->get($this->view_soal);
		return $query->result();
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
	
	public function get_unprocessed($limit = 10){
		$this->db->where('time_left < 1');
		$this->db->where('nilai is null');
		$this->db->limit($limit);
		$this->db->order_by('id ASC');
		$query = $this->db->get($this->view_name);
		return $query->result();
	}

}