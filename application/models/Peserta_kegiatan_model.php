<?php

class Peserta_kegiatan_model extends CI_Model {

	private $table_name = 'peserta_kegiatan';
	private $view_name = 'v_peserta_kegiatan';

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
		return $this->db->count_all($this->view_name);
	}
	
	private function filtering($filter){
		$masking_field = array('doc_design', 'doc_surat_tugas', 'doc_laporan', 'doc_biodata', 'doc_hasil');
		
		foreach($filter as $f){
			if(in_array($f['name'], $masking_field)){
				if($f['value'] == 'true'){
					$this->db->where('TRIM(' . $f['name'] . ') <> ""');
				}else if($f['value'] == 'false'){
					$this->db->where('(' . $f['name'] . ' = "" OR ' . $f['name'] . ' IS NULL)');
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
	
	public function count_filter($filter){
		$this->filtering($filter);
		
		return $this->db->count_all_results($this->view_name);
	}
	
	public function get_filter($filter, $limit = null, $offset = null, $order_column = null, $order_method = 'ASC'){
		$this->filtering($filter);
		
		if($limit){
			if($offset){
				$this->db->limit($limit, $offset);
			}else{
				$this->db->limit($limit);
			}
		}
		
		if($order_column){
			$this->db->order_by($order_column, $order_method);
		}
		
		$query = $this->db->get($this->view_name);
		$result = $query->result();
		return $query->result();
	}
	
	public function add($data) {
		$this->db->insert($this->table_name, $data);
		return $this->db->insert_id();
	}
	
	public function get_row($id, $array = false) {
		$query = $this->db->get_where($this->view_name, array('id' => $id), 1);
		if($array){
			return $query->row_array();
		}else{
			return $query->row();
		}
		
	}
	
	public function edit($id, $data) {
		$this->db->where('id', $id);
		$this->db->update($this->table_name, $data);
		return $id;
	}
	
	public function delete($kegiatan_id, $peserta_id) {
		$this->db->where('kegiatan_id', $kegiatan_id);
		$this->db->where('peserta_id', $peserta_id);
		$this->db->delete($this->table_name);
	}
	
	public function get_by_kegiatan($id){
		$this->db->select('*');
		$this->db->where('kegiatan_id',$id);
		return $this->db->get($this->view_name)->result();
	}
	
	public function insert_if_not_exist($kegiatan_id, $peserta_id, $jenis_peserta_id){
		$this->db->select('*');
		$this->db->where('kegiatan_id', $kegiatan_id);
		$this->db->where('peserta_id', $peserta_id);
		$row = $this->db->get($this->table_name)->row();
		if($row){
			return array(
				'success' => false,
				'code' => 'duplicate',
				'message' => 'Already Exists'
			);
		}
		
		$insert_id = $this->add(array(
			'kegiatan_id' => $kegiatan_id,
			'peserta_id' => $peserta_id,
			'jenis_peserta_id' => $jenis_peserta_id
		));
		if(!$insert_id){
			return array(
				'success' => false,
				'code' => 'error',
				'message' => 'Insert Error'
			);
		}
		$row = $this->get_row($insert_id, true);
		return array(
			'success' => true,
			'code' => 'success',
			'data' => $row
		);
		
	}

}