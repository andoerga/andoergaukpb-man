<?php

class Mata_ujian_model extends CI_Model {

	private $table_name = 'ujian';
	private $view_name = 'v_mata_ujian';
	private $tipe_registrasi = 'tipe_registrasi';
	
	private $db;

	public function __construct() {
		parent::__construct();
		$this->db = $this->load->database('db', TRUE);
	}
	
	public function get_all($tipe_registrasi_id = false, $array = false) {
		if($tipe_registrasi_id){
			$this->db->where('tipe_registrasi_id', $tipe_registrasi_id);
		}
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
	
	public function add($data) {
		$this->db->insert($this->table_name, $data);
		return $this->db->insert_id();
	}
	
	public function get_row($id, $tipe_registrasi_id = false) {
		if($tipe_registrasi_id){
			$this->db->where('tipe_registrasi_id', $tipe_registrasi_id);
		}
		$query = $this->db->where('id', $id);
		$query = $this->db->get($this->view_name);
		return $query->row();
	}
	
	public function edit($id, $data) {
		$this->db->where('id_ujian', $id);
		$this->db->update($this->table_name, $data);
		return $id;
	}
	
	public function delete($id) {
		$this->db->where('id_ujian', $id);
		$this->db->delete($this->table_name);
	}
	
	public function get_tipe_registrasi_pambud() {
		$this->db->where('id LIKE "4%"');
		$query = $this->db->get($this->tipe_registrasi);
		return $query->result();
	}
	
	public function get_tipe_registrasi_pambel() {
		$this->db->where('id LIKE "32"');
		$query = $this->db->get($this->tipe_registrasi);
		return $query->result();
	}
	
	public function get_tipe_registrasi_pambel_bp() {
		$this->db->where('id LIKE "31"');
		$query = $this->db->get($this->tipe_registrasi);
		return $query->result();
	}
	
	public function get_by_tingkat($tingkat_id) {
		$this->db->where('tingkat_id', $tingkat_id);
		$this->db->order_by('urutan', 'asc');
		$query = $this->db->get($this->view_name);
		return $query->result();
	}

}